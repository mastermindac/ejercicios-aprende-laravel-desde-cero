@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create new contact</div>

            <div class="card-body">
              <form method="POST" action="{{ route('contacts.store') }}">
                @csrf

                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="phone_number"
                    class="col-md-4 col-form-label text-md-end">Phone Number</label>

                  <div class="col-md-6">
                    <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" 
                      name="phone_number" value="{{ old('phone_number') }}" autocomplete="phone_number">
                      @error('phone_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  
                </div>

                <div class="row mb-3">
                  <label for="phone_number"
                    class="col-md-4 col-form-label text-md-end">email</label>

                  <div class="col-md-6">
                    <input id="email" type="tel" class="form-control @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}" autocomplete="email">
                      @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  </div>
                  
                  
                </div>

                <div class="row mb-3">
                  <label for="age"
                    class="col-md-4 col-form-label text-md-end">Age</label>

                  <div class="col-md-6">
                    <input id="age" type="tel" class="form-control @error('age') is-invalid @enderror" 
                      name="age" value="{{ old('age') }}" autocomplete="age">
                       @error('age')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  </div>
                 
                </div>

                <div class="row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
