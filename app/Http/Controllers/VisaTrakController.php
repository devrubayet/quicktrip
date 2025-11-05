<?php

namespace App\Http\Controllers;

use App\Models\VisaTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisaTrakController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
  
public function index() {
    $visaCount = VisaTrack::count();
    $pendingVisa = VisaTrack::where('status', 'pending')->count();
    $approvedVisa = VisaTrack::where('status', 'approve')->count();
    $rejectedVisa = VisaTrack::where('status', 'rejected')->count();

    return view('admin.pages.visa-index', compact('visaCount','pendingVisa','approvedVisa','rejectedVisa'));
}

public function indexAjax(Request $request) {
    $referenceNumber = $request->input('reference_number', '');
    if ($referenceNumber) {
        $visa_statuses = VisaTrack::where('reference_number', $referenceNumber)->get();
    } else {
        $visa_statuses = VisaTrack::orderByRaw('CAST(reference_number AS UNSIGNED) ASC')
        ->paginate(10);
    }

    if ($visa_statuses->count() > 0) {
        return response()->json([
            'success' => true,
            'data' => $visa_statuses instanceof \Illuminate\Pagination\LengthAwarePaginator ? $visa_statuses->items() : $visa_statuses,
            'pagination' => $visa_statuses instanceof \Illuminate\Pagination\LengthAwarePaginator ? [
                'current_page' => $visa_statuses->currentPage(),
                'last_page' => $visa_statuses->lastPage(),
                'per_page' => $visa_statuses->perPage(),
                'total' => $visa_statuses->total(),
                'next_page_url' => $visa_statuses->nextPageUrl(),
                'prev_page_url' => $visa_statuses->previousPageUrl(),
            ] : null
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No data found!',
        ], 404);
    }
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.components.create-track');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'applicant_name' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'reference_number' => 'required|string|max:255|unique:visa_tracks,reference_number',
        'status' => 'required|in:Approved,Pending,Rejected', // ✅ Fixed
        'pdf' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    $data = $request->only('applicant_name', 'reference_number', 'name', 'status');

    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf'); // ✅ single file
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/visa_pdfs', $filename);
        $data['pdf'] = $filename;
    }

    try {
        VisaTrack::create($data);

        flash()->success('Status info saved successfully!');
        return redirect()->back();
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            flash()->error('Duplicate entry detected! This reference number already exists.');
        } else {
            flash()->addError('Something went wrong. Please try again.', $e->getMessage());
            
        }

        return redirect()->back()->withInput();
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
        $visa_status = VisaTrack::findOrFail($id);
        return view('admin.components.create-track', compact('visa_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $visa_status = VisaTrack::findOrFail($id);

    $request->validate([
        'applicant_name' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'reference_number' => 'required|string|max:255|unique:visa_tracks,reference_number,' . $visa_status->id,
        'status' => 'required|string',
        'pdf' => 'nullable|mimes:pdf|max:2048',
    ]);

    // ✅ Initialize $data from request so it always exists
    $data = $request->only(['applicant_name', 'name', 'reference_number', 'status']);

    // ✅ If user checked "remove PDF"
    if ($request->has('remove_pdf') && $visa_status->pdf) {
        if (Storage::disk('public')->exists($visa_status->pdf)) {
            Storage::disk('public')->delete($visa_status->pdf);
        }
        $data['pdf'] = null; // remove from database
    }

    // ✅ Handle file upload if provided
    if ($request->hasFile('pdf')) {
        // Delete old file if exists
        if ($visa_status->pdf && Storage::disk('public')->exists($visa_status->pdf)) {
            Storage::disk('public')->delete($visa_status->pdf);
        }

        // Store new file
        $data['pdf'] = $request->file('pdf')->store('visa-pdfs', 'public');
    }

    // ✅ Update the record
    $visa_status->update($data);

    return redirect()->route('admin.visa')->with('success', 'Visa record updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    try {
        $visa = VisaTrack::findOrFail($id);

        // যদি pdf ফাইল থাকে তাহলে সেটি storage থেকে মুছে ফেলো
        if ($visa->pdf && file_exists(storage_path('app/public/' . $visa->pdf))) {
            unlink(storage_path('app/public/' . $visa->pdf));
        }

        // রেকর্ড ডিলিট করো
        $visa->delete();

        return redirect()->route('admin.visa');
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete record: ' . $e->getMessage()
        ]);
    }
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
}
