<?php

Route::get('/', function(){
	return view('home');
});

Route::get('customer/all', 'CustomerController@all');

Route::get('customer/{id}', 'CustomerController@details');

Route::get('customer/{id}/delete', 'CustomerController@delete');

Route::get('customer/edit/{id}/', 'CustomerController@edit');

Route::get('item/all', 'ItemController@all');

Route::get('invoice/all', 'InvoiceController@all');

Route::get('invoice/{id}', 'InvoiceController@getInvoiceDetails');

Route::get('invoice/{invoice_id}/{item_id}/delete', 'InvoiceController@delete');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
