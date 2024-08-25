<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminController2;
use App\Http\Controllers\NavBarController;

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

Auth::routes();


// main laprint routes

Route::get('/', [NavBarController::class, 'index'])->name('/');
Route::get('blog', [NavBarController::class, 'blog'])->name('blog');

Route::get('category/{id}', [NavBarController::class, 'cat'])->name('category');
Route::get('product/{id}', [NavBarController::class, 'pro'])->name('product');
Route::get('product/variant/{product}', [NavBarController::class, 'variants'])->name('variants');
Route::post('category/produit/variant/cart', [NavBarController::class, 'cart_item'])->name('cart_item');
Route::get('product/variant2/{product}', [NavBarController::class, 'variants2'])->name('variants2');
Route::view('/test', 'laprint.header');
Route::get('/contact', [NavBarController::class, 'contact'])->name('contact');
Route::post('/contactC', [NavBarController::class, 'contactC'])->name('contactC');

Route::get('/aboutUs', [NavBarController::class, 'AboutUs'])->name('aboutUs');
Route::post('/send', [NavBarController::class, 'sendEmail'])->name('failed');
Route::post('/sendMail_admin', [AdminController2::class, 'sendMail'])->name('sendMail');
Route::get('/admin/login', [AdminController::class, 'loginform'])->name('admin.login');
Route::get('/blogs/tag/{tag}', [NavBarController::class, 'filterTag'])->name('blogs.tag');
Route::post('/blog/search',[NavBarController::class, 'searchBlog'])->name('blog.search');






