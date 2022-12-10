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



Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);


Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);

Route::resource('investor', App\Http\Controllers\InvestorController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);


Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);

Route::resource('investor', App\Http\Controllers\InvestorController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);


Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);

Route::resource('investor', App\Http\Controllers\InvestorController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);


Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);

Route::resource('investor', App\Http\Controllers\InvestorController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);


Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('investment', App\Http\Controllers\InvestmentController::class);

Route::resource('purchase', App\Http\Controllers\PurchaseController::class);

Route::resource('investor', App\Http\Controllers\InvestorController::class);

Route::resource('supplier', App\Http\Controllers\SupplierController::class);
