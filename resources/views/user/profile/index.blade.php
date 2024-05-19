@extends('layouts.master')

@section('title','Profile')

@push('css')
    
@endpush

@section('content')
  <div class="row g-3">
        <div class="col-lg-2">
          <div class="card border-0 h-100 shadow-sm">
            @if($user->image)
              <img class="card-img-top" src="{{ asset('storage/profile/'.$user->image) }}" alt="Profile Image" />
            @else
              <img class="card-img-top" src="{{asset('assets/img/profile.jpg')}}" alt="Profile Image" />
            @endif
            <div class="card-body">
              <h5 class="card-title">{{$user->name}} 
                @if ($user->status == 1)
                  <span data-bs-toggle="tooltip" data-bs-placement="right" title="Unverified">
                    <small class="fa fa-check-circle text-danger" data-fa-transform="shrink-4 down-2"></small>
                  </span>
                @else
                  <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified">
                    <small class="fa fa-check-circle text-success" data-fa-transform="shrink-4 down-2"></small>
                  </span>
                @endif
                </h5>
              <p class="card-text">{{$user->email}}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card border-0 p-3 h-100 shadow-sm">
            <div class="card-header border-0 bg-white">
              <h5 class="mb-0">Profile Settings</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('user.profile.update',$user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-2">
                  <div class="col-sm-12 col-lg-4">
                    <div class="mb-3">
                      <label class="form-label" for="name"> Name</label>
                      <input class="form-control" type="text" name="name" placeholder="First Name" id="name" :value="old('name')" value="{{$user->name}}" required/>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4">
                      <div class="mb-3">
                          <label class="form-label" for="email">Email*</label>
                          <input class="form-control" type="email" name="email" :value="old('email')" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required id="email" data-wizard-validate-email="true" value="{{$user->email}}" />
                        <div class="invalid-feedback">You must add email</div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-4">
                      <div class="mb-3">
                          <label class="form-label" for="phone">Phone*</label>
                          <input class="form-control" type="text" name="phone" :value="old('phone')" placeholder="phone numbr" id="phone" data-wizard-validate-email="true" value="{{$user->phone}}" />
                      </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="customFile">Profile Image</label>
                  <input class="form-control" id="customFile" type="file" name="image" />
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary px-5 px-sm-6" type="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card border-0 p-3 h-100 shadow-sm">
              <div class="card-header border-0 bg-white">
                <h5>Change Password</h5>
              </div>
              <div class="card-body">
                <form action="{{route('user.profile.updatePassword')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <input class="form-control" id="old-password" type="password" name="old_password" placeholder="Old Password"/>
                  </div>
                  <div class="mb-3">
                    <input class="form-control" id="new-password" type="password" name="password" placeholder="New Password"/>
                  </div>
                  <div class="mb-3">
                    <input class="form-control" id="confirm-password" type="password" name="password_confirmation" placeholder="Confirm Password"/>
                  </div>
                  <button class="btn btn-primary d-block w-100 mb-3" type="submit">Update Password </button>
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection
@push('js')   

@endpush
