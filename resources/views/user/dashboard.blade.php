@extends('layouts.master')
@section('title','User | Dashboard')
@push('css')
@endpush
@section('content')
  <div class="row g-3">
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm h-100 p-2">
                <div class="card-body">
                    <h5>Total Region</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Region::where('user_id', Auth::id())->count()}}</h2>
                            <a href="{{route('user.region.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/region.png')}}" alt="branch-manager" style="height: 80px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm h-100 p-2">
                <div class="card-body">
                    <h5>Total Branch</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Branch::where('user_id', Auth::id())->count()}}</h2>
                            <a href="{{route('user.branch.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/branch.png')}}" alt="branch-manager" style="height: 80px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow-sm h-100 p-2">
                <div class="card-body">
                    <h5>Total Staff</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Staff::where('user_id', Auth::id())->count()}}</h2>
                            <a href="{{route('user.staff.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/staff.png')}}" alt="branch-manager" style="height: 100px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('js')

@endpush