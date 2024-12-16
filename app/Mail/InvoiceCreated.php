<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Mail\InvoiceCreated;
use Illuminate\Support\Facades\Mail;

class InvoiceCreated extends Mailable
{
 use Queueable, SerializesModels;
 public $invoice;
 public function __construct(Invoice $invoice)
 {
 $this->invoice = $invoice;
 }
 public function build()
{
 return $this->view('emails.invoice_created')
 ->subject('Nouvelle facture créée')
 ->attach(storage_path('app/invoices/example.pdf'))
 ->with(['invoice' => $this->invoice]);
}

 public function store(Request $request)
{
 $validated = $request->validate([
 'client_name' => 'required|max:255',
 'amount' => 'required|numeric|min:0',
 'status' => 'in:unpaid,paid,canceled',
 'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
 ]);
 if ($request->hasFile('file')) {
 $validated['file_path'] = $request->file('file')->store('invoices');
 }
 $invoice = Invoice::create($validated);
 // Envoi de l'email
 Mail::to('admin@example.com')->send(new InvoiceCreated($invoice));
 return redirect()->route('invoices.index')->with('success', 'Facture créée avec succès.');

}
}