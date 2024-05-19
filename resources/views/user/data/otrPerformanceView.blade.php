@extends('layouts.master')

@section('title','Category')

@push('css')
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="card mb-3 border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mt-3">Top OTR performance</h5>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <form action="{{route('user.otrPerformanceDataFilter')}}" method="get">
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
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#SN</th>
                            <th>Name of Employee</th>
                            <th class="text-end">OTR %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $result = 0;
                            $collection = collect([]);
                            $sorted = [];
                        @endphp
                        @foreach ($allStaff as $staff)
                            @php
                                $data = $staff->data()->orderBy('otr', 'desc')->whereDate('date', $carbon)->first();
                                if ($data) {
                                    $collection = $collection->push(['name' => $staff->name, 'otr' => $data->otr]);
                                    $sorted = $collection->sortBy([['otr', 'desc']]);
                                }
                            @endphp
                        @endforeach
                        @php
                            $key = 0;
                        @endphp
                        @if ($sorted)
                            @foreach ($sorted as $item)
                                @php
                                    $key = $key+1
                                @endphp
                                <tr>
                                    <td>{{$key}}</td>
                                    <td style="min-width:220px">{{$item['name']}}</td>
                                    <td style="min-width:140px" class="text-end">{{$item['otr']}}</td>
                                </tr>
                                @php
                                    $result = $result + $item['otr'];
                                @endphp
                            @endforeach
                        @endif
                        @if ($sorted)
                            <tr>
                                <th colspan="2" class="rmf-bg-primary">Average</th>
                                <th class="text-end rmf-bg-primary">{{number_format($result / $sorted->count(), 2)}}%</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js') 
   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#example');
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