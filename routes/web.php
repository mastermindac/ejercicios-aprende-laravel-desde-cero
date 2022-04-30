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

Route::put('/ejercicio1', function() {
    return "PUT OK";
});

Route::patch('/ejercicio1', function() {
    return "PATCH OK";
});

Route::delete('/ejercicio1', function() {
    return "DELETE OK";
});

// Ejercicio 2

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
    ]);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if ($request->get('price') < 0) {
        return Response::json(['message' => "Price can't be less than 0"])->setStatusCode(422);
    }

    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
    ]);
});

Route::post('/ejercicio2/c', function (Request $request) {

    // Una forma simple para sacar el discount, con if-else
    $discount = 0;
    if ($request->query('discount') == "SAVE5") {
        $discount = 5;
    } else if ($request->query('discount') == "SAVE10") {
        $discount = 10;
    } else if ($request->query('discount') == "SAVE15") {
        $discount = 15;
    }

    // Otra forma de sacar el discount, con el match de PHP 8
    // $discount = match ($request->query('discount')) {
    //     'SAVE5' => 5,
    //     'SAVE10' => 10,
    //     'SAVE15' => 15,
    //     default => 0,
    // };

    // Calcular precio nuevo
    $price = (100 - $discount) / 100 * $request->get('price');

    // Devolver respuesta
    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $price,
        'discount' => $discount,
    ]);
});

// Ejercicio 3

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
        'accessories.*.price' => 'required|numeric|gt:0',
    ]);

    return response();
});
