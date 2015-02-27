<?php namespace App\Http\Controllers;

use DB;
use Request;
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

	public function update($id){
		$first_name = Request::input('first_name');		
		$last_name = Request::input('last_name');
		$email = Request::input('email');
		$gender = Request::input('gender');

		$sql = "UPDATE customer
				SET first_name = :first_name, 
				last_name = :last_name, 
				email = :email, 
				gender = :gender
				WHERE id = :id";

		DB::insert($sql, ["first_name" => $first_name,
						  "last_name" => $last_name,
						  "email" => $email,
						  "gender" => $gender,
						  "id" => $id]);

		return redirect('customer/all');
	}

	public function add(){
		$first_name = Request::input('first_name');		
		$last_name = Request::input('last_name');
		$email = Request::input('email');
		$gender = Request::input('gender');

		$sql = "
			INSERT INTO customer (
				first_name, last_name, email, gender, customer_since
			) VALUES (
				:first_name, :last_name, :email, :gender, CURDATE()
			)
		";

		$sql2 = "
			INSERT INTO invoice (
				customer_id, created_at
			) VALUES (
				:customer_id, CURDATE()
			)
		";

		DB::insert($sql, [
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'gender' => $gender,
			]);

		// $customer_id = 


		DB::insert($sql2, [
			':customer_id' => DB::getPdo()->lastInsertId()
		]);

		return redirect('customer/all');
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
