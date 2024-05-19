<?php

namespace App\Http\Controllers;

use App\Imports\DataImport;
use App\Models\Branch;
use App\Models\Data;
use App\Models\Region;
use App\Models\Staff;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carbon = Carbon::today();
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.index', compact('allStaff', 'carbon'));


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function performanceView()
    {
        $carbon = Carbon::today();
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.performanceView', compact('allStaff', 'carbon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function branchPerformanceView()
    {
        $carbon = Carbon::today();
        $branches = Branch::where('user_id', Auth::id())->get();
        $regions = Region::where('user_id', Auth::id())->get();
        return view('user.data.branchPerformanceView', compact('branches', 'regions', 'carbon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function regionPerformanceView()
    {
        $carbon = Carbon::today();
        $regions = Region::where('user_id', Auth::id())->get();
        return view('user.data.regionPerformanceView', compact('regions', 'carbon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function otrPerformanceView()
    {
        $carbon = Carbon::today();
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.otrPerformanceView', compact('allStaff', 'carbon'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'staff_id' => ['required'],
            'date' => ['required'],
            'disbursement' => ['required', 'numeric'],
            'receivable' => ['required', 'numeric'],
            'regular_receive' => ['required', 'numeric'],
            'dues_collection' => ['required', 'numeric'],
            'advance_collection' => ['required', 'numeric'],
        ]);


        $total_collection = $request->regular_receive + $request->dues_collection + $request->advance_collection;
        $otr = ($request->regular_receive / $request->receivable)*100;
        $new_due = $request->receivable - $request->regular_receive;
        $inc_dic = $new_due - $request->dues_collection;
        

        $data = Data::create([
            'user_id' => Auth::id(),
            'staff_id' => $request->staff_id,
            'date' => $request->date,
            'disbursement' => $request->disbursement,
            'receivable' => $request->receivable,
            'regular_receive' => $request->regular_receive,
            'dues_collection' => $request->dues_collection,
            'advance_collection' => $request->advance_collection,
            'total_collection' => $total_collection,
            'otr' => $otr,
            'new_due' => $new_due,
            'inc_dic' => $inc_dic,
        ]);

        Toastr::success('Data has been successfully submited', 'Success');
        return redirect()->back();
    }

    public function uploadData(Request $request)
    {

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'date' => 'required',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');
        $date = $request->date;
 
        // Process the Excel file
        Excel::import(new DataImport($date), $file);
        Toastr::success('Data Successfully upload', 'Success');
        return redirect()->back();

        // $request->validate([
        //     'file' => ['required', 'mimes:xlsx'],
        // ],

        // [
        //     'file.required' => 'File is required',
        //     'file.mimes' => 'Only xlsx file will be supported'
        // ]);

        // Excel::import(new DataImport, $request->file);

        // Excel::import(new DataImport, $request->file);
        // Toastr::success('Data Successfully upload', 'Success');
        // return redirect()->back();
        
        // try {
        //     Excel::import(new DataImport, $request->file);
        //     Toastr::success('Data Successfully upload', 'Success');
        //     return redirect()->back();
        // } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //     $failures = $e->failures();
            
        //     return redirect()->back()->with('import_errors', $failures);
            
        //     // foreach ($failures as $failure) {
        //     //     $failure->row(); // row that went wrong
        //     //     $failure->attribute(); // either heading key (if using heading row concern) or column index
        //     //     $failure->errors(); // Actual error messages from Laravel validator
        //     //     $failure->values(); // The values of the row that has failed.

        //     // }

            
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_id' => ['required'],
            'date' => ['required'],
            'disbursement' => ['required', 'numeric'],
            'receivable' => ['required', 'numeric'],
            'regular_receive' => ['required', 'numeric'],
            'dues_collection' => ['required', 'numeric'],
            'advance_collection' => ['required', 'numeric'],
        ]);


        $total_collection = $request->regular_receive + $request->dues_collection + $request->advance_collection;
        $otr = ($request->regular_receive / $request->receivable)*100;
        $new_due = $request->receivable - $request->regular_receive;
        $inc_dic = $new_due - $request->dues_collection;
        
        $data = Data::find($id);

        $data->user_id = Auth::id();
        $data->staff_id = $request->staff_id;
        $data->date = $request->date;
        $data->disbursement = $request->disbursement;
        $data->receivable = $request->receivable;
        $data->regular_receive = $request->regular_receive;
        $data->dues_collection = $request->dues_collection;
        $data->advance_collection = $request->advance_collection;
        $data->total_collection = $total_collection;
        $data->otr = $otr;
        $data->new_due = $new_due;
        $data->inc_dic = $inc_dic;
        $data->save();


        Toastr::success('Data has been successfully updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Data::find($id);
        if (!is_null($data)){

            $data->delete();
            Toastr::success('Data has been Successfully Deleted', 'Success');
            return redirect()->back();

        }else{
            return redirect()->back();
        }
    }


    public function dataFilter(Request $request)
    {

        $carbon =$request->start_date;
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.index', compact('allStaff', 'carbon'));

    }

    public function performanceDataFilter(Request $request)
    {

        $carbon = $request->start_date;
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.performanceView', compact('allStaff', 'carbon'));
    }


    public function regionPerformanceDataFilter(Request $request)
    {
        $carbon = $request->start_date;
        $regions = Region::where('user_id', Auth::id())->get();
        return view('user.data.regionPerformanceView', compact('regions', 'carbon'));
    }

    public function branchPerformanceDataFilter(Request $request)
    {

        $carbon = $request->start_date;
        $branches = Branch::where('user_id', Auth::id())->get();
        $regions = Region::where('user_id', Auth::id())->get();
        return view('user.data.branchPerformanceView', compact('branches', 'regions', 'carbon'));

    }

    public function otrPerformanceDataFilter(Request $request)
    {
        $carbon = $request->start_date;;
        $allStaff = Staff::where('user_id', Auth::id())->get();
        return view('user.data.otrPerformanceView', compact('allStaff', 'carbon'));

    }
}
