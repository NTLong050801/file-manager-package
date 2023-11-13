<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ntlong050801\FileManager\app\Models\FileManager;

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
}
