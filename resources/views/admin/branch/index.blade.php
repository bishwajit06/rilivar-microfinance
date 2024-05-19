@extends('layouts.master')

@section('title','Category')

@push('css')
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endpush

@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-0 p-md-4 shadow border-0">
                <div class="card-header bg-white border-0">
                    <div class="d-flex">
                        <h5>Branch</h5>
                        <div class="ms-auto">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add branch <i class="fa-solid fa-circle-plus"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-4">
                                    <form action="{{route('admin.branch.store')}}" method="post">
                                        @csrf
                                        <div class="modal-header border-0">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create branch</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="region_id" class="form-label">Region Name</label>
                                                <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                    <option value="" selected>Select...</option>
                                                    @foreach (App\Models\Region::all() as $region)
                                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name" placeholder="Enter branch name">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create branch</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>#SN</th>
                            <th>Branch name</th>
                            <th>Under Region</th>
                            <th>Branch Slug</th>
                            <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $key => $branch)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$branch->name}}</td>
                                    <td>{{$branch->region->name}}</td>
                                    <td>{{$branch->slug}}</td>
                                    <td class="text-end">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$branch->slug}}">
                                    Edit
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$branch->slug}}" tabindex="-1" aria-labelledby="exampleModal{{$branch->slug}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-4">
                                                <form action="{{route('admin.branch.update',$branch->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModal{{$branch->slug}}Label">Update branch</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label for="region_id" class="form-label">Region Name</label>
                                                            <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                                @foreach (App\Models\Region::all() as $region)
                                                                    <option 
                                                                        {{$branch->region_id ==  $region->id ? 'selected' : ''}}
                                                                    value="{{$region->id}}">{{$region->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="region_id" class="form-label">Branch Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{$branch->name}}" placeholder="Category name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update branch</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-sm" type="button" onclick="deleteBranch({{ $branch->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">Delete</button>
                                    <form id="delete-form-{{ $branch->id }}" action="{{ route('admin.branch.destroy',$branch->id) }}" method="post" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js') 
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function deleteBranch(id) {
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