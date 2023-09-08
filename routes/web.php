<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('register', [PassportAuthControlle::class,'register']);
Route::post('login', [PassportAuthControlle::class,'login']);
Route::post('logout', [PassportAuthControlle::class,'logout']);

Route::middleware('auth:api')->group(function () {
    Route::post('register', [PassportAuthControlle::class,'register']);
    Route::post('logout', [PassportAuthControlle::class,'logout']);
});

Route::get('/', function () {
    return view('welcome');
});
