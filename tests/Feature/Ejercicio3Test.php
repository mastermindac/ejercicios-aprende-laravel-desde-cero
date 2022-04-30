<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Ejercicio3Test extends TestCase {
    public function test_ejercicio3_datos_correctos_pasan_la_validacion() {
        $response = $this->post('/ejercicio3', [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB Keyboard',
            'price' => 200,
            'has_battery' => true,
            'battery_duration' => 8,
            'colors' => ['blue', 'white', 'black'],
            'dimensions' => ['width' => 40, 'height' => 5, 'length' => 20],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => 20],
                ['name' => 'Keycaps', 'price' => 15],
            ]
        ]);

        $response->assertSessionDoesntHaveErrors();
    }

    public function test_ejercicio3_campo_battery_duration_no_se_tiene_cuenta_si_has_battery_es_falso() {
        $response = $this->post('/ejercicio3', [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB Keyboard',
            'price' => 200,
            'has_battery' => false,
            'colors' => ['blue', 'white', 'black'],
            'dimensions' => ['width' => 40, 'height' => 5, 'length' => 20],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => 20]
            ]
        ]);

        $response->assertSessionDoesntHaveErrors();
    }

    public function test_ejercicio3_datos_con_campos_que_faltan_no_pasan_la_validacion() {
        $response = $this->post('/ejercicio3', [
            'colors' => [],
            'dimensions' => ['width' => 40, 'height' => 5, 'length' => 20],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => 20]
            ]
        ]);

        $response->assertSessionHasErrors(['name', 'description', 'price', 'has_battery', 'colors']);
        $response->assertSessionDoesntHaveErrors(['battery_duration']);
    }

    public function test_ejercicio3_nombre_y_descripcion_con_demasiados_caracters_no_pasan_la_validacion() {
        $response = $this->post('/ejercicio3', [
            'name' => str_repeat("Long Name", 16),
            'description' => str_repeat("Long Description", 64),
            'price' => 200,
            'has_battery' => true,
            'battery_duration' => 8,
            'colors' => ['blue', 'white', 'black'],
            'dimensions' => ['width' => 40, 'height' => 5, 'length' => 20],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => 20],
                ['name' => 'Keycaps', 'price' => 15],
            ]
        ]);

        $response->assertSessionHasErrors(['name', 'description']);
    }

    public function test_ejercicio3_precios_de_un_centavo_son_correctos() {
        $response = $this->post('/ejercicio3', [
            'name' => 'Keyboard',
            'description' => 'Mechanical RGB Keyboard',
            'price' => 0.01,
            'has_battery' => true,
            'battery_duration' => 8,
            'colors' => ['blue', 'white', 'black'],
            'dimensions' => ['width' => 40, 'height' => 5, 'length' => 20],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => 0.1],
                ['name' => 'Keycaps', 'price' => 0.05],
            ]
        ]);

        $response->assertSessionDoesntHaveErrors();
    }

    public function test_ejercicio3_datos_con_campos_null_o_numeros_negativos_no_pasan_la_validacion() {
        $response = $this->post('/ejercicio3', [
            'name' => null,
            'description' => null,
            'price' => -100,
            'has_battery' => true,
            'battery_duration' => -5,
            'colors' => [null, 'white', 'black'],
            'dimensions' => ['width' => -5, 'height' => 5, 'length' => -5],
            'accessories' => [
                ['name' => 'Wrist rest', 'price' => -5],
                ['name' => null, 'price' => 0.0]
            ]
        ]);

        $response->assertSessionHasErrors([
            'name',
            'description',
            'price',
            'battery_duration',
            'colors.0',
            'dimensions.width',
            'dimensions.length',
            'accessories.0.price',
            'accessories.1.name',
            'accessories.1.price',
        ]);
    }
}
