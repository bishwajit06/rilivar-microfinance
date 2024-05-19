<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Particular;
use App\Models\Staff;
use App\Models\Target;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::where('user_id', Auth::id())->get();
        $branches = Branch::where('user_id', Auth::id())->get();
        $particulars = Particular::where('user_id', Auth::id())->get();
        return view('user.target.index', compact('staffs','particulars', 'branches'));
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

        foreach ($request->particular as $key => $data) {
            
            if ($request->particular) {
                    Target::create([
                    'user_id' => Auth::id(),
                    'staff_id' => $request->staff_id,
                    'particular_id' => $request['particular_id'][$key],
                    'p_june' => $request['p_june'][$key],
                    'july' => $request['july'][$key],
                    'august' => $request['august'][$key],
                    'september' => $request['september'][$key],
                    'october' => $request['october'][$key],
                    'november' => $request['november'][$key],
                    'december' => $request['december'][$key],
                    'january' => $request['january'][$key],
                    'february' => $request['february'][$key],
                    'march' => $request['march'][$key],
                    'april' => $request['april'][$key],
                    'may' => $request['may'][$key],
                    'june' => $request['june'][$key],
                    'ac_july' => $request['ac_july'][$key],
                    'ac_august' => $request['ac_august'][$key],
                    'ac_september' => $request['ac_september'][$key],
                    'ac_october' => $request['ac_october'][$key],
                    'ac_november' => $request['ac_november'][$key],
                    'ac_december' => $request['ac_december'][$key],
                    'ac_january' => $request['ac_january'][$key],
                    'ac_february' => $request['ac_february'][$key],
                    'ac_march' => $request['ac_march'][$key],
                    'ac_april' => $request['ac_april'][$key],
                    'ac_may' => $request['ac_may'][$key],
                    'ac_june' => $request['ac_june'][$key],
                ]);
            }
        } 
        // foreach ($request->id as $key => $data) {
        //     $input = [
        //         'id' => $request['id'][$key],
        //         'particular' => $request['particular'][$key],
        //         'p_june' => $request['p_june'][$key],
        //         'july' => $request['july'][$key],
        //         'august' => $request['august'][$key],
        //         'september' => $request['september'][$key],
        //         'october' => $request['october'][$key],
        //         'november' => $request['november'][$key],
        //         'december' => $request['december'][$key],
        //         'january' => $request['january'][$key],
        //         'february' => $request['february'][$key],
        //         'march' => $request['march'][$key],
        //         'april' => $request['april'][$key],
        //         'may' => $request['may'][$key],
        //         'june' => $request['june'][$key],
        //         'ac_july' => $request['ac_july'][$key],
        //         'ac_august' => $request['ac_august'][$key],
        //         'ac_september' => $request['ac_september'][$key],
        //         'ac_october' => $request['ac_october'][$key],
        //         'ac_november' => $request['ac_november'][$key],
        //         'ac_december' => $request['ac_december'][$key],
        //         'ac_january' => $request['ac_january'][$key],
        //         'ac_february' => $request['ac_february'][$key],
        //         'ac_march' => $request['ac_march'][$key],
        //         'ac_april' => $request['ac_april'][$key],
        //         'ac_may' => $request['ac_may'][$key],
        //         'ac_june' => $request['ac_june'][$key],
        //     ];

        //     DB::table('targets')->where('id', $request->id[$key])->update($input);

        //     if ($request->id[$key] == NULL) {
        //             Target::create([
        //             'user_id' => Auth::id(),
        //             'staff_id' => $request->staff_id,
        //             'particular' => $request['particular'][$key],
        //             'p_june' => $request['p_june'][$key],
        //             'july' => $request['july'][$key],
        //             'august' => $request['august'][$key],
        //             'september' => $request['september'][$key],
        //             'october' => $request['october'][$key],
        //             'november' => $request['november'][$key],
        //             'december' => $request['december'][$key],
        //             'january' => $request['january'][$key],
        //             'february' => $request['february'][$key],
        //             'march' => $request['march'][$key],
        //             'april' => $request['april'][$key],
        //             'may' => $request['may'][$key],
        //             'june' => $request['june'][$key],
        //             'ac_july' => $request['ac_july'][$key],
        //             'ac_august' => $request['ac_august'][$key],
        //             'ac_september' => $request['ac_september'][$key],
        //             'ac_october' => $request['ac_october'][$key],
        //             'ac_november' => $request['ac_november'][$key],
        //             'ac_december' => $request['ac_december'][$key],
        //             'ac_january' => $request['ac_january'][$key],
        //             'ac_february' => $request['ac_february'][$key],
        //             'ac_march' => $request['ac_march'][$key],
        //             'ac_april' => $request['ac_april'][$key],
        //             'ac_may' => $request['ac_may'][$key],
        //             'ac_june' => $request['ac_june'][$key],
        //         ]);
        //     }
        // } 

        Toastr::success('The Target and Achievement has been successfully created', 'Success');
        return redirect()->route('user.staff.show',$request->staff_id);
    }

    public function targetUpdate(Request $request) 
    {

       foreach ($request->id as $key => $data) {
            $input = [
                'id' => $request['id'][$key],
                'staff_id' => $request['staff_id'][$key],
                'particular_id' => $request['particular_id'][$key],
                'p_june' => $request['p_june'][$key],
                'july' => $request['july'][$key],
                'august' => $request['august'][$key],
                'september' => $request['september'][$key],
                'october' => $request['october'][$key],
                'november' => $request['november'][$key],
                'december' => $request['december'][$key],
                'january' => $request['january'][$key],
                'february' => $request['february'][$key],
                'march' => $request['march'][$key],
                'april' => $request['april'][$key],
                'may' => $request['may'][$key],
                'june' => $request['june'][$key],
                'ac_july' => $request['ac_july'][$key],
                'ac_august' => $request['ac_august'][$key],
                'ac_september' => $request['ac_september'][$key],
                'ac_october' => $request['ac_october'][$key],
                'ac_november' => $request['ac_november'][$key],
                'ac_december' => $request['ac_december'][$key],
                'ac_january' => $request['ac_january'][$key],
                'ac_february' => $request['ac_february'][$key],
                'ac_march' => $request['ac_march'][$key],
                'ac_april' => $request['ac_april'][$key],
                'ac_may' => $request['ac_may'][$key],
                'ac_june' => $request['ac_june'][$key],
            ];

            DB::table('targets')->where('id', $request['id'][$key])->update($input);
        }


        if ($request->new_particular_id !== Null) {
            foreach ($request->new_id as $key => $value) {

            if ($request->new_id[$key] == NULL) {
                Target::create([
                    'user_id' => Auth::id(),
                    'staff_id' => $request['new_staff_id'][$key],
                    'particular_id' => $request['new_particular_id'][$key],
                    'p_june' => $request['new_p_june'][$key],
                    'july' => $request['new_july'][$key],
                    'august' => $request['new_august'][$key],
                    'september' => $request['new_september'][$key],
                    'october' => $request['new_october'][$key],
                    'november' => $request['new_november'][$key],
                    'december' => $request['new_december'][$key],
                    'january' => $request['new_january'][$key],
                    'february' => $request['new_february'][$key],
                    'march' => $request['new_march'][$key],
                    'april' => $request['new_april'][$key],
                    'may' => $request['new_may'][$key],
                    'june' => $request['new_june'][$key],
                    'ac_july' => $request['new_ac_july'][$key],
                    'ac_august' => $request['new_ac_august'][$key],
                    'ac_september' => $request['new_ac_september'][$key],
                    'ac_october' => $request['new_ac_october'][$key],
                    'ac_november' => $request['new_ac_november'][$key],
                    'ac_december' => $request['new_ac_december'][$key],
                    'ac_january' => $request['new_ac_january'][$key],
                    'ac_february' => $request['new_ac_february'][$key],
                    'ac_march' => $request['new_ac_march'][$key],
                    'ac_april' => $request['new_ac_april'][$key],
                    'ac_may' => $request['new_ac_may'][$key],
                    'ac_june' => $request['new_ac_june'][$key],
                ]);
            }
           
        }
        }

     

        Toastr::success('The Target and Achievement has been successfully updated', 'Success');
        return redirect()->back();
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
        dd($id);

        $particular = $request->particular;
        $january = $request->january;
        $february = $request->february;
        $march = $request->march;
        $april = $request->april;
        $may = $request->may;
        $june = $request->june;
        $july = $request->july;
        $august = $request->august;
        $september = $request->september;
        $october = $request->october;
        $november = $request->november;
        $december = $request->december;

        for ($i=0; $i < count($particular); $i++) { 
            $data = [
                'user_id' => Auth::id(),
                'branch_id' => 4,
                'particular' => $particular[$i],
                'january' => $january[$i],
                'february' => $february[$i],
                'march' => $march[$i],
                'april' => $april[$i],
                'may' => $may[$i],
                'june' => $june[$i],
                'july' => $july[$i],
                'august' => $august[$i],
                'september' => $september[$i],
                'october' => $october[$i],
                'november' => $november[$i],
                'december' => $december[$i]
            ];

            Target::insert($data);
        }

        Toastr::success('The Target has been successfully created', 'Success');
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
        
        $staff = Staff::find($id);

         if ($staff->targets) {
            foreach ($staff->targets as $item) {
                $target = Target::find($item->id);
                $target->delete();
            }
         }
         Toastr::success('The Target has been Successfully Deleted', 'Success');
        return redirect()->back();
    }

    // public function destroyTarget($id)
    // {
    //     $target = Target::find($id);
    //     if (!is_null($target)){

    //         $target->delete();
    //         Toastr::success('The Target has been Successfully Deleted', 'Success');
    //         return redirect()->back();

    //     }else{
    //         return redirect()->back();
    //     }
    // }

    public function getStaff(Branch $branch) 
    {
        // foreach ($branch->staff as $staff) {
        //     if (!$staff->targets->count() > 0) {
        //         return $staff->where('user_id', Auth::id())->select('id', 'name')->get();
        //     }
        // }

        return $branch->staff()->where('user_id', Auth::id())->select('id', 'name')->get();
    }
}
