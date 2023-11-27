<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ntlong050801\FileManager\app\Models\FileManager;
use Ntlong050801\FileManager\app\Models\User;


class AjaxController extends Controller
{

    public function getChildren(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(FileManager::LIST_TYPE_FOLDER)],
        ]);
        $query = FileManager::query();
        $finalPath = null;
        $isTrash = false;
        $isShare = false;
        $type = $request->input('type');
        $userId = auth()->id() ?? $request->input('user_id');
        $parentId = $request->input('parent_id');
        $user = User::find($userId);
        switch ($type) {
            case  FileManager::TYPE_DELETE_FOLDER:
            {
                $children = $query->where('user_id', $userId)->where('is_direct_deleted', 1)->get();
                $isTrash = true;
                break;
            }
            case FileManager::TYPE_PRIVATE_FOLDER:
            {
                if (empty($parentId)) {
                    $parent = $query->where('user_id', $userId)->whereNull('parent_id')->first();
                } else {
                    $parent = $query->where('id', $parentId)->first();
                }
                $children = $parent?->children()->where('is_trash', false)->get()->reverse();
                $finalPath = $this->processFolderPath($parent);
                break;
            }
            case FileManager::TYPE_SHARE_FOLDER :
            {
                $parent = $user->files->where('pivot.is_click_permission', true)->where('is_trash', false);
                if (!empty($parentId)) {
                    $children = $user->files->where('pivot.is_click_permission', false)->where('parent_id', $parentId)->where('is_trash', false);
                    $finalPath = $this->processFolderPath(FileManager::find($parentId));
                } else {
                    $children = $parent;
                    $finalPath = $this->processFolderPath(null);
                }
                $isShare = true;
                break;
            }
            default :
            {
                if (!empty($parentId) && $parentId != (FileManager::where('user_id', $userId)->whereNull('parent_id')->first()->id)) {
                    if (!empty($user->files) && $user->files->where('pivot.file_id', $parentId)->count() > 0) {
                        $children = $user->files->where('pivot.is_click_permission', false)->where('parent_id', $parentId)->where('is_trash', false);
                        $finalPath = $this->processFolderPath(FileManager::find($parentId));
                    } else {
                        $parent = $query->where('id', $parentId)->first();
                        $children = $parent?->children()->where('is_trash', false)->get()->reverse();
                        $finalPath = $this->processFolderPath($parent);
                    }
                } else {
                    $children = FileManager::where(function ($query) use ($userId, $parentId) {

                        // Các file thuộc sở hữu của bạn
                        if (empty($parentId)) {
                            $parentId = FileManager::root()->id;
                        }
                        $query->where('user_id', $userId)->where('parent_id', $parentId)->where('is_trash', false);
                        // Các file được chia sẻ với bạn
                        $query->orWhereHas('users', function ($query) use ($userId) {
                            $query->where('user_id', $userId)->where('is_click_permission', true)->where('is_trash', false);
                        });
                    })->orderByDesc('id')->get();
                }
            }
        }

        $users = User::all();
        $users = $users->reject(function ($user) use ($userId) {
            return $user->id == $userId;
        });
        $view = view('file-manager::pages.file-manager.components.folder', compact('children', 'isTrash', 'isShare', 'users', 'userId'))->render();
        return response()->json([
            'view' => $view,
            'folder_path' => $finalPath,
            'count_children' => $children?->count(),
        ]);
