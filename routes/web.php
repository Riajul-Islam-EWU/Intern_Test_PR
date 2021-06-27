<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\HomeController;

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

Route::get('/addproduct', [App\Http\Controllers\ProductController::class, 'index'])->name('addproduct');

Route::post('saveproducts', [App\Http\Controllers\ProductCategoryController::class, 'store'])->name('saveproducts');

Route::get('/products', [App\Http\Controllers\HomeController::class, 'getProducts'])->name('products');

Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteProducts'])->name('delete');
