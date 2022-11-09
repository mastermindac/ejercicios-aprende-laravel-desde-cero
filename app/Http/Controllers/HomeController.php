<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $contacts = auth()->user()->contacts;   
        return view('home', ['contacts' => $contacts]);
    }

    // php artisan tinker, que es:

    // Es una especie de shell para interactuar con la aplicacion de laravel
    // aqui puedes, imaginate que tienes una query supertocha, para no ponerla en el codigo
    // se usa esta terminal.Ejecuta sentencias sql llamando a lasclases de modelos de laravel


    // User::find(1)->contacts()->get();

    // Contact::first()


}
