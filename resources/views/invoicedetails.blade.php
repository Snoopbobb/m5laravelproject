@extends('layout')


@section('main_content')
	<h2>Invoice: {{$invoices[0]->invoice_id}} Customer: {{ ucwords($invoices[0]->first_name) }} {{ ucwords($invoices[0]->last_name) }}</h2>
	<table border="1px solid black">
		<th>Quantity</th>
		<th>Name</th>
		<th>Price</th>
		<th>Sub Total</th>
		@foreach($invoices as $invoice) 
		<tr>
			<td>{{ $invoice->quantity }}</td>
			<td>{{ $invoice->name }}</td>
			<td>{{ $invoice->price }}</td>
			<td>{{ $invoice->subtotal }}</td>
			<td><a href="{{$invoice->invoice_id}}/{{$invoice->item_id}}/delete">Remove</a></td>
		</tr>
		@endforeach 
	</table>
	<a href="/invoice/all">Back To Invoices</a>
	<form>
		<label>Quantity</label>
		<input type="text" name="quantity" >
		<select>
			<option>Items</option>
		</select>
		<button>Add</button>
	</form>
@endsection