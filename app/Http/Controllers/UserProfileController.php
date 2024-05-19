<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return view('user.profile.index', compact('user'));
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
        //
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
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'phone' => 'nullable',
            'image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],

        ]);

        $user = User::find(Auth::id());

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
        if (Storage::disk('public')->exists('profile/'.$user->image))
        {
            Storage::disk('public')->delete('profile/'.$user->image);
        }

//          Resize image for profile and upload
        $profileImageSize = Image::make($profileImage)->resize(250,250)->stream();
        Storage::disk('public')->put('profile/'.$profileImageName,$profileImageSize);

    }else{
        $profileImageName = $user->image;
    }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = $profileImageName;
        $user->save();

        Toastr::success('Profile Successfully Updated', 'Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request) 
    {
        $this->validate($request,[
           'old_password' => 'required',
           'password' => 'required|confirmed',
       ]);

       $hashedPassword = Auth::user()->password;
       if (Hash::check($request->old_password,$hashedPassword))
       {
          if (!Hash::check($request->password,$hashedPassword))
          {
           $user = User::find(Auth::id());
           $user->password = Hash::make($request->password);
           $user->save();
           Toastr::success('Password Successfully Changed :)', 'Success');
           //Auth::logout();
           return redirect()->back();
          }else{
           Toastr::error('New password cannot be the same as old password.', 'Error');
           return back();
            }
       }else{
           Toastr::error('Current password not match.', 'Error');
           return back();
       }
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

    
}
