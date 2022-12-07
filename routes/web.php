<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
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


Route::post('/ejercicio2/a', function(Request $request) {
    return Response::json([
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
        'price'=>$request->get('price')
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


Route::post('ejercicio2/c', function (Request $request) {
    $descuento = $request->query('discount');

    $valor_descuento = 0;

    if($descuento == "SAVE5") {
        $valor_descuento = 5;
    } else if($descuento == "SAVE10") {
        $valor_descuento = 10;
    } else if($descuento == "SAVE15") {
        $valor_descuento = 15;
    }

    $precio_original = $request->get('price');
    $precio_con_descuento = $precio_original * ((100 - $valor_descuento) / 100);

    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $precio_con_descuento,
        "discount" => $valor_descuento,
    ]);
});