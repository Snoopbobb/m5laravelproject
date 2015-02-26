<?php namespace App\Http\Controllers;

use DB;
// use App\Library\SQL;

class CustomerController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function all(){
		$results = DB::select('select * from customer');
		
		return view('customers', ["results" => $results]);
	}

	public function details($id){
		$customer = DB::select("select * from customer where id = :id", array("id" => $id));

		return view('customerdetails', ["customer" => $customer[0]]);
	}

	public function edit($id){
		$customer = DB::select("select * from customer where id = :id", array("id" => $id));

		return view('customeredit', ["customer" => $customer[0]]);	
	}

	public function delete($id){
		$sql = "
			DELETE
			FROM customer
			WHERE id =:id";

		DB::select($sql, array('id' => $id));

		return redirect('customer/all');
	}

}
