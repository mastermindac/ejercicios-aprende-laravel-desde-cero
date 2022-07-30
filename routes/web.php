<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ejercicio 1

Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});


Route::post('/ejercicio3', function (Request $request) {
    $request->validate([
        "name" => "required|string|max:64",
        "price" => "required|numeric|min:0",
        "description" => "required|string|max:512",
        "has_battery" => "required|boolean",
        "battery_duration" => "required_if:has_battery,true|numeric|min:0",
        "colors" => "required",
        "colors.*" => "required|string",
        "dimensions" => "required",
        "dimensions.*" => "required|numeric|min:0",
        "accessories" => "required",
        "accessories.*.name" => "required|string",
        "accessories.*.price" => "required|numeric|gt:0",
    ]);
    return response();
});
