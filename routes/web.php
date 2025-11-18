<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RaffleController;
use App\Http\Middleware\EnsureIsBlogOwner;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasMinimumRole;
use App\Http\Controllers\UserController;


Route::controller(BlogController::class)
    ->prefix('blogs')
    ->name('blogs.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/{id}/like', 'like')
            ->middleware('auth')
            ->name('like');

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



Route::controller(RaffleController::class)
    ->name('raffles.')
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
        Route::view('/', 'dashboard.index')->name('index');



        // USER PROFILE
        Route::view('/my-profile', 'dashboard.my-profile')->name('my-profile.show');
        Route::get('/profiles', [UserController::class, 'all_users'])->name('all-users')
            ->middleware(EnsureUserHasMinimumRole::class.':4');
        Route::get('/profiles/{id}', [UserController::class, 'user_profile'])->name('user-profile.show')
            ->middleware(EnsureUserHasMinimumRole::class.':4');



        // USER PERSONAL BLOGS
        Route::get('/blogs', [BlogController::class, 'admin_my_blogs'])
            ->middleware(EnsureUserHasMinimumRole::class.':2')
            ->name('blogs');
        Route::post('/blogs/create', [BlogController::class, 'store'])
            ->middleware(EnsureUserHasMinimumRole::class.':2')
            ->name('blogs.store');
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])
            ->middleware([EnsureUserHasMinimumRole::class.':2', EnsureIsBLogOwner::class])
            ->name('blogs.edit');
        Route::post('/blogs/{id}/update', [BlogController::class, 'update'])
            ->middleware([EnsureUserHasMinimumRole::class.':2', EnsureIsBLogOwner::class])
            ->name('blogs.update');
        Route::post('/blogs/{blog}/request-publish', [BlogController::class, 'request_publish'])
            ->middleware([EnsureUserHasMinimumRole::class.':2', EnsureIsBLogOwner::class])
            ->name('blogs.request_publish');
        Route::post('/blogs/{blog}/delete', [BlogController::class, 'destroy'])
            ->middleware([EnsureUserHasMinimumRole::class.':2', EnsureIsBLogOwner::class])
            ->name('blogs.destroy');
        Route::post('/blogs/{blog}/move-to-draft', [BlogController::class, 'move_to_draft'])
            ->middleware([EnsureUserHasMinimumRole::class.':2', EnsureIsBLogOwner::class])
            ->name('blogs.move_to_draft');



        // BLOG REQUESTS & PUBLISHING
        Route::get('/blogs/publish-requests', [BlogController::class, 'publish_requests'])
            ->middleware(EnsureUserHasMinimumRole::class.':4')
            ->name('blogs.publish_requests');
        Route::post('/blogs/{blog}/publish', [BlogController::class, 'publish'])
            ->middleware(EnsureUserHasMinimumRole::class.':4')
            ->name('blogs.publish');
        Route::post('/blogs/handle-publish-request-result/{blog}', [BlogController::class, 'handle_publish_request_result'])
            ->middleware(EnsureUserHasMinimumRole::class.':4')
            ->name('blogs.handle_publish_request_result');

        // RAFFLES
        Route::get('/my-raffles', [RaffleController::class, 'my_raffles'])
            ->middleware(EnsureUserHasMinimumRole::class.':3')
            ->name('my-raffles');
    });
