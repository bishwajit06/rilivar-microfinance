<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        foreach ($request->id as $key => $data) {
            $input = [
                'id' => $request['id'][$key],
                'particular' => $request['particular'][$key],
                'january' => $request['january'][$key],
                'february' => $request['february'][$key],
                'march' => $request['march'][$key],
                'april' => $request['april'][$key],
                'may' => $request['may'][$key],
                'june' => $request['june'][$key],
                'july' => $request['july'][$key],
                'august' => $request['august'][$key],
                'september' => $request['september'][$key],
                'october' => $request['october'][$key],
                'november' => $request['november'][$key],
                'december' => $request['december'][$key],
            ];

            DB::table('achievements')->where('id', $request->id[$key])->update($input);

            if ($request->id[$key] == NULL) {
                    Achievement::create([
                    'user_id' => Auth::id(),
                    'staff_id' => $request->staff_id,
                    'particular' => $request['particular'][$key],
                    'january' => $request['january'][$key],
                    'february' => $request['february'][$key],
                    'march' => $request['march'][$key],
                    'april' => $request['april'][$key],
                    'may' => $request['may'][$key],
                    'june' => $request['june'][$key],
                    'july' => $request['july'][$key],
                    'august' => $request['august'][$key],
                    'september' => $request['september'][$key],
                    'october' => $request['october'][$key],
                    'november' => $request['november'][$key],
                    'december' => $request['december'][$key],
                ]);
            }
        } 


        Toastr::success('The Achievement has been successfully created', 'Success');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyAchievement($id)
    {
        $achievement = Achievement::find($id);
        if (!is_null($achievement)){

            $achievement->delete();
            Toastr::success('The Achievement has been Successfully Deleted', 'Success');
            return redirect()->back();

        }else{
            return redirect()->back();
        }
    }
}
