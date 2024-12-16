@extends('layout')
@section('content')
<h1>Créer une Facture</h1>
<form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
 @csrf
 <div class="form-group">
 <label>Nom du client</label>
 <input type="text" name="client_name" class="form-control" required>
 </div>
 <div class="form-group">
 <label>Montant</label>
 <input type="number" name="amount" class="form-control" required>
 </div>
 <div class="form-group">
 <label>Statut</label>
 <select name="status" class="form-control">
 <option value="unpaid">Non payé</option>
 <option value="paid">Payé</option>
 <option value="canceled">Annulé</option>
 </select>
 </div>
 <div class="form-group">
 <label>Justificatif</label>
 <input type="file" name="file" class="form-control">
 </div>
 <button type="submit" class="btn btn-primary">Créer</button>
</form>
@endsection