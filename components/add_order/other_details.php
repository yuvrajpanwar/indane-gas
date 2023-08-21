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

if($user_type=="General")
{
	$data_amount = getOredrAmount($order_id);
	$data_max_order_date =getMaxOrderDate();
}
if($user_type=="Registered")
{
	$data_amount = getRegisterOredrAmount($order_id);
	$data_max_order_date =getRegisterMaxOrderDate();
}

$dateOfLastBillOrg = $data_max_order_date[0]['inv'];
$dateOfLastBill = common::changeToReverseDate($dateOfLastBillOrg);


$total_amount = $data_amount['totalprice'];
$discount = $data_amount['discount'];
$final_amount = $total_amount-$discount;

if(isset($_POST['add']))
{
	form_validation::add_validation('invoice_date', 'required', 'Provide  invoice_date');
	form_validation::add_validation('r_charge', 'required', 'Reverse Charge');
	form_validation::add_validation('con_type', 'required', 'Connection Type');
	//form_validation::add_validation('sv_numver', 'required', 'SV Number');
	//form_validation::add_validation('consumer_number', 'required', 'Consumer Number');
	//form_validation::add_validation('date_supply', 'required', 'Date of Supply');
	//form_validation::add_validation('mode', 'required', 'Date of Supply');
	
	

	$output = array();
			
	if(form_validation::validate_fields())
	{
		//echo "here";die();
		date_default_timezone_set('Asia/Kolkata');
		$cuurent_datetime =date("Y-m-d h:i:sa");
		
		$invoice_date = common::changeToReverseDate(common::get_control_value("invoice_date"));
		if($invoice_date=="0000-00-00" || $invoice_date=="")
		{
			common::set_message(32);
			common::redirect_to(common::get_component_link(array("add_order","other_details"),array("id"=>$order_id,"type"=>$user_type)));die();
		}
		
		$r_charge = common::get_control_value("r_charge");
		$con_type = common::get_control_value("con_type");
		$sv_numver = common::get_control_value("sv_numver");
		$consumer_number = common::get_control_value("consumer_number");
		//$date_supply = common::get_control_value("date_supply");
		$date_supply = "";
		$mode = common::get_control_value("mode");
		$gst_number = common::get_control_value("gst_number");
		
		if($mode=="Both")
		{
			$cash_amount=common::get_control_value("cash_amount");
			$bank_amount=common::get_control_value("bank_amount");
		}
		else
		{
			$cash_amount="";
			$bank_amount="";
		}	
		
		
		
		if($invoice_date!="" && $r_charge!="" && $order_id!="")
		{
			if($user_type=="General")
			{
				$table_name="oredr_basic_details";
				updateInvoice_date(array("invice_date"=>$invoice_date),array("id"=>$order_id));
			}
			if($user_type=="Registered")
			{
				$table_name="register_other_basic_details";
				updateRegisterInvoice_date(array("invice_date"=>$invoice_date),array("id"=>$order_id));
			}
			
			$q = new Query();
			$q->insert_into("$table_name",array(
			"o_id"=>$order_id,
			"invoice_date"=>$invoice_date,
			"reverse_charge"=>$r_charge,
			"content_type"=>$con_type,
			"sv_number"=>$sv_numver,
			"consumer_number"=>$consumer_number,
			"user_gst"=>$gst_number,
			"date_of_supply"=>$date_supply,
			"payment_mode"=>$mode,
			"cash_amount"=>$cash_amount,
			"bank_amount"=>$bank_amount
			))
			->run();
			
			
		
			common::set_message(27);
			//common::redirect_to(common::get_component_link(array("add_order","details"),array("id"=>$order_id)));
			common::redirect_to(common::get_component_link(array("add_order","list"),array("user_type"=>$user_type)));
		}
	}
}
?>