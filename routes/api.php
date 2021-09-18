<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers;

Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::post('/logout','AuthController@logout');  
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::post('/order','orderController@createOrder');
});