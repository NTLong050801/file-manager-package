<?php

use Illuminate\Support\Facades\Route;
use Ntlong050801\FileManager\app\Http\Controllers\AjaxController;
use Ntlong050801\FileManager\app\Http\Controllers\FileManagerController;


Route::prefix('file-manager')->group(function (){
    Route::get('/',[FileManagerController::class,'index'])->name('file-manager.index');
});
Route::prefix('ajax')->group(function (){
   Route::get('/{fileManager}/children',[AjaxController::class,'getChildren'])->name('ajax.get-children');
});
