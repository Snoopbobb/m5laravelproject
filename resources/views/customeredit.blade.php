@extends('layout')



@section('main_content')
<form>
	<label>First Name:</label>
	<input name="first_name" value=" {{ $customer->first_name }}" type="text"></input>
	<label>Last Name:</label>
	<input name="last_name" value="{{ $customer->last_name }}" type="text"></input>
	<label>Email:</label>
	<input name="email" value="{{ $customer->email }}" type="email"></input>
	<select name="gender">
		<option>Male</option>
		<option>Female</option>
	</select>
	<button>Submit</button>
</form>
@endsection