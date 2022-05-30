<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/basket', [BasketController::class, 'basket'])->name('basket');
Route::get('/basket/place', [BasketController::class, 'basketPlace'])->name('basket-place');
Route::post('/basket/add/{product}', [BasketController::class, 'basketAdd'])->name('basket-add');
Route::post('/basket/confirm/', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
Route::post('/basket/remove/{product}', [BasketController::class, 'basketRemove'])->name('basket-remove');
Route::get('/{category}', [MainController::class, 'category'])->name('category');
Route::get('/{category}/{product?}',  [MainController::class, 'product'])->name('product');



// Route::get('/categories', function () {
//     return view('categories');
// });

// Route::get('/mobiles/iphone_x_64', function () {
//     return view('product');
// });