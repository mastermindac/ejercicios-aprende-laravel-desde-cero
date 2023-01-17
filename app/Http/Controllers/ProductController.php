<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $products = auth()->user()->products()->get(); 

         
        return response()->json(["products" => $products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {



        $data = $request->validated();
        $product= auth()->user()->products()->create($data); // ya crea automaticamente la FK



/*
        $data = $request->validate([
            'name' => 'required|max:64',
            'description' => 'required|max:512',
            'price' => 'required|numeric|min:1',
        ]);

        $data['user_id'] = auth()->user()->id;

        $product = Product::create($data);
*/


        return response()->json([
            "message" => "Product created successfully",
            "product" => $product
        ]);
   
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return response()->json([
            "product" => $product
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //$this->authorize('update', $product);

        //return $product;
        return response()->json(["product" => $product]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        $product->update($data);



        return response()->json([
            "message" => "Product updated successfully",
            "product" => $product
        ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json([
            "message" => "Product deleted successfully",
            "product" => $product
        ]);

    }
}
