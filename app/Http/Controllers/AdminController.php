<?php

namespace App\Http\Controllers;

use App\Models\SiteInfo;
use App\Models\VisaTrack;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function create_track(){
        return view('admin.components.create-track');
    }
    function index(){
        
        $visaCount = VisaTrack::count();
        $pendingVisa = VisaTrack::where('status', 'pending')->count();
        $approvedVisa = VisaTrack::where('status', 'approved')->count();
        $rejectedVisa = VisaTrack::where('status', 'rejected')->count();
        return view ('admin.dashboard',compact('visaCount','pendingVisa', 'approvedVisa','rejectedVisa'));
    }

    function siteInfo(){
        return response()->json([
            'info'=> SiteInfo::find(1)
        ]);
    }
}
