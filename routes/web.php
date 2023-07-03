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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/route', function () {
    return "test";
});

Route::get('/route/post', function () {
    return "it works";
});
Route::get('/ejercicio1', function () {
    return "GET OK";
});
Route::post('/ejercicio1', function () {
    return "POST OK";
});
Route::put('/ejercicio1', function () {
    return "PUT OK";
});
Route::patch('/ejercicio1', function () {
    return "PATCH OK";
});
Route::delete('/ejercicio1', function () {
    return "DELETE OK";
});
