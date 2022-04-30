<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Ejercicio4Test extends TestCase
{
    use DatabaseMigrations;

    public function test_usuario_puede_crear_producto()
    {
        $user = User::factory()->createOne();

        $data = [
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200
        ];

        $response = $this->actingAs($user)->post(route('products.store'), $data);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', [...$data, 'user_id' => $user->id]);
        $response->assertExactJson([
            'message' => 'Product created successfully',
            'product' => Product::first()->toArray(),
        ]);
    }

    /**
     * @depends test_usuario_puede_crear_producto
     */
    public function test_index_devuelve_todos_los_productos_que_pertenecen_al_usuario() {
        [$user1, $user2] = User::factory(2)->create();

        $p1 = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user1->id,
        ]);

        $p2 = Product::create([
            'name' => 'Monitor',
            'description' => '27" 1440p 144Hz IPS monitor',
            'price' => 500,
            'user_id' => $user1->id,
        ]);

        $p3 = Product::create([
            'name' => 'Mouse',
            'description' => 'Gaming mouse',
            'price' => 100,
            'user_id' => $user2->id,
        ]);

        $response = $this->actingAs($user1)->get(route('products.index'));

        $response->assertOk()->assertExactJson([
            'products' => [$p1->toArray(), $p2->toArray()]]
        );
    }

    /**
     * @depends test_usuario_puede_crear_producto
     */
    public function test_usuario_puede_ver_producto_creado_por_otro_usuario()
    {
        [$user1, $user2] = User::factory(2)->create();
        
        $product = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user1->id,
        ]);

        $response = $this->actingAs($user2)->get(route('products.show', $product->id));

        $response->assertOk()->assertExactJson([
            'product' => $product->toArray()
        ]);
    }

    /**
     * @depends test_usuario_puede_crear_producto
     */
    public function test_usuario_puede_editar_producto()
    {
        $user = User::factory()->createOne();
        
        $product = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user->id,
        ]);

        $data =  [
            'name' => 'Updated name',
            'description' => 'Updated description',
            'price' => 400,
        ];

        $response = $this->actingAs($user)->put(route('products.update', $product->id), $data);

        $response->assertOk()->assertExactJson([
            'message' => 'Product updated successfully',
            'product' => [...$product->toArray(), ...$data]
        ]);
    }

    /**
     * @depends test_usuario_puede_crear_producto
     */
    public function test_usuario_puede_borrar_producto()
    {
        $user = User::factory()->createOne();
        
        $product = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('products.destroy', $product->id));

        $response->assertOk()->assertExactJson([
            'message' => 'Product deleted successfully',
            'product' => [...$product->toArray()]
        ]);
    }

    /**
     * @depends test_usuario_puede_crear_producto
     */
    public function test_solo_usuario_propietario_del_producto_puede_borrarlo_o_editarlo()
    {
        [$user1, $user2] = User::factory(2)->create();
        
        $product = Product::create([
            'name' => 'Keyboard',
            'description' => 'Mechanical keyboard',
            'price' => 200,
            'user_id' => $user1->id,
        ]);

        $response = $this->actingAs($user2)->delete(route('products.destroy', $product->id));
        $response->assertForbidden();
        $response = $this->actingAs($user2)->delete(route('products.update', $product->id), []);
        $response->assertForbidden();
    }
}