//        return view('file-manager::pages.file-manager.components.folder', compact('childrens'));
    }

    public function loadFolderRemove(Request $request)
    {
        $request->validate([
            'folder_id' => ['nullable', 'integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
            'file_id' => ['required', 'integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())]
        ]);
        $fileId = $request->input('file_id');
        $folderId = $request->input('folder_id');
        $parent = $folderId ? FileManager::find($folderId) : FileManager::root();
        $finalPath = $this->processFolderPath($parent);

        $folders = $parent->children
            ->whereNull('file_type')
            ->where('is_trash', false)
            ->reject(function ($folder) use ($fileId) {
                return $folder->id == $fileId;
            });

        $file = FileManager::find($fileId);
        $view = view('file-manager::pages.file-manager.components.content-modal-move-file', compact('folders', 'file', 'finalPath'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function moveFile(Request $request)
    {
        $request->validate([
            'file_id' => ['integer', 'required', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
            'folder_id' => ['nullable', 'integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())]
        ]);
        try {
            $file = FileManager::findOrFail($request->input('file_id'));
            $folderId = $request->input('folder_id');
            $parent = $folderId ? FileManager::find($folderId) : FileManager::root();
            $fileCount = $this->checkExitsNameInFolder($parent->id, $file->name);

            if ($fileCount >= 1) {
                return response()->json(['message' => "Đã tồn tại tên này trong thư mục"], 422);
            }
            $this->processMoveFile($file, $parent);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        try {
            $name = $request->input('name');
            if (empty($request->input('parent_id'))) {
                $parent = FileManager::root();
            } else {
                $parent = FileManager::find($request->input('parent_id'));
            }
            $fileCount = $this->checkExitsNameInFolder($parent->id, $name);
            if ($fileCount >= 1) {
                return response()->json(['message' => "Đã tồn tại tên này trong thư mục"], 422);
            }
            $path = $parent->file_path."/$name";
            Storage::makeDirectory($path);
            FileManager::create([
                'name' => $name,
                'file_path' => $path,
                'parent_id' => $parent->id,
                'user_id' => auth()->id(),
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function rename(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'id' => ['required', 'integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
        ]);
        try {
            $file = FileManager::findOrFail($request->input('id'));
            $fileCount = $this->checkExitsNameInFolder($file->parent_id, $request->input('name'));

            if ($fileCount >= 1) {
                return response()->json(['message' => "Đã tồn tại tên này trong thư mục"], 422);
            }
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
        $maxFileSize = config('file-manager.capacity_max_file_upload') * 1024;
        $request->validate([
            'file' => ['required', 'mimes:doc,csv,xlsx,xls,docx,pdf,ppt,odt,ods,odp,jpeg,png,jpg,gif', "max:$maxFileSize"],
        ]);
        try {
            if (empty($request->input('parent_id'))) {
                $parentId = FileManager::root()->id;
            } else {
                $parentId = $request->input('parent_id');
            }
            $path = FileManager::findOrFail($parentId)->file_path;
            $file = $request->file('file');
            $fileSize = $file->getSize();
            $fileType = $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            $fileCount = $this->checkExitsNameInFolder($parentId, $name);
            if ($fileCount >= 1) {
                return response()->json(['message' => "Đã tồn tại tên này trong thư mục"], 422);
            }
            $checkMemory = $this->checkMemory($fileSize);
            if (!$checkMemory){
                return response()->json(['message' => "Không đủ bộ nhớ để upload file"], 422);
            }
            Storage::putFileAs($path, $file, $originalName);
            // For example, assuming you have a FileManager model:
            FileManager::create([
                'name' => $name,
                'file_path' => $path.'/'.$originalName,
                'file_type' => $fileType,
                'file_size' => $fileSize,
                'parent_id' => $parentId,
                'user_id' => auth()->id(),
            ]);
            $this->updateMemoryUsed();
            return response()->json(['message' => 'Upload file thành công']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function trash(Request $request)
    {
        $request->validate([
            'ids' => ['array', 'required'],
            'value' => ['required', Rule::in(['0', '1'])],
            'is_direct_deleted' => ['required', Rule::in(['0', '1'])]
        ]);
        try {
            $idString = $request->input('ids')[0];
            $idArray = explode(',', $idString);
            foreach ($idArray as $id) {

                $validator = Validator::make(['id' => $id], [
                    'id' => ['required', 'integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()->first()], 422);
                }
                $file = FileManager::findOrFail($id);
                $root = FileManager::root();
                if ($file->parent->is_direct_deleted) {
                    $fileCount = $this->checkExitsNameInFolder($file->parent_id, $file->name);
                    if ($fileCount >= 1) {
                        $currentFilePath = $file->file_path;
                        $newFileName = $file->name.' ('.$fileCount.')';
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
                    }
                    $this->processMoveFile($file, $root);
                }
                $file->update([
                    'is_direct_deleted' => $request->input('is_direct_deleted'),
                ]);
                $this->updateIsTrash($file, $request->input('value'));
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'ids' => ['array', 'required'],
        ]);
        try {
            $idString = $request->input('ids')[0];
            $idArray = explode(',', $idString);
            foreach ($idArray as $id) {
                Validator::make(['id' => $id], [
                    'id.*' => ['required', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
                ])->validate();
                $file = FileManager::find($id);
                $filePath = $file->file_path;
                $this->destroyFileIsDirectDeleted($file);
                if (!empty($file->file_type)) {
                    Storage::delete($filePath);
                } else {
                    Storage::deleteDirectory($filePath);
                }
                $file->delete();
            }
            $this->updateMemoryUsed();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function permission(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'file_id' => ['required', 'integer', Rule::in(User::find(auth()->id())->file->where('is_trash', false)->pluck('id')->toArray())],
            'is_active' => ['required', 'boolean'],
        ]);
        try {
            $file = FileManager::find($request->input('file_id'));
            $parent = $file->parent;
            $user = User::find($request->input('user_id'));
            $isActive = $request->input('is_active');
            if ($isActive) {
                $isClickPermission = true;
                if ($user->files()->wherePivot('file_id', $parent->id)->exists()) {
                    $isClickPermission = false;
                }
                $file->users()->attach($user, ['is_click_permission' => $isClickPermission]);
            } else {
                $file->users()->detach($user);
            }
            $this->updatePermission($file, $user, $isActive);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function processMoveFile(FileManager $fileChildManager, FileManager $parentFileManager)
    {
        $originalFilePath = $fileChildManager->file_path;
        $destinationDirectory = $parentFileManager->file_path;
        $filename = pathinfo($originalFilePath, PATHINFO_BASENAME);
        $destinationPath = $destinationDirectory.'/'.$filename;
        Storage::move($originalFilePath, $destinationPath);
        $fileChildManager->update([
            'parent_id' => $parentFileManager->id,
            'file_path' => $destinationPath,
        ]);
        $this->updateFilePathWhenRename($fileChildManager, $originalFilePath, $destinationPath);
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

    private function destroyFileIsDirectDeleted(FileManager $fileManager)
    {
        $root = FileManager::root();
        foreach ($fileManager->children as $child) {
            if ($child->is_direct_deleted) {
                $originalFilePath = $child->file_path;
                $destinationDirectory = $root->file_path;
                $filename = pathinfo($originalFilePath, PATHINFO_BASENAME);
                $destinationPath = $destinationDirectory.'/'.$filename;
                Storage::move($originalFilePath, $destinationPath);
                $child->update([
                    'parent_id' => $root->id,
                    'file_path' => $root->file_path.'/'.$child->name,
                ]);
            }
            $this->destroyFileIsDirectDeleted($child);
        }
    }

    private function updatePermission(FileManager $fileManager, User $user, bool $isActive = false)
    {
        foreach ($fileManager->children as $child) {
            if ($isActive) {
                $child->users()->updateExistingPivot($user->id, ['is_click_permission' => false]);
                $child->users()->attach($user);
            } else {
                $child->users()->detach($user);
            }
            $this->updatePermission($child, $user, $isActive);
        }
    }

    private function processFolderPath(?FileManager $parent)
    {
        $finalPath = null;

        if ($parent) {
            $segments = [];
            $currentFolder = $parent;

            while ($currentFolder) {
                if ($currentFolder->parent) {
                    $segments[] = '<a href="#" class="show-children" data-id="'.$currentFolder->id.'">'.$currentFolder->name.'</a>';
                } else {
                    // If this is the last segment, set the name to "Tài liệu" and data-id to null
                    $segments[] = '<a href="#" class="show-children" data-id="'.null.'">Tài liệu</a>';
                }

                // Move to the parent folder
                $currentFolder = $currentFolder->parent;
            }

            // Reverse the array to get the correct order (from parent to child)
            $segments = array_reverse($segments);

            // Implode the segments to create the final path
            $finalPath = implode('<span class="svg-icon svg-icon-2 svg-icon-primary mx-1">
                        <img src="'.asset('assets/media/icons/duotune/arrows/arr071.svg').'" alt="">
                    </span>', $segments);
        }

        return $finalPath;
    }

    private function checkExitsNameInFolder(int $parentId, string $name)
    {
        $files = FileManager::where('parent_id', $parentId)->where('name', 'LIKE', $name)->get();
        return $files->count();
    }

    private function checkMemory(int $fileSize):bool
    {
        $user = Auth::user();
        // Tổng bộ nhớ đã sử dụng và bộ nhớ tối đa được phép
        $usedMemory = $user->used_memory;
        $maxMemory = $user->memory;

        $newMemoryUsage = $usedMemory + $fileSize;

        if ($newMemoryUsage <= $maxMemory) {
            return true;
        }
        return false;
    }

    private function updateMemoryUsed(){
        $user = User::find(auth()->id());
        $totalMemory = $user->getTotalFileSize();
        $user->update([
           'used_memory' => $totalMemory,
        ]);
    }
}
