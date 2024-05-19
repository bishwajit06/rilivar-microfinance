@extends('layouts.master')

@section('title','Category')

@push('css')
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card p-0 p-md-4 shadow border-0">
            <div class="card-header bg-white border-0">
                <div class="d-flex">
                    <h5>All Staff</h5>
                    <div class="ms-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add staff <i class="fa-solid fa-circle-plus"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content p-4">
                                <form action="{{route('user.staff.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header border-0">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create staff</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Staff Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="staff name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="region_id" class="form-label">Region Name</label>
                                                    <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                        <option value="" selected>Select...</option>
                                                        @foreach (App\Models\Region::where('user_id', Auth::id())->get() as $region)
                                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="branch_id" class="form-label">Branch Name</label>
                                                    <select class="form-select bg-light" aria-label="Default select example" name="branch_id" id="branch_id" required>
                                                        <option value="" selected>Select...</option>
                                                        @foreach (App\Models\Branch::where('user_id', Auth::id())->get() as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Profile image</label>
                                                    <input class="form-control" type="file" id="image" name="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                        <th>#SN</th>
                        <th width="3%">ID</th>
                        <th>Staff name</th>
                        <th>Region</th>
                        <th>Branch</th>
                        <th>Phone</th>
                        <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $key => $item)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->Region->name}}</td>
                                <td>{{$item->branch->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td class="text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModal{{$item->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-4">
                                            <form action="{{route('user.staff.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModal{{$item->id}}Label">Update staff</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Staff Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="staff name" value="{{$item->name}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$item->phone}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="region_id" class="form-label">Region Name</label>
                                                                <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                                    @foreach (App\Models\Region::where('user_id', Auth::id())->get() as $region)
                                                                        <option 
                                                                            {{$item->region_id ==  $region->id ? 'selected' : ''}}
                                                                        value="{{$region->id}}">{{$region->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="branch_id" class="form-label">Branch Name</label>
                                                                <select class="form-select bg-light" aria-label="Default select example" name="branch_id" id="branch_id" required>
                                                                    @foreach (App\Models\Branch::where('user_id', Auth::id())->get() as $branch)
                                                                        <option 
                                                                            {{$item->branch_id ==  $branch->id ? 'selected' : ''}}
                                                                        value="{{$branch->id}}">{{$branch->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Profile image</label>
                                                                <input class="form-control" type="file" id="image" name="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-sm" type="button" onclick="deleteStaff({{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('user.staff.destroy',$item->id) }}" method="post" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{route('user.staff.show',$item->id)}}" class="btn btn-primary btn-sm" title="Details"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-4 g-3">
        @foreach ($staff as $key => $item)
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{$item->name}}</h5>
                    <div class="d-flex mb-3">
                        @if($item->image)
                        <img style="height: 80px" src="{{ asset('storage/profile/'.$item->image) }}" alt="Profile Image" />
                        @else
                        <img style="height: 80px" src="{{asset('assets/img/profile.jpg')}}" alt="Profile Image" />
                        @endif
                        <div class="align-self-center ms-3">
                            <p class="mb-1">{{$item->Region->name}}</p>
                            <p class="mb-1">{{$item->branch->name}}</p>
                            <p class="mb-1"><i class="fa-solid fa-phone-volume"></i> {{$item->phone}}</p>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModal{{$item->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content p-4">
                                <form action="{{route('user.staff.update',$item->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModal{{$item->id}}Label">Update staff</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Staff Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="staff name" value="{{$item->name}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$item->phone}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="region_id" class="form-label">Region Name</label>
                                                    <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                        @foreach (App\Models\Region::where('user_id', Auth::id())->get() as $region)
                                                            <option 
                                                                {{$item->region_id ==  $region->id ? 'selected' : ''}}
                                                            value="{{$region->id}}">{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="branch_id" class="form-label">Branch Name</label>
                                                    <select class="form-select bg-light" aria-label="Default select example" name="branch_id" id="branch_id" required>
                                                        @foreach (App\Models\Branch::where('user_id', Auth::id())->get() as $branch)
                                                            <option 
                                                                {{$item->branch_id ==  $branch->id ? 'selected' : ''}}
                                                            value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Staff</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-danger btn-sm" type="button" onclick="deleteStaff({{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('user.staff.destroy',$item->id) }}" method="post" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="{{route('user.staff.show',$item->id)}}" class="btn btn-primary btn-sm" title="Details"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('js') 
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false
            });
        });
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function deleteStaff(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush