<?php
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
$ab= common::load_model("db");

$order_id = common::get_control_value("id");
$user_type = common::get_control_value("type");

if(isset($_POST['add']))
{
	form_validation::add_validation('billing_name', 'required', 'Provide  Name');
	//form_validation::add_validation('billing_number', 'required', 'Provide Number');
	form_validation::add_validation('billing_address', 'required', 'Provide Address');
	form_validation::add_validation('billing_state', 'required', 'Provide State');
	
	

	$output = array();
			
	if(form_validation::validate_fields())
	{
		//echo "here";die();
		date_default_timezone_set('Asia/Kolkata');
		$cuurent_datetime =date("Y-m-d h:i:sa");
		//echo $cuurent_datetime;die();
		$array2d =$_POST;
		$size_data = max(array_map('count', $array2d));
		$billing_name = common::get_control_value("billing_name");
		$billing_number = common::get_control_value("billing_number");
		$billing_address = common::get_control_value("billing_address");
		$billing_state = common::get_control_value("billing_state");
		
		$decider = common::get_control_value("decider");
		if($decider=="no")
		{
			$shippeing_address = common::get_control_value("shippeing_address");
		}
		else
		{
			$shippeing_address =$billing_address;
		}
		
		if($billing_name!=""  && $billing_address!="" && $order_id!="")
		{
			if($user_type=="General")
			{
				$table_name="user_billing_address";
			}
			if($user_type=="Registered")
			{
				$table_name="register_billing_address";
			}
			
			$q = new Query();
			$q->insert_into("$table_name",array(
			"order_id"=>$order_id,
			"name"=>$billing_name,
			"number"=>$billing_number,
			"billing_address"=>$billing_address,
			"shipping_address"=>$shippeing_address,
			"state"=>$billing_state
			))
			->run();
			
		

			common::set_message(26);
			common::redirect_to(common::get_component_link(array("add_order","other_details"),array("id"=>$order_id,"type"=>$user_type)));
			//common::redirect_to(common::get_component_link(array("add_order","add")));
		}
	}
}
?>