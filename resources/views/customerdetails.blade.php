@extends('layout')



@section('main_content')
	<table border="1px solid black">
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Gender</th>
		<tr>
			<td>{{ $customer->first_name }}</td>
			<td>{{ $customer->last_name }}</td>
			<td>{{ $customer->email }}</td>
			<td>{{ $customer->gender }}</td>
			<td><a href="#">New Invoice</a></td>
			<td><a href="customer/edit/{{ $customer->id }}" >Edit</a></td>
		</tr>
	</table>
@endsection