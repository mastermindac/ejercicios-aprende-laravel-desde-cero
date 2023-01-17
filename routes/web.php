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
        'name' => 'required|string|max:64',
        'description' => 'required|string|max:512',
        'price' => 'required|numeric|gt:0',
        'has_battery' => 'required|boolean',
        'battery_duration' => 'required_if:has_battery,true|numeric|gt:0',
        'colors' => 'required|array',
        'colors.*' => 'required|string',
        'dimensions' => 'required|array',
        'dimensions.width' => 'required|numeric|gt:0',
        'dimensions.length' => 'required|numeric|gt:0',
        'dimensions.height' => 'required|numeric|gt:0',
        'accessories' => 'required|array',
        'accessories.*' => 'required|array',
        'accessories.*.name' => 'required|string',
        'accessories.*.price' => 'required|numeric|gt:0'
    ]);

    return response();
});
