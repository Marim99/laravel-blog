<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginWithGithubController;
use App\Http\Controllers\LoginWithGoogleController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/deletedPosts/', [PostController::class, 'showDeletedPosts'])->name('posts.showDeletedPosts');
    Route::get('/posts/deletedPosts/forceDelete', [PostController::class, 'forceDeleteAllPosts'])->name('posts.forceDeleteAllPosts');
    Route::get('/posts/deletedPosts/restoreAllPosts', [PostController::class, 'restoreAllPosts'])->name('posts.restoreAllPosts');
    Route::delete('/posts/{post}/{comment}', [CommentController::class, 'delete'])->name('comments.delete');
    // Route::delete('/posts/{post}/{tag}', [PostController::class, 'deleteTag'])->name('comments.delete');
    Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit/', [PostController::class, 'edit'])->name('posts.edit');
    Route::delete('/posts/{post}/tags/{tag}', [PostController::class, 'deleteTag'])->name('posts.tags.detach');
    Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/deleteOldPosts', [PostController::class, 'deleteOldPosts'])->name('posts.deleteOldPosts');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/restore', [PostController::class, 'restorePost'])->name('posts.restorePost');
    // Route::post('/posts/{post}', [CommentController::class, 'create'])->name('comments.create');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Google API routes 
Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);


// Github API routes
Route::get('/auth/redirect', [LoginWithGithubController::class,'redirectToGithub']);
 
Route::get('/auth/callback', [LoginWithGithubController::class, 'handleGithubCallback']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
