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
            <h5 class="mt-3">Top Rank by performance</h5>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                        <div class="col-lg-3">
                            <form action="{{route('user.performanceDataFilter')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <div class="mb-3">
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary px-3">find report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <div class="table-responsive">
                <table>
                    <tbody>
                        <tr>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th style="width:50px;">#SN</th>
                                        <th>Employee</th>
                                        <th>Disbursement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('disbursement', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'disbursement' => $data->disbursement]);
                                                $sorted = $collection->sortBy([['disbursement', 'desc']]);
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
                                                    <td>{{$key}}</td>
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:100px">{{$item['disbursement']}}</td>
                                                    @php
                                                        $result = $result + $item['disbursement']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="2">Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Receivable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('receivable', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'receivable' => $data->receivable]);
                                                $sorted = $collection->sortBy([['receivable', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:100px">{{$item['receivable']}}</td>
                                                    @php
                                                        $result = $result + $item['receivable']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Regular receive</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('regular_receive', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'regular_receive' => $data->regular_receive]);
                                                $sorted = $collection->sortBy([['regular_receive', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:140px">{{$item['regular_receive']}}</td>
                                                    @php
                                                        $result = $result + $item['regular_receive']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Dues collection</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('dues_collection', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'dues_collection' => $data->dues_collection]);
                                                $sorted = $collection->sortBy([['dues_collection', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:140px">{{$item['dues_collection']}}</td>
                                                    @php
                                                        $result = $result + $item['dues_collection']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Advance collection</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('advance_collection', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'advance_collection' => $data->advance_collection]);
                                                $sorted = $collection->sortBy([['advance_collection', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:160px">{{$item['advance_collection']}}</td>
                                                    @php
                                                        $result = $result + $item['advance_collection']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Total collection</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('total_collection', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'total_collection' => $data->total_collection]);
                                                $sorted = $collection->sortBy([['total_collection', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:160px">{{$item['total_collection']}}</td>
                                                    @php
                                                        $result = $result + $item['total_collection']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>OTR %</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
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
                                        @if ($sorted)
                                            @php
                                                $key = 0;
                                            @endphp
                                            @foreach ($sorted as $item)
                                                @php
                                                    $key = $key+1
                                                @endphp
                                                <tr>
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:100px">{{$item['otr']}}</td>
                                                    @php
                                                        $result = $result + $item['otr']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{number_format($result / $sorted->count(), 2)}}%</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>New due</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('new_due', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'new_due' => $data->new_due]);
                                                $sorted = $collection->sortBy([['new_due', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:100px">{{$item['new_due']}}</td>
                                                    @php
                                                        $result = $result + $item['new_due']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                        <th>Inc / Dic</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $result = 0;
                                            $collection = collect([]);
                                            $sorted = []
                                        @endphp
                                        @foreach ($allStaff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('inc_dic', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push(['name' => $staff->name, 'inc_dic' => $data->inc_dic]);
                                                $sorted = $collection->sortBy([['inc_dic', 'desc']]);
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
                                                    <td style="min-width:220px">{{$item['name']}}</td>
                                                    <td style="min-width:100px">{{$item['inc_dic']}}</td>
                                                    @php
                                                        $result = $result + $item['inc_dic']
                                                    @endphp
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Total</th>
                                                <th>{{$result}}/=</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
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