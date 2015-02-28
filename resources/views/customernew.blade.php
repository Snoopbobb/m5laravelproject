@extends('layout')



@section('main_content')
<form method="POST" action="/customer/add">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<label>First Name:</label>
	<input name="first_name" type="text"></input>
	<label>Last Name:</label>
	<input name="last_name" type="text"></input>
	<label>Email:</label>
	<input name="email" type="email"></input>
	<select name="gender">
		<option>male</option>
		<option>female</option>
	</select>
	<button>Add</button>
</form>
@endsection