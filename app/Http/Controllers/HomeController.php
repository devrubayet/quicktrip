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

    function createTestimonials(){
        return view('admin.components.testimonial-create');
    }

    function storeTestimonial(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:255',
            'message' => 'required|string',
            'avatar'  => 'required|mimes:png,jpg', // বা file upload হলে 'image|mimes:jpg,png'
        ]);

        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->bio = $request->bio;
        $testimonial->message = $request->message;

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $path = $request->file('avatar')->store('avatars/', 'public');
            $testimonial->avatar = $path;
        } else {
            // file না আসলে, যেটা user দিয়েছে সেটা save করবো (URL হতে পারে)
            $testimonial->avatar = $request->avatar;
        }
        $testimonial->save();
        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Service Slider has been saved!');
        return redirect()->route('create-testi');
    }


    function showAirlines(){
        $airlines = Airline::all();
        return view('admin.pages.all-airlines',compact('airlines'));

    }

    function CreateAirline(){
        return view('admin.components.create-airline');
    }

    function storeAirline(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => "required|mimes:png,jpg"

        ]);
        $airlines = new Airline();
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg'
            ]);
            $path =  $request->file('image')->store('airlines/', 'public');
            $airlines->image = $path;
        }
        else{
            $airlines->image = $request->image;
        }

        $airlines->save();
        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Service Slider has been saved!');
        return redirect()->route('create-airline');
    }
    function editAirline($id){
        $airline= Airline::findOrFail($id);
        return view('admin.components.create-airline', compact('airline'));

    }
     function updateAirline(Request $request ,$id){
        $airline = Airline::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => "required|mimes:png,jpg"

        ]);
        $airline->name = $request->name;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg'
            ]);
            $path =  $request->file('image')->store('airlines/', 'public');
            $airline->image = $path;
        }
       

        $airline->save();
        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Service Slider has been saved!');
        return redirect()->route('showAirlines');
    }


    function Contact(){
        $banks= BankDetail::all();
        return view('frontend.pages.contact', compact('bank'));
    }
}
