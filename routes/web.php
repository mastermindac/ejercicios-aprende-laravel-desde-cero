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


//Ejercicio 3

Route::post('/ejercicio3', function (Request $request) {
    $request->validate([
        'name' => 'required|max:64',
        'description' => 'required|max:512',
        'price' => ['required','numeric','min:0.01'],
        'has_battery' => ['required','boolean'],
        'battery_duration' => 'sometimes|required_unless:has_battery,false|numeric|min:1',
        "colors"    => "required|array",
        "colors.*"  => "required|string|distinct",
        "dimensions"    => "required|array",
        "dimensions.*"  => "required|numeric|min:1",
        "accessories"    => "required|array",
        "accessories.*.name"  => "required|string",
        "accessories.*.price"  => "required|numeric|min:0.01",
        
    ]);
});