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
$order_type = common::get_control_value("order_type");
if(!$order_id || !$user_type)
{
	common::redirect_to(common::get_component_link(array("add_order","list")));die();
} 

if($order_type=="new")
{
	$next_url=common::get_component_link(array('add_order','other_details'),array("id"=>$order_id,"type"=>$user_type,"order_type"=>'new'));
}
else
{
	$next_url=common::get_component_link(array('add_order','edit_other_details'),array("id"=>$order_id,"type"=>$user_type,"order_type"=>'old'));
}	


if($user_type=="General")
{
	$order_details=getOrder($order_id);
	//$discount=$order_details['discount'];
	
	$user_details_data=get_general_user_details($order_id);

}
if($user_type=="Registered")
{
	$user_details_data=get_register_user_details($order_id);
}

$user_name=$user_details_data['name'];
$user_number=$user_details_data['number'];
$user_address=$user_details_data['billing_address'];
$user_state=$user_details_data['state'];

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
				$check_for_record=check_user_details($order_id);
				if($check_for_record)
				{
					updateGeneralUser_address(array("name"=>$billing_name,"number"=>$billing_number,"billing_address"=>$billing_address,"shipping_address"=>$shippeing_address),array("order_id"=>$order_id));
				}
				else
				{
					$q = new Query();
					$q->insert_into("user_billing_address",array(
					"order_id"=>$order_id,
					"name"=>$billing_name,
					"number"=>$billing_number,
					"billing_address"=>$billing_address,
					"shipping_address"=>$shippeing_address,
					"state"=>$billing_state
					))
					->run();
				}	
				
				
			}
			if($user_type=="Registered")
			{
				$check_for_record=check_Register_user_details($order_id);
				if($check_for_record)
				{
					updateRegisterUser_address(array("name"=>$billing_name,"number"=>$billing_number,"billing_address"=>$billing_address,"shipping_address"=>$shippeing_address),array("order_id"=>$order_id));
				}
				else
				{
					$q = new Query();
					$q->insert_into("register_billing_address",array(
					"order_id"=>$order_id,
					"name"=>$billing_name,
					"number"=>$billing_number,
					"billing_address"=>$billing_address,
					"shipping_address"=>$shippeing_address,
					"state"=>$billing_state
					))
					->run();
				}	
				
			}
			
			common::set_message(30);
			if($order_type=="new")
			{
				common::redirect_to(common::get_component_link(array("add_order","other_details"),array("id"=>$order_id,"type"=>$user_type)));
			}
			else
			{
				common::redirect_to(common::get_component_link(array("add_order","edit_other_details"),array("id"=>$order_id,"type"=>$user_type)));
			}	
			
			//common::redirect_to(common::get_component_link(array("add_order","add")));
		}
	}
}
?>