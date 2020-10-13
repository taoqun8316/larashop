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

Route::namespace('Api')->group(function () {
    Route::get('/', 'PagesController@root');
    Route::get('/users','UserController@show');   //登录用户信息
    Route::post('/users','UserController@register');   //注册
    Route::post('/login','UserController@login');    //登录
    Route::get('user_addresses', 'UserAddressesController@index');  //收货地址列表

});




