<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    public function index() {
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);
        return view('admin.dashboard', compact('admin'));
    }
}
