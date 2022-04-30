<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Ejercicio1Test extends TestCase
{
    private function ejercicio1_request($method, $expected) {
        $response = $this->{$method}('/ejercicio1');

        $method = strtoupper($method);

        $this->assertEquals(
            200,
            $response->status(),
            "La peticion $method /ejercicio1 ha recibido un codigo de estado incorrecto: {$response->status()}, asegurate de que la ruta existe y el metodo HTTP es el que toca"
        );

        $this->assertEquals(
            $expected,
            $response->getContent(),
            "La peticion $method /ejercicio1 debe devolver la cadena '$expected', pero ha devuelto '{$response->getContent()}'"
        );
    }

    public function test_ejercicio1_get_ok() {
        $this->ejercicio1_request('get', "GET OK");
    }

    public function test_ejercicio1_post_ok() {
        $this->ejercicio1_request('post', "POST OK");
    }

    public function test_ejercicio1_put_ok() {
        $this->ejercicio1_request('put', "PUT OK");
    }

    public function test_ejercicio1_patch_ok() {
        $this->ejercicio1_request('patch', "PATCH OK");
    }

    public function test_ejercicio1_delete_ok() {
        $this->ejercicio1_request('delete', "DELETE OK");
    }
}
