<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RuffleController;
use Illuminate\Support\Facades\Route;



Route::controller(BlogController::class)
    ->prefix('blogs')
    ->name('blogs.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');

        Route::middleware('auth')->group(function () {
            // Route::get('/create', 'create');
            // Route::post('/create', 'store');;
            // Route::post('/{id}/edit', 'edit')->name('edit');
            // Route::post('/{id}/update', 'update')->name('update');
            // Route::get('/{id}/preview', 'preview')->name('preview')
            // Route::post('/{id}/send_to_validate', 'send_to_validate')->name('send');
            // Route:.get('/{id}/delete', 'delete')->name('delete');
            // Route::post('/{id}/delete', 'destroy')->name('destroy');
        });
    });



Route::controller(RuffleController::class)
    ->name('ruffles.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
    });



Route::controller(AuthController::class)
    ->name('auth.')
    ->group(function () {

        Route::view('/login', 'auth.login')->name('login.show');
        Route::post('/login', 'login')->name('login');

        Route::view('/register', 'auth.register')->name('register.show');
        Route::post('/register', 'register')->name('register');

        Route::post('/logout', 'logout')->name('logout');
    });



Route::middleware('auth')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', function () { // Sorry, but I'm not creating a controller for 1 single route...
            return view('dashboard.index');
        })->name('index');

        Route::get('/blogs', [BlogController::class, 'admin_my_blogs'])->name('blogs');
        Route::post('/blogs/create', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::post('/blogs/{id}/update', [BlogController::class, 'update'])->name('blogs.update');
        Route::post('/blogs/{blog}/request-publish', [BlogController::class, 'request_publish'])->name('blogs.request_publish');
        Route::post('/blogs/{blog}/publish', [BlogController::class, 'publish'])->name('blogs.publish');

        Route::get('/blogs/publish-requests', [BlogController::class, 'publish_requests'])->name('blogs.publish_requests');

        Route::post('/blogs/publish-requests/{blog}/deny', [BlogController::class, 'deny_publish'])->name('blogs.deny_publish');
        Route::post('/blogs/publish-requests/{blog}/allow', [BlogController::class, 'allow_publish'])->name('blogs.allow_publish');
        Route::post('/blogs/{blog}/delete', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });
