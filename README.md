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

Public 
```bash
php artisan vendor:publish --tag=file-manager --force
```
Make a blade example: 
Route:
```bash
  Route::prefix('document-manager')->group(function (){
       Route::get('/',[DocumentManagerController::class,'index'])->name('document-manager.index');
  });
```
  And DocumentManagerController function Index() :
```bash
  public function index(){
        $html = app('router')->getRoutes()->match(app('request')->create(route('file-manager.index')))->run();
        return view('pages.document-manager.index',compact('html'));
  }
```
  Note: route('file-manager.index') is return view file manager

  In view pages.document-manager.index :
```bash
    @extends('layouts.main')
    @section('content')
        {!! $html; !!}
    @endsection
```

## Usage
View affter:
![image](https://github.com/NTLong050801/file-manager-package/assets/90180848/99f2b0ce-20d4-491a-af4a-2d1afbce4227)


  
