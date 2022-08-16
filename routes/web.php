<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Client\Request as ClientRequest;
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

Route::post('/ejercicio2/a', function () {
    return Response::json(["name"=>"Keyboard",
    "description"=>"Mechanical RGB keyboard",
    "price"=>200]);
});

Route::post('/ejercicio2/b', function () {
    $product = ["name"=>"Keyboard",
    "description"=>"Mechanical RGB keyboard",
    "price"=>-100];

    if ($product["price"] < 0) {
        return Response::json(["message"=>"Price can't be less than 0"])->setStatusCode(422);
    }
});

Route::post('/ejercicio2/c', function (Request $request) {

    if ($request->query('discount') === "SAVE5") {
        return Response::json(["name"=>"Keyboard",
        "description"=>"Mechanical RGB keyboard",
        "price"=>190,
        "discount"=>5]);
    } else if ($request->query('discount') === "SAVE10") {
        return Response::json(["name"=>"Keyboard",
        "description"=>"Mechanical RGB keyboard",
        "price"=>180,
        "discount"=>10]);
    } else if ($request->query('discount') === "SAVE15") {
        return Response::json(["name"=>"Keyboard",
        "description"=>"Mechanical RGB keyboard",
        "price"=>170,
        "discount"=>15]);
    } else {
        return Response::json(["name"=>"Keyboard",
        "description"=>"Mechanical RGB keyboard",
        "price"=>200,
        "discount"=>0]);
    }
});

