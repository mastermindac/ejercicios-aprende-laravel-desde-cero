<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
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

Route::post('/ejercicio3', function(Request $req) {
    $req->validate([
        'name' => 'required|string|max:64',
        'description' => 'required|string|max:512',
        'has_battery' => 'required|boolean',
        'battery_duration' => 'required_if:has_battery,true|numeric|gt:0',
        'price' => 'numeric|required|gt:0',
        'colors' => 'array|required',
        'colors.*' => 'string|required',
        'dimensions' => 'required|array',
        'dimensions.width' => 'integer|required|gt:0',
        'dimensions.height' => 'integer|required|gt:0',
        'dimensions.length' => 'integer|required|gt:0',
        'accessories' => 'required|array',
        'accessories.*' => 'required|array',
        'accessories.*.name' => 'string|required',
        'accessories.*.price' => 'required|numeric|gt:0'

    ]);
});