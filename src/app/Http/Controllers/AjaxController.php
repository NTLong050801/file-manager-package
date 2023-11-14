<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ntlong050801\FileManager\app\Jobs\DownloadFileJob;
use Ntlong050801\FileManager\app\Models\FileManager;
use ZipArchive;

class AjaxController extends Controller
{
    public function getChildren(Request $request)
    {
        if (empty($request->input('parent_id'))) {
            $parent = FileManager::where('user_id', $request->input('user_id'))->whereNull('parent_id')->first();
        } else {
            $parent = FileManager::find($request->input('parent_id'));
        }

        $childrens = $parent->children;
        $view = view('file-manager::pages.file-manager.components.folder', compact('childrens'))->render();
        $folderPath = $parent->file_path;
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
        return response()->json([
            'view' => $view,
            'folder_path' => $finalPath,
            'count_children' => $childrens->count(),
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
            $path = FileManager::find($request->input('parent_id'))->file_path."/$name";
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
            'file_manager' => ['required', 'integer']
        ]);
        $file = FileManager::findOrFail($request->input('file_manager'));
        if (!empty($file)) {
            $file->update([
                'name' => $request->input('name'),
            ]);
        }
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,png,pdf|max:1024',
            'parent_id' => ['required', 'integer'],
        ]);
        $parentId = $request->input('parent_id');
        $path = FileManager::findOrFail($parentId)->file_path;
        foreach ($request->file('files') as $file) {
            // Get the file size in bytes
            $fileSize = $file->getSize();
            $fileType = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();

            Storage::putFileAs($path, $file, $name);

            // For example, assuming you have a FileManager model:
            FileManager::create([
                'name' => $name,
                'file_path' => $path.'/'.$name,
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
            'id' => ['required', 'integer']
        ]);
        $file = FileManager::findOrFail($request->input('id'));
        $path = $file->file_path;
        if (Storage::exists($path)) {
            if (empty($file->file_type)) {
                $pathZip = storage_path('app/'.$file->name.'.zip');
                if (Storage::exists($pathZip)) {
                    Storage::delete($pathZip);
                }
                DownloadFileJob::dispatch($file)->delay(now()->addSeconds(30));
                return response()->download($pathZip)->deleteFileAfterSend();
            } else {
                return response()->download(storage_path('app/'.$path));
            }
        } else {
            abort('404');
        }
    }
}
