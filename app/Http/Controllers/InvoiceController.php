<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Visa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['client', 'visa'])
                            ->orderBy('id', 'desc')
                            ->paginate(15);

        return view('admin.pages.invoiceindex', compact('invoices'));
    }

    public function create($visaId)
    {
        $visa = Visa::with('client', 'payments')->findOrFail($visaId);
        $payments = $visa->payments()->latest()->first();

        return view('admin.components.invoice', compact('visa', 'payments'));
    }

    public function store(Request $request, $visaId)
    {
        $visa = Visa::with('client', 'payments')->findOrFail($visaId);
        $payments = $visa->payments()->latest()->first();

        if (!$payments) {
            return back()->with('error', 'No payment found for this visa!');
        }

        Invoice::create([
            'client_id'      => $visa->client_id,
            'visa_id'        => $visa->id,
            'payment_id'     => $payments->id,
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'total_amount'   => $payments->gross_amount,
            'status'         => 'Unpaid',
            'issued_date'    => now(),
            'due_date'       => now()->addDays(7),
            'note'           => $request->note ?? 'Auto-generated invoice',
        ]);

        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice generated successfully!');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['client', 'visa'])->findOrFail($id);
        return view('admin.components.invoice', compact('invoice'));
    }


public function download($id)
{
    $invoice = Invoice::with(['client', 'visa'])->findOrFail($id);

    $site = \App\Models\SiteInfo::first();

    // Safe logo path
    $logoPath = ($site && $site->logo)
        ? storage_path('app/public/' . $site->logo)
        : null;

    // File name using invoice number
    $fileName = ($invoice->invoice_number ?? 'invoice_' . $invoice->id) . '.pdf';

    return Pdf::loadView('admin.components.pdf', [
        'invoice' => $invoice,
        'logoPath' => $logoPath,
    ])->download($fileName);
}

}
