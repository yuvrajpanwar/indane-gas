<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
    common::load_model("db");
	$user_type=common::get_control_value("type");
	
	if($user_type=="General")
	{
		//$data_amount = getOredrAmount($order_id);
		$data_max_order_date =getMaxOrderDate();
	}
	if($user_type=="Registered")
	{
		//$data_amount = getRegisterOredrAmount($order_id);
		$data_max_order_date =getRegisterMaxOrderDate();
	}

	$dateOfLastBillOrg = $data_max_order_date[0]['inv'];
	$dateOfLastBill = common::changeToReverseDate($dateOfLastBillOrg);
	
	echo $dateOfLastBill;die();

?> 