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

Route::post('/ejercicio2/a', function (Request $req) {
    return Response::json([
        "name" => $req->get('name'),
        "description" => $req->get('description'),
        "price" => $req->get('price')
    ]);
});

Route::post('/ejercicio2/b', function (Request $req) {
    if ($req->get('price') < 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }
    return Response::json([
        "name" => $req->get('name'),
        "description" => $req->get('description'),
        "price" => $req->get('price')
    ]);
});

Route::post('/ejercicio2/c', function (Request $req) {

    $discount = 0;

    switch ($req->query('discount')) {
        case 'SAVE5':
            $discount = 5;
            break;
        case 'SAVE10':
            $discount = 10;
            break;
        case 'SAVE15':
            $discount = 15;
            break;
    }

    $price = $req->get('price') - ($req->get('price') * ($discount / 100));

    return Response::json([
        "name" => $req->get('name'),
        "description" => $req->get('description'),
        "price" => $price,
        "discount" => $discount
    ]);
});
