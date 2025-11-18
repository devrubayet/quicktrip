<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // All Clients
    public function index()
    {
        $clients = Client::latest()->get();
        return view('admin.pages.all-clients', compact('clients'));
    }
    public function indexAjax(Request $request)
{
    $search = $request->input('search', '');
    $clients = Client::query();

    if ($search) {
        $clients->where('name', 'like', "%$search%")
                ->orWhere('passport_number', 'like', "%$search%");
    }

    $clients = $clients->paginate(10);

    return response()->json([
        'success' => true,
        'data' => $clients->items(),
        'pagination' => [
            'current_page' => $clients->currentPage(),
            'last_page' => $clients->lastPage(),
            'per_page' => $clients->perPage(),
            'total' => $clients->total(),
            'next_page_url' => $clients->nextPageUrl(),
            'prev_page_url' => $clients->previousPageUrl(),
        ],
    ]);
}


    // Add form
    public function create()
    {
        return view('admin.components.createclient');
    }

    // Store Client
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'passport_number' => 'required|string|max:255|unique:clients,passport_number',
                'phone' => 'required|string|max:30',
            ]);

            Client::create([
                'name' => $request->name,
                'passport_number' => $request->passport_number,
                'phone' => $request->phone,
                // 'email' => $request->email,
                // 'address' => $request->address,
            ]);

            return redirect()->route('client.index')->with('success', 'Client created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Edit Client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    // Update Client
    public function update(Request $request, $id)
    {
        try {

            $client = Client::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'passport_number' => 'required|string|max:255|unique:clients,passport_number,' . $client->id,
                'phone' => 'required|string|max:30',
            ]);

            $client->update([
                'name' => $request->name,
                'passport_number' => $request->passport_number,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            return redirect()->route('client.index')->with('success', 'Client updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Delete Client
    public function destroy($id)
    {
        try {
            Client::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function overview($id)
{
    $client = Client::with(['visas.payments'])->findOrFail($id);

    return view('admin.pages.client-overview', compact('client'));
}



}
