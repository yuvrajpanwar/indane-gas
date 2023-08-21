<?php 
 //common::user_access_only("admin");
 $login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
    common::load_model("db");
	date_default_timezone_set('Asia/Kolkata');
	$current_date = date("Y-m-d");
	$first_day_this_month = date('Y-m-01', strtotime($current_date));
	//echo $first_day_this_month;die();
	//$last_day_april_2010 = date('m-01-Y', strtotime('April 21, 2010'));
   /* $get_today = getPurchaseToday($login_id);
	$purchase_today=round($get_today['today_purchase'],2);
	//echo $purchase_today;die();
	$get_purchase_this_mounth = getPurchaseMounth($first_day_this_month,$current_date,$login_id);
	$purchase_this_mounth=round($get_purchase_this_mounth['month_purchase'],2);
	
	$get_purchase_till = getPurchaseAll($login_id);
	$purchase_till = round($get_purchase_till['all_purchase'],2);
	*/
	
	$get_sale_today = getSaleToday($current_date,$login_id);
	$sale_today = $get_sale_today['today_sale'];
	
	$get_today_discount = getDiscountToday($current_date,$login_id);
	$discount_today = $get_today_discount['today_discount'];
	
	$reg_sale_today = getRegisterSaleToday($current_date,$login_id);
	$regsale_today = $reg_sale_today['today_sale'];
	
	$reg_today_discount = getRegisterDiscountToday($current_date,$login_id);
	$regdiscount_today = $reg_today_discount['today_discount'];
	
	$total_sale_today=$sale_today+$regsale_today;
	$total_discount=$discount_today+$regdiscount_today;
	
	$final_today_sale = round($total_sale_today-$total_discount);
	
	//$final_today_sale = round($sale_today-$discount_today);
	
	
	
	$get_sale_this_mounth = getSaleMounth($first_day_this_month,$current_date,$login_id);
	$sale_this_mounth = $get_sale_this_mounth['month_sale'];
	
	$get_discount_month=getDiscountMounth($first_day_this_month,$current_date,$login_id);
	$discount_this_mounth = $get_discount_month['month_discount'];
	
	$reg_sale_this_mounth = getRegSaleMounth($first_day_this_month,$current_date,$login_id);
	$regsale_this_mounth = $reg_sale_this_mounth['month_sale'];
	
	$regget_discount_month=getRegDiscountMounth($first_day_this_month,$current_date,$login_id);
	$regdiscount_this_mounth = $regget_discount_month['month_discount'];
	
	$total_this_month_sale = $sale_this_mounth+$regsale_this_mounth;
	$total_discount_this_month =$discount_this_mounth+$regdiscount_this_mounth;
	
	$final_month_sale= round($total_this_month_sale-$total_discount_this_month);
	//$final_month_sale= round($sale_this_mounth-$discount_this_mounth);


	
	$get_sale_till = getgetSaleTill($login_id);
	$sale_till = $get_sale_till['all_sale'];
	
	$get_discount_till = getgetDiscountTill($login_id);
	$discount_till = $get_discount_till['all_discount'];
	
	$regget_sale_till = getregSaleTill($login_id);
	$regsale_till = $regget_sale_till['all_sale'];
	
	$regget_discount_till = getregDiscountTill($login_id);
	$regdiscount_till = $regget_discount_till['all_discount'];
	
	$total_tiil_sale = $sale_till+$regsale_till;
	$total_discount_till =$discount_till+$regdiscount_till;
	
	$final_sale_till = round($total_tiil_sale-$total_discount_till);
	
	//$final_sale_till = round($sale_till-$discount_till);
	

?>