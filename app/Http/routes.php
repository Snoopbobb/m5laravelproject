<?php

Route::get('/', function(){
	return view('home');
});

Route::get('customer/add', function(){
	return view('customernew');
});

Route::get('customer/all', 'CustomerController@all');

Route::get('customer/{id}', 'CustomerController@details');

Route::get('customer/{id}/delete', 'CustomerController@delete');

Route::get('customer/{id}/edit', 'CustomerController@edit');

Route::post('customer/{id}/update', 'CustomerController@update');

Route::post('customer/add', 'CustomerController@add');

Route::get('item/all', 'ItemController@all');

Route::get('item/{id}/delete', 'ItemController@delete');

Route::get('item/{id}/edit', 'ItemController@edit');

Route::post('item/{id}/update', 'ItemController@update');

Route::get('item/add', 'ItemController@add');

Route::get('invoice/all', 'InvoiceController@all');

Route::get('invoice/new/{id}', 'InvoiceController@newInvoice');

Route::get('invoice/{invoice_id}', 'InvoiceController@getInvoiceDetails');

Route::get('invoice/{invoice_id}/{item_id}/delete', 'InvoiceController@delete');

ROUTE::post('invoice/{invoice_id}/add', 'InvoiceController@add');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
