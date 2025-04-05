<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{slug}', [PostController::class, 'post'])->name('post');
Route::get('/posts/category/{slug}', [PostController::class, 'posts'])->name('posts.category');
Route::get('/posts/author/{username}', [PostController::class, 'posts'])->name('posts.author');
Route::get('/posts/popular', [PostController::class, 'posts'])->name('posts.popular');
Route::get('/posts/unggulan', [PostController::class, 'posts'])->name('posts.featured');
Route::get('/posts/search', [PostController::class, 'posts'])->name('posts.search');
Route::post('/post/comment', [PostController::class, 'comment'])->name('post.comment');


Route::fallback(function () {
    return redirect()->back();
});
