@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Contact information</div>

            <div class="card-b<ody">
              <p>Name: {{ $contact->name }}</p>
              <p>EMail: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
              <p>Phone: <a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a></p>
              <p>Age: {{ $contact->age }}</p>
              <p>{{ $contact->created_at }}</p>
              <p>{{ $contact->updated_at }}</p>
            </div>

        </div>
      </div>
    </div>
  </div>
@endsection
