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
    return response($request, 200);
});



Route::post('/ejercicio2/b', function (Request $request) {

    $price = $request->get('price');

    if ($price < 0)
        return response()->json(['message' => 'Price can\'t be less than 0'], 422);
    else
        return $price;
});


Route::post('/ejercicio2/c', function (Request $request) {

    $discount = $request->query('discount');
    $price = $request->get('price');
    $name = $request->get('name');
    $description = $request->get('description');

    if ($discount == "SAVE5") {
        $price = $price - $price * 0.05;
        return response()->json(['name' => $name, 'description' => $description, 'price'=>$price,'discount'=>5], 200);

    } elseif ($discount == "SAVE10") {
        $price = $price - $price * 0.10;
        return response()->json(['name' => $name, 'description' => $description, 'price'=>$price,'discount'=>10], 200);
    } elseif ($discount == "SAVE15") {
        $price = $price - $price * 0.15  ;
        return response()->json(['name' => $name, 'description' => $description, 'price'=>$price,'discount'=>15], 200);
    } else
        return response()->json(['name' => $name, 'description' => $description, 'price'=>$price,'discount'=>0], 200);


    });
