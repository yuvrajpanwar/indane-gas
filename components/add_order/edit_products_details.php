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
	$next_url=common::get_component_link(array('add_order','user_details'),array("id"=>$order_id,"type"=>$user_type,"order_type"=>'new'));
}
if($order_type=="old")
{
	$next_url=common::get_component_link(array('add_order','edit_user_details'),array("id"=>$order_id,"type"=>$user_type,"order_type"=>'old'));
}

if($user_type=="General")
{
	$order_details=getOrder($order_id);
	$discount=$order_details['discount'];
	
	$other_order_item_data=getOtherDataItem($order_id);
	
	$select_old_order_item = new Query();
	$select_old_order_item->select("product_id,qty")
	->from(TBL_ORDER_ITEM)
	->where_equal_to(array('order_id'=>$order_id))
	->run();
	$order_item_array=  $select_old_order_item->get_selected();
	$old_product_data= [];
	foreach($order_item_array as $pro) 
	{
		$pro_id=$pro['product_id'];
		$pro_qty=$pro['qty'];
		$old_product_data[$pro_id] = $pro_qty;
		//$old_product_data[] = $pro_id;
	}

}
if($user_type=="Registered")
{
	$order_details=getOrderRegister($order_id);
	$discount=$order_details['discount'];
	$other_order_item_data=getRegisterOtherDataItem($order_id);
	
	$select_old_order_item = new Query();
	$select_old_order_item->select("product_id,qty")
	->from(TBL_REGISTER_ORDER_ITEM)
	->where_equal_to(array('order_id'=>$order_id))
	->run();
	$order_item_array=  $select_old_order_item->get_selected();
	
	$old_product_data= [];
	foreach($order_item_array as $pro) 
	{
		$pro_id=$pro['product_id'];
		$pro_qty=$pro['qty'];
		$old_product_data[$pro_id] = $pro_qty;
		//$old_product_data[] = $pro_id;
	}
	
}

foreach ($other_order_item_data as $other_item)
{
	$title_other_item=$other_item['product_name'];

	if($title_other_item=="Security Deposit cylinder")
	{
		$cylinder_rate=$other_item['rate'];
		$cylinder_quantity=$other_item['pro_qty'];
	}
	if($title_other_item=="Security Deposit regulator")
	{
		$regulator_rate=$other_item['rate'];
		$regulator_quantity=$other_item['pro_qty'];
	}
}



