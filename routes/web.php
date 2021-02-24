<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    Route::get('/', 'HomeController@index')->name('front.home');
    Route::view('/product', "product");
    Route::get('/contact', 'HomeController@contact')->name('front.contact');
    Route::post('/contact', 'HomeController@sendContactMessage')->name('front.contact.send');
    Route::group(['prefix' => 'shop'], function () { // localhost.com/shop/
        Route::get('/', 'ShopController@index')->name('shop.home');
        Route::get('/{category}', 'ShopController@category')->name('shop.category');
    });
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::group(['prefix' => 'profile'], function () { // /profile/Ayman/update
            Route::group(['prefix' => 'admin','middleware'=>['admin','password.confirm']], function () {
                Route::get('/users/', 'AdminController@viewUsers')->name('front.admin.viewUsers');
                Route::get('/orders/', 'AdminController@viewOrders')->name('front.admin.viewOrders');
                Route::get('/items/', 'AdminController@viewItem')->name('front.admin.viewItems');
                Route::get('/products/', 'AdminController@viewProduct')->name('front.admin.viewProducts');
                Route::get('/categories/', 'AdminController@viewCategories')->name('front.admin.viewCategory');

                Route::put('/items/', 'AdminController@updateItem')->name('front.admin.updateItem');
                Route::put('/products/', 'AdminController@updateProduct')->name('front.admin.updateProduct');
                Route::put('/categories/', 'AdminController@updateCategory')->name('front.admin.updateCategory');

                Route::post('/items/', 'AdminController@addItem')->name('front.admin.addItem');
                Route::post('/products/', 'AdminController@addProduct')->name('front.admin.addProduct');
                Route::post('/categories/', 'AdminController@addCategories')->name('front.admin.addCategory');

                Route::get('/items/{id}', 'AdminController@deleteItem')->name('front.admin.deleteItem');
                Route::get('/products/{id}', 'AdminController@deleteProduct')->name('front.admin.deleteProduct');
                Route::get('/categories/{id}', 'AdminController@deleteCategory')->name('front.admin.deleteCategory');

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
