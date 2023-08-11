<?php

use App\Http\Controllers\ProductController;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

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

// Ejercicio 2


Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json(["name" => "Keyboard","description" => "Mechanical RGB keyboard","price" => 200]);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if($request->get('price') < 0){
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    } else {
        return Response::json(["name" => "Keyboard","description" => "Mechanical RGB keyboard","price" => 200]);
    }
});

Route::post('/ejercicio2/c', function (Request $request) {
    if($request->get('discount') == 'SAVE5' ){
        return Response::json([
            "name" => "Keyboard",
            "description" => "Mechanical RGB keyboard",
            "price" => $request->get('price') - (5 * $request->get('price') / 100),
            "discount" => 5
        ]);
    } else if($request->get('discount') == 'SAVE10' ){
        return Response::json([
            "name" => "Keyboard",
            "description" => "Mechanical RGB keyboard",
            "price" => $request->get('price') - (10 * $request->get('price') / 100),
            "discount" => 10
        ]);
    } else if($request->get('discount') == 'SAVE15' ){
        return Response::json([
            "name" => "Keyboard",
            "description" => "Mechanical RGB keyboard",
            "price" => $request->get('price') - (15 * $request->get('price') / 100),
            "discount" => 15
        ]);
    } else {
        return Response::json([
            "name" => "Keyboard",
            "description" => "Mechanical RGB keyboard",
            "price" => $request->get('price'),
            "discount" => 0
        ]);
    }
});
