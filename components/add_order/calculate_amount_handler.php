<?php  

$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
    common::load_model("db");
	$product_id=common::get_control_value("pro_id");
	$total_qty=common::get_control_value("pcs");
	
	$data = get_product_amount($product_id);
	
	$return_content=0;
	$rate=$data["price"];
	$cgst_tax=$data["cgst_tax"];
	$sgst_tax=$data["sgst_tax"];
	
	$cgst_amount=$rate*$cgst_tax/100;
	$sgst_amount=$rate*$sgst_tax/100;
	
	$rate=$rate*$total_qty;
	$cgst_amount=$cgst_amount*$total_qty;
	$sgst_amount=$sgst_amount*$total_qty;
	
	$final_amount=$rate+$cgst_amount+$sgst_amount;
	
       $cgst_amount=round($cgst_amount,2);
    $sgst_amount=round($sgst_amount,2);
    $rate=round($rate,2);
    $final_amount=round($final_amount,2);
	
	$return_content =$rate."-".$cgst_amount."-".$sgst_amount."-".$final_amount;
	
	echo $return_content;die();

?> 