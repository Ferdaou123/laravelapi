@extends('layout')  
@section('content')  
<h1>Modifier la facture</h1>  
<form action="{{ route('invoices.update', $invoice->id) }}" method="POST">  
    @csrf  
    @method('PUT')  
    <div class="form-group">  
        <label for="client_name">Nom du client</label>  
        <input type="text" id="client_name" name="client_name" class="form-control" value="{{ $invoice->client_name }}" required>  
    </div>  
    <div class="form-group">  
        <label for="invoice_date">Date de la facture</label>  
        <input type="date" id="invoice_date" name="invoice_date" class="form-control" value="{{ $invoice->invoice_date }}" required>  
    </div>  
    <div class="form-group">  
        <label for="amount">Montant</label>  
        <input type="number" id="amount" name="amount" class="form-control" value="{{ $invoice->amount }}" required>  
    </div>  
    <div class="form-group">  
        <label for="status">Statut</label>  
        <select id="status" name="status" class="form-control">  
            <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Non payé</option>  
            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Payé</option>  
            <option value="canceled" {{ $invoice->status == 'canceled' ? 'selected' : '' }}>Annulé</option>  
        </select>  
    </div>  
    <button type="submit" class="btn btn-primary">Mettre à jour</button>  
</form>  
@endsection