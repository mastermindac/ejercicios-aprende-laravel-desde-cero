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
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $request->get('price')
    ])->setStatusCode(200);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if ($request->get('price') < 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }

    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $request->get('price')
    ]);
});

Route::post('/ejercicio2/c', function (Request $request) {
    $discount = 0;

    if($request->query('discount') == 'SAVE5'){
        $discount = 5;
    }
    else if($request->query('discount') == 'SAVE10'){
        $discount = 10;
    }
    else if($request->query('discount') == 'SAVE15'){
        $discount = 15;
    }

    $price = (100 - $discount) / 100 * $request->get('price');

    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $price,
        'discount' => $discount,
    ]);


});
