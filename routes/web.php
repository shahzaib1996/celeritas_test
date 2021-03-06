<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function (){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::resource('category', PostCategoryController::class)->except(['destroy']);
    Route::get('category/{category}', [PostCategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('posts/category/{id}', [PostCategoryController::class, 'showPosts'])->name('category.posts');
    
    Route::resource('post', PostController::class)->except(['destroy']);
    Route::get('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('post/detail/{slug}', [PostController::class, 'show'])->name('post.show');
    Route::post('post/{post}/comment/add', [PostController::class, 'comment'])->name('post.comment');
    
});

