@extends('layouts.master')
@section('title','Admin | Dashboard')
@push('css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow h-100 p-2">
                <div class="card-body">
                    <h5 class="text-primary-emphasis">Total Branch Manager</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\User::count()}}</h2>
                            <a href="{{route('admin.manager.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/branch-manager.png')}}" alt="branch-manager" style="height: 90px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow h-100 p-2">
                <div class="card-body">
                    <h5>Total Region</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Region::count()}}</h2>
                            <a href="{{route('admin.region.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/region.png')}}" alt="branch-manager" style="height: 80px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow h-100 p-2">
                <div class="card-body">
                    <h5>Total Branch</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Branch::count()}}</h2>
                            <a href="{{route('admin.branch.index')}}" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
                        </div>
                        <div class="ms-auto">
                            <img src="{{asset('assets/img/branch.png')}}" alt="branch-manager" style="height: 90px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card border-0 shadow h-100 p-2">
                <div class="card-body">
                    <h5>Total Staff</h5>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h2 class="h1">{{App\Models\Staff::count()}}</h2>
                            <a href="#" class="btn btn-light text-primary btn-sm shadow-sm rounded-1">More details</a>
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
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
      new DataTable('#example');
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    function deleteAccount(id) {
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