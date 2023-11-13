<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Ntlong050801\FileManager\app\Models\FileManager;

class AjaxController extends Controller
{
    public function getChildren(FileManager $fileManager)
    {
        $childrens = $fileManager->children;
        return view('file-manager::pages.file-manager.components.folder', compact('childrens'));
    }

    public function createFolder(Request $request){

    }
}
