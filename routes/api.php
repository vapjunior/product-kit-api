<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::middleware('auth:api')->group(function() {
    Route::get('products', 'API\ProductController@index');
    Route::post('products/', 'API\ProductController@store');
    Route::get('products/{product}', 'API\ProductController@show');
    Route::put('products/{product}', 'API\ProductController@update');
    Route::delete('products/{product}', 'API\ProductController@destroy');
});


