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

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json([
        "name" => $request->get('name'),
        "description" => $request->get('description'),
        "price" => $request->get('price')
    ])->setStatusCode(200);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if($request->get('price') < 0) {
        return Response::json([
            "message" => "Price can't be less than 0"
        ])->setStatusCode(422);
    }
    return Response::json([
        "name" => $request->get('name'),
        "description" => $request->get('description'),
        "price" => $request->get('price')
    ])->setStatusCode(200);
});

Route::post('/ejercicio2/c', function (Request $request) {
    $discount = $discount = match ($request->query('discount')) {
        'SAVE5' => 5,
        'SAVE10' => 10,
        'SAVE15' => 15,
        default => 0
    };
    $price = $request->get('price');

    $final_price = $discount > 0 
        ? $price - (($price * $discount) / 100)
        : $price;

    $data = [
        "name" => $request->get('name'),
        "description" => $request->get('description'),
        "price" => $final_price,
        "discount" => $discount
    ];

    return Response::json($data)->setStatusCode(200);
});