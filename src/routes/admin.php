<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('login', 'AdminController@getLogin');
    Route::post('login', 'AdminController@postLogin');

    Route::group(['middleware' => ['admin_auth']], function(){
        Route::get('/', function(){
            return response()->json(\Illuminate\Support\Facades\Auth::guard('admin')->user());
        });
    });
});