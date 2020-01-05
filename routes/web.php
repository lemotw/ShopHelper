<?php


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
Auth::routes();

Route::get('/', function(){return view('home');})->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('shopholder', 'SaleController@ShopHolderIndex')->name('ShopHolderIndex')->middleware(['ShopHolder']);

Route::Group(['prefix' => 'sale'], function(){
    Route::get('/', 'SaleController@SaleIndex')->name('sale.ShopIndex');

    Route::get('TodaySaleReport','SaleController@TodaySaleReport')->name('sale.TodaySaleReport');
    Route::post('BetweenSaleReport','SaleController@BetweenSaleReport')->name('sale.BetweenSaleReport');

    Route::get('TodaySaleStatistic','SaleController@TodaySaleStatistic')->name('sale.TodaySaleStatistic');
    Route::post('BetweenSaleStatistic','SaleController@BetweenSaleStatistic')->name('sale.BetweenSaleStatistic');

    Route::get('TodaySaleInvoice','SaleController@TodaySaleInvoice')->name('sale.TodaySaleInvoice');
    Route::post('BetweenSaleInvoice','SaleController@BetweenSaleInvoice')->name('sale.BetweenSaleInvoice');

    Route::get('TodaySale','SaleController@TodaySale')->name('sale.TodaySale');
    Route::post('BetweenSale','SaleController@BetweenSale')->name('sale.BetweenSale');
});

Route::Group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

    Route::get('/', 'AdminController@AdminIndex')->name('AdminIndex');
    Route::get('/Shops', 'AdminController@ShopAllMaintain')->name('ShopAllMaintain');

    Route::get('Users', 'AdminController@UserMaintain')->name('UserMaintain');
    Route::get('User/Add', 'AdminController@ShowUserAdd')->name('ShowUserAdd');
    Route::post('User/Add', 'AdminController@UserAdd')->name('UserAdd');
    Route::get('User/deleteUser', 'AdminController@UserDelete')->name('UserDelete');

    Route::get('Shop', 'AdminController@ShopMaintain')->name('ShopMaintain');
    Route::get('Shop/add', 'AdminController@ShowShopAdd')->name('ShowShopAdd');
    Route::post('Shop/add', 'AdminController@ShopAdd')->name('ShopAdd');
    Route::get('Shop/deleteOwn', 'AdminController@ShopDeleteOwn')->name('ShopDeleteOwn');
    Route::get('Shop/delete', 'AdminController@ShopDelete')->name('ShopDelete');

    Route::get('Shop/addOwn','AdminController@ShowShopAddOwn')->name('ShopShopAddOwn');
    Route::post('Shop/addOwn', 'AdminController@AddOwn')->name('AddOwn');

    Route::get('Shop/edit', 'AdminController@ShowShopEdit')->name('ShowShopEdit');
    Route::post('Shop/edit', 'AdminController@ShopEdit')->name('ShopEdit');
});