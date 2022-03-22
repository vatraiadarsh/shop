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

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');


    Route::resource('/admin/category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/admin/product', App\Http\Controllers\Admin\ProductController::class);

Route::get('/admin/profile/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'index']);
Route::put('/admin/profile/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'update']);



});


