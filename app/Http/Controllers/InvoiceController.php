<?php namespace App\Http\Controllers;
use DB;
use Request;

class InvoiceController extends Controller {

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
		$sql = "SELECT v.id, CONCAT(first_name, ' ', last_name) AS name, SUM(quantity * price) AS subtotal
			FROM customer AS c, invoice AS v, invoice_item AS t, item as i 
			WHERE c.id = v.customer_id
			AND v.id = t.invoice_id
			AND i.id = t.item_id
			Group by t.invoice_id";

		$invoices = DB::select($sql);

		return view('invoices', ["invoices" => $invoices]);
	}

	public function getInvoiceDetails($id){
		$sql = "
			SELECT quantity, i.name, price, (price * quantity) AS subtotal, t.invoice_id AS invoice_id, 
				   t.item_id, c.first_name AS first_name, c.last_name AS last_name
			FROM invoice_item AS t, invoice AS v, item AS i, customer as c
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND c.id = v.customer_id
			AND v.id = :id";

		$sql2 = "SELECT item.name, item.id  
				FROM item";	

		// $sql3 = "SELECT first_name, last_name
		// 		FROM customer
		// 		WHERE customer.id = :id";

		$invoice_items = DB::select($sql, ["id" => $id]);
		$items = DB::select($sql2);
		// $customers = DB::select($sql3, ["id" => $id]);
		// foreach ($customers as $customer) {
		// 	$first_name = $customer->first_name;
		// 	$last_name = $customer->last_name;
		// }
		return view('invoicedetails', ["invoice_items" => $invoice_items, 
										"items" => $items, 
										"invoice_id" => $id]
										// "first_name" => $first_name,
										// "last_name" => $last_name]
										);
	}

	public function newInvoice($customer_id){
		$sql = "
			INSERT INTO invoice (
				customer_id, created_at
			) VALUES (
				:customer_id, CURDATE()
			)
		";

		DB::insert($sql, [
			':customer_id' => $customer_id
		]);

		return redirect("invoice/" . DB::getPdo()->lastInsertId());
	}

	public function add($invoice_id){
		$sql = "
			INSERT INTO invoice_item (
				invoice_id, item_id, quantity
			) VALUES (
				:invoice_id, :item_id, :quantity
			)
			ON DUPLICATE KEY UPDATE
			quantity = :quantity2
			";
		
		
		$quantity = Request::input('quantity');
		$quantity2 = Request::input('quantity');
		$item_id = Request::input('item_id');

		DB::select($sql, ["invoice_id" => $invoice_id, "item_id" => $item_id, "quantity" => $quantity, "quantity2" => $quantity2]);

		return redirect("invoice/$invoice_id");
	}

	public function delete($invoice_id, $item_id){
		$sql = "
			DELETE
			FROM invoice_item
			WHERE (invoice_id, item_id) IN ((:invoice_id, :item_id))";

		DB::select($sql, ["invoice_id" => $invoice_id, 'item_id' => $item_id]);

		return redirect("invoice/$invoice_id");
	}

}
