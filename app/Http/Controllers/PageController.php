<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function loadDashboard()
    {
        return view('user.dashboard');
    }

    public function home()
    {
        $data = Data::whereDate('date', Carbon::today())->orderBy('otr', 'desc')->get();
        $disbursement = Data::whereDate('date', Carbon::today())->orderBy('disbursement', 'desc')->get();
        $receivable = Data::whereDate('date', Carbon::today())->orderBy('receivable', 'desc')->get();
        $regular_receive = Data::whereDate('date', Carbon::today())->orderBy('regular_receive', 'desc')->get();
        $dues_collection = Data::whereDate('date', Carbon::today())->orderBy('dues_collection', 'desc')->get();
        $advance_collection = Data::whereDate('date', Carbon::today())->orderBy('advance_collection', 'desc')->get();
        $total_collection = Data::whereDate('date', Carbon::today())->orderBy('total_collection', 'desc')->get();
        $otr = Data::whereDate('date', Carbon::today())->orderBy('otr', 'desc')->get();
        $new_due = Data::whereDate('date', Carbon::today())->orderBy('new_due', 'desc')->get();
        $inc_dic = Data::whereDate('date', Carbon::today())->orderBy('inc_dic', 'desc')->get();
        return view('frontend.pages.home', compact('data', 'disbursement', 'receivable', 'regular_receive', 'dues_collection', 'advance_collection', 'total_collection', 'otr', 'new_due', 'inc_dic'));
    }

    public function filterData(Request $request)
    {

        $start_date =$request->start_date;
        $data = Data::whereDate('date', 'like', $start_date)->orderBy('otr', 'desc')->get();
        $disbursement = Data::whereDate('date', 'like', $start_date)->orderBy('disbursement', 'desc')->get();
        $receivable = Data::whereDate('date', 'like', $start_date)->orderBy('receivable', 'desc')->get();
        $regular_receive = Data::whereDate('date', 'like', $start_date)->orderBy('regular_receive', 'desc')->get();
        $dues_collection = Data::whereDate('date', 'like', $start_date)->orderBy('dues_collection', 'desc')->get();
        $advance_collection = Data::whereDate('date', 'like', $start_date)->orderBy('advance_collection', 'desc')->get();
        $total_collection = Data::whereDate('date', 'like', $start_date)->orderBy('total_collection', 'desc')->get();
        $dues_collection = Data::whereDate('date', 'like', $start_date)->orderBy('dues_collection', 'desc')->get();
        $dues_collection = Data::whereDate('date', 'like', $start_date)->orderBy('dues_collection', 'desc')->get();
        $otr = Data::whereDate('date', 'like', $start_date)->orderBy('otr', 'desc')->get();
        $new_due = Data::whereDate('date', 'like', $start_date)->orderBy('new_due', 'desc')->get();
        $inc_dic = Data::whereDate('date', 'like', $start_date)->orderBy('inc_dic', 'desc')->get();
        return view('frontend.pages.home', compact('data', 'disbursement', 'receivable', 'regular_receive', 'dues_collection', 'advance_collection', 'total_collection', 'otr', 'new_due', 'inc_dic'));

        // $data = Data::whereDate('date', '>=', $start_date)->whereDate('date', '<=', $start_date)->get();
        // return view('frontend.pages.home', compact('data'));

    }
}