Route::middleware(['auth'])->group(function () {

    //first admin dashboard
    Route::get('/admin', [AdminController::class, 'dashboardView'])->name('dashboard');
    Route::get('/admin/dashboard/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/dashboard/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/dashboard/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.product');
    Route::PATCH('/admin/dashboard/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::get('/admin/dashboard/category/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.category');
    Route::PATCH('/admin/dashboard/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::get('/admin/dashboard/product/add', [AdminController::class, 'addProduct'])->name('admin.product.add');
    Route::post('/admin/dashboard/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::post('/admin/dashboard/category/store', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::get('/admin/dashboard/category/add', [AdminController::class, 'addCategory'])->name('admin.category.add');
    Route::get('/admin/dashboard/variants', [AdminController::class, 'variants'])->name('admin.variants');
    Route::post('/admin/dashboard/variant/create', [AdminController::class, 'addVariant'])->name('admin.variants.create');
    Route::PUT('/admin/dashboard/variant/update/{id}', [AdminController::class, 'updateVariant'])->name('admin.variants.update');
    Route::get('/admin/dashboard/product/add/variant/{id}', [AdminController::class, 'productAddVariant'])->name('admin.product.add.variant');
    Route::post('/admin/dashboard/product/store/variant/', [AdminController::class, 'productStoreVariant'])->name('admin.product.store.variant');
    Route::get('/admin/dashboard/product/delete/variant/{id}', [AdminController::class, 'productDeleteVariant'])->name('admin.product.delete.variant');
    Route::delete('/admin/dashboard/product/destroy/variant/{id}', [AdminController::class, 'productDestroyVariant'])->name('admin.product.destroy.variant');






    //second(better) admin dashboard

    Route::get('/admin2', [AdminController2::class, 'dashboardView'])->name('dashboard2');
    Route::get('/admin2/dashboard/products', [AdminController2::class, 'products'])->name('admin2.products');
    Route::get('/admin2/dashboard/product/add', [AdminController2::class, 'addProduct'])->name('admin2.product.add');
    Route::post('/admin2/dashboard/product/store', [AdminController2::class, 'storeProduct'])->name('admin2.product.store');
    Route::get('/admin2/dashboard/product/edit/{id}', [AdminController2::class, 'editProduct'])->name('admin2.product');
    Route::PATCH('/admin2/dashboard/product/update/{id}', [AdminController2::class, 'updateProduct'])->name('admin2.product.update');
    Route::delete('/admin2/dashboard/product/softDelete/{id}', [AdminController2::class, 'softDeleteProduct'])->name('admin2.product.softDelete');
    Route::get('/admin2/dashboard/restoreProducts', [AdminController2::class, 'softProducts'])->name('admin2.softProduct');
    Route::get('/admin2/dashboard/product/restore/{id}', [AdminController2::class, 'restoreProduct'])->name('admin2.product.restore');
    Route::delete('/admin2/dashboard/products/{id}/hardDelete', [AdminController2::class, 'hardDeleteProduct'])->name('admin2.product.hardDelete');
    Route::delete('/admin2/dashboard/category/softDelete/{id}', [AdminController2::class, 'softDeleteCategory'])->name('admin2.category.softDelete');
    Route::get('/admin2/dashboard/restoreCategories', [AdminController2::class, 'softCategories'])->name('admin2.softCategory');
    Route::get('/admin2/dashboard/category/restore/{id}', [AdminController2::class, 'restoreCategory'])->name('admin2.category.restore');
    Route::delete('/admin2/dashboard/category/{id}/hardDelete', [AdminController2::class, 'hardDeleteCategory'])->name('admin2.category.hardDelete');
    Route::post('/admin2/dashboard/products/filter', [AdminController2::class, 'categoryFilter'])->name('categoryFilter');
    Route::get('/admin2/dashboard/categories', [AdminController2::class, 'categories'])->name('admin2.categories');
    Route::get('/admin2/dashboard/category/edit/{id}', [AdminController2::class, 'editCategory'])->name('admin2.category');
    Route::PATCH('/admin2/dashboard/category/update/{id}', [AdminController2::class, 'updateCategory'])->name('admin2.category.update');
    Route::post('/admin2/dashboard/category/store', [AdminController2::class, 'storeCategory'])->name('admin2.category.store');
    Route::get('/admin2/dashboard/category/add', [AdminController2::class, 'addCategory'])->name('admin2.category.add');
    Route::get('/admin2/dashboard/variants', [AdminController2::class, 'variants'])->name('admin2.variants');
    Route::post('/admin2/dashboard/variant/create', [AdminController2::class, 'addVariant'])->name('admin2.variants.create');
    Route::PUT('/admin2/dashboard/variant/update/{id}', [AdminController2::class, 'updateVariant'])->name('admin2.variants.update');
    Route::get('/admin2/dashboard/product/add/variant/{id}', [AdminController2::class, 'productAddVariant'])->name('admin2.product.add.variant');
    Route::post('/admin2/dashboard/product/store/variant/', [AdminController2::class, 'productStoreVariant'])->name('admin2.product.store.variant');
    Route::get('/admin2/dashboard/product/delete/variant/{id}', [AdminController2::class, 'productDeleteVariant'])->name('admin2.product.delete.variant');
    Route::delete('/admin2/dashboard/product/destroy/variant/{id}', [AdminController2::class, 'productDestroyVariant'])->name('admin2.product.destroy.variant');
    Route::get('/admin2/dashboard/mails', [AdminController2::class, 'mails'])->name('admin2.mails');
    Route::delete('/admin2/dashboard/mail/delete/{id}', [AdminController2::class, 'deleteMail'])->name('admin2.mail.delete');
    Route::get('/admin2/dashboard/restoreMails', [AdminController2::class, 'softMails'])->name('admin2.softMails');
    Route::get('/admin2/dashboard/mail/restore/{id}', [AdminController2::class, 'restoreMail'])->name('admin2.mail.restore');
    Route::delete('/admin2/dashboard/Mail/{id}/hardDelete', [AdminController2::class, 'hardDeleteMail'])->name('admin2.Mail.hardDelete');

    Route::get('admin2/dashboard/blogs',[AdminController2::class, 'blogs'])->name('admin2.blog');
    Route::get('admin2/dashboard/blogs/add',[AdminController2::class, 'addBlog'])->name('admin2.blog.add');
    Route::post('admin2/dashboard/blogs/store',[AdminController2::class, 'storeBlog'])->name('admin2.blog.store');
    Route::get('admin2/dashboard/blog/edit/{id}',[AdminController2::class, 'editBlog'])->name('admin2.blog.edit');
    Route::PUT('admin2/dashboard/blog/store/{id}',[AdminController2::class, 'updateBlog'])->name('admin2.blog.update');
    Route::delete('/admin2/dashboard/blog/delete/{id}', [AdminController2::class, 'deleteBlog'])->name('admin2.blog.delete');
    Route::get('admin2/dashboard/tags',[AdminController2::class, 'Tags'])->name('admin2.tags');
    Route::get('admin2/dashboard/tags/add',[AdminController2::class, 'addTags'])->name('admin2.tags.add');
    Route::post('admin2/dashboard/tags/store',[AdminController2::class, 'storeTags'])->name('admin2.tags.store');
    Route::delete('admin2/dashboard/tag/delete/{id}',[AdminController2::class, 'deleteTag'])->name('admin2.tag.delete');
    Route::PUT('/admin2/dashboard/tag/update/{id}',[AdminController2::class, 'updateTag'])->name('admin.tag.update');









});
