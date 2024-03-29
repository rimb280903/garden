<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/blog/{id}',[ArticleController::class,'showarticle'])->name('show.article');

Route::get('/articles', [ArticleController::class,'showArticles'])->name('articles');




Route::group(['prefix' => 'admin'],function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('/login',[AdminController::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard',[HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/blogs',[ArticleController::class, 'index2'])->name('admin.blogs');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.article.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('admin.article.store');
        Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('admin.article.show');
        Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.article.edit');
        Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('admin.article.update');
        Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.article.destroy');

        Route::get('/logout',[HomeController::class, 'logout'])->name('admin.logout');

    });
});
