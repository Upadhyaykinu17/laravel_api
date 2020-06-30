<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login' , 'Api\LoginController@login');
Route::post('/register' , 'Api\LoginController@register');

Route::apiResource('/products', 'Api\ProductController');

Route::group(['prefix' => 'products'], function () {
    Route::apiResource('/{product}/reviews', 'Api\ReviewController');
});