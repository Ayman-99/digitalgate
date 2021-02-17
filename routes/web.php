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
    Route::group(['prefix' => 'shop'], function () { // localhost.com/shop/
        Route::get('/', 'ShopController@index')->name('shop.home');
    });
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::group(['prefix' => 'profile'], function () { // /profile/Ayman/update
            Route::group(['prefix' => 'admin','middleware'=>['admin','password.confirm']], function () {
                Route::get('/', 'ProfileController@adminIndex')->name('front.profile.admin');
                Route::post('/item/', 'ProfileController@itemAdd')->name('front.admin.addItem');
                Route::delete('/item/', 'ProfileController@itemDelete')->name('front.admin.deleteItem');
                Route::post('/product/', 'ProfileController@productAdd')->name('front.admin.addProduct');
                Route::post('/product/', 'ProfileController@productDelete')->name('front.admin.deleteProduct');
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

Route::get("/cart", function(){
    return session();
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
