<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use Illuminate\Http\Request;

class BankController extends Controller
{
    function index(){
        $banks = BankDetail::all();
        return view('admin.pages.all-bank', compact('banks'));
    }
    function create(){
        return view('admin.components.bank_form');
    }
    function store(Request $request){
        try {
            $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'branch_name' => 'required'
        ]);
        BankDetail::create($request->all());

        
        flash()
            ->option('position', 'top-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Service Slider has been saved!');
            
        return redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
             flash()->addError('Something went wrong: ' . $e->getMessage());
        return redirect()->back();
        }
    }


    public function edit($id)
{
    $bank = BankDetail::findOrFail($id);
    return view('admin.components.bank_form', compact('bank'));
}

public function update(Request $request, $id)
{
    try {
        $bank = BankDetail::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'branch_name' => 'required|string|max:255',
        ]);

        $bank->update($request->all());

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 5000)
            ->option('ltr', true)
            ->success('Bank details updated successfully!');

        return redirect()->route('admin.dashboard');

    } catch (\Exception $e) {
        flash()->addError('Something went wrong: ' . $e->getMessage());
        return redirect()->back()->withInput();
    }
}

public function destroy($id)
{
    try {
        $bank = BankDetail::findOrFail($id);

        // যদি logo file থাকে, remove it from storage
        if ($bank->logo_url && file_exists(public_path($bank->logo_url))) {
            unlink(public_path($bank->logo_url));
        }

        $bank->delete();

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 5000)
            ->option('ltr', true)
            ->success('Bank details deleted successfully!');

        return redirect()->back();

    } catch (\Exception $e) {
        flash()->addError('Something went wrong: ' . $e->getMessage());
        return redirect()->back();
    }
}

}
