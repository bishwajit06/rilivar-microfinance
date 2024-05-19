@extends('layouts.master')

@section('title','Category')

@push('css')
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <form action="{{route('user.target.store')}}" method="post">
            @csrf
                <div class="card border-0">
                    <div class="card-header py-3 bg-white">
                        <h5 class="mt-2">Create Target</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <select class="form-select" aria-label="Default select example" name="branch_id" required>
                                        <option value="" selected>Select branch...</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-4">
                                    <select class="form-select" aria-label="Default select example" name="staff_id" required>
                                        <option value="" selected>Select Staff...</option>
                                        @foreach ($staffs as $staff)
                                        @if (!$staff->targets->count() > 0)
                                            <option value="{{$staff->id}}">{{$staff->name}}</option> 
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table" id="target-table">
                            <tr>
                                <th width=12%>Particular</th>
                                <th>P June</th>
                                <th>July</th>
                                <th>August</th>
                                <th>september</th>
                                <th>october</th>
                                <th>november</th>
                                <th>december</th>
                                <th>January</th>
                                <th>february</th>
                                <th>march</th>
                                <th>april</th>
                                <th>may</th>
                                <th>june</th>
                            </tr>
                            @foreach ($particulars as $particular)
                                <tr>
                                <input type="hidden" name="particular_id[]" value="{{$particular->id}}">
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="particular[]" placeholder="Name" value="{{$particular->name}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="p_june[]" placeholder="0" value="{{$particular->p_june}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="july[]" placeholder="0" value="{{$particular->july}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="august[]" placeholder="0" value="{{$particular->august}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="september[]" placeholder="0" value="{{$particular->september}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="october[]" placeholder="0" value="{{$particular->october}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="november[]" placeholder="0" value="{{$particular->november}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="december[]" placeholder="0" value="{{$particular->december}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="january[]" placeholder="0" value="{{$particular->january}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="february[]" placeholder="0" value="{{$particular->february}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="march[]" placeholder="0" value="{{$particular->march}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="april[]" placeholder="0" value="{{$particular->april}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="may[]" placeholder="0" value="{{$particular->may}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="june[]" placeholder="0" value="{{$particular->june}}"></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4"><h5 class="my-3">Create Achievement</h5></td>
                            </tr>
                            <tr>
                                <th colspan="2">Particular</th>
                                <th>July</th>
                                <th>August</th>
                                <th>september</th>
                                <th>october</th>
                                <th>november</th>
                                <th>december</th>
                                <th>January</th>
                                <th>february</th>
                                <th>march</th>
                                <th>april</th>
                                <th>may</th>
                                <th>june</th>
                            </tr>
                            @foreach ($particulars as $particular)
                                <tr>
                                <td class="px-1" colspan="2"><input type="text" class="form-control form-control-sm" placeholder="Name" value="{{$particular->name}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_july[]" placeholder="0" value="{{$particular->ac_july}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_august[]" placeholder="0" value="{{$particular->ac_august}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_september[]" placeholder="0" value="{{$particular->ac_september}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_october[]" placeholder="0" value="{{$particular->ac_october}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_november[]" placeholder="0" value="{{$particular->ac_november}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_december[]" placeholder="0" value="{{$particular->ac_december}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_january[]" placeholder="0" value="{{$particular->ac_january}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_february[]" placeholder="0" value="{{$particular->ac_february}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_march[]" placeholder="0" value="{{$particular->ac_march}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_april[]" placeholder="0" value="{{$particular->ac_april}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_may[]" placeholder="0" value="{{$particular->may}}"></td>
                                <td class="px-1"><input type="text" class="form-control form-control-sm" name="ac_june[]" placeholder="0" value="{{$particular->june}}"></td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary px-3">Submit</button>
                            <button type="button" class="btn btn-secondary">Print</button>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-header py-3 bg-white">
                    <div class="d-flex">
                        <h5 class="mt-2 ms-1">Target of</h5>
                        <button class="btn btn-primary btn-sm ms-auto" id="addBtn">Add Row <i class="fa-solid fa-plus"></i></button>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm py-2 ms-2" id="removeBtn">Delete Row <i class="fa-regular fa-trash-can"></i></a>
                    </div>
                </div>
                 <div class="card-body">
                    <form action="{{route('user.target.store')}}" method="post">
                            @csrf
                            <table class="table" id="target-table">
                                <tr>
                                    <th width=12%>Particular</th>
                                    <th>P June</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>september</th>
                                    <th>october</th>
                                    <th>november</th>
                                    <th>december</th>
                                    <th>January</th>
                                    <th>february</th>
                                    <th>march</th>
                                    <th>april</th>
                                    <th>may</th>
                                    <th>june</th>
                                    <th></th>
                                </tr>
                                @foreach ($targets as $target)
                                    <tr>
                                    <input type="hidden" name="id[]" value="{{$target->id}}">
                                    <input type="hidden" name="staff_id" value="">
                                    <input type="hidden" name="ac_july[]" value="{{$target->ac_july}}">
                                    <input type="hidden" name="ac_august[]" value="{{$target->ac_august}}">
                                    <input type="hidden" name="ac_september[]" value="{{$target->ac_september}}">
                                    <input type="hidden" name="ac_october[]" value="{{$target->ac_october}}">
                                    <input type="hidden" name="ac_november[]" value="{{$target->ac_november}}">
                                    <input type="hidden" name="ac_december[]" value="{{$target->ac_december}}">
                                    <input type="hidden" name="ac_january[]" value="{{$target->ac_january}}">
                                    <input type="hidden" name="ac_february[]" value="{{$target->ac_february}}">
                                    <input type="hidden" name="ac_march[]" value="{{$target->ac_march}}">
                                    <input type="hidden" name="ac_april[]" value="{{$target->ac_april}}">
                                    <input type="hidden" name="ac_may[]" value="{{$target->ac_may}}">
                                    <input type="hidden" name="ac_june[]" value="{{$target->ac_june}}">
                                    <td class="px-1"><input type="text" class="form-control form-control-sm" name="particular[]" placeholder="Name" value="{{$target->particular}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="p_june[]" placeholder="0" value="{{$target->p_june}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="july[]" placeholder="0" value="{{$target->july}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="august[]" placeholder="0" value="{{$target->august}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="september[]" placeholder="0" value="{{$target->september}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="october[]" placeholder="0" value="{{$target->october}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="november[]" placeholder="0" value="{{$target->november}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="december[]" placeholder="0" value="{{$target->december}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="january[]" placeholder="0" value="{{$target->january}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="february[]" placeholder="0" value="{{$target->february}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="march[]" placeholder="0" value="{{$target->march}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="april[]" placeholder="0" value="{{$target->april}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="may[]" placeholder="0" value="{{$target->may}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="june[]" placeholder="0" value="{{$target->june}}"></td>
                                    
                                    <td class="pt-3">
                                        <a href="{{route('user.destroyTarget',$target->id)}}" class="text-danger" title="Remove"><i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary px-3">Submit</button>
                                <button type="button" class="btn btn-secondary">Print</button>
                            </div>
                        </form>
                 </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-header py-3 bg-white">
                    <div class="d-flex">
                        <h5 class="mt-2 ms-1">Achievement of </h5>
                    </div>
                </div>
                 <div class="card-body">
                    <form action="{{route('user.target.store')}}" method="post">
                            @csrf
                            <table class="table" id="achievement-table">
                                <tr>
                                    <th width=12%>Particular</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>september</th>
                                    <th>october</th>
                                    <th>november</th>
                                    <th>december</th>
                                    <th>January</th>
                                    <th>february</th>
                                    <th>march</th>
                                    <th>april</th>
                                    <th>may</th>
                                    <th>june</th>
                                </tr>
                                @foreach ($targets as $achievement)
                                    <tr>
                                    <input type="hidden" name="id[]" value="{{$achievement->id}}">
                                    <input type="hidden" name="staff_id" value="">
                                    <input type="hidden" name="particular[]" value="{{$achievement->particular}}">
                                    <input type="hidden" name="p_june[]" value="{{$achievement->p_june}}">
                                    <input type="hidden" name="july[]" value="{{$achievement->july}}">
                                    <input type="hidden" name="august[]" value="{{$achievement->august}}">
                                    <input type="hidden" name="september[]" value="{{$achievement->september}}">
                                    <input type="hidden" name="october[]" value="{{$achievement->october}}">
                                    <input type="hidden" name="november[]" value="{{$achievement->november}}">
                                    <input type="hidden" name="december[]" value="{{$achievement->december}}">
                                    <input type="hidden" name="january[]" value="{{$achievement->january}}">
                                    <input type="hidden" name="february[]" value="{{$achievement->february}}">
                                    <input type="hidden" name="march[]" value="{{$achievement->march}}">
                                    <input type="hidden" name="april[]" value="{{$achievement->april}}">
                                    <input type="hidden" name="may[]" value="{{$achievement->may}}">
                                    <input type="hidden" name="june[]" value="{{$achievement->june}}">
                                    <td class="px-1">{{$achievement->particular}}</td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_july[]" placeholder="0" value="{{$achievement->ac_july}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_august[]" placeholder="0" value="{{$achievement->ac_august}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_september[]" placeholder="0" value="{{$achievement->ac_september}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_october[]" placeholder="0" value="{{$achievement->ac_october}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_november[]" placeholder="0" value="{{$achievement->ac_november}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_december[]" placeholder="0" value="{{$achievement->ac_december}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_january[]" placeholder="0" value="{{$achievement->ac_january}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_february[]" placeholder="0" value="{{$achievement->ac_february}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_march[]" placeholder="0" value="{{$achievement->ac_march}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_april[]" placeholder="0" value="{{$achievement->ac_april}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_may[]" placeholder="0" value="{{$achievement->ac_may}}"></td>
                                    <td class="px-1"><input type="number" class="form-control form-control-sm" name="ac_june[]" placeholder="0" value="{{$achievement->ac_june}}"></td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary px-3">Submit</button>
                                <button type="button" class="btn btn-secondary">Print</button>
                            </div>
                        </form>
                 </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-header py-4 bg-white text-center">
                    <h3>Area MFP</h3>
                    <h5>Terget & Achivement Report (FY-2023-2024)</h5>
                    <h5 class="mt-2 ms-1">Report of </h5>
                    <p>Branch: </p>
                </div>
                 <div class="card-body">
                    <div class="mb-4 mt-2 text-center">
                        <button class="btn btn-outline-primary btn-sm" id="july">July</button>
                        <button class="btn btn-outline-primary btn-sm" id="august">August</button>
                        <button class="btn btn-outline-primary btn-sm" id="september">September</button>
                        <button class="btn btn-outline-primary btn-sm" id="october">October</button>
                        <button class="btn btn-outline-primary btn-sm" id="november">November</button>
                        <button class="btn btn-outline-primary btn-sm" id="december">December</button>
                        <button class="btn btn-outline-primary btn-sm" id="january">January</button>
                        <button class="btn btn-outline-primary btn-sm" id="february">February</button>
                        <button class="btn btn-outline-primary btn-sm" id="march">March</button>
                        <button class="btn btn-outline-primary btn-sm" id="april">April</button>
                        <button class="btn btn-outline-primary btn-sm" id="may">May</button>
                        <button class="btn btn-outline-primary btn-sm" id="june">June</button>
                    </div>
                    <form action="{{route('user.achievement.store')}}" method="post">
                            @csrf
                            <table class="table" id="report-table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th width="15%">Particulars</th>
                                        <th>Possition June-2023</th>
                                        <th>Target July-2023 to June-2024</th>
                                        <th>Target July-2023 to January-2024</th>
                                        <th>Achivement July-2023 to January-2024</th>
                                        <th>Inc/Dec July-2023 to January-2024</th>
                                        <th>Inc/Dec June-2023 to January-2024</th>
                                    </tr>
                                </thead>
                                <tbody id="defaultTbody">
                                    @foreach ($targets as $key => $target)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$target->particular}}</td>
                                        <td>{{$target->p_june}}</td>
                                        <td>{{$target->june}}</td>
                                        <td>{{$target->july}}</td>
                                        <td>{{$target->ac_july}}</td>
                                        <td>{{$target->ac_july - $target->july}}</td>
                                        <td>{{$target->ac_july - $target->p_june}}</td>
                                    </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        </form>
                 </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('js') 
   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#example');
    </script>

    <script>
    $(function() {
        $('select[name=branch_id]').change(function() {

            var url = '{{ url('user/branch') }}'+'/' + $(this).val() + '/staff/';

            $.get(url, function(data) {
                var select = $('form select[name= staff_id]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
        });
    });
</script>

    {{-- <script>
        $("#addBtn").on("click", function ()
            {
                // Adding a row inside the tbody.
                $("#target-table tbody").append(`
                <tr class="targetTableRow">
                    <input type="hidden" name="id[]">
                    <input type="hidden" name="staff_id" value="">
                    <input type="hidden" name="ac_july[]" value="">
                    <input type="hidden" name="ac_august[]" value="">
                    <input type="hidden" name="ac_september[]" value="">
                    <input type="hidden" name="ac_october[]" value="">
                    <input type="hidden" name="ac_november[]" value="">
                    <input type="hidden" name="ac_december[]" value="">
                    <input type="hidden" name="ac_january[]" value="">
                    <input type="hidden" name="ac_february[]" value="">
                    <input type="hidden" name="ac_march[]" value="">
                    <input type="hidden" name="ac_april[]" value="">
                    <input type="hidden" name="ac_may[]" value="">
                    <input type="hidden" name="ac_june[]" value="">
                    <td><input type="text" class="form-control form-control-sm" name="particular[]" placeholder="Name"></td>
                    <td><input type="number" class="form-control form-control-sm" name="p_june[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="july[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="august[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="september[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="october[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="november[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="december[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="january[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="february[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="march[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="april[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="may[]" placeholder="0"></td>
                    <td><input type="number" class="form-control form-control-sm" name="june[]" placeholder="0"></td>
                    
                    <td class="pt-3"></td>
                </tr>`);
        });

        $("#removeBtn").on("click", function ()
        {
            $('.targetTableRow').remove();
        });

        $("#july").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                $("#august, #september, #september, #october, #november, #december, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->july}}</td>
                    <td>{{$target->ac_july}}</td>
                    <td>{{$target->ac_july - $target->july}}</td>
                    <td>{{$target->ac_july - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#august").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                $("#july, #september, #september, #october, #november, #december, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->august}}</td>
                    <td>{{$target->ac_august}}</td>
                    <td>{{$target->ac_august - $target->august}}</td>
                    <td>{{$target->ac_august - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#september").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #october, #november, #december, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->september}}</td>
                    <td>{{$target->ac_september}}</td>
                    <td>{{$target->ac_september - $target->september}}</td>
                    <td>{{$target->ac_september - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#october").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #november, #december, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->october}}</td>
                    <td>{{$target->ac_october}}</td>
                    <td>{{$target->ac_october - $target->october}}</td>
                    <td>{{$target->ac_october - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#november").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #december, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->november}}</td>
                    <td>{{$target->ac_november}}</td>
                    <td>{{$target->ac_november - $target->november}}</td>
                    <td>{{$target->ac_november - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#december").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #january, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->december}}</td>
                    <td>{{$target->ac_december}}</td>
                    <td>{{$target->ac_december - $target->december}}</td>
                    <td>{{$target->ac_december - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#january").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #february, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->january}}</td>
                    <td>{{$target->ac_january}}</td>
                    <td>{{$target->ac_january - $target->january}}</td>
                    <td>{{$target->ac_january - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#february").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #january, #march, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->february}}</td>
                    <td>{{$target->ac_february}}</td>
                    <td>{{$target->ac_february - $target->february}}</td>
                    <td>{{$target->ac_february - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#march").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #january, #february, #april, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->march}}</td>
                    <td>{{$target->ac_march}}</td>
                    <td>{{$target->ac_march - $target->march}}</td>
                    <td>{{$target->ac_march - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#april").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #january, #february, #march, #may, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->april}}</td>
                    <td>{{$target->ac_april}}</td>
                    <td>{{$target->ac_april - $target->april}}</td>
                    <td>{{$target->ac_april - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#may").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #january, #february, #march, #april, #june").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->may}}</td>
                    <td>{{$target->ac_may}}</td>
                    <td>{{$target->ac_may - $target->may}}</td>
                    <td>{{$target->ac_may - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        $("#june").on("click", function ()
            {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $("#july, #august, #september, #september, #october, #november, #december, #january, #february, #march, #april, #may").addClass('btn-outline-primary').removeClass('btn-primary');
                $("#defaultTbody").remove();
                $("#report-table tbody tr").remove();
                // Adding a row inside the tbody.
                $("#report-table tbody").append(`
                @foreach ($targets as $key => $target)
                <tr>
                    <th>{{$key+1}}</th>
                    <td>{{$target->particular}}</td>
                    <td>{{$target->p_june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->june}}</td>
                    <td>{{$target->ac_june}}</td>
                    <td>{{$target->ac_june - $target->june}}</td>
                    <td>{{$target->ac_june - $target->p_june}}</td>
                </tr>
                @endforeach`);
                
        });

        
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function deleteTarget(id) {
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