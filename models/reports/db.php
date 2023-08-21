<?php
function getSale($login_id)
{

	$date = date("Y-m-d");
    
    $q    = new Query();
    $q->select("orders.*, user_billing_address.name,  amount  AS total_sv ")->from("orders
    INNER JOIN user_billing_address ON orders.id = user_billing_address.order_id
    LEFT JOIN (SELECT order_id,SUM(amount) as amount from  other_order_item Group By  order_id) AS
    other_order_item_2 ON orders.id = other_order_item_2.order_id")->where_equal_to(array(
        'orders.invice_date' => $date,
        'orders.admin_id' => $login_id,
        "orders.status" => 3
    ))->order_by("orders.invice_date asc")->run();
    return $q->get_selected();
}
function getRegisterSale($login_id)
{

	$date = date("Y-m-d");
    $q    = new Query();
    $q->select("register_user_order.*, register_billing_address.name, amount AS total_sv")->from("register_user_order
    INNER JOIN register_billing_address ON register_user_order.id = register_billing_address.order_id
    LEFT JOIN (SELECT order_id,SUM(amount) as amount from  register_other_order_item   Group By   order_id) AS register_other_order_item_2 
    ON register_user_order.id = register_other_order_item_2.order_id")->where_equal_to(array(
        'register_user_order.invice_date' => $date,
        'register_user_order.admin_id' => $login_id,
        "register_user_order.status" => 3
    ))->order_by("register_user_order.invice_date asc")->run();
    return $q->get_selected();
}
function getGeneralOrderItem($start,$end,$login_id)
{
	$q    = new Query();
    $q->select("orders.id AS od_id, order_item.*")->from("orders INNER JOIN order_item ON orders.id = order_item.order_id")->where_equal_to(array(
        'orders.admin_id' => $login_id,
        "orders.status" => 3
    ))->where_greater_than_or_equal_to(array(
        'orders.invice_date' => $start
    ))->where_less_than_or_equal_to(array(
        'orders.invice_date' => $end
    ))->order_by("orders.id asc")->run();
    return $q->get_selected();
	
}
function getRegisterOrderItem($start,$end,$login_id)
{
	$q    = new Query();
    $q->select("register_user_order.id AS od_id, register_user_order_item.*")->from("register_user_order INNER JOIN register_user_order_item ON register_user_order.id = register_user_order_item.order_id")->where_equal_to(array(
        'register_user_order.admin_id' => $login_id,
        "register_user_order.status" => 3
    ))->where_greater_than_or_equal_to(array(
        'register_user_order.invice_date' => $start
    ))->where_less_than_or_equal_to(array(
        'register_user_order.invice_date' => $end
    ))->order_by("register_user_order.id asc")->run();
    return $q->get_selected();
	
}
function searchSale($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
    $q    = new Query();
    $q->select("orders.*, user_billing_address.name,  amount  AS total_sv ")->from("orders
    INNER JOIN user_billing_address ON orders.id = user_billing_address.order_id
    LEFT JOIN (SELECT order_id,SUM(amount) as amount from  other_order_item Group By  order_id) AS
    other_order_item_2 ON orders.id = other_order_item_2.order_id")->where_equal_to(array(
        'orders.admin_id' => $login_id,
        "orders.status" => 3
    ))->where_greater_than_or_equal_to(array(
        'orders.invice_date' => $start
    ))->where_less_than_or_equal_to(array(
        'orders.invice_date' => $end
    ))->order_by("orders.invice_date asc")->run();
    return $q->get_selected();
}

function searchRegisterSale($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
    $q    = new Query();
    $q->select("register_user_order.*, register_billing_address.name, amount AS total_sv")->from("register_user_order
    INNER JOIN register_billing_address ON register_user_order.id = register_billing_address.order_id
    LEFT JOIN (SELECT order_id,SUM(amount) as amount from  register_other_order_item   Group By   order_id) AS register_other_order_item_2 
    ON register_user_order.id = register_other_order_item_2.order_id")->where_equal_to(array(
    'register_user_order.admin_id' => $login_id,
    "register_user_order.status" => 3
    ))->where_greater_than_or_equal_to(array(
    'register_user_order.invice_date' => $start
    ))->where_less_than_or_equal_to(array(
    'register_user_order.invice_date' => $end
    ))->order_by("register_user_order.invice_date asc")->run();
    return $q->get_selected();
}

