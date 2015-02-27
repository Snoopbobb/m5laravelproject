@extends('layout')


@section('main_content')
<h2>Invoices</h2>
<table border="1px solid black">
<th>ID</th>
<th>Name</th>
<th>Sub-Total</th>
@foreach($invoices as $invoice)
	<tr>
		<td>{{ $invoice->id }}</td>
		<td>{{ ucwords($invoice->name) }}</td>
		<td>{{ $invoice->subtotal }}</td>
		<td><a href="/invoice/{{ $invoice->id }}">Details</a></td>
	</tr>
@endforeach
</table>
@endsection
