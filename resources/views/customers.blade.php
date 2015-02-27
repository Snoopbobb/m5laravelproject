@extends('layout')



@section('main_content')
	<table border="1px solid black">
		<th></th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Gender</th>
		@foreach($results as $customer)
		<tr>
			<td><a href="{{ $customer->id }}">Details</a></td>
			<td>{{ ucwords($customer->first_name) }}</td>
			<td>{{ ucwords($customer->last_name) }}</td>
			<td>{{ $customer->email }}</td>
			<td>{{ $customer->gender }}</td>
			<td><a href="/invoice/{{$customer->id}}">New Invoice</a></td>
			<td><a href="{{ $customer->id }}/edit" >Edit</a></td>
			<td><a href="{{ $customer->id }}/delete">Delete</a></td>
		</tr>
		@endforeach
	</table>
	<a href="/customer/add">Add Customer</a>
@endsection
