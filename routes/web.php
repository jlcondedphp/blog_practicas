<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::middleware();
Route::get('/', [\App\Http\Controllers\PostController::class, 'home'])->name('home');


Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'detail'])->name('posts.detail');
Auth::routes();

Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

Route::group(['middleware'=>'admin'], function () {
    Route::resource('/admin/posts', \App\Http\Controllers\PostController::class);
    Route::resource('/admin/roles', \App\Http\Controllers\RolesController::class);   
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
