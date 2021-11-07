<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PostController::class, 'index'])->name('home');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])
        ->name('logout');

    Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store']);

    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('create-post')
        ->middleware('admin');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('store-post')
        ->middleware('admin');

    Route::get('/posts/dashboard', [PostController::class, 'dashboard'])
        ->name('dashboard-post')
        ->middleware('admin');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('edit-post')
        ->middleware('admin');

    Route::patch('/posts/{post}', [PostController::class, 'update'])
        ->name('update-post')
        ->middleware('admin');

    Route::delete('/posts/{post}/delete', [PostController::class, 'delete'])
        ->name('delete-post')
        ->middleware('admin');
});

Route::get('/posts/{post:slug}', [PostController::class, 'show'])
    ->name('show-post');
