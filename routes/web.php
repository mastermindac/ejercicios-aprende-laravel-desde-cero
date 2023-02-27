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
    return $request;
});

Route::post('/ejercicio2/b', function (Request $request) {
    $precio = $request->get("price");

    if($precio < 0){
        return Response::json(["message"=>"Price can't be less than 0"])->setStatusCode(422);
    }else{
        return Response::json(["message"=>"Price correct"]);
    }
    
});

Route::post('/ejercicio2/c', function (Request $request) {
    $descuento = $request->get("discount");
    $precio = $request->get("price");

    
     if($descuento != NULL){
        if($descuento == "SAVE5"){
            $cantidad = 0.05;
            $precio_final = $precio - ($precio*$cantidad);

            return Response::json(["name"=>$request->get("name"),"description"=>$request->get("description"),"price"=>$precio_final,"discount"=>5]);
        }elseif($descuento == "SAVE10"){
            $cantidad = 0.1;
            $precio_final = $precio - ($precio*$cantidad);

            return Response::json(["name"=>$request->get("name"),"description"=>$request->get("description"),"price"=>$precio_final,"discount"=>10]);
        }else{
            $cantidad = 0.15;
            $precio_final = $precio - ($precio*$cantidad);

            return Response::json(["name"=>$request->get("name"),"description"=>$request->get("description"),"price"=>$precio_final,"discount"=>15]);
        }
    }else{
        return Response::json(["name"=>$request->get("name"),"description"=>$request->get("description"),"price"=>$request->get("price"),"discount"=>0]);
    } 
    
});