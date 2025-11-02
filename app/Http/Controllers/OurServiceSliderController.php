<?php

namespace App\Http\Controllers;

use App\Models\OurServiceSlider;
use Illuminate\Http\Request;

class OurServiceSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = OurServiceSlider::all();
        return view('admin.pages.all-slider',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.components.create-ourservice');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg', // বা file upload হলে 'image|mimes:jpg,png'
        ]);

        $ourservices = new OurServiceSlider;
        $ourservices->title = $request->title;
        $ourservices->status = $request->has('status') ? 'active' : 'inactive';


        // যদি file upload করা হয়
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $path = $request->file('image')->store('Our_services', 'public');
            $ourservices->image = $path;
        } else {
            // file না আসলে, যেটা user দিয়েছে সেটা save করবো (URL হতে পারে)
            $ourservices->image = $request->image;
        }

        $ourservices->save();

        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Service Slider has been saved!');
            

        return redirect()->route('service-create');
        } catch (\Exception  $e) {
            flash()->addError('Something went wrong: ' . $e->getMessage());
        return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $slider = OurServiceSlider::findOrfail($id);
        return view('admin.components.create-ourservice', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $slider = OurServiceSlider::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $slider->title = $request->title;
    $slider->status = $request->has('status') ? 'active' : 'inactive';

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('Our_services', 'public');
        $slider->image = $path;
    }

    $slider->save();

    flash()->success('Slider updated successfully!');
    return redirect()->route('all-slider');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $slider = OurServiceSlider::findOrFail($id);

    // যদি storage-এ image থাকে, remove করে দাও
    if ($slider->image && file_exists(storage_path('app/public/' . $slider->image))) {
        unlink(storage_path('app/public/' . $slider->image));
    }

    $slider->delete();

    flash()->success('Slider deleted successfully!');
    return redirect()->route('all-slider');
}

    public function toggle($id)
{
    $slider = OurServiceSlider::findOrFail($id);
    $slider->status = $slider->status === 'active' ? 'inactive' : 'active';
    $slider->save();

    return back()->with('success', 'Slider status updated!');
}
}
