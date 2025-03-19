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
    return view('layouts.app');
    // return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user',[App\Http\Controllers\UserController::class,'index'])->name('user.index');
Route::get('user/create',[App\Http\Controllers\UserController::class,'create'])->name('user.create');
Route::post('user/store',[App\Http\Controllers\UserController::class,'store'])->name('user.store');
Route::get('user/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
Route::put('user/update/{id}',[App\Http\Controllers\UserController::class,'update'])->name('user.update');



Route::get('my-profile',[App\Http\Controllers\MyProfileController::class,'index'])->name('my.profile');
Route::post('my-profile',[App\Http\Controllers\MyProfileController::class,'update_profile'])->name('my.profile.update');
Route::get('change-password',[App\Http\Controllers\MyProfileController::class,'change_password'])->name('change.password');
Route::post('change-password/{id}',[App\Http\Controllers\MyProfileController::class,'do_change_password'])->name('change.password.action');


Route::get('category',[App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
Route::get('category/create',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
Route::post('category/store',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
Route::get('category/edit/{id}',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
Route::put('category/update/{id}',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
Route::delete('category/{id}',[App\Http\Controllers\CategoryController::class,'destroy'])->name('category.destroy');

Route::get('package',[App\Http\Controllers\PackageController::class,'index'])->name('package.index');
Route::get('package/create',[App\Http\Controllers\PackageController::class,'create'])->name('package.create');
Route::post('package/store',[App\Http\Controllers\PackageController::class,'store'])->name('package.store');
Route::get('package/edit/{id}',[App\Http\Controllers\PackageController::class,'edit'])->name('package.edit');
Route::put('package/update/{id}',[App\Http\Controllers\PackageController::class,'update'])->name('package.update');
Route::delete('package/{id}',[App\Http\Controllers\PackageController::class,'destroy'])->name('package.destroy');
Route::get('package/{id}/is-show/',[App\Http\Controllers\PackageController::class,'change_is_show'])->name('package.is-show');

Route::get('product',[App\Http\Controllers\ProductController::class,'index'])->name('product.index');
Route::get('product/create',[App\Http\Controllers\ProductController::class,'create'])->name('product.create');
Route::post('product/store',[App\Http\Controllers\ProductController::class,'store'])->name('product.store');
Route::get('product/edit/{id}',[App\Http\Controllers\ProductController::class,'edit'])->name('product.edit');
Route::put('product/update/{id}',[App\Http\Controllers\ProductController::class,'update'])->name('product.update');
Route::delete('product/{id}',[App\Http\Controllers\ProductController::class,'destroy'])->name('product.destroy');
Route::get('product/photo/{id}',[App\Http\Controllers\ProductImageController::class,'index'])->name('product.photo.index');
Route::get('product/photo/create-photo',[App\Http\Controllers\ProductImageController::class,'create'])->name('product.photo.create');




