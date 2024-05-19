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
            <h5 class="mt-3">Top Rank performance by Branch</h5>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-lg-3">
                    <form action="{{route('user.branchPerformanceDataFilter')}}" method="get">
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width:50px;">#SN</th>
                        <th>Branch</th>
                        <th>Disbursement</th>
                        <th>Receivable</th>
                        <th>Regular Receive</th>
                        <th>Dues collection</th>
                        <th>Advance Collection</th>
                        <th>Total collection</th>
                        <th>OTR</th>
                        <th>New due</th>
                        <th>Inc/Dic</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if ($regions->count() > 0)
                            @foreach ($regions as $region)
                                @php
                                    $region_disbursement_total = 0;
                                    $region_receivable_total = 0;
                                    $region_regular_receive_total = 0;
                                    $region_dues_collection_total = 0;
                                    $region_advance_collection_total = 0;
                                    $region_total_collection_total = 0;
                                    $region_otr_total = 0;
                                    $region_new_due_total = 0;
                                    $region_inc_dic_total = 0;
                                @endphp
                                @php
                                    $collection2 = collect([]);
                                    $sorted2 = [];
                                @endphp
                                @foreach ($branches->where('region_id', $region->id) as $branch)
                                @php
                                    $result_disbursement = 0;
                                    $result_receivable = 0;
                                    $result_regular_receive = 0;
                                    $result_dues_collection = 0;
                                    $result_advance_collection = 0;
                                    $result_total_collection = 0;
                                    $result_otr = 0;
                                    $result_new_due = 0;
                                    $result_inc_dic = 0;
                                @endphp
                                    @if ($branch->staff()->count() > 0)
                                        @php
                                            $collection = collect([]);
                                            $sorted = [];
                                        @endphp
                                        @foreach ($branch->staff as $staff)
                                        @php
                                            $data = $staff->data()->orderBy('id', 'desc')->whereDate('date', $carbon)->first();
                                            if ($data) {
                                                $collection = $collection->push([
                                                    'name' => $staff->name,
                                                    'disbursement' => $data->disbursement,
                                                    'receivable' => $data->receivable,
                                                    'regular_receive' => $data->regular_receive,
                                                    'dues_collection' => $data->dues_collection,
                                                    'advance_collection' => $data->advance_collection,
                                                    'total_collection' => $data->total_collection,
                                                    'otr' => $data->otr,
                                                    'new_due' => $data->new_due,
                                                    'inc_dic' => $data->inc_dic,
                                            ]);
                                                $sorted = $collection->sortBy([['disbursement', 'desc']]);
                                            }
                                        @endphp
                                        @endforeach
                                        @if ($sorted)
                                            @foreach ($sorted as $item)
                                                @php
                                                    $result_disbursement = $result_disbursement + $item['disbursement'];
                                                    $result_receivable = $result_receivable + $item['receivable'];
                                                    $result_regular_receive = $result_regular_receive + $item['regular_receive'];
                                                    $result_dues_collection = $result_dues_collection + $item['dues_collection'];
                                                    $result_advance_collection = $result_advance_collection + $item['advance_collection'];
                                                    $result_total_collection = $result_total_collection + $item['total_collection'];
                                                    $result_otr = $result_otr + $item['otr'];
                                                    $result_new_due = $result_new_due + $item['new_due'];
                                                    $result_inc_dic = $result_inc_dic + $item['inc_dic'];
                                                @endphp
                                            @endforeach
                                            @php
                                                $resultOtr = number_format(($result_regular_receive / $result_receivable)*100, 2);
                                                $collection2 = $collection2->push([
                                                    'name2' => $branch->name,
                                                    'disbursement2' => $result_disbursement,
                                                    'receivable2' => $result_receivable,
                                                    'regular_receive2' => $result_regular_receive,
                                                    'dues_collection2' => $result_dues_collection,
                                                    'advance_collection2' => $result_advance_collection,
                                                    'total_collection2' => $result_total_collection,
                                                    'otr2' => $resultOtr,
                                                    'new_due2' => $result_new_due,
                                                    'inc_dic2' => $result_inc_dic,
                                            ]);
                                                $sorted2 = $collection2->sortBy([['otr2', 'desc']]);
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                                @if ($sorted2)
                                @php
                                    $key = 0;
                                @endphp
                                    @foreach ($sorted2 as $item2)
                                        @php
                                            $key = $key+1;
                                        @endphp
                                        <tr>
                                            <th>{{$key}}</th>
                                            <td style="min-width:160px">{{$item2['name2']}}</td>
                                            <td style="min-width:120px">{{$item2['disbursement2']}}</td>
                                            <td style="min-width:120px">{{$item2['receivable2']}}</td>
                                            <td style="min-width:140px">{{$item2['regular_receive2']}}</td>
                                            <td style="min-width:140px">{{$item2['dues_collection2']}}</td>
                                            <td style="min-width:160px">{{$item2['advance_collection2']}}</td>
                                            <td style="min-width:140px">{{$item2['total_collection2']}}</td>
                                            <td style="min-width:120px">{{number_format(($item2['regular_receive2'] / $item2['receivable2'])*100, 2)}}%</td>
                                            <td style="min-width:120px">{{$item2['new_due2']}}</td>
                                            <td style="min-width:120px">{{$item2['inc_dic2']}}</td>
                                        </tr>
                                        @php
                                            $region_disbursement_total = $region_disbursement_total + $item2['disbursement2'];
                                            $region_receivable_total = $region_receivable_total + $item2['receivable2'];
                                            $region_regular_receive_total = $region_regular_receive_total + $item2['regular_receive2'];
                                            $region_dues_collection_total = $region_dues_collection_total + $item2['dues_collection2'];
                                            $region_advance_collection_total = $region_advance_collection_total + $item2['advance_collection2'];
                                            $region_total_collection_total = $region_total_collection_total + $item2['total_collection2'];
                                            $region_otr_total = $region_otr_total + $item2['otr2'];
                                            $region_new_due_total = $region_new_due_total + $item2['new_due2'];
                                            $region_inc_dic_total = $region_inc_dic_total + $item2['inc_dic2'];
                                        @endphp
                                    @endforeach
                                @endif
                                @if ($data)
                                    <tr>
                                        <th colspan="2" class="rmf-bg-primary">Branch of {{$region->name}}</th>
                                        <th>{{$region_disbursement_total}}/-</th>
                                        <th>{{$region_receivable_total}}/-</th>
                                        <th>{{$region_regular_receive_total}}/-</th>
                                        <th>{{$region_dues_collection_total}}/-</th>
                                        <th>{{$region_advance_collection_total}}/-</th>
                                        <th>{{$region_total_collection_total}}/-</th>
                                        <th>
                                            @if ($sorted2)
                                                {{number_format(($region_regular_receive_total / $region_receivable_total)*100, 2)}}%
                                            @endif
                                        </th>
                                        <th>{{$region_new_due_total}}/-</th>
                                        <th>{{$region_inc_dic_total}}/-</th>
                                    </tr>
                                @endif
                            @endforeach
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