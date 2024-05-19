@extends('layouts.master')

@section('title','Login')

@push('css')
    
@endpush

@section('content')
<section class="login-form">
      <div class="container my-5 py-0 py-md-5">
          <div class="row justify-content-center align-items-center">
              <div class="col-md-5 p-3 p-md-5 rounded-3 bg-white shadow">
                  <div class="text-center mb-5">
                    <a href="#"><img style="height: 50px;" src="{{asset('assets/img/logo.png')}}" class="img-fluid" alt="Imgae"></a>
                    <h5 class="mt-3 fw-light">Admin Login</h5>
                  </div>
                  <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf
                        <div class="mb-3">
                            <input class="form-control bg-light" type="email" placeholder="Email address" name="email" :value="old('email')" required autofocus/>
                        </div>
                        <div class="mb-3">
                            <input class="form-control bg-light" type="password" placeholder="Password" name="password" required autocomplete="current-password" />
                        </div>
                      <div class="form-check d-flex mb-3">
                        <label class="form-check-label">
                          <input class="form-check-input rounded-1" type="checkbox" name="remember"> Remember me
                        </label>
                        <a class="ms-auto text-success" href="#">Forget password</a>
                      </div>
                      <div class="d-grid">
                        <button type="submit" class="btn btn-success mb-3 px-4 rounded-pill">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
@endsection
@push('js') 

@endpush