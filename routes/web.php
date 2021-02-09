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
Auth::routes(['verify' => true]);

Route::middleware('web')->group(function () {
    Route::get('/', 'HomeController@index')->name('front.home');
    Route::get('/contact', 'HomeController@contact')->name('front.contact');
    Route::group(['prefix' => 'shop'], function () {
        Route::get('/', 'ShopController@index')->name('shop.home');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/checkout', 'CheckoutController@index')->name('front.checkout');
            Route::group(['prefix' => 'admin'], function () {
                Route::get('/', 'ProfileController@customerIndex')->name('profile.admin.home');
            });
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/', 'ProfileController@customerIndex')->name('profile.customer.home');
            });
        });
    });
});

/*Route::get("/product/create", function () {
    $order = new App\Models\Order(['user_id'=>1,'transaction'=>'eeee', 'total'=>75.5]);
    $order->save();
    $order->products()->sync([1 => ['qty' => 333],2 =>['qty'=>1]]);
    return $order;
    /*
     $sync_data = [];
for($i = 0; $i < count($allergy_ids); $i++))
    $sync_data[$allergy_ids[$i]] = ['severity' => $severities[$i]];

$food->allergies()->sync($sync_data);
});*/
