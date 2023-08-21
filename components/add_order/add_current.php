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
	form_validation::add_validation('cylinder_name', 'required', 'cylinder_name');
	form_validation::add_validation('cylinder_rate', 'required', 'cylinder_rate');
	form_validation::add_validation('regulator_name', 'required', 'regulator_name');
	form_validation::add_validation('regulator_rate', 'required', 'regulator_rate');

	$output = array();
			
	if(form_validation::validate_fields())
	{
		//echo "here";die();
		date_default_timezone_set('Asia/Kolkata');
		$cuurent_datetime =date("Y-m-d h:i:sa");
		$array2d =$_POST;
		print_r($array2d);die();
		
		$size_data = max(array_map('count', $array2d));
		
		$cylinder_name = common::get_control_value("cylinder_name");
		$cylinder_rate = common::get_control_value("cylinder_rate");
		$cylinder_pice = common::get_control_value("cylinder_pice");
		$cylinder_amount = $cylinder_rate*$cylinder_pice;
		
		$regulator_name = common::get_control_value("regulator_name");
		$regulator_rate = common::get_control_value("regulator_rate");
		$regulator_pice = common::get_control_value("regulator_pice");
		$regulator_amount = $regulator_rate*$regulator_pice;
		
		
		$pro_name = $_POST['pro_name'];
		$totalitem =sizeof($pro_name);
		//echo $totalitem;die();
		//$total_pieces=1;
		//$total_amount = $_POST['total_amount'];

		if($pro_name!="")
		{
			//echo"here";die();
			
			$reciptno = rand().date('dmy');
			//$totalitem=$size_data;
			
			$order_amount=0;
			for($i=0;$i<$totalitem;$i++)
			{
				
				$total_amount = $_POST['total_amount'][$i];
				$order_amount =$order_amount+$total_amount;
				//$totalitem
			}
			
			
			$order_amount=$order_amount+$cylinder_amount+$regulator_amount;
			
			$q = new Query();
			$q->insert_into("orders",array(
			"admin_id"=>$login_id,
			"totalitem"=>$totalitem,
			"totalprice"=>$order_amount,
			"status"=>3,
			"order_date"=>$cuurent_datetime
			))
			->run();
			
			$order_id = $q->get_insert_id();
			$invoice_num="In".$order_id;
			//updateRecipt_number(array("recipt_no"=>$order_id),array("id"=>$order_id));
			updateRecipt_number(array("recipt_no"=>$invoice_num),array("id"=>$order_id));
			
			
			
			$other_item = new Query();
			$other_item->insert_into("other_order_item",array(
			"order_id"=>$order_id,
			"product_name"=>$cylinder_name,
			"rate"=>$cylinder_rate,
			"pro_qty"=>$cylinder_pice,
			"amount"=>$cylinder_amount
			))
			->run();
			
			
			
			$other_item1 = new Query();
			$other_item1->insert_into("other_order_item",array(
			"order_id"=>$order_id,
			"product_name"=>$regulator_name,
			"rate"=>$regulator_rate,
			"pro_qty"=>$regulator_pice,
			"amount"=>$regulator_amount
			))
			->run();
			
			//print_r($_POST['pro_name']);die();
			
			for($j=0;$j<$totalitem;$j++)
			{
				//echo"here";die();
				
				$pro_name = $_POST['pro_name'][$j];
				//$unit = $_POST['unit'][$j];
				$total_pieces = $_POST['total_pice'][$j];
				//$total_pieces=1;
				$rate = $_POST['price'][$j];
				$rate = $rate/$total_pieces;
				$cgst_amount = $_POST['cgst'][$j];
				$sgst_amount = $_POST['sgst'][$j];
				//echo $_POST['cgst'][$j];die();
				$per_qty_price = $_POST['per_rate'][$j];
				
				$cgst_tax = $_POST['cgst_tax'][$j];
				$sgst_tax = $_POST['sgst_tax'][$j];
				
				$total_amount = $_POST['total_amount'][$j];
				//$gmqty = $_POST['gmqty'][$j];
				
				//$price = $total_amount/$total_pieces;
				
				//echo $cgst_tax." ".$sgst_tax." ".$cgst_amount." ".$sgst_amount;die();
				if($pro_name)
				{
					$q = new Query();
					$q->insert_into("order_item",array(
					"admin_id"=>$login_id,
					"order_id"=>$order_id,
					"product_id"=>$pro_name,
					"rate"=>$per_qty_price,
					"cgst_tax"=>$cgst_tax,
					"cgst_amount"=>$cgst_amount,
					"sgst_tax"=>$sgst_tax,
					"sgst_amount"=>$sgst_amount,
					"qty"=>$total_pieces,
					"price"=>$total_amount
					))
					->run();
				}
				
				
				
				$new_gmqty ="gmqty-$total_pieces";
				$update_stock=new Query();
				$update_stock->update("stock",array("gmqty = $new_gmqty"))
				->where_equal_to(array("product_id"=>$pro_name))
				->run();
				
			}

			common::set_message(3);
			//common::redirect_to(common::get_component_link(array("add_order","details"),array("id"=>$order_id)));
			common::redirect_to(common::get_component_link(array("add_order","user_details"),array('id'=>$order_id)));
		}
	}
}
?>