<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\BankDetail;
use App\Models\OurServiceSlider;
use App\Models\SiteInfo;
use App\Models\Testimonial;
use App\Models\VisaTrack;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $ourservices = OurServiceSlider::where('status','active')->get();
        $testimonials = Testimonial::all();
        $airlines = Airline::all();
        $banks = BankDetail::all();
        

        return view('frontend.pages.home', compact('ourservices','testimonials','airlines','banks'));
    }

    public function visa_track(Request $request)
    {
        $request->validate([
            'reference_number' => 'required|string|max:50',

        ]);
        $visa_status = VisaTrack::where('reference_number', $request->reference_number)->first();
        if ($visa_status) {
            return response()->json([
                'success' => true,
                'data' => [
                    'reference_number' => $visa_status->reference_number,
                    'name' => $visa_status->name,
                    'applicant_name' => $visa_status->applicant_name,
                    'status' => $visa_status->status,
                    'pdf' => $visa_status->pdf,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no data found!',
            ], 400);
        }

    }

   




    
    


    function Contact(){
        $banks= BankDetail::all();
        return view('frontend.pages.contact', compact('banks'));
    }
}
