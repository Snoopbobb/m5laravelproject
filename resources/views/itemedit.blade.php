@extends('layout')



@section('main_content')
<form method="POST" action="/item/{{ $item->id }}/update">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<label>Name:</label>
	<input name="name" value=" {{ $item->name }}" type="text"></input>
	<label>Price:</label>
	<input name="price" value="{{ $item->price }}" type="text"></input>
	<button>Update</button>
</form>
<a href="/item/all">Back To Items</a>
@endsection