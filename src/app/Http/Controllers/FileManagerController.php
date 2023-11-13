<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ntlong050801\FileManager\app\Models\FileManager;

class FileManagerController extends Controller
{
    public function index(){
        $parent = FileManager::where('user_id',auth()->id())->first();
        return view('file-manager::pages.file-manager.index',compact('parent'));
    }
}
