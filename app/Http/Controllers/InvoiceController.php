<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Afficher la liste des factures
    public function index()
{
 $invoices = \Cache::remember('invoices', 60, function () {
 return \App\Models\Invoice::paginate(10);
 });
 return view('invoices.index', compact('invoices'));
}

    // Afficher le formulaire de création
    public function create()
    {
     return view('invoices.create');
    }

    // Enregistrer une nouvelle facture
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'client_name' => 'required|string',
        'amount' => 'required|numeric',
        'status' => 'required|string',
        'file' => 'required|file', // Validation pour le fichier
    ]);

    // Gestion du fichier
    $filePath = $request->file('file')->store('invoices', 'public'); // Sauvegarde dans le dossier 'invoices'

    // Création de la facture
    Invoice::create([
        'client_name' => $validatedData['client_name'],
        'amount' => $validatedData['amount'],
        'status' => $validatedData['status'],
        'file_path' => $filePath, // Enregistrement du chemin du fichier
    ]);

    return redirect()->route('invoices.index')->with('success', 'Facture créée avec succès.');
}

    
    // Afficher le formulaire de modification  
    public function edit($id)
    {
     $invoice = \App\Models\Invoice::findOrFail($id);
     return view('invoices.edit', compact('invoice'));
    }
    

// Mettre à jour une facture  
public function update(Request $request, $id)
{
 $invoice = \App\Models\Invoice::findOrFail($id);
 $validated = $request->validate([
 'client_name' => 'required|max:255',
 'amount' => 'required|numeric|min:0',
 'status' => 'in:unpaid,paid,canceled',
 'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
 ]);
 if ($request->hasFile('file')) {
 \Storage::delete($invoice->file_path);
 $validated['file_path'] = $request->file('file')->store('invoices');
 }
 $invoice->update($validated);
 return redirect()->route('invoices.index')->with('success', 'Facture mise à jour avec succès.');
}
// Supprimer une facture  
public function destroy($id)
{
 $invoice = \App\Models\Invoice::findOrFail($id);
 if ($invoice->file_path) {
 \Storage::delete($invoice->file_path);
 }
 $invoice->delete();
 return redirect()->route('invoices.index')->with('success', 'Facture supprimée avec succès.');
}
}