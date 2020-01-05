<?php

use Illuminate\Http\Request;
use App\Service\SaleInfoCRUDService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('TokenValid', 'API\PostTokenController@ValidToken');
Route::post('GetToken', 'API\PostTokenController@GetToken');

Route::Group(['prefix' => 'sales'], function(){
    Route::post('salelist', 'API\SaleInfoController@PostSaleList');
    Route::post('saledetail', 'API\SaleInfoController@PostSaleDetail');
});