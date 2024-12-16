@extends('layout')
@section('content')
<h1>Liste des Factures</h1>
<table class="table">
 <thead>
 <tr>
 <th>#</th>
 <th>Client</th>
 <th>Montant</th>
 <th>Statut</th>
 <th>Actions</th>
 </tr>
 </thead>
 <tbody>
 @foreach($invoices as $invoice)
 <tr>
 <td>{{ $invoice->id }}</td>

 <td>{{ $invoice->client_name }}</td>
 <td>{{ $invoice->amount }}</td>
 <td>{{ $invoice->status }}</td>
 <td>
 <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Modifier</a>
 <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
 @csrf
 @method('DELETE')
 <button type="submit" class="btn btn-danger">Supprimer</button>
 </form>
 </td>
 </tr>
 @endforeach
 </tbody>
</table>
{{ $invoices->links() }}
@endsection