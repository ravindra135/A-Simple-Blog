<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [App\Http\Controllers\AdminPostsController::class, 'post'])->name('post');

Route::get('/admin', function (){

   return view('admin.index');

})->name('admin');

Route::group(['middleware'=>'admin'], function(){

    Route::resource('/admin/users', '\App\Http\Controllers\AdminUsersController');

    Route::resource('/admin/posts', '\App\Http\Controllers\AdminPostsController');

    Route::resource('/admin/categories', '\App\Http\Controllers\AdminCategoriesController');

    Route::resource('/admin/media', '\App\Http\Controllers\AdminMediasController');

    Route::resource('admin/comments', '\App\Http\Controllers\PostCommentsController');

    Route::resource('admin/comment/replies', '\App\Http\Controllers\CommentRepliesController');

});

Route::group(['middleware'=>'auth'], function (){

    Route::post('/comment/reply', [\App\Http\Controllers\CommentRepliesController::class, 'reply'])->name('comment.reply');

});
