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

Route::put('/ejercicio1', function () {
    return 'PUT OK';
});

Route::patch('ejercicio1', function () {
    return 'PATCH OK';
});

Route::delete('/ejercicio1', function () {
    return "DELETE OK";
});


Route::post('/ejercicio2/a', function () {
    return Response::json(["name" => "Keyboard", "description" => "Mechanical RGB keyboard", "price" => 200]);
});

Route::post('/ejercicio2/b', function (Request $request) {

    if ($request->get('price') < -0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }
    // return Response::json(["name" => "Keyboard", "description" => "Mechanical RGB keyboard", "price" => 200]);
});
