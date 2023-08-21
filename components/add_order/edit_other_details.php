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
if(!$order_id || !$user_type)
{
	common::redirect_to(common::get_component_link(array("add_order","list")));die();
}
if($user_type=="General")
{
	$data_amount = getOredrAmount($order_id);
	$data_max_order_date =getMaxOrderDate();
	$order_basic_details =get_general_orderBasic_details($order_id);
}
if($user_type=="Registered")
{
	$data_amount = getRegisterOredrAmount($order_id);
	$data_max_order_date =getRegisterMaxOrderDate();
	$order_basic_details =get_register_orderBasic_details($order_id);
}

$dateOfLastBillOrg = $data_max_order_date[0]['inv'];
$dateOfLastBill = common::changeToReverseDate($dateOfLastBillOrg);


$order_remark=$data_amount['order_remark'];
$total_amount = $data_amount['totalprice'];
$discount = $data_amount['discount'];
$final_amount = $total_amount-$discount;
//echo $final_amount;die();
// basic details...................
$reverschage=$order_basic_details['reverse_charge'];
$content_type=$order_basic_details['content_type'];
$sv_number=$order_basic_details['sv_number'];
$consumer_number=$order_basic_details['consumer_number'];
$user_gst=$order_basic_details['user_gst'];
$payment_mode=$order_basic_details['payment_mode'];
$cash_amount=$order_basic_details['cash_amount'];
$bank_amount=$order_basic_details['bank_amount'];
$save_invoice_date=$order_basic_details['invoice_date'];

$cash_select="";
$bank_select="";
$both_select="";
$Credit_select="";
if($payment_mode=="cash")
{$cash_select="checked";}
if($payment_mode=="Bank")
{$bank_select="checked";}
if($payment_mode=="Both")
{$both_select="checked";}
if($payment_mode=="Credit")
{$Credit_select="checked";}		

if(isset($_POST['add']))
{
	//form_validation::add_validation('invoice_date', 'required', 'Provide  invoice_date');
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
		
		//$invoice_date = common::changeToReverseDate(common::get_control_value("invoice_date"));
		$r_charge = common::get_control_value("r_charge");
		$con_type = common::get_control_value("con_type");
		$sv_numver = common::get_control_value("sv_numver");
		$consumer_number = common::get_control_value("consumer_number");
		$remark = common::get_control_value("remark_text");
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
		
		
		
		if($r_charge!="" && $order_id!="")
		{
			if($user_type=="General")
			{
				$check_basic_details=checkGeneralOrderBasicDetails($order_id);
				if($check_basic_details)
				{
					updateGeneralUser_order_basic_details(array("reverse_charge"=>$r_charge,"content_type"=>$con_type,"sv_number"=>$sv_numver,"consumer_number"=>$consumer_number,"user_gst"=>$gst_number,"payment_mode"=>$mode,"cash_amount"=>$cash_amount,"bank_amount"=>$bank_amount),array("o_id"=>$order_id));
					updateInvoice_date(array("order_remark"=>$remark),array("id"=>$order_id));
				}
				else
				{
					$invoice_date = common::changeToReverseDate(common::get_control_value("invoice_date"));
					
					$q = new Query();
					$q->insert_into("oredr_basic_details",array(
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
					updateInvoice_date(array("invice_date"=>$invoice_date,"order_remark"=>$remark),array("id"=>$order_id));
				}
				
				
			}
			if($user_type=="Registered")
			{
				$check_basic_details=checkRegisterOrderBasicDetails($order_id);
				
				if($check_basic_details)
				{
					updateRegisterUser_order_basic_details(array("reverse_charge"=>$r_charge,"content_type"=>$con_type,"sv_number"=>$sv_numver,"consumer_number"=>$consumer_number,"user_gst"=>$gst_number,"payment_mode"=>$mode,"cash_amount"=>$cash_amount,"bank_amount"=>$bank_amount),array("o_id"=>$order_id));
					updateRegisterInvoice_date(array("order_remark"=>$remark),array("id"=>$order_id));
				}
				else
				{
					$invoice_date = common::changeToReverseDate(common::get_control_value("invoice_date"));
					
					$q = new Query();
					$q->insert_into("register_other_basic_details",array(
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
					
					updateRegisterInvoice_date(array("invice_date"=>$invoice_date,"order_remark"=>$remark),array("id"=>$order_id));
				}	
				
				
				
			}
			/*
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
			*/
			
		
			common::set_message(28);
			//common::redirect_to(common::get_component_link(array("add_order","details"),array("id"=>$order_id)));
			common::redirect_to(common::get_component_link(array("add_order","list"),array("user_type"=>$user_type)));
		}
	}
}
?>