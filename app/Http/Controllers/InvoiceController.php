<?php namespace App\Http\Controllers;

use DB;

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
			SELECT quantity, i.name, price, (price * quantity) AS subtotal, t.invoice_id, t.item_id, c.first_name, c.last_name
			FROM invoice_item AS t, invoice AS v, item AS i, customer as c
			WHERE v.id = t.invoice_id
			AND i.id = t.item_id
			AND c.id = v.customer_id
			AND v.id = :id";	

		$invoices = DB::select($sql, ["id" => $id]);
		return view('invoicedetails', ["invoices" => $invoices]);
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
