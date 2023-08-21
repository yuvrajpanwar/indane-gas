 <?php
 //common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
  common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");
//echo $login_id;die();
$id = common::get_control_value("id");
$data_order = getOrderById($id,$login_id);
$invice_number =$data_order['recipt_no'];
$customer_name=$data_order['name'];
$customer_number=$data_order['number'];
$customer_billing_address=$data_order['billing_address'];
$customer_shipping_address=$data_order['shipping_address'];
$customer_state=$data_order['state'];
$discount=$data_order['discount'];

$other_details=getOtherDetails($id);
$invice_date=$other_details['invoice_date'];
$invoce_formate=date("d-M-Y",strtotime($invice_date));

$reverse_charge=$other_details['reverse_charge'];
$content_type=$other_details['content_type'];
$sv_number=$other_details['sv_number'];
$consumer_number=$other_details['consumer_number'];
$date_of_supply=$other_details['date_of_supply'];
$payment_mode=$other_details['payment_mode'];
$cash_payment=$other_details['cash_amount'];
$bank_payment=$other_details['bank_amount'];

if($date_of_supply!="0000-00-00")
{
	$supply_formate=date("d-M-Y",strtotime($date_of_supply));
}
else
{
	$supply_formate="";
}
$payment_mode=$other_details['payment_mode'];

$data1 = getOrderByDetails($id);

$data2 = getOtherDataItem($id);

//$converter = new Encryption;
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
