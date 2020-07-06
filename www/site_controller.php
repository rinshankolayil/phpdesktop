<?php
include_once('db.php');

/**
 * 
 */
class SiteController
{
	public $db;

	
	function __construct()
	{
		$this->db = new TopFormDB();
		$this->db->conn = $this->db;

	}
	public function edit_item_html($post_data){
		$result = file_get_contents('templates/edit_items.php');
		return $result;
	}
	public function add_new_item_html(){
		$result = file_get_contents('templates/add_new_item.php');
		return $result;
	}
	public function modal_customer_details(){
		$result = file_get_contents('templates/add_customer_details.php');
		return $result;
	}
	public function view_and_save_bill(){
		$item = $this->db->save_bill($_POST);
		$hotel_details = $this->db->get_hotel_details();
		$hotel_log_type = $this->db->get_logo_type();
		$item['hotel_details'] = $hotel_details[0];
		$item['hotel_name'] = $hotel_details[1];
		$item['hotel_logo_type'] = $hotel_log_type;
		$item['html_render'] =true;
		header("Refresh:0; url=url_router.php?class_name=SiteController&function_name=select_bill_item&invoice_number=".$item['invoice_number']);
	}
	public function select_bill_item(){
		if(isset($_POST)){
			if(isset($_GET['invoice_number'])){
				$array=array("invoice_number"=>$_GET['invoice_number']);
			}
			else
			{
				$array=$_POST;
			}
			$item = $this->db->select_bill_item_model($array,true);
		}
		if($item){
			$hotel_details = $this->db->get_hotel_details();
			$hotel_log_type = $this->db->get_logo_type();
			$view_print_area = $this->db->view_print_area();
			$item['hotel_details'] = $hotel_details[0];
			$item['hotel_name'] = $hotel_details[1];
			$item['print_view'] = $view_print_area;
			$item['hotel_logo_type'] = $hotel_log_type;
			$this->render('view_bill',$item);
		}
		else{
			header("Refresh:0; url=view_bill.php?item_none=1");
		}

	}

	public function select_bill_item_edit(){
		$item = $this->db->select_bill_item_model($_GET,false);
		$this->render('edit_bill',$item);
	}
	public function sales_report(){
		$this->render('templates/filter_sales_report','');
	}
	public function sales_report_submit(){
		if(isset($_GET['today'])){
			$item = $this->db->select_sales_report($_GET);
		}
		$item = $this->db->select_sales_report($_POST);
		$this->render('sales_report',$item);
	}
	public function select_invoices(){
		$item = $this->db->select_invoices($_POST);
		if($item){
			$this->render('view_all_bill',$item);
		}
		else{
			header("Refresh:0; url=view_bill.php?item_none=1");
		}
	}
	public function load_profile_details(){
		$item = $this->db->load_profile_details();
		$this->render('templates/profile_form',$item);
	}

	public function save_print_config(){
		$content = $_POST['print_css'];
		$file="static/css/print.css";
		$handle = fopen($file, "w");
		fwrite($handle, $content);
		fclose($handle);
		$this->redirect('settings');
	}
	public function upload_logo_image(){
		$target_dir = "static/";
		// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$fileName = $_FILES['file']['tmp_name'];
		$file_name = explode(".",$_FILES['file']['name']);
		$file_name = explode(".", $_FILES['file']['name']);

		$extension = strtolower(end($file_name));
		$name = "img_logo" . '.' .$extension;
		$location = 'static/logos/'.$name;
		$type = 0;
		$item = $this->db->save_logo($location,$type);
		move_uploaded_file($fileName, $location);
	}
	public function logo_image_default(){
		$name = $_POST['logo_path'];
		$location = 'static/logos/'.$name;
		$type = 1;
		if($_POST['logo_post'] == 1){
			$location = 'text_only';
			$type = 2;
		}
		$item = $this->db->save_logo($location,$type);
		$this->redirect('settings');
	}


	public function render($path,$item){
		$render_from = true;
		include_once($path . '.php');
	}
	public function redirect($page,$params=''){
		header("Refresh:0; url=".$page.'.php');
	}
}