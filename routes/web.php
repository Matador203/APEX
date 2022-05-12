<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\Categories\ListCategories;
use App\Http\Livewire\Admin\Products\ListProducts;
use App\Http\Livewire\Admin\Suppliers\ListSuppliers;
use App\Http\Livewire\Admin\Users\ListUsers;

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
Route::get('admin/dashboard', DashboardController::class)->name('dashboard');
Route::get('admin/users', ListUsers::class)->name('users');
Route::get('admin/suppliers', ListSuppliers::class)->name('suppliers');
Route::get('admin/categories', ListCategories::class)->name('categories');
Route::get('admin/products', ListProducts::class)->name('products');