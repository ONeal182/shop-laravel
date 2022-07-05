<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false

]);
Route::get('locale/{locale}', 'MainController@changeLocale')->name('locale');
Route::middleware(['set_locale'])->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::group([
            'prefix' => 'person',
            'namespace' => 'Person',
            'as' => 'person.'
        ], function () {

            Route::get('/orders', 'OrderController@index')->name('orders');
            Route::get('/orders/{order}', 'OrderController@show')->name('orders-show');
        });
        Route::group([
            'middleware' => 'auth',
            'namespace' => 'Admin',
            'prefix' => 'admin'
        ], function () {
            Route::group(['middleware' => 'is_admin'], function () {
                Route::get('/orders', 'OrderController@index')->name('orders');
                Route::get('/orders/{order}', 'OrderController@show')->name('orders-show');
            });
            Route::resource('categories', 'CategoryController');
            Route::resource('products', 'ProductController');
        });
    });
    Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');



    Route::group([
        'prefix' => 'basket'
    ], function () {
        Route::post('/add/{product}', [BasketController::class, 'basketAdd'])->name('basket-add');
    });
    Route::group([
        'middleware' => 'basket_is_not_empty',
        'prefix' => 'basket'
    ], function () {
        Route::get('/', [BasketController::class, 'basket'])->name('basket');
        Route::get('/place', [BasketController::class, 'basketPlace'])->name('basket-place');

        Route::post('/confirm/', [BasketController::class, 'basketConfirm'])->name('basket-confirm');
        Route::post('/remove/{product}', [BasketController::class, 'basketRemove'])->name('basket-remove');
    });

    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/categories', [MainController::class, 'categories'])->name('categories');
    Route::post('/subscription/{product}', [MainController::class, 'subscribe'])->name('subscription');
    Route::get('/{category}', [MainController::class, 'category'])->name('category');
    Route::get('/{category}/{product?}',  [MainController::class, 'product'])->name('product');
});





// Route::get('/categories', function () {
//     return view('categories');
// });

// Route::get('/mobiles/iphone_x_64', function () {
//     return view('product');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
