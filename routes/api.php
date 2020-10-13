<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function () {
    Route::post('/register','UserController@register');   //注册
    Route::post('/login','UserController@login');    //登录
});

/*Route::namespace('Api')->group(['middleware' => 'auth.jwt'], function () {
    Route::get('/', 'PagesController@root');
    Route::get('/users','UserController@show');   //登录用户信息
    Route::get('user_addresses', 'UserAddressesController@index');  //收货地址列表

});*/




