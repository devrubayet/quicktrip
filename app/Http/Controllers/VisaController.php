<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    public function index()
    {
        $visaCount = Visa::count();
        $pendingVisa = Visa::where('status', 'pending')->count();
        $approvedVisa = Visa::where('status', 'approve')->count();
        $rejectedVisa = Visa::where('status', 'rejected')->count();

        return view('admin.pages.visa-index', compact('visaCount', 'pendingVisa', 'approvedVisa', 'rejectedVisa'));
    }

    public function indexAjax(Request $request)
    {
        $referenceNumber = $request->input('reference_number', '');
        if ($referenceNumber) {
            $visa_statuses = Visa::where('reference_number', $referenceNumber)->get();
        } else {
            $visa_statuses = Visa::orderByRaw('CAST(reference_number AS UNSIGNED) ASC')
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
    $clients = Client::all(); // passport number select করতে
    return view('admin.components.create-track', compact('clients'));
}


public function store(Request $request)
{
    $request->validate([
        'passport_number' => 'required|exists:clients,passport_number',
        'visa_name' => 'required|string|max:255',
        'status' => 'required|in:Received,Pending,Approved,Rejected',
        'pdf' => 'nullable|file|mimes:pdf|max:2048',
        'gross_amount' => 'required|numeric',
        'net_amount' => 'required|numeric',
        'note' => 'nullable|string|max:500',
    ]);

    try {
        DB::beginTransaction();

        // 1️⃣ Passport দিয়ে Client খুঁজে আনা
        $client = Client::where('passport_number', $request->passport_number)->first();

        // 2️⃣ Visa Create
        $visaData = [
            'client_id' => $client->id,
            'name' => $request->visa_name,
            'applicant_name' => $client->name,
            'status' => $request->status,
            'reference_number' => 'QTV' . strtoupper(uniqid()),
        ];

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/visa_pdfs', $filename);
            $visaData['pdf'] = $filename;
        }

        $visa = Visa::create($visaData);

        // 3️⃣ Payment Create
        $gross = $request->gross_amount;
        $net = $request->net_amount;
        $profit = $gross - $net;

        Payment::create([
            'client_id' => $client->id,
            'visa_id' => $visa->id,
            'gross_amount' => $gross,
            'net_amount' => $net,
            'profit_amount' => $profit,
            'note' => $request->note ?? null,
        ]);

        DB::commit();

        return back()->with('success', 'Visa & Payment info saved successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error: ' . $e->getMessage());
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
    public function edit($id)
    {
        $visa_status = Visa::findOrFail($id);
        $clients = Client::all();
        return view('admin.components.create-track', compact('visa_status','clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visa_status = Visa::findOrFail($id);

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
            $visa = Visa::findOrFail($id);

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
        $visa_status = Visa::where('reference_number', $request->reference_number)->first();
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
