<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;

class FileManagerController extends Controller
{
    public function index(){
        return view('pages.file-manager.index');
    }
}
