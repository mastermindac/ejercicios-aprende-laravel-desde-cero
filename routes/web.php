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
    return view('ejercicio2');
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
    ]);
});

Route::post('/ejercicio2/b', function (Request $request) {
    $price = $request->get('price');
    if ($price < 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    } else {
        return Response::json([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
        ]);
    }
});

Route::post('/ejercicio2/c', function (Request $request) {
    $discount = $request->query('discount');
    $price = $request->get('price');
    if (in_array($discount, ["SAVE5", "SAVE10", "SAVE15"])) {
        $discountValue = intval(substr($discount, 4));
        $price -= $request->get('price') * ($discountValue / 100);
    } else {
        $discountValue = 0;
    }
    return Response::json([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'price' => $price,
        'discount' => $discountValue
    ]);
});
