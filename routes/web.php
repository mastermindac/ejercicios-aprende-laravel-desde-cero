<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductValidation;
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

Route::put('/ejercicio1', function () {
    return "PUT OK";
});

Route::delete('/ejercicio1', function () {
    return "DELETE OK";
});

Route::patch('/ejercicio1', function () {
    return "PATCH OK";
});

//Ejercicio 2

Route::post('/ejercicio2/a', function (Request $request) {
        return Response::json([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),])
        ;
});

Route::post('/ejercicio2/b', function (Request $request) {

    if($request->get('price') < 0)
    {
        return Response::json([
            "message" => "Price can't be less than 0"])->setStatusCode(422);
    } else {
        return Response::json([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price')
        ]);
    }

});

Route::get('/ejercicio2/c', function (Request $request) {
    $params = $request->query('discount');

    $discount = 0;

    if ($params == "SAVE5") {
        $discount = 5;
    } else if ($params == "SAVE10") {
        $discount = 10;
    } else if ($params == "SAVE15") {
        $discount = 15;
    }

    $price = (100 - $discount) / 100 * $request->get('price');

            return Response::json([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $price,
            'discount' => $discount,
        ]);
        

    }

);

Route::post('/ejercicio3', [ProductValidation::class, 'store'])->name('products.store');