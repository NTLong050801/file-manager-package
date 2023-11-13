<?php

use Illuminate\Support\Facades\Route;
use Ntlong050801\FileManager\app\Http\Controllers\AjaxController;
use Ntlong050801\FileManager\app\Http\Controllers\FileManagerController;


Route::prefix('file-manager')->group(function (){
    Route::get('/',[FileManagerController::class,'index'])->name('file-manager.index');
});
Route::prefix('ajax')->group(function (){
   Route::get('/children',[AjaxController::class,'getChildren'])->name('ajax.get-children');
   Route::post('/store-folder',[AjaxController::class,'storeFolder'])->name('ajax.store-folder');
});
