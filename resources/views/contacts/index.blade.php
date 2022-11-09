@extends('layouts.app')

@section('content')
  <div class="container">

    @forelse($contacts as $contact)
      <div class="d-flex justify-content-between bg-dark mb-3 rounded px-4 py-2">
        <div>
          <img src="https://picsum.photos/20/20" style="width: 20px;">
        </div>

        <div class="d-flex align-items-center">
          <p class="me-2 mb-0">{{ $contact->name }}</p>
          <p class="me-2 mb-0 d-none d-md-block">
            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
          </p>
          <p class="me-2 mb-0 d-none d-none d-md-block">
            <a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a>
          </p>

        </div>
      </div>
    @empty
      <div class="col-md-4 mx-auto">
        <div class="card card-bdy text-center">
          <p>No hay contactos</p>
          <a href="{{ route('contacts.create') }}">Añade uno</a>
        </div>
      </div>
    @endforelse

  </div>
@endsection
