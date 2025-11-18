<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use App\Models\Visa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function create_track(){
        return view('admin.components.create-track');
    }
    function index(){
        
        $visaCount = Visa::count();
        $pendingVisa = Visa::where('status', 'pending')->count();
        $approvedVisa = Visa::where('status', 'approved')->count();
        $rejectedVisa = Visa::where('status', 'rejected')->count();
        return view ('admin.dashboard',compact('visaCount','pendingVisa', 'approvedVisa','rejectedVisa'));
    }

    function siteInfo(){
        return response()->json([
            'info'=> SiteInfo::find(1)
        ]);
    }
}
