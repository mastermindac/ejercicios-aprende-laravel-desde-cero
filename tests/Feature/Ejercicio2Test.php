<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Ejercicio2Test extends TestCase
{
    public function test_ejercicio_2_apartado_a_devuelve_lo_que_recibe()
    {
        $product = [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB keyboard',
            'price' => 200
        ];

        $response = $this->post('/ejercicio2/a', $product);
        
        $response->assertStatus(200);
        $response->assertExactJson($product);
    }

    /**
     * @depends test_ejercicio_2_apartado_a_devuelve_lo_que_recibe
     */
    public function test_ejercicio_2_apartado_b_comprueba_si_el_precio_es_menor_que_cero()
    {
        $product = [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB keyboard',
            'price' => -100
        ];

        $response = $this->post('/ejercicio2/b', $product);
        
        $response->assertStatus(422);
        $response->assertExactJson(["message" => "Price can't be less than 0"]);
    }

    /**
     * @depends test_ejercicio_2_apartado_b_comprueba_si_el_precio_es_menor_que_cero
     */
    public function test_ejercicio_2_apartado_c_aplica_descuento()
    {
        $price = 200;

        $product = [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB keyboard',
            'price' => $price,
            'discount' => 0,
        ];

        // Sin descuento
        $response = $this->post('/ejercicio2/c', $product);
        $response->assertStatus(200);
        $response->assertExactJson($product);

        // Con descuento
        foreach (['SAVE5' => 5, 'SAVE10' => 10, 'SAVE15' => 15] as $code => $amount) {
            $response = $this->post("/ejercicio2/c?discount=$code", $product);
            $response->assertStatus(200);
            $priceWithDiscount = (100 - $amount) / 100 * $price;
            $this->assertEquals(
                $priceWithDiscount, 
                $response['price'], 
                "Al aplicar el codigo de descuento $code a un precio de 200, el resultado deberia ser $priceWithDiscount, pero la respuesta ha devuelto {$response['price']}"
            );
            $this->assertEquals(
                $amount, 
                $response['discount'], 
                "Al aplicar el codigo de descuento $code, la respuesta tiene que contener en el campo 'discount' el porcentaje $amount, pero contiene: {$response['discount']}"
            );
            
            $response->assertExactJson([...$product, ...['price' => $priceWithDiscount, 'discount' => $amount]]);
        }
    }
}
