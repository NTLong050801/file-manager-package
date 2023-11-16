<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ntlong050801\FileManager\app\Jobs\DownloadFileJob;
use Ntlong050801\FileManager\app\Models\FileManager;
use ZipArchive;

class AjaxController extends Controller
{
    public function getChildren(Request $request)
    {
        $query = FileManager::query();
        $finalPath = null;
        $type = $request->input('type');
        $isTrash = false;
        if ($type == 'deleted-folder') {
            $childrens = $query->where('user_id', $request->input('user_id'))->where('is_direct_deleted', 1)->get();
            $isTrash = true;
        } else {
            if (empty($request->input('parent_id'))) {
                $parent = $query->where('user_id', $request->input('user_id'))->whereNull('parent_id')->first();
            } else {
                $parent = $query->where('id', $request->input('parent_id'))->first();
            }
            $childrens = $parent?->children()->where('is_trash', 0)->get()->reverse(); //reverse()

            $folderPath = $parent?->file_path;
            if (!empty($folderPath)) {
                $segments = explode('/', $folderPath);

                foreach ($segments as $key => &$segment) {
                    $fileManager = FileManager::where('name', 'LIKE', $segment)->where('user_id', $parent->user_id)->first();

                    if ($key === 0) {
                        $segment = null;
                    } elseif ($key === 1) {
                        $segment = '<a href="#" class="show-children" data-id="'.$fileManager?->id.'">Tài liêu</a>';
                    } else {
                        $segment = '<span class="svg-icon svg-icon-2 svg-icon-primary mx-1">
                        <img src="'.asset('assets/media/icons/duotune/arrows/arr071.svg').'" alt="">
                    </span>'.'<a href="#" class="show-children" data-id="'.$fileManager?->id.'">'.$segment.'</a>';
                    }

                }
                $finalPath = implode('', $segments);
            }
        }

        $view = view('file-manager::pages.file-manager.components.folder', compact('childrens','isTrash'))->render();
        return response()->json([
            'view' => $view,
            'folder_path' => $finalPath,
            'count_children' => $childrens?->count(),
        ]);
//        return view('file-manager::pages.file-manager.components.folder', compact('childrens'));
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        try {
            $name = $request->input('name');
            if (empty($request->input('parent_id'))) {
                $parent = FileManager::where('user_id', $request->input('user_id'))->whereNull('parent_id')->first();
            } else {
                $parent = FileManager::find($request->input('parent_id'));
            }
            $path = $parent->file_path."/$name";
            Storage::makeDirectory($path);
            FileManager::create([
                'name' => $name,
                'file_path' => $path,
                'parent_id' => $request->input('parent_id'),
                'user_id' => $request->input('user_id'),
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function rename(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'id' => ['required', 'integer']
        ]);
        try {
            $file = FileManager::findOrFail($request->input('id'));
            $currentFilePath = $file->file_path;
            $newFileName = $request->input('name');
            $directory = pathinfo($currentFilePath, PATHINFO_DIRNAME);
            $newFilePath = $directory.'/'.$newFileName;
            if (!empty($file->file_type)) {
                $newFilePath = $newFilePath.".$file->file_type";
            }
            Storage::move($currentFilePath, $newFilePath);

            $file->update([
                'name' => $newFileName,
                'file_path' => $newFilePath,
            ]);
            $this->updateFilePathWhenRename($file, $currentFilePath, $newFilePath);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:doc,csv,xlsx,xls,docx,pdf,ppt,odt,ods,odp,jpeg,png,jpg,gif|max:1024',

            'parent_id' => ['required', 'integer'],
        ]);
        $parentId = $request->input('parent_id');
        $path = FileManager::findOrFail($parentId)->file_path;
        foreach ($request->file('files') as $file) {
            // Get the file size in bytes
            $fileSize = $file->getSize();
            $fileType = $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            Storage::putFileAs($path, $file, $originalName);

            // For example, assuming you have a FileManager model:
            FileManager::create([
                'name' => $name,
                'file_path' => $path.'/'.$originalName,
                'file_type' => $fileType,
                'file_size' => $fileSize,
                'parent_id' => $parentId,
                'user_id' => $request->input('user_id'),
            ]);
        }

    }

    public function downloadFile(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'type' => ['required',Rule::in(['all-folder', 'deleted-folder'])]
        ]);
        $file = FileManager::findOrFail($request->input('id'));
        $path = $file->file_path;
        $isTrash = ($request->input('type') === 'deleted-folder');
        
        if (Storage::exists($path)) {
            if (empty($file->file_type)) {
                $pathZip = storage_path('app/'.$file->name.'.zip');
                if (Storage::exists($pathZip)) {
                    Storage::delete($pathZip);
                }
                DownloadFileJob::dispatch($file,$isTrash)->delay(now()->addSeconds(30));
                return response()->download($pathZip)->deleteFileAfterSend();
            } else {
                return response()->download(storage_path('app/'.$path));
            }
        } else {
            abort('404');
        }
    }

    public function trash(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'value' => ['required', Rule::in(['0', '1'])],
            'is_direct_deleted' => ['required', Rule::in(['0', '1'])]
        ]);
        try {
            $file = FileManager::findOrFail($request->input('id'));
            $root = FileManager::root();
            if ($file->parent->is_direct_deleted) {
                $originalFilePath = $file->file_path;
                $destinationDirectory = $root->file_path;
                $filename = pathinfo($originalFilePath, PATHINFO_BASENAME);
                $destinationPath = $destinationDirectory.'/'.$filename;
                Storage::move($originalFilePath, $destinationPath);
                $file->update([
                    'parent_id' => $root->id,
                    'file_path' => $root->file_path.'/'.$file->name,
                ]);
            }
            $file->update([
                'is_direct_deleted' => $request->input('is_direct_deleted'),
            ]);
            $this->updateIsTrash($file, $request->input('value'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);
        try {
            $file = FileManager::find($request->input('id'));
            $filePath = $file->file_path;
            if (!empty($filePath)) {
                Storage::delete($filePath);
            } else {
                Storage::deleteDirectory($filePath);
            }
            $file->delete();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    private function updateIsTrash(FileManager $fileManager, $value)
    {
        $fileManager->update([
            'is_trash' => $value,
        ]);
        foreach ($fileManager->children as $child) {
            $this->updateIsTrash($child, $value);
        }
    }

    private function updateFilePathWhenRename(FileManager $fileManager, $oldFilePath, $newFilePath)
    {
        foreach ($fileManager->children as $child) {
            $path = $child->file_path;
            $newPath = str_replace($oldFilePath, $newFilePath, $path);
            $child->update([
                'file_path' => $newPath,
            ]);
            $this->updateFilePathWhenRename($child, $oldFilePath, $newFilePath);
        }
    }

}
