<?php
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
$ab= common::load_model("db");

if(isset($_POST['add']))
{
	//form_validation::add_validation('party', 'required', 'Select Party');

	$output = array();
			
	if(form_validation::validate_fields())
	{
		//echo "here";die();
		date_default_timezone_set('Asia/Kolkata');
		$cuurent_datetime =date("Y-m-d h:i:sa");
		//echo $cuurent_datetime;die();
		$array2d =$_POST;
		$size_data = max(array_map('count', $array2d));
		//echo $size_data;die();
		$party = $_POST['party'];
		$date = $_POST['date'];
		$debit = $_POST['debit'];
		$credit = $_POST['credit'];
		
		if($party!="" && $date!="" && ($debit!="" ||  $credit!=""))
		{

			for($j=0;$j<$size_data;$j++)
			{

				$party = $_POST['party'][$j];
				$date = $_POST['date'][$j];
				$debit = $_POST['debit'][$j];
				$credit = $_POST['credit'][$j];
				$remark = $_POST['remark'][$j];
				$status="";
				$amount=0;
				if($debit)
				{
					$status="pending";
					$amount=$debit;
				}
				if($credit)
				{
					$status="pay";
					$amount=$credit;
				}
				$sale = new Query();
				$sale->insert_into("sale_price",array(
				"admin_id"=>$login_id,
				//"invoice_number"=>$invoice_num,
				"user_id"=>$party,
				//"trans_type"=>'sale',
				"remark"=>$remark,
				"amount"=>$amount,
				"date"=>$date,
				"status"=>$status
				))
				->run();
				$payment_id = $sale->get_insert_id();
				$invoice_num="KB".$payment_id;
				//updateRecipt_number(array("recipt_no"=>$order_id),array("id"=>$order_id));
				updateRecipt_number(array("invoice_number"=>$invoice_num),array("id"=>$payment_id));
			}
			
			common::set_message(3);
			common::redirect_to(common::get_component_link(array("general","add")));
		}
	}
}
?>