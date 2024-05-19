<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Particular;
use App\Models\Staff;
use App\Models\Target;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::where('user_id', Auth::id())->get();
        return view('user.staff.index', compact('staff'));
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
            'region_id' => ['required'],
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);


        $profileImage = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($profileImage))
    {
        // Make unique name for image
        $currentdate = Carbon::now()->toDateString();
        $profileImageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$profileImage->getClientOriginalExtension();

        // Check profile directory is exists
        if (!Storage::disk('public')->exists('profile'))
        {
            Storage::disk('public')->makeDirectory('profile');
        }


        // Resize image for profile and upload
        $profileImageSize = Image::make($profileImage)->resize(300,300)->stream();
        Storage::disk('public')->put('profile/'.$profileImageName,$profileImageSize);

    }else{
        $profileImageName = NULL;
    }


        $staff = Staff::create([
            'user_id' => Auth::id(),
            'region_id' => $request->region_id,
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'image' => $profileImageName,
        ]);

        Toastr::success('The Staff has been successfully created', 'Success');
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
        $staff = Staff::find($id);
        $particulars = Particular::where('user_id', Auth::id())->get();
        $targets = Target::where('user_id', Auth::id())->where('staff_id', $id)->orderBy('created_at', 'asc')->get();
        $achievements = Achievement::where('user_id', Auth::id())->where('staff_id', $id)->orderBy('created_at', 'asc')->get();
        return view('user.staff.view', compact('targets', 'particulars', 'achievements', 'staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
            'region_id' => ['required'],
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $staff = Staff::find($id);

        $profileImage = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($profileImage))
    {
//          Make unique name for image
        $currentdate = Carbon::now()->toDateString();
        $profileImageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$profileImage->getClientOriginalExtension();

//          Check profile directory is exists
        if (!Storage::disk('public')->exists('profile'))
        {
            Storage::disk('public')->makeDirectory('profile');
        }

//          Delete old image
        if (Storage::disk('public')->exists('profile/'.$staff->image))
        {
            Storage::disk('public')->delete('profile/'.$staff->image);
        }

//          Resize image for profile and upload
        $profileImageSize = Image::make($profileImage)->resize(250,250)->stream();
        Storage::disk('public')->put('profile/'.$profileImageName,$profileImageSize);

    }else{
        $profileImageName = $staff->image;
    }


        $staff->user_id = Auth::id();
        $staff->region_id = $request->region_id;
        $staff->branch_id = $request->branch_id;
        $staff->name = $request->name;
        $staff->phone = $request->phone;
        $staff->image = $profileImageName;
        $staff->save();

        Toastr::success('The Staff has been successfully updated', 'Success');
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
        if (!is_null($staff)){

            $staff->delete();
            Toastr::success('The Staff has been Successfully Deleted', 'Success');
            return redirect()->back();

        }else{
            return redirect()->back();
        }
    }
}
