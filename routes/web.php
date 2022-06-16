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
    return response()->json($request);
});

Route::post('/ejercicio2/b', function (Request $request) {
    if (((float)$request['price']) < 0) {
        return response()->json(
            ["message" => "Price can't be less than 0"],
            422
        );
    }
    return response()->json($request);
});

Route::post('/ejercicio2/c', function (Request $request) {
    $req = $request->all();
    $discount = 0;
    if ($request->query->get('discount')) {
        $discount = (int) str_replace("SAVE", "", $request->query->get('discount'));
    }

    if (((float)$req['price']) < 0) {
        return response()->json(
            ["message" => "Price can't be less than 0"],
            422
        );
    }

    $price = (float)$req['price'];
    $price = $price - ($discount ? ($price * ($discount / 100)) : 0);
    return response()->json([
        "name" => $req['name'],
        "description" => $req['description'],
        "price" => $price,
        "discount" => $discount,
    ], 200);
});
