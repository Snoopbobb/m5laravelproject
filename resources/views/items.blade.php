@extends('layout')



@section('main_content')
	<h2>Items</h2>
	<table border="1px solid black">
		<th>Product Name</th>
		<th>Price</th>
		@foreach($results as $item)
		<tr>
			<td>{{ $item->name }}</td>
			<td>{{ $item->price }}</td>
			<td><a href="{{ $item->id }}/edit" >Edit</a></td>
			<td><a href="{{ $item->id }}/delete">Delete</a></td>
		</tr>
		@endforeach
	</table>
@endsection
