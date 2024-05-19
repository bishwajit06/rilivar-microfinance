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
                        <h5>Region</h5>
                        <div class="ms-auto">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add region <i class="fa-solid fa-circle-plus"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-4">
                                    <form action="{{route('user.region.store')}}" method="post">
                                        @csrf
                                        <div class="modal-header border-0">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create region</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name" placeholder="Enter region name">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create region</button>
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
                            <th>Region name</th>
                            <th>Region Slug</th>
                            <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $key => $region)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$region->name}}</td>
                                    <td>{{$region->slug}}</td>
                                    <td class="text-end">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$region->slug}}">
                                    Edit
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$region->slug}}" tabindex="-1" aria-labelledby="exampleModal{{$region->slug}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-4">
                                                <form action="{{route('user.region.update',$region->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModal{{$region->slug}}Label">Update region</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" name="name" value="{{$region->name}}" placeholder="Category name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update region</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger btn-sm" type="button" onclick="deleteRegion({{ $region->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">Delete</button>
                                    <form id="delete-form-{{ $region->id }}" action="{{ route('user.region.destroy',$region->id) }}" method="post" style="display:none;">
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
        function deleteRegion(id) {
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