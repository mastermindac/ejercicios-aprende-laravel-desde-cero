<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Contact::create($request->all());
        // return response("Contact created");
        // dd("entra");
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'digits:9'],
            'age' => 'required|numeric|min:1|max:25',
        ]);

        Contact::create($data);

        return redirect()->route('home');

        // if (is_null($request->get('name'))) {
        //     return back()->withErrors(['name' => 'Este campo es required']);
        // }



        if (is_null($request->get('name'))) {

            //dd( $request->get('name') );


            // Distintas maneras para redirigir hacia atrar para mosrar el error
            // return Response::redirectTo('/contacts/create')->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);

            // return response()->redirectTo('/contacts/create')->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);

            // return redirect('/contacts/create')->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);

            // return redirect(route('contacs.create'))->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);

            // return redirect()->route('contacs.create')->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);

            // return redirect()->back()->withErrors([
            //     'name'=> 'Esto es requerido',
            // ]);
            return back()->withErrors([
                'name' => 'Esto es requerido',
            ]);
        }


        return response("contact created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(int $contactId)
    {
        $contact = Contact::findOrFail($contactId);
        // dd(request()->route('contact'));
        return view('contacts.update', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'digits:9'],
            'age' => 'required|numeric|min:1|max:25',
        ]);

        $contact->update($data);

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect( route('home') );
    }
}