function getSale_report_excel()
{
	$date = date("Y-m-d");
	/*$q = new Query();
	$q->select("orders.*, user_billing_address.name")
	->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
	->where_equal_to(array("orders.status"=>3))
	->order_by("orders.invice_date asc")
	->run(); 
	*/
	
	$q = new Query();
	$q->select()
	->from(TBL_ORDER)
	->where_equal_to(array("status"=>3,'invice_date'=>$date))
	->order_by("invice_date asc")
	->run();
	
	return  $q->get_selected();

}
function getRegisterSale_report_excel()
{
	$date = date("Y-m-d");
	/*$q = new Query();
	$q->select("register_user_order.*, register_billing_address.name")
	->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
	->where_equal_to(array("register_user_order.status"=>3))
	->order_by("register_user_order.invice_date asc")
	->run();
	*/
	
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_ORDER)
	->where_equal_to(array("status"=>3,'invice_date'=>$date))
	->order_by("invice_date asc")
	->run();
	
	return  $q->get_selected();

}


function getPurchaseToday($login_id)
{
	
	date_default_timezone_set('Asia/Kolkata');
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("SUM(`total_amount`) as today_purchase")
    ->from(TBL_CONSIGNMENT_DETAIL)
    ->where_equal_to(array('order_date'=>$date,'admin_id'=>$login_id))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}
function getPurchaseMounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
    $q = new Query();
    $q->select("SUM(`total_amount`) as month_purchase")
    ->from(TBL_CONSIGNMENT_DETAIL)
    ->where_greater_than_or_equal_to(array('order_date'=>$start))
    ->where_less_than_or_equal_to(array('order_date'=>$end))
	->where_equal_to(array('admin_id'=>$login_id))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}

function getPurchaseAll($login_id)
{

    $q = new Query();
    $q->select("SUM(`total_amount`) as all_purchase")
    ->from(TBL_CONSIGNMENT_DETAIL)
	->where_equal_to(array('admin_id'=>$login_id))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getSaleToday($search_date,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $search_date." 00:00:00";
    $to_date = $search_date." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("SUM(`totalprice`) as today_sale,SUM(`discount`) as today_discount")
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getRegisterSaleToday($search_date,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $search_date." 00:00:00";
    $to_date = $search_date." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("SUM(`totalprice`) as today_sale,SUM(`discount`) as today_discount")
    ->from(TBL_REGISTER_ORDER)
	//->where_in(array('status'=>1,'status'=>3))
	//->where_in('status',array('1','3'))
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getDiscountToday($search_date,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $search_date." 00:00:00";
    $to_date = $search_date." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("SUM(`discount`) as today_discount")
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getRegisterDiscountToday($search_date,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $search_date." 00:00:00";
    $to_date = $search_date." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("SUM(`discount`) as today_discount")
    ->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getSaleMounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
    $q = new Query();
    $q->select("SUM(`totalprice`) as month_sale,SUM(`discount`) as month_discount")
    ->from(TBL_ORDER)
	//->where_in('status',array('1','3'))
	//->where_in(array('status'=>1,'status'=>3))
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}
function getRegSaleMounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
    $q = new Query();
    $q->select("SUM(`totalprice`) as month_sale,SUM(`discount`) as month_discount")
    ->from(TBL_REGISTER_ORDER)
	//->where_in('status',array('1','3'))
	//->where_in(array('status'=>1,'status'=>3))
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}

function getDiscountMounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
    $q = new Query();
    $q->select("SUM(`discount`) as month_discount")
    ->from(TBL_ORDER)
	//->where_in('status',array('1','3'))
	//->where_in(array('status'=>1,'status'=>3))
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}
function getRegDiscountMounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
    $q = new Query();
    $q->select("SUM(`discount`) as month_discount")
    ->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
	->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->limit(1)
 ->run(); 
return  $q->get_selected(); 
}


function getgetSaleTill($login_id)
{
    $q = new Query();
    $q->select("SUM(`totalprice`) as all_sale,SUM(`discount`) as all_discount")
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getregSaleTill($login_id)
{
    $q = new Query();
    $q->select("SUM(`totalprice`) as all_sale,SUM(`discount`) as all_discount")
    ->from(TBL_REGISTER_ORDER)
	//->where_in('status',array('1','3'))
	//->where_in(array('status'=>1,'status'=>3))
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}

function getgetDiscountTill($login_id)
{
    $q = new Query();
    $q->select("SUM(`discount`) as all_discount")
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}
function getregDiscountTill($login_id)
{
    $q = new Query();
    $q->select("SUM(`discount`) as all_discount")
    ->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>3))
    ->limit(1)
	->run(); 
	return  $q->get_selected(); 
}

?>