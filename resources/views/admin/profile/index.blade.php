@extends('layouts.master')

@section('title','Profile')

@push('css')
    
@endpush

@section('content')
  <div class="row g-3">
      <div class="col-lg-2">
        <div class="card border-0 h-100">
          @if($admin->image)
            <img class="card-img-top" src="{{ asset('storage/profile/'.$admin->image) }}" alt="Profile Image" />
          @else
            <img class="card-img-top" src="{{asset('assets/img/profile.jpg')}}" alt="Profile Image" />
          @endif
          <div class="card-body">
            <h5 class="card-title">{{$admin->name}} 
              @if ($admin->status == 1)
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Unverified">
                  <small class="fa fa-check-circle text-danger" data-fa-transform="shrink-4 down-2"></small>
                </span>
              @else
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified">
                  <small class="fa fa-check-circle text-success" data-fa-transform="shrink-4 down-2"></small>
                </span>
              @endif
              </h5>
              <p class="small">Admin</p>
            <p class="card-text">{{$admin->email}}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card border-0 p-3 h-100">
          <div class="card-header border-0 bg-white">
            <h5 class="mb-0">Profile Settings</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update',$admin->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row g-2">
                <div class="col-sm-12 col-lg-6">
                  <div class="mb-3">
                    <label class="form-label" for="name"> Name</label>
                    <input class="form-control" type="text" name="name" placeholder="First Name" id="name" :value="old('name')" value="{{$admin->name}}" required/>
                  </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                      <div class="mb-3">
                          <label class="form-label" for="bootstrap-wizard-wizard-email">Email*</label>
                          <input class="form-control" type="email" name="email" :value="old('email')" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required id="bootstrap-wizard-wizard-email" data-wizard-validate-email="true" value="{{$admin->email}}" />
                        <div class="invalid-feedback">You must add email</div>
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
        <div class="card border-0 p-3 h-100">
            <div class="card-header border-0 bg-white">
              <h5>Change Password</h5>
            </div>
            <div class="card-body">
              <form action="{{route('admin.profile.updatePassword')}}" method="POST">
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
