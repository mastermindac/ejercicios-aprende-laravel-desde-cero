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

//Ejercicio 2

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if ($request->price < 0) {
        return Response::json([
            'message' => "Price can't be less than 0",
        ])->setStatusCode(422);
    }

    return Response::json([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);
});

Route::post('/ejercicio2/c', function (Request $request) {
    $discount = match ($request->query('discount')) {
        'SAVE5' => 5,
        'SAVE10' => 10,
        'SAVE15' => 15,
        default => 0,
    };
    $priceWithDiscount = (100 - $discount) / 100 * $request->price;
    
    return Response::json([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $priceWithDiscount,
        'discount' => $discount,
    ]);
});
