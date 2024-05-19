@extends('layouts.master')

@section('title','Category')

@push('css')
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card p-0 p-md-4 shadow border-0">
                <div class="card-header bg-white border-0">
                    <div class="d-flex">
                        <h5>Data Collection information</h5>
                        <div class="ms-auto">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add data info <i class="fa-solid fa-circle-plus"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content p-4">
                                        <form action="{{route('user.data.store')}}" method="post">
                                            @csrf
                                            <div class="modal-header border-0">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Information</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="staff_id" class="form-label">Staff name</label>
                                                            <select class="form-select bg-light" aria-label="Default select example" name="staff_id" id="staff_id" required>
                                                                <option value="" selected>Select...</option>
                                                                @foreach (App\Models\Staff::where('user_id', Auth::id())->get() as $staff)
                                                                    <option value="{{$staff->id}}">{{$staff->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="date" class="form-label">Collection date</label>
                                                            <input type="date" class="form-control" id="date" name="date" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="disbursement" class="form-label">Disbursement</label>
                                                            <input type="number" class="form-control" id="disbursement" name="disbursement" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="receivable" class="form-label">Receivable</label>
                                                            <input type="number" class="form-control" id="receivable" name="receivable" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="regular_receive" class="form-label">Regular receive</label>
                                                            <input type="number" class="form-control" id="regular_receive" name="regular_receive" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="dues_collection" class="form-label">Dues collection</label>
                                                            <input type="number" class="form-control" id="dues_collection" name="dues_collection" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="advance_collection" class="form-label">Advance collection</label>
                                                            <input type="number" class="form-control" id="advance_collection" name="advance_collection" required>
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
                    <div class="row justify-content-between">
                        <div class="col-lg-3">
                            <form action="{{route('user.data.filter')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <div class="mb-3">
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary px-3">Find report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{route('user.uploadData')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex">
                                    <div class="ms-auto">
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="ms-2">
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div>
                                    <div class="ms-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                <th>#SN</th>
                                <th>Employee</th>
                                <th>Disbursement</th>
                                <th>Receivable</th>
                                <th>Regular Receive</th>
                                <th>Dues Collection</th>
                                <th>Advance Collection</th>
                                <th>Total Collection</th>
                                <th>OTR %</th>
                                <th>New Due</th>
                                <th>Inc/Dic</th>
                                <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $collection = collect([]);
                                    $sorted = []
                                @endphp
                                @foreach ($allStaff as $staff)
                                    @php
                                        $data = $staff->data()->orderBy('otr', 'desc')->whereDate('date', $carbon)->first();
                                        if ($data) {
                                            $collection = $collection->push([
                                                'id' => $data->id, 
                                                'staff_id' => $data->staff_id,
                                                'date' => $data->date,
                                                'name' => $data->staff->name,
                                                'disbursement' => $data->disbursement,
                                                'receivable' => $data->receivable,
                                                'regular_receive' => $data->regular_receive,
                                                'dues_collection' => $data->dues_collection,
                                                'advance_collection' => $data->advance_collection,
                                                'total_collection' => $data->total_collection,
                                                'otr' => $data->otr,
                                                'new_due' => $data->new_due,
                                                'inc_dic' => $data->inc_dic
                                            ]);
                                            $sorted = $collection->sortBy([['otr', 'desc']]);
                                        }
                                    @endphp
                                    @endforeach
                                    @if ($sorted)
                                        @php
                                            $key = 0;
                                        @endphp
                                        @foreach ($sorted as $item)
                                            @php
                                                $key = $key+1
                                            @endphp
                                            <tr>
                                                <th scope="row">{{$key}}</th>
                                                <td>{{$item['name']}}</td>
                                                <td>{{$item['disbursement']}}</td>
                                                <td>{{$item['receivable']}}</td>
                                                <td>{{$item['regular_receive']}}</td>
                                                <td>{{$item['dues_collection']}}</td>
                                                <td>{{$item['advance_collection']}}</td>
                                                <td>{{$item['total_collection']}}</td>
                                                <td><strong>{{$item['otr']}}%</strong></td>
                                                <td>{{$item['new_due']}}</td>
                                                <td>{{$item['inc_dic']}}</td>
                                                <td class="text-end">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item['id']}}">
                                                    <i class="fas fa-edit text-primary"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModal{{$item['id']}}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content p-4">
                                                                <form action="{{route('user.data.update',$item['id'])}}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModal{{$item['id']}}Label">Update data</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-start">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="staff_id" class="form-label">Staff name</label>
                                                                                    <select class="form-select bg-light" aria-label="Default select example" name="staff_id" id="staff_id" required>
                                                                                        @foreach (App\Models\Staff::where('user_id', Auth::id())->get() as $staff)
                                                                                            <option {{$item['staff_id']  ==  $staff->id ? 'selected' : ''}} value="{{$staff->id}}">{{$staff->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="date" class="form-label">Collection date</label>
                                                                                    <input type="date" class="form-control" id="date" name="date" value="{{$item['date']}}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="disbursement" class="form-label">Disbursement</label>
                                                                                    <input type="number" class="form-control" id="disbursement" name="disbursement" value="{{$item['disbursement']}}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="receivable" class="form-label">Receivable</label>
                                                                                    <input type="number" class="form-control" id="receivable" name="receivable" value="{{$item['receivable']}}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="regular_receive" class="form-label">Regular receive</label>
                                                                                    <input type="number" class="form-control" id="regular_receive" name="regular_receive" value="{{$item['regular_receive']}}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="dues_collection" class="form-label">Dues collection</label>
                                                                                    <input type="number" class="form-control" id="dues_collection" name="dues_collection" value="{{$item['dues_collection']}}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label for="advance_collection" class="form-label">Advance collection</label>
                                                                                    <input type="number" class="form-control" id="advance_collection" name="advance_collection" value="{{$item['advance_collection']}}" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Update data</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn p-0 ms-1" type="button" onclick="deleteData({{ $item['id'] }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>
                                                    <form id="delete-form-{{ $item['id'] }}" action="{{ route('user.data.destroy',$item['id']) }}" method="post" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
        function deleteData(id) {
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