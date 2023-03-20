<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
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
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::group(['middleware' => ['XssSanitization']], function () {
    Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit/', [PostController::class, 'edit'])->name('posts.edit');
});

Route::get('/posts/deletedPosts/', [PostController::class, 'showDeletedPosts'])->name('posts.showDeletedPosts');
Route::delete('/posts/{post}/{comment}', [CommentController::class, 'delete'])->name('comments.delete');
Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{post}/restore', [PostController::class, 'restorePost'])->name('posts.restorePost');
Route::post('/posts/{post}', [CommentController::class, 'create'])->name('comments.create');
