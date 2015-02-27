@extends('layout')


@section('main_content')
	<h2>Invoice: {{$invoice_id}} Customer: {{ ucwords($first_name) }} {{ ucwords($last_name) }}</h2>
	<table border="1px solid black">
		<th>Quantity</th>
		<th>Name</th>
		<th>Price</th>
		<th>Sub Total</th>
		@foreach($invoice_items as $detail) 
		<tr>
			<td>{{ $detail->quantity }}</td>
			<td>{{ $detail->name }}</td>
			<td>{{ $detail->price }}</td>
			<td>{{ $detail->subtotal }}</td>
			<td><a href="{{$invoice_id}}/{{$detail->item_id}}/delete">Remove</a></td>
		</tr>
		@endforeach
	</table>
	<a href="/invoice/all">Back To Invoices</a>
	<form method="POST" action="/invoice/{{ $invoice_id }}/add">
		<label>Quantity</label>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="quantity" >
		<select name="item_id">
			@foreach($items as $item)
			<option value="{{ $item->id }}">{{ $item->name }}</option>
			@endforeach
		</select>
		<button>Add</button>
	</form>
@endsection