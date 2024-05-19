@extends('layouts.master')

@section('title','All users')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <section class="user-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4 border-0 bj-shadow p-3 px-md-4">
                    <div class="card-header border-0 bg-white">
                        <div class="d-flex">
                            <h5>All Branch Manager</h5>
                            <div class="ms-auto">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Create Branch Manager <i class="fa-solid fa-circle-plus ms-2"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-4">
                                            <form action="{{route('admin.manager.store')}}" method="post">
                                                @csrf
                                                <div class="modal-header border-0">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create branch manager</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Entet email" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Phone</label>
                                                                <input type="phone" class="form-control" id="phone" name="phone" placeholder="Entet phone number">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="region_id" class="form-label">Region Name</label>
                                                                <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                                    <option value="" selected>Select...</option>
                                                                    @foreach (App\Models\Region::all() as $region)
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
                                                                    @foreach (App\Models\Branch::all() as $branch)
                                                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3"><label class="form-label" for="password">Password*</label>
                                                                <input class="form-control bg-light" type="password" name="password" placeholder="Password" required id="password" data-wizard-validate-password="true" />
                                                                <div class="invalid-feedback">Please enter password</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3"><label class="form-label" for="password_confirmation">Confirm Password*</label><input class="form-control bg-light" type="password" name="password_confirmation" placeholder="Confirm Password" required id="password_confirmation" data-wizard-validate-confirm-password="true" />
                                                                <div class="invalid-feedback">Passwords need to match</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit data</button>
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
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Region</th>
                                    <th>Branch</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($user->image)
                                        <img class="rounded-circle border-2 border-primary" style="height: 25px; width:25px" src="{{ asset('storage/profile/'.$user->image) }}"/>
                                        <span class="ms-1">{{$user->name}}</span>
                                        @else
                                        <img class="rounded-circle border-2 border-primary" style="height: 25px; width:25px" src="{{asset('assets/img/profile.jpg')}}" alt="" />
                                        <span class="ms-1">{{$user->name}}</span>
                                        @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->region->name}}</td>
                                    <td>{{$user->branch->name}}</td>
                                    <td class="text-end">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user->id}}">
                                        <i class="fas fa-edit text-info"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModal-{{$user->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content p-4">
                                                    <form action="{{route('admin.manager.store')}}" method="post">
                                                        @csrf
                                                        <div class="modal-header border-0">
                                                            <h1 class="modal-title fs-5" id="exampleModal-{{$user->id}}Label">Update branch manager</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Entet email" value="{{$user->email}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="phone" class="form-label">Phone</label>
                                                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Entet phone number" value="{{$user->phone}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="region_id" class="form-label">Region Name</label>
                                                                        <select class="form-select bg-light" aria-label="Default select example" name="region_id" id="region_id" required>
                                                                            @foreach (App\Models\Region::all() as $region)
                                                                                <option 
                                                                                    {{$user->region_id ==  $region->id ? 'selected' : ''}}
                                                                                value="{{$region->id}}">{{$region->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="branch_id" class="form-label">Branch Name</label>
                                                                        <select class="form-select bg-light" aria-label="Default select example" name="branch_id" id="branch_id" required>
                                                                            @foreach (App\Models\Branch::all() as $branch)
                                                                                <option 
                                                                                    {{$user->branch_id ==  $branch->id ? 'selected' : ''}}
                                                                                value="{{$branch->id}}">{{$branch->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-lg-6">
                                                                    <div class="mb-3"><label class="form-label" for="password">Password*</label>
                                                                        <input class="form-control bg-light" type="password" name="password" placeholder="Password" required id="password" data-wizard-validate-password="true" />
                                                                        <div class="invalid-feedback">Please enter password</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3"><label class="form-label" for="password_confirmation">Confirm Password*</label><input class="form-control bg-light" type="password" name="password_confirmation" placeholder="Confirm Password" required id="password_confirmation" data-wizard-validate-confirm-password="true" />
                                                                        <div class="invalid-feedback">Passwords need to match</div>
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn p-0 ms-1" type="button" onclick="deleteUser({{ $user->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.manager.destroy',$user->id) }}" method="post" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        
                                        <a href="{{route('admin.manager.show',$user->id)}}" class="btn text-primary ms-1 p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details"><i class="fas fa-eye"></i>
                                    </td>
                                </tr>
                                @endforeach                      
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Region</th>
                                    <th>Branch</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')   
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    function deleteUser(id) {
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