if(isset($_POST['add']))
{
	//form_validation::add_validation('user_type', 'required', 'Please select User Type');
	//form_validation::add_validation('cylinder_rate', 'required', 'cylinder_rate');
	//form_validation::add_validation('regulator_name', 'required', 'regulator_name');
	//form_validation::add_validation('regulator_rate', 'required', 'regulator_rate');

	$output = array();
			
	if(form_validation::validate_fields())
	{
		//echo "here";die();
		date_default_timezone_set('Asia/Kolkata');
		$cuurent_datetime =date("Y-m-d h:i:sa");
		$array2d =$_POST;
		//print_r($array2d);die();
		
		$size_data = max(array_map('count', $array2d));
		//$user_type = common::get_control_value("user_type");
		
		$cylinder_name = common::get_control_value("cylinder_name");
		$cylinder_rate = common::get_control_value("cylinder_rate");
		$cylinder_pice = common::get_control_value("cylinder_pice");
		//$cylinder_amount = $cylinder_rate*$cylinder_pice;
		$cylinder_amount = $cylinder_rate;
		
		$regulator_name = common::get_control_value("regulator_name");
		$regulator_rate = common::get_control_value("regulator_rate");
		$regulator_pice = common::get_control_value("regulator_pice");
		//$regulator_amount = $regulator_rate*$regulator_pice;
		$regulator_amount = $regulator_rate;
		
		$discount_price = common::get_control_value("discount");
		
		
		$pro_name = $_POST['pro_name'];
		$totalitem =sizeof($pro_name);
		//echo $totalitem;die();
		//$total_pieces=1;
		//$total_amount = $_POST['total_amount'];

		if($pro_name!="")
		{
			
			$totalitem=$totalitem+2;
			
			$order_amount=0;
			$order_amount=$order_amount+$cylinder_amount+$regulator_amount;
			if($user_type=="General")
			{
				$order_table="orders";
				$order_item_table="order_item";
				$other_order_item_table="other_order_item";
				
				$delete_other_order_item = new Query();
				$delete_other_order_item->delete("other_order_item")
				->where_equal_to(array("order_id"=>$order_id))
				->run();
				
				
				
				$delete_order_item = new Query();
				$delete_order_item->delete("order_item")
				->where_equal_to(array("order_id"=>$order_id))
				->run();
				
			}
			if($user_type=="Registered")
			{
				$order_table="register_user_order";
				$order_item_table="register_user_order_item";
				$other_order_item_table="register_other_order_item";
				
				$delete_other_order_item = new Query();
				$delete_other_order_item->delete("register_other_order_item")
				->where_equal_to(array("order_id"=>$order_id))
				->run();
				
				$delete_order_item = new Query();
				$delete_order_item->delete("register_user_order_item")
				->where_equal_to(array("order_id"=>$order_id))
				->run();
			}
			
			/*$q = new Query();
			$q->insert_into("$order_table",array(
			"admin_id"=>$login_id,
			"totalitem"=>$totalitem,
			"discount"=>$discount_price,
			"status"=>3,
			"user_type"=>$user_type,
			"order_date"=>$cuurent_datetime
			))
			->run();
			
			$order_id = $q->get_insert_id();
			*/
			
			
			//updateRecipt_number(array("recipt_no"=>$order_id),array("id"=>$order_id));
			
			
			if($cylinder_name && $cylinder_rate)
			{
				$other_item = new Query();
				$other_item->insert_into("$other_order_item_table",array(
				"order_id"=>$order_id,
				"product_name"=>$cylinder_name,
				"rate"=>$cylinder_rate,
				"pro_qty"=>$cylinder_pice,
				"amount"=>$cylinder_amount
				))
				->run();
			}
			
			
			
			if($regulator_name && $regulator_rate)
			{
				$other_item1 = new Query();
				$other_item1->insert_into("$other_order_item_table",array(
				"order_id"=>$order_id,
				"product_name"=>$regulator_name,
				"rate"=>$regulator_rate,
				"pro_qty"=>$regulator_pice,
				"amount"=>$regulator_amount
				))
				->run();
			}	
			
			
			
			//print_r($_POST['pro_name']);die();
			
			for($j=0;$j<$totalitem;$j++)
			{
				//echo"here";die();
				
				$pro_name = $_POST['pro_name'][$j];
				//$unit = $_POST['unit'][$j];
				$total_pieces = $_POST[$pro_name];
				//$total_pieces=1;
				$pro_details=get_product_amount($pro_name);

				$rate = $pro_details['price'];
				$rate_all = $rate*$total_pieces;
				//echo $_POST['cgst'][$j];die();
				//$per_qty_price = $_POST['per_rate'][$j];
				
				$cgst_tax = $pro_details['cgst_tax'];
				$sgst_tax = $pro_details['sgst_tax'];
				
				if($cgst_tax)
				{
					$cgst_amount = $rate_all*$cgst_tax/100;
				}
				else
				{
					$cgst_amount =0;
				}	

				if($sgst_tax)
				{
					$sgst_amount = $rate_all*$sgst_tax/100;
				}
				else
				{
					$sgst_amount =0;
				}
				
				
				$total_amount = $rate_all+$cgst_amount+$sgst_amount;
				//$gmqty = $_POST['gmqty'][$j];
				
				//$price = $total_amount/$total_pieces;
				
				//echo $cgst_tax." ".$sgst_tax." ".$cgst_amount." ".$sgst_amount;die();
				if($pro_name)
				{
					//print_r($old_product_data);die();
					
					$q = new Query();
					$q->insert_into("$order_item_table",array(
					"admin_id"=>$login_id,
					"order_id"=>$order_id,
					"product_id"=>$pro_name,
					"rate"=>$rate,
					"cgst_tax"=>$cgst_tax,
					"cgst_amount"=>$cgst_amount,
					"sgst_tax"=>$sgst_tax,
					"sgst_amount"=>$sgst_amount,
					"qty"=>$total_pieces,
					"price"=>$total_amount
					))
					->run();

					$order_amount=$order_amount+$total_amount;
					
					$stock_details=getStockById($pro_name);
					//print_r($stock_details);die();
					
					if($stock_details)
					{
						$record_id=$stock_details['id'];
						$store_qty=$stock_details['gmqty'];
						
						if(array_key_exists($pro_name,$old_product_data))
						{
							//echo "new id".$pro_name."old id".$old_product_data[''];
							//echo"here".$pro_name;die();
							
							$old_product_qty=$old_product_data[$pro_name];
							
							//echo $old_product_qty.$total_pieces;die();
							if($old_product_qty>$total_pieces)
							{
								$difference=$old_product_qty-$total_pieces;
								$stock=$store_qty+$difference;
								if($stock>=0)
								{
									$new_stock=$stock;
								}
								else
								{
									$new_stock=0;
								}
								
								$update_stock=new Query();
								$update_stock->update("stock",array("gmqty"=>$new_stock))
								->where_equal_to(array("product_id"=>$pro_name,"id"=>$record_id))
								->run();
								
							}
							else if($old_product_qty<$total_pieces)
							{
								$difference=$total_pieces-$old_product_qty;
								
								$stock=$store_qty-$difference;
								if($stock>=0)
								{
									$new_stock=$stock;
								}
								else
								{
									$new_stock=0;
								}
								
								$update_stock=new Query();
								$update_stock->update("stock",array("gmqty"=>$new_stock))
								->where_equal_to(array("product_id"=>$pro_name,"id"=>$record_id))
								->run();
								//echo $store_qty.$stock;die();
							}
							
							/*if($stock>=0)
							{
								$new_stock=$stock;
							}
							else
							{
								$new_stock=0;
							}
							*/
							//echo $new_stock;die();
							
							
						}
						else
						{
							$new_stock=$store_qty-$total_pieces;
							if($new_stock>=0)
							{
								$new_stock=$new_stock;
							}
							else
							{
								$new_stock=0;
							}	
							
							$update_stock=new Query();
							$update_stock->update("stock",array("gmqty"=>$new_stock))
							->where_equal_to(array("product_id"=>$pro_name,"id"=>$record_id))
							->run();
						}	
						
						
						
						/*if($store_qty>=$total_pieces)
						{
							
							
							$new_stock=$store_qty-$total_pieces;
							//echo $new_stock;die();
							$update_stock=new Query();
							$update_stock->update("stock",array("gmqty"=>$new_stock))
							->where_equal_to(array("product_id"=>$pro_name))
							->run();
							
						}*/	
					}
				}
				
				
				
				
				/*$new_gmqty ="gmqty-$total_pieces";
				$update_stock=new Query();
				$update_stock->update("stock",array("gmqty = $new_gmqty"))
				->where_equal_to(array("product_id"=>$pro_name))
				->run();*/
				
			}
			if($user_type=="General")
			{
				//$invoice_num="G".$order_id;
				updateRecipt_number(array("totalitem"=>$totalitem,"discount"=>$discount_price,"totalprice"=>$order_amount),array("id"=>$order_id));
			}
			if($user_type=="Registered")
			{
				//$invoice_num="R".$order_id;
				updateRegisterRecipt_number(array("totalitem"=>$totalitem,"discount"=>$discount_price,"totalprice"=>$order_amount),array("id"=>$order_id));
			}

			//updateRecipt_number(array("totalprice"=>$order_amount),array("id"=>$order_id));
			
			common::set_message(29);
			//common::redirect_to(common::get_component_link(array("add_order","details"),array("id"=>$order_id)));
			if($order_type=="new")
			{
				common::redirect_to(common::get_component_link(array("add_order","user_details"),array('id'=>$order_id,'type'=>$user_type)));
			}
			if($order_type=="old")
			{
				common::redirect_to(common::get_component_link(array("add_order","edit_user_details"),array('id'=>$order_id,'type'=>$user_type)));
			}	
			
		}
	}
}
?>