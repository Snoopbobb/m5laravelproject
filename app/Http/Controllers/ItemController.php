<?php namespace App\Http\Controllers;
use DB;
use Request;

class ItemController extends Controller {

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
	public function all()
	{

		$results = DB::select('select * from item');
		
		return view('items', ["results" => $results]);
	}

	public function edit($id){
		$item = DB::select("select * from item where id = :id", array("id" => $id));

		return view('itemedit', ["item" => $item[0]]);
	}

	public function update($id){
		$name = Request::input('name');		
		$price = Request::input('price');

		$sql = "UPDATE item
				SET name = :name,  
				price = :price
				WHERE id = :id";

		DB::insert($sql, ["name" => $name,
						  "price" => $price,
						  "id" => $id]);

		return redirect('item/all');
	}

	public function delete($id){
		$sql = "
			DELETE
			FROM item
			WHERE id =:id";

		DB::select($sql, array('id' => $id));

		return redirect('item/all');
	}

}
