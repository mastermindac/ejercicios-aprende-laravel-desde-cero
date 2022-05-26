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

// Ejercicio 2 A 

Route::post('/ejercicio2/a', function (Request $request) {
    return Response::json([
        "name" => $request->name,
        "description" => $request->description,
        "price" => $request->price,
    ]);
});

// Ejercicio 2 B

Route::post('/ejercicio2/b', function (Request $request) {
    $price = $request->price;
    $mensaje = "";
    if($price < 0){
        $mensaje = "Price can't be less than 0";
    }else{
        $mensaje = "The price is " . $price;
    }
    return Response::json([
        "message"=> $mensaje
    ])->setStatusCode(422);
});


// Ejercicio 2 C

route::post('/ejercicio2/c', function (Request $request){
    if(!empty($request->get("discount"))){
        $discountCode = $request->get("discount"); 
        $discount = intval(trim($discountCode, "SAVE"));
    }else{
        $discount = 0;
    }
    $price = $request->price;
    if($discount > 0){
        $price = $price - (($price * $discount)/100)  ; 
    }else{
        $price;
    }
    return Response::json([
        "name" => $request->name,
        "description" => $request-> description,
        "price" => $price,
        "discount" => $discount 
    ]);
});