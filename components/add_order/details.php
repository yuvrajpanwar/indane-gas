 <?php
 //common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
  common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");
$id = common::get_control_value("id");
$user_type = common::get_control_value("type");
if(!$id || !$user_type)
{
	common::redirect_to(common::get_component_link(array("add_order","list")));die();
}	
if($user_type=="General")
{
	$data_order = getOrderById($id,$login_id);
	$other_details=getOtherDetails($id);
	$data1 = getOrderByDetails($id);
	$data2 = getOtherDataItem($id);
}

if($user_type=="Registered")
{
	$data_order = getRegisterOrderById($id,$login_id);
	$other_details=getRegisterOtherDetails($id);
	$data1 = getRegisterOrderByDetails($id);
	$data2 = getRegisterOtherDataItem($id);
	
	
}


$invice_number =$data_order['recipt_no'];
$customer_name=$data_order['name'];
$customer_number=$data_order['number'];
$customer_billing_address=$data_order['billing_address'];
$customer_shipping_address=$data_order['shipping_address'];
$customer_state=$data_order['state'];
$discount=$data_order['discount'];



$invoice_date=$other_details['invoice_date'];
if($invoice_date!="0000-00-00" && $invoice_date!="")
{
	//$date_display=date("d-M-Y",strtotime($invoice_date));
	$invoice_formate=date("d-M-Y",strtotime($invoice_date));
}
else
{
	$invoice_formate=$invoice_date;
}


$reverse_charge=$other_details['reverse_charge'];
$content_type=$other_details['content_type'];
$sv_number=$other_details['sv_number'];
$consumer_number=$other_details['consumer_number'];
$date_of_supply=$other_details['date_of_supply'];
$payment_mode=$other_details['payment_mode'];
$cash_payment=$other_details['cash_amount'];
$bank_payment=$other_details['bank_amount'];
$customer_gst=$other_details['user_gst'];

if($date_of_supply!="0000-00-00")
{
	$supply_formate=date("d-M-Y",strtotime($date_of_supply));
}
else
{
	$supply_formate="";
}
$payment_mode=$other_details['payment_mode'];




$data = getAddress($login_id);
$converter = new Encryption;
$companyname = $converter->decode($data["companyname"]);
$address = $converter->decode($data["address"]);
$city = $converter->decode($data["city"]);
$statezip = $converter->decode($data["statezip"]);
$phone = $converter->decode($data["phone"]);
$gst_num = $converter->decode($data["gst_number"]);
$email_id = $converter->decode($data["email"]);


?> 
