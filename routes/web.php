<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isEmpty;

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
    // dd($request);
    return Response::json($request)->setStatusCode(200);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if ($request->get('price') <= 0) {
        return Response::json(["message" => "Price can't be less than 0"])->setStatusCode(422);
    }
});

Route::post('/ejercicio2/c', function (Request $request) {
    $descuentos = ['SAVE5' => 5, 'SAVE10' => 10, 'SAVE15' => 15];
    $precio = $request->get('price');
    $descuento = $request->get('discount');
    
    if (!isset($descuentos[$descuento])) {
        $request["discount"] = 0;
        return Response::json($request)->setStatusCode(200);
    }
    $porcentajeDescuento = $descuentos[$descuento];
    $precioConDescuento = (100 - $porcentajeDescuento) / 100 * $precio;
    $request['price'] = $precioConDescuento;
    $request['discount'] = $porcentajeDescuento;

    return Response::json($request)->setStatusCode(200);

});