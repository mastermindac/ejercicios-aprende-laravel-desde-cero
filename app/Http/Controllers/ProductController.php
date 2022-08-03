<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = auth()->user()->products()->create($request->all());
        Log::info('Product created', ["product" => $product]);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        Log::info('Product deleted', ["product" => $product]);

        return response()->json([
            'message' => 'Product deleted successfully',
            'product' => $product
        ]);
    }
}
