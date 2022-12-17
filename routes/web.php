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


    //$json = json_decode($request->getContent());

    $request->validate([
        'name' => 'required|max:64',
        'description' => 'required|max:512',
        'price' => 'required|numeric|gt:0',
        'has_battery' => 'required|boolean',
        'battery_duration' => 'required_if:has_battery,true|numeric|min:0',
        'colors' => 'required',
        'colors.*' => 'string',
        'dimensions' => 'required',
        'dimensions.width' => 'numeric|gt:0',
        'dimensions.height' => 'numeric|gt:0',
        'dimensions.length' => 'numeric|gt:0',
        'accessories' => 'required||array',
        'accessories.*.name' => 'required|string',
        'accessories.*.price' => 'required|numeric|gt:0',
    ]);

   


    /*
    $request->validate([
        'name' => 'required',
        'phone_number' => ['required','digits:9'],
        'email' => ['required','email'],
        'age' => ['required','numeric','min:1','max:255']
    ]);
*/


    return response('');

});
