# Document Manager Package

## Installation

Install the package using Composer:

```bash
composer require ntlong050801/file-manager
```

Run migrate:

```bash
php artisan migrate
```

Public Css/ Js
```bash
php artisan vendor:publish --tag=css --force
php artisan vendor:publish --tag=js --force
```
Make a blade example: 
  Route::prefix('document-manager')->group(function (){
       Route::get('/',[DocumentManagerController::class,'index'])->name('document-manager.index');
  });
  And DocumentManagerController function Index() :
  public function index(){
        $html = app('router')->getRoutes()->match(app('request')->create(route('file-manager.index')))->run();
        return view('pages.document-manager.index',compact('html'));
  }
  Note: route('file-manager.index') is return view file manager

  In view pages.document-manager.index :
    @extends('layouts.main')
    @section('content')
        {!! $html; !!}
    @endsection


  
