<?php

use Illuminate\Support\Facades\Route;
use Ntlong050801\FileManager\app\Http\Controllers\AjaxController;
use Ntlong050801\FileManager\app\Http\Controllers\FileManagerController;


Route::middleware('web')->group(function () {
    Route::prefix('file-manager')->group(function () {
        Route::get('/', [FileManagerController::class, 'index'])->name('file-manager.index');

        Route::get('/download-file', [FileManagerController::class, 'downloadFile'])->name('file-manager.download-file');
        Route::get('/download-multiple-files', [FileManagerController::class, 'downloadMultipleFile'])->name('file-manager.download-multiple-file');
        Route::get('/preview-file', [FileManagerController::class, 'preview'])->name('file-manager.preview');
        Route::get('image-preview/{pathFile}', [FileManagerController::class, 'showImageFromStorage'])
            ->where('pathFile', '.*')->name('file-manager.show-image-from-storage');


    });
    Route::prefix('ajax')->group(function () {
        Route::get('/children', [AjaxController::class, 'getChildren'])->name('ajax.get-children');
        Route::post('/store-folder', [AjaxController::class, 'storeFolder'])->name('ajax.store-folder');
        Route::patch('/rename', [AjaxController::class, 'rename'])->name('ajax.rename');
        Route::post('/upload-file', [AjaxController::class, 'uploadFile'])->name('ajax.upload-file');

        Route::patch('/put-file-trash', [AjaxController::class, 'trash'])->name('ajax.put-file-trash');
        Route::delete('/destroy', [AjaxController::class, 'destroy'])->name('ajax.destroy');

        Route::post('/update-permission', [AjaxController::class, 'permission'])->name('ajax.update-permission');
        Route::get('/load-folder-remove', [AjaxController::class,'loadFolderRemove'])->name('ajax.load-folder-remove');
        Route::patch('/move-file-to-folder', [AjaxController::class,'moveFile'])->name('ajax.move-file');

        Route::get('/search',[AjaxController::class,'search'])->name('ajax.search');
    });
});

