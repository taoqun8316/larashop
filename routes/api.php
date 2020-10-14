<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::post('/register','UserController@register');   //注册
    Route::post('/login','UserController@login');    //登录
});

Route::namespace('Api')->middleware(['auth.jwt'])->group(function () {

    Route::get('/users','UserController@getAuthUser');   //登录用户信息
    Route::get('user_addresses', 'UserAddressesController@index');  //收货地址列表
    Route::get('user_addresses/create', 'UserAddressesController@create');  //新建收货地址

});