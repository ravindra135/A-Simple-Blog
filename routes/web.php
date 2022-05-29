<?php

use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/posts', [App\Http\Controllers\HomeController::class, 'index'])->name('home.posts');

Route::get('/posts/{id}', [App\Http\Controllers\AdminPostsController::class, 'post'])->name('post');


Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::resource('/admin/users', '\App\Http\Controllers\AdminUsersController');

    Route::resource('/admin/posts', '\App\Http\Controllers\AdminPostsController');
    Route::get('check_slug', [\App\Http\Controllers\AdminPostsController::class, 'getSlug'])->name('admin.posts.checkSlug');

    Route::resource('/admin/categories', '\App\Http\Controllers\AdminCategoriesController');

    Route::resource('/admin/media', '\App\Http\Controllers\AdminMediasController');

    Route::resource('admin/comments', '\App\Http\Controllers\PostCommentsController');

    Route::resource('admin/comment/replies', '\App\Http\Controllers\CommentRepliesController');

    Route::get('admin/file-manager', function (){
       return view('admin.filemanager');
    })->name('admin.filemanager');

    Route::delete('admin/delete/media', [App\Http\Controllers\AdminMediasController::class, 'massDelete'])->name('mass.delete');
});

Route::group(['middleware'=>'auth'], function (){

    Route::post('/comment/reply', [\App\Http\Controllers\CommentRepliesController::class, 'reply'])->name('comment.reply');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
