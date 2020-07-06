<?php


class TopFormDB extends SQLite3 {
	

	public $date;
	public $conn;
	public $time_only;
	public $date_ony;
	public $date_year_month;
	public $date_year;
	function __construct(){
		$this->open('database.db');
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', time());
		$date_ony = date('Y-m-d', time());
		$this->time_only = date('h:i:s a', time());
		$year_month = date('Y-m', time());
		$year = date('Y', time());
		$this->date = $date;
		$this->date_only = $date_ony;
		$this->date_year_month = $year_month;
		$this->date_year = $year;
	}

	public function update_items($post_data){
		$item_name = $post_data['item_name'];
		$item_code = $post_data['item_code'];
		$item_price = $post_data['item_price'];
		$id = $post_data['id'];
		$sql = "UPDATE item_details SET item_name='$item_name',item_code='$item_code',item_price='$item_price' WHERE id='$id'";
		$this->conn->exec($sql);
		header("Refresh:0; url=items.php");
	}
	public function delete_item(){
		$item_code = $_POST['item_code'];
		$sql = "DELETE FROM item_details WHERE item_code='$item_code'";
		$this->conn->exec($sql);
		return 'Deleted';
	}
	public function select_items(){
		$sql = "SELECT * FROM item_details";
		$result = $this->conn->query($sql);
		$result_count = $this->conn->query($sql);
		$result_html = '';
		$count = 1 ;
		$row_count = $result_count->fetchArray(SQLITE3_ASSOC);
		if($row_count){
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				$result_html .= '<tr>';
				$result_html .= '<td>' . $count . '</td>';
				$result_html .= '<td>' . $row['item_name'] . '</td>';
				$result_html .= '<td>' . $row['item_code'] . '</td>';
				$result_html .= '<td>' . $row['item_price'] . '</td>';
				$result_html .= '<td><button item_name="'.$row['item_name'].'" item_code="'.$row['item_code'].'" item_price="'.$row['item_price'].'" edit_id="' . $row['id'] . '" class="edit_item_details btn-transparent"><i class="fa fa-edit y-code"></i></button>';
				$result_html .='&nbsp;&nbsp;&nbsp;<button item_code="'.$row['item_code'].'" class="delete_item btn-transparent"><i class="fa fa-trash bro-code"></i></button></td></tr>';


				// $return_array[] = $rows;
				$count++;
			}
			return $result_html;
		}
		else{
			$result_html = '';
			return $result_html;
		}
		
	}
	public function select_invoices($post_data){
		if (isset($post_data['date'])){
			$search_date = $_POST['date'];
		}
		else{
			$search_date = $this->date_only;
		}
		// echo '<pre>';
		// print_r($post_data);
		if(isset($post_data['filter_invoice'])){
			if($post_data['filter_invoice'] == 'phone'){
				$phone_number = $post_data['invoice_number'];
				$sql = "SELECT * FROM customer_bill WHERE customer_number='$phone_number'";
			}
			else{
				$filter_name = $post_data['invoice_number'];
				$sql = "SELECT * FROM customer_bill WHERE customer_name='$filter_name'";
			}
		}
		else{
			$sql = "SELECT * FROM customer_bill WHERE added_date='$search_date'";
		}
		$result = $this->conn->query($sql);
		$result_count = $this->conn->query($sql);
		$result_html = '';
		$count = 1 ;
		$row_count = $result_count->fetchArray(SQLITE3_ASSOC);
		if(isset($row_count)){;
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				$result_html .= '<tr>';
				$result_html .= '<td>' . $count . '</td>';
				$result_html .= '<td>' . $row['customer_name'] . '</td>';
				$result_html .= '<td>' . $row['customer_number'] . '</td>';
				$result_html .= '<td>' . $row['total_price_bill'] . '</td>';
				$url = "url_router.php?class_name=SiteController&function_name=select_bill_item&invoice_number=".$row['id'];
				$result_html .= '<td><a href="'.$url.'" class="view_invoice btn-transparent"><i class="fa fa-eye o"></i></a>';
				// $result_html .='&nbsp;&nbsp;&nbsp;<button item_code="'.$row['id'].'" class="delete_invoice btn-transparent"><i class="fa fa-trash bro-code"></i></button>';
				$result_html .='</td></tr>';


				// // $return_array[] = $rows;
				// $count++;
			}
			$item['result_html'] = $result_html;
			$item['date'] = $search_date;
			if(isset($post_data['ajax'])){
				return $result_html;
			}
		}
		else{
			$item = '';
		}
		return $item;
	}
	public function get_hotel_details(){
		$sql = "SELECT * FROM hotel_info";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		$result_html = '';
		$hotel_name = '<p>' . $row['hotel_name']. '</p>';
		$result_html .= '<p>' . $row['hotel_info']. '</p>';
		$result_html .= '<p>' . $row['hotel_address']. '</p>';
		$result_html .= '<p> Tel: ' . $row['hotel_phone']. '&nbsp;&nbsp;,Mob: '. $row['mobile'] .'</p>';
		$result_html .= '<p> Liscence No.: ' . $row['hote_liscence']. '</p>';
		$return_array[0] = $result_html;
		$return_array[1] = $hotel_name;
		return $return_array;
	}
	public function select_items_code(){
		$sql = "SELECT item_name,item_code,item_price FROM item_details";
		$result = $this->conn->query($sql);
		while($row = $result->fetchArray(SQLITE3_ASSOC)){
			$json[] = $row['item_name'] . ' - ' . $row['item_code'];
			$price_array[$row['item_code']] = $row['item_price'];
		}
		$return_array[0] = $json;
		$return_array[1] = $price_array;
		return json_encode($return_array,true);

	}
	public function insert_items($post_data){
		$item_name = $post_data['item_name'];
		$item_code = $post_data['item_code'];
		$item_price = $post_data['item_price'];
		$sql = "INSERT INTO item_details (item_name,item_code,item_price,added_on) VALUES('$item_name','$item_code','$item_price','$this->date')";
		$this->conn->exec($sql);
		header("Refresh:0; url=items.php");
		
	}

	public function save_bill($post_data){
		$row_num = 1;
		$cashier_name = $post_data['cashier_name'];
		$customer_name = $post_data['customer_name'];
		$customer_number = $post_data['customer_number'];
		$customer_location = $post_data['customer_location'];
		$total_price_bill = $post_data['total_price_bill'];
		$items_total = (int) $post_data['total_rows'];
		$item['cashier_name'] = $cashier_name;
		$item['customer_name'] = $customer_name;
		$item['customer_number'] = $customer_number;
		$item['customer_location'] = $customer_location;
		$item['total_price_bill'] = $total_price_bill;
		$item['items_total'] = $items_total;
		if(isset($post_data['invoice_number'])) $invoice_number = $post_data['invoice_number'];

		if(!isset($invoice_number))
		{
			$sql_bill = "INSERT INTO customer_bill (items_total,cashier_name,customer_name,customer_number,customer_location,total_price_bill,added_date,added_time) VALUES('$items_total','$cashier_name','$customer_name','$customer_number','$customer_location','$total_price_bill','$this->date_only','$this->time_only')";
			$this->conn->exec($sql_bill);
			$reference_key = $this->conn->lastInsertRowID();
			
		}
		else{
			$sql_bill = "UPDATE customer_bill SET items_total='$items_total',cashier_name='$cashier_name',customer_name='$customer_name',customer_number='$customer_number',customer_location='$customer_location',total_price_bill='$total_price_bill',added_date='$this->date_only',added_time='$this->time_only' WHERE id='$invoice_number'";
			$this->conn->exec($sql_bill);
			$reference_key = $invoice_number;
		}
		$item['invoice_number'] = $reference_key;
		$item_code = '';
		$qty_selled = '';
		$print_html = '';
		$qty_total = 0;
		
		$result_html = '';
		for($i = 1; $i<=$items_total;$i++){
			if($post_data['delete_row_'.$i] == 0){
				$item_name = $post_data['item_name_row_input_'.$i];
				$item_price = $post_data['item_price_row_input_'.$i];
				$total_price_row = $post_data['item_total_row_input_'.$i];

				
				$item_str = (string) $post_data['item_code_row_input_'.$i];
				$item_explode = explode("-",$item_str);
				$item_code .= $item_explode[1];
				if($i != $items_total) $item_code .= ',';
				$item['code'][$i] = $item_explode[1];
	
				$qty_str = (string) $post_data['item_qty_input_'.$i];
				$qty_selled .= $qty_str;
				if($i != $items_total) $qty_selled .= ',';

				$qty = $post_data['item_qty_input_'.$i];
				
				$qty_int = (int)$qty_str;
				$temp_name =  $post_data['item_name_row_input_'.$i];
				if(isset($invoice_number)){
					$sales_report_daily = $this->sales_report($qty,$item_explode[1],$reference_key,'edit');
					$sales_report_montly = $this->sales_report_montly($qty,$item_explode[1],$reference_key,'edit');
					$sales_report_montly = $this->sales_report_yearly($qty,$item_explode[1],$reference_key,'edit');
				}
				else{
					$sales_report_daily = $this->sales_report($qty,$item_explode[1],$reference_key,'new');
					$sales_report_montly = $this->sales_report_montly($qty,$item_explode[1],$reference_key,'new');
					$sales_report_montly = $this->sales_report_yearly($qty,$item_explode[1],$reference_key,'new');
				}
				

				$result_html .= '<tr>';
				$result_html .= '<td>' . $i . '</td>';
				$result_html .= '<td>' . $item_explode[1] . '</td>';
				$result_html .= '<td>' . $item_name . '</td>';
				$result_html .= '<td>' . $qty_int . '</td>';
				$result_html .= '<td>' .  $item_price. '</td>';
				$result_html .= '<td>' .  $total_price_row. '</td>';

				$print_html .= '<tr>';
				$print_html .= '<td>' . $item_name . '</td>';
				$print_html .= '<td>' . $qty_int . '</td>';
				$print_html .= '<td>' .  $item_price. '</td>';
				$print_html .= '<td>' .  $total_price_row. '</td></tr>';

			}
		}
		if(!isset($invoice_number)){
			$sql = "INSERT INTO items_selled (item_code,reference_key,qty_selled) VALUES('$item_code','$reference_key','$qty_selled')";
			$this->conn->exec($sql);
		}
		else{

			$sql = "UPDATE items_selled SET item_code='$item_code',qty_selled='$qty_selled' WHERE reference_key='$reference_key'";
						echo '<br>';
			$this->conn->exec($sql);
		}
		$print_foot = '<tr><th colspan="2"> Qty :' .$items_total . '</th>';
		$print_foot .= '<th colspan="2"> Total :' .$total_price_bill . '</th></tr>';
		$item['print_html'] = $print_html;
		$item['print_foot'] = $print_foot;
		$item['html'] = true;
		$item['html_content'] = $result_html;
		return $item;
	}
	public function sales_report($qty,$item_code,$invoice_number,$bill_type){
		$sql = "SELECT * FROM sales_report_daily WHERE item_code='$item_code' AND date_time='$this->date_only'";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		if($row){
			#update
			$qty_pre = (int) $row['qty_selled'];
			$new_qty = $qty_pre + $qty;
			if($bill_type == 'edit'){
				$remove_last_added_qty = (int) $row['last_added_qty'];
				$new_qty = $qty_pre + $qty - $remove_last_added_qty;
			}
			$sql_sales_insert = "UPDATE sales_report_daily SET qty_selled='$new_qty',last_added_qty='$qty',invoice_number ='$invoice_number' WHERE item_code='$item_code' AND date_time='$this->date_only'";
			$this->conn->exec($sql_sales_insert);
		}
		else{

			#insert
			$sql_sales_insert = "INSERT INTO sales_report_daily (item_code,qty_selled,date_time,last_added_qty,invoice_number) VALUES('$item_code','$qty','$this->date_only','$qty','$invoice_number')";
			$this->conn->exec($sql_sales_insert);
		}
	}
	public function sales_report_montly($qty,$item_code,$invoice_number,$bill_type){
		$sql = "SELECT * FROM sales_report_monthly WHERE item_code='$item_code' AND date_time='$this->date_year_month'";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		// echo '<pre>';
		// print_r($row);
		if($row){
			#update
			$qty_pre = (int) $row['qty_selled'];
			$new_qty = $qty_pre + $qty;
			// echo $new_qty; echo '<br>';
			if($bill_type == 'edit'){
				// echo "month";
				$remove_last_added_qty = (int) $row['last_added_qty'];
				$new_qty = $qty_pre + $qty - $remove_last_added_qty;
			}
			$sql_sales_insert = "UPDATE sales_report_monthly SET qty_selled='$new_qty',last_added_qty='$qty',invoice_number ='$invoice_number' WHERE item_code='$item_code' AND date_time='$this->date_year_month'";

			// echo $sql_sales_insert;
			$this->conn->exec($sql_sales_insert);
		}
		else{

			#insert
			$sql_sales_insert = "INSERT INTO sales_report_monthly (item_code,qty_selled,date_time,last_added_qty,invoice_number) VALUES('$item_code','$qty','$this->date_year_month','$qty','$invoice_number')";
			$this->conn->exec($sql_sales_insert);
		}
	}
	public function sales_report_yearly($qty,$item_code,$invoice_number,$bill_type){
		$sql = "SELECT * FROM sales_report_yearly WHERE item_code='$item_code' AND date_time='$this->date_year'";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		// 		echo '<pre>';
		// print_r($row);
		if($row){
			#update
			$qty_pre = (int) $row['qty_selled'];
			$new_qty = $qty_pre + $qty;
			if($bill_type == 'edit'){
				// echo "year"; echo '<br>';
				$remove_last_added_qty = (int) $row['last_added_qty'];
				// echo $remove_last_added_qty; echo '<br>';
				$new_qty = $qty_pre + $qty - $remove_last_added_qty;
			}
			$sql_sales_insert = "UPDATE sales_report_yearly SET qty_selled='$new_qty',last_added_qty='$qty',invoice_number ='$invoice_number' WHERE item_code='$item_code' AND date_time='$this->date_year'";
			$this->conn->exec($sql_sales_insert);
		}
		else{

			#insert
			$sql_sales_insert = "INSERT INTO sales_report_yearly (item_code,qty_selled,date_time,last_added_qty,invoice_number) VALUES('$item_code','$qty','$this->date_year','$qty','$invoice_number')";
			$this->conn->exec($sql_sales_insert);
		}
	}

	public function select_bill_item_model($post_data,$return_html){
		$invoice_number = $post_data['invoice_number'];

		$sql = "SELECT * FROM customer_bill WHERE id='$invoice_number'";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		if($row){
			$item['cashier_name'] = $row['cashier_name'];
			$item['customer_name'] = $row['customer_name'];
			$item['customer_number'] = $row['customer_number'];
			$item['customer_location'] = $row['customer_location'];
			$item['total_price_bill'] = $row['total_price_bill'];
			$item['bill_date'] = $row['added_date'];
			$item['bill_time'] = $row['added_time'];
			$item['items_total'] = $row['items_total'];
			$item['invoice_number'] = $invoice_number;
			$sql2 = "SELECT * FROM items_selled WHERE reference_key='$invoice_number'";
			$result2 = $this->conn->query($sql2);
			$row2 = $result2->fetchArray(SQLITE3_ASSOC);
			$item_codes = $row2['item_code'];
			$item_code_explode = explode(',', $item_codes);
			$qty = $row2['qty_selled'];
			$qty_selled = explode(",", $qty);
			$result_html = '';
			$print_html ='';
			$price_str = '';
			$count = 0;
			$qty_total = 0;
			foreach ($item_code_explode as $key => $item_code) {
				$qty_item = (int)$qty_selled[$count];
				$item_code = trim($item_code);
				$sql_item = "SELECT * FROM item_details WHERE item_code='$item_code'";
				$result_item = $this->conn->query($sql_item); 
				$row_item = $result_item->fetchArray(SQLITE3_ASSOC);
				$qty_total += $qty_item;
				$item_price = (int)$row_item['item_price'];
				$total_price_row = $item_price * $qty_item;
				if ($return_html == true){
					$result_html .= '<tr>';
					$result_html .= '<td>' . $count . '</td>';
					$result_html .= '<td>' . $row_item['item_code'] . '</td>';
					$result_html .= '<td>' . $row_item['item_name'] . '</td>';
					$result_html .= '<td>' . $qty_item . '</td>';
					$result_html .= '<td>' .  $item_price. '</td>';
					$result_html .= '<td>' .  $total_price_row. '</td></tr>';
	
	
					$print_html .= '<tr>';
					$print_html .= '<td>' . $row_item['item_name'] . '</td>';
					$print_html .= '<td>' . $qty_item . '</td>';
					$print_html .= '<td>' .  $item_price. '</td>';
					$print_html .= '<td>' .  $total_price_row. '</td></tr>';
	
				}
				else{
					$return_item[$count]['item_code'] = $row_item['item_code'];
					$return_item[$count]['item_name'] = $row_item['item_name'];
					$return_item[$count]['qty_item'] = $qty_item;
					$return_item[$count]['item_price'] = $item_price;
					$return_item[$count]['total_price_row'] = $total_price_row;
					$price_str .= $total_price_row . ',';
				}
				$count++;
			}
	
			if ($return_html == true){
				$print_foot = '<tr><th colspan="2"> Qty :' .$qty_total . '</th>';
				$print_foot .= '<th colspan="2"> Total :' .$row['total_price_bill'] . '</th></tr>';
				$item['html'] = true;
				$item['html_content'] = $result_html;
				$item['print_html'] = $print_html;
				$item['print_foot'] = $print_foot;
			}
			if ($return_html == true){
				return $item;
			}
			else{
				$item['price_str'] = $price_str;
				$return_array[0] = $item;
	
				$return_array[1] = $return_item;
				return $return_array;
			}
		}
		else{
			return '';
		}

	}
	public function select_sales_report($post_data){
		if(isset($post_data['from_date'])){
			$new_array[0] = (string)$post_data['from_date'];
			$new_array[1] = (string)$post_data['to_date'];
			$type = $post_data['filter_by'];
		}
		else{
			$type = '';
		}
		if(isset($_GET['today'])){
			$new_array[0] = (string)$this->date_only;
			$new_array[1] = (string)$this->date_only;
		}

		$sql_price = "SELECT * FROM item_details";
		$result_price = $this->conn->query($sql_price);
		$price_array = [];
		while($row_price = $result_price->fetchArray(SQLITE3_ASSOC)){
			$price_array['item_price'][(int)$row_price['item_code']] = $row_price['item_price'];
			$price_array['item_name'][(int)$row_price['item_code']] = $row_price['item_name'];
			$name_array[(int)$row_price['item_code']] = $row_price['item_name'];
		}
		// echo '<pre>';
		// print_r($price_array);
		if($type == 'date' || $type == 'week' || isset($_GET['today'])){
			$new = implode("','",$new_array);
			$table_name = 'sales_report_daily';
		}
		else if($type == 'month'){
			$from = strtotime($new_array[0]);
			$to = strtotime($new_array[1]);
			$from_month = date("m",$from);
			$to_month = date("m",$to);
			
			$from_year=date("Y",$from);
			$to_year=date("Y",$to);

			$new_array[0] = $from_year . '-' . $from_month;
			$new_array[1] = $to_year . '-' . $to_month;
			
			$new = implode("','",$new_array);
			$table_name = 'sales_report_monthly';
			// echo '<pre>';
			// print_r($post_data);
			// print_r($new);
			// exit;
		}
		else{
			$from = strtotime($new_array[0]);
			$to = strtotime($new_array[1]);	
			$from_year=date("Y",$from);
			$to_year=date("Y",$to);
			$new_array[0] = $from_year;
			$new_array[1] = $to_year;
			$new = implode("','",$new_array);
			$table_name = 'sales_report_yearly';
		}
		$sql = "SELECT * FROM $table_name WHERE date_time IN ('$new') ORDER BY date_time ASC";
		$result = $this->conn->query($sql);
		$result_count = $this->conn->query($sql);
		$pre_date = '';
		$count = 0;
		$total_price_by_date = 0;
		$total_qty_by_date = 0;
		$price = 0;
		$qty_all = 0;
		$row_count = $result_count->fetchArray(SQLITE3_ASSOC);
		if($row_count){
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				$date = $row['date_time'];

				$new_date = strtotime($date);
				$month = date("m",$new_date);
				$year=date("Y",$new_date);
				if($type == 'date' || isset($_GET['today'])){
					$date_key = $date;
				}
				else if($type == 'month'){
					$date_key = $year . '-' . $month;
				}
				else{
					$date_key = $year;
				}
				$item_code_in_date = (int)$row['item_code'];
				$item_qty = (int)$row['qty_selled'];
				$item_price = (int)$price_array['item_price'][$item_code_in_date];
				$total_price = $item_price * $item_qty;
				$total_price_by_date += $item_price;
				$total_qty_by_date += $item_qty;
				$return_row[$date_key][$count]['item_name'] = $price_array['item_name'][$item_code_in_date];
				$return_row[$date_key][$count]['item_qty'] = $item_qty;
				$return_row[$date_key][$count]['item_price'] = $item_price;
				$return_row[$date_key][$count]['item_price_total'] = $total_price;
				if($pre_date != $date_key && $count !=0){
					$qty_all = 0;
					$price = 0;
				}
				$price += $total_price;
				$qty_all += $item_qty;
				

				$total[$date_key]['qty'] = $qty_all;
				$total[$date_key]['price'] = $price;

				$return_row[$date_key] = array_values($return_row[$date_key]);
				$return_row[$date_key] = array_values($return_row[$date_key]);
				$return_row[$date_key] = array_values($return_row[$date_key]);
				$return_row[$date_key] = array_values($return_row[$date_key]);
				$count++;
				$pre_date = $date_key;
			}

			$sql_today_year = "SELECT * FROM sales_report_yearly WHERE date_time='$this->date_year'";
			$result_year = $this->conn->query($sql_today_year);
			$price = 0;
			$qty_all = 0;
			$total_year = [];
			while($row_year = $result_year->fetchArray(SQLITE3_ASSOC)){
				$item_code_in_date = (int)$row_year['item_code'];
				$item_qty = (int)$row_year['qty_selled'];
				$item_price = (int)$price_array['item_price'][$item_code_in_date];
				$total_price = $item_price * $item_qty;
				$price += $total_price;
				$qty_all += $item_qty;
				$total_year['qty_selled'] =  $qty_all;
				$total_year['price'] =  $price;
			}
			$sql_month = "SELECT * FROM sales_report_monthly WHERE date_time='$this->date_year_month'";
			$result_month = $this->conn->query($sql_month);
			$price = 0;
			$qty_all = 0;
			while($row_month = $result_month->fetchArray(SQLITE3_ASSOC)){
				$item_code_in_date = (int)$row_month['item_code'];
				$item_qty = (int)$row_month['qty_selled'];
				$item_price = (int)$price_array['item_price'][$item_code_in_date];
				$total_price = $item_price * $item_qty;
				$price += $total_price;
				$qty_all += $item_qty;
				$total_month['qty_selled'] =  $qty_all;
				$total_month['price'] =  $price;
			}
			$sql_today = "SELECT * FROM sales_report_daily WHERE date_time='$this->date_only'";
			$result_today = $this->conn->query($sql_today);
			$price = 0;
			$qty_all = 0;
			$pre_qty = 0;
			while($row_daily = $result_today->fetchArray(SQLITE3_ASSOC)){
				$item_code_in_date = (int)$row_daily['item_code'];
				$item_qty = (int)$row_daily['qty_selled'];
				$item_price = (int)$price_array['item_price'][$item_code_in_date];
				$total_price = $item_price * $item_qty;
				$price += $total_price;
				$qty_all += $item_qty;
				$total_daily['qty_selled'] =  $qty_all;
				$total_daily['price'] =  $price;
			}
			if(!isset($total_daily)) $total_daily = 0;
			if(!isset($total_year)) $total_year = 0;
			if(!isset($total_month)) $total_month = 0;
			if(!isset($total)) $total = 0;
			if(!isset($return_row)) $return_row = 0;
			$array_return[0] = $return_row;
			$array_return['total'] = $total;
			$array_return['year'] = $total_year;
			$array_return['month'] = $total_month;
			$array_return['day'] = $total_daily;
		}
		else{
			$array_return['not_data'] = True;
		}
		return $array_return;
		

	}
	public function view_print_area(){
		$sql = "SELECT * FROM developer_tools WHERE id='1'";
		// echo $sql;
		$result = $this->conn->query($sql);
		$result_html = '';
		$count = 1 ; 
		$row = $result->fetchArray(SQLITE3_ASSOC);
		// print_r($row);
		return $row['print_view'];

	}
	public function update_print_view(){
		$print_view = $_POST['print_view'];
		$sql = "UPDATE developer_tools SET print_view='$print_view'";
		$this->conn->exec($sql);
		header("Refresh:0; url=settings.php");
	}
	public function update_home_page(){
		$redirect = $_POST['update_home_page'];
		$sql = "UPDATE developer_tools SET redirect='$redirect'";
		$this->conn->exec($sql);
		header("Refresh:0; url=settings.php");
	}
	public function is_developer(){
		$is_developer = (string) $_POST['is_developer'];
		$sql = "UPDATE developer_tools SET is_developer='$is_developer'";
		$this->conn->exec($sql);
		header("Refresh:0; url=settings.php");
	}
	public function update_table_index(){
		$reset_table_index = $_POST['reset_table_index'];

		if($reset_table_index == 'selected'){
			$sql = "UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='customer_bill' OR NAME='items_selled' OR NAME='sales_report_daily' OR NAME='sales_report_yearly' OR NAME='sales_report_monthly'";
		}
		else{
			$sql = "UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='items_selled'";
		}
		$this->conn->exec($sql);
		header("Refresh:0; url=settings.php");
	}
	public function delete_all_invoice(){
		$sql = "DELETE FROM customer_bill";
		$this->conn->exec($sql);
		$sql = "DELETE FROM items_selled";
		$this->conn->exec($sql);
		$sql = "DELETE FROM sales_report_daily";
		$this->conn->exec($sql);
		$sql = "DELETE FROM sales_report_monthly";
		$this->conn->exec($sql);
		$sql = "DELETE FROM sales_report_yearly";
		$this->conn->exec($sql);
		$sql = "UPDATE SQLITE_SEQUENCE SET SEQ=0 WHERE NAME='customer_bill' OR NAME='items_selled' OR NAME='sales_report_daily' OR NAME='sales_report_yearly' OR NAME='sales_report_monthly'";
		$this->conn->exec($sql);
		header("Refresh:0; url=settings.php");

	}
	public function load_profile_details(){
		$sql = "SELECT * FROM hotel_info WHERE id='2'";
		// echo $sql;
		$result = $this->conn->query($sql);
		$result_html = '';
		$count = 1 ; 
		$row = $result->fetchArray(SQLITE3_ASSOC);
		// print_r($row);exit;
		return $row;

	}
	public function update_hotel_info(){
		$name = $_POST['name'];
		$info = $_POST['info'];
		$address = $_POST['address'];
		$tel = $_POST['tel'];
		$mob_phone = $_POST['mob_phone'];
		$lis_num = $_POST['lis_num'];
		$sql = "UPDATE hotel_info SET hotel_address='$address',hotel_phone='$tel',hote_liscence='$lis_num',hotel_info='$info',mobile='$mob_phone',hotel_name='$name' WHERE id='2'";
		$this->conn->exec($sql);
		header("Refresh:0; url=profile.php");
	}
	public function save_logo($path,$type){
		$sql = "UPDATE hotel_info SET logo_image='$path',logo_type='$type' WHERE id='2'";
		$this->conn->exec($sql);
	}
	public function get_logo_type(){
		$sql = "SELECT logo_type FROM hotel_info WHERE id='2'";
		$result = $this->conn->query($sql);
		$row = $result->fetchArray(SQLITE3_ASSOC);
		return $row['logo_type'];
	}
}

