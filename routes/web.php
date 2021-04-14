<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('logout', 'Auth\LoginController@logout', function () {
    return \Illuminate\Support\Facades\URL::previous();
});
Auth::routes(['verify' => true]);
Route::middleware('web')->group(function () {
    Route::get('/test1', 'Base@test');
    Route::view('/test2', 'emails.welcome');
    Route::get('/', 'HomeController@index')->name('front.home');
    Route::view('/product', "product");
    Route::get('/contact', 'HomeController@contact')->name('front.contact');
    Route::post('/contact', 'HomeController@sendContactMessage')->name('front.contact.send');
    Route::group(['prefix' => 'shop'], function () { // localhost.com/shop/
        Route::get('/', 'ShopController@index')->name('shop.home');
        Route::match(array('post', 'delete'),'/cart/', "ShopController@cart");
        Route::post('/cart/discount', 'CheckoutController@addDiscount');
        Route::post('/product/rate', 'ShopController@addRate');
        Route::get('/{product}', 'ShopController@product')->name('shop.product');
    });
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/checkout/', 'CheckoutController@index')->name('front.checkout');
        Route::post('/pay', 'PaymentController@payWithPaypal')->name('front.pay');
        Route::get('/cancelled', 'PaymentController@cancelled')->name('front.pay.cancelled');
        Route::get('/success', 'PaymentController@status')->name('front.pay.status');
        Route::group(['prefix' => 'profile'], function () { // /profile/Ayman/update
            Route::group(['prefix' => 'admin','middleware'=>['admin','password.confirm']], function () {
                Route::get('/users/', 'AdminController@viewUsers')->name('front.admin.viewUsers');
                Route::get('/orders/', 'AdminController@viewOrders')->name('front.admin.viewOrders');
                Route::any('/items/', 'AdminController@viewItem')->name('front.admin.items');
                Route::any('/products/', 'AdminController@viewProduct')->name('front.admin.products');
                Route::any('/categories/', 'AdminController@viewCategories')->name('front.admin.categories');

                Route::any('/items/restore', 'AdminController@restoreItems')->name('front.admin.restoreItems');
                Route::any('/products/restore', 'AdminController@restoreProducts')->name('front.admin.restoreProducts');
                Route::any('/categories/restore', 'AdminController@restoreCategories')->name('front.admin.restoreCategories');

                Route::get('/updateRates', 'AdminController@processRate')->name('front.admin.updateRates');

                Route::get('/cache/clear', 'AdminController@clearCache')->name('front.admin.clearCache');
            });
            Route::group(['prefix' => '{name}', 'middleware'=>'user.profile'], function () {
                Route::get('/', 'ProfileController@index')->name('front.profile.home');
                Route::post('/', 'ProfileController@getOrder')->name('front.profile.order');
                Route::put('/update', 'ProfileController@update')->name('front.profile.update');
                Route::put('/updatePassword', 'ProfileController@updatePassword')->name('front.profile.updatePassword');
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
