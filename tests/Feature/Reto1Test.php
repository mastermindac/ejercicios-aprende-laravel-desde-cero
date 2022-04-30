<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class Reto1Test extends TestCase
{
    use DatabaseMigrations;

    public function test_log_producto_creado()
    {
        $user = User::factory()->createOne();

        $data = [
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200
        ];

        Log::shouldReceive('info')->once()->withArgs(
            fn ($message, $context) => $message === 'Product created'
                && $context['product']->only(['name', 'description', 'price', 'user_id']) === [...$data, 'user_id' => $user->id]
        );

        $this->actingAs($user)->post(route('products.store'), $data);
    }

    public function test_log_producto_borrado()
    {
        $user = User::factory()->createOne();
        
        $product = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user->id,
        ]);

        Log::shouldReceive('info')->once()->withArgs(
            fn ($message, $context) => $message === 'Product deleted' && $context['product']->is($product)
        );

        $this->actingAs($user)->delete(route('products.destroy', $product->id));
    }
}
