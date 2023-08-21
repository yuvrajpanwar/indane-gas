<?php
// get product Amount..................
function get_product_amount($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_PRODUCTS)
	->where_equal_to(array('id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

function check_user_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_USER_INFORMATION)
	->where_equal_to(array('order_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

function check_Register_user_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_BILLING_ADDRESS)
	->where_equal_to(array('order_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

function get_product()
{

    $q = new Query();
    $q->select("id,title,gmqty,unit,price,discount")
	->from(TBL_PRODUCTS)
//->where_like_after(array('title'=>$data_pas))
//->where_like(array('title'=>$data_pas))
	->run();
	return  $q->get_selected();
}

// get general user details..................
function get_general_user_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_USER_INFORMATION)
	->where_equal_to(array('order_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

// get register user details..................
function get_register_user_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_BILLING_ADDRESS)
	->where_equal_to(array('order_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

// get general order basic details..................
function get_general_orderBasic_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_ORDER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

// get Register order basic details..................
function get_register_orderBasic_details($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_OTHER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();
}

// get product name..................
function get_product_name($data_pas,$login_id)
{
	$q = new Query();
	$q->select()
	->from(TBL_PRODUCTS)
	->where_equal_to(array('admin_id'=>$login_id,'type'=>'retiail'))
	->where_like(array('title'=>$data_pas))
	->run();
	return  $q->get_selected();
}

// User details base on  mobile..................
function details_base_on_mobile($id,$login_id)
{
    $q = new Query();
    $q->select()
	->from(TBL_PARTY)
	->where_equal_to(array('id'=>$id,'admin_id'=>$login_id))
	->limit(1)
	->run();
	return  $q->get_selected();
}
// get stock........................
function getStockById($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_STOCK)
	->where_equal_to(array('product_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

// get Order........................
function getOrder($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_ORDER)
	->where_equal_to(array('id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

function getOrderRegister($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

function getOtherDetails($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_ORDER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

function getRegisterOtherDetails($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_OTHER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

function getOtherDataItem($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_OTHER_ORDER_ITEM)
	->where_equal_to(array('order_id'=>$id))
	->run();
	return  $q->get_selected();

}

function getRegisterOtherDataItem($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_OTHER_ORDER_ITEM)
	->where_equal_to(array('order_id'=>$id))
	->run();
	return  $q->get_selected();

}

function checkGeneralOrderBasicDetails($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_ORDER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->run();
	return  $q->get_selected();

}
function checkRegisterOrderBasicDetails($id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTER_OTHER_BASIC_DETAILS)
	->where_equal_to(array('o_id'=>$id))
	->run();
	return  $q->get_selected();

}

function getOredrAmount($id)
{
	$q = new Query();
	$q->select("totalprice,discount,order_remark")
	->from(TBL_ORDER)
	->where_equal_to(array('id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}
function getRegisterOredrAmount($id)
{
	$q = new Query();
	$q->select("totalprice,discount,order_remark")
	->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('id'=>$id))
	->limit(1)
	->run();
	return  $q->get_selected();

}


function getMaxOrderDate()
{
	$q = new Query();
	$q->select("MAX( invice_date ) as inv")
	->from(TBL_ORDER)
	->run();
	return  $q->get_selected();

}
function getRegisterMaxOrderDate()
{
	$q = new Query();
	$q->select("MAX( invice_date ) as inv")
	->from(TBL_REGISTER_ORDER)
	->run();
	return  $q->get_selected();

}


function updateRecipt_number($data,$condi)
{
    $q=new Query();
	$q->update(TBL_ORDER,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateGeneralUser_address($data,$condi)
{
    $q=new Query();
	$q->update(TBL_USER_INFORMATION,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateRegisterUser_address($data,$condi)
{
    $q=new Query();
	$q->update(TBL_REGISTER_BILLING_ADDRESS,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateGeneralUser_order_basic_details($data,$condi)
{
    $q=new Query();
	$q->update(TBL_ORDER_BASIC_DETAILS,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateRegisterUser_order_basic_details($data,$condi)
{
    $q=new Query();
	$q->update(TBL_REGISTER_OTHER_BASIC_DETAILS,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateRegisterRecipt_number($data,$condi)
{
    $q=new Query();
	$q->update(TBL_REGISTER_ORDER,$data)
	->where_equal_to($condi)
	->run();
       
}
function updateInvoice_date($data,$condi)
{
			$q=new Query();
            $q->update(TBL_ORDER,$data)
            ->where_equal_to($condi)
            ->run();
       
}

function updateRegisterInvoice_date($data,$condi)
{
			$q=new Query();
            $q->update(TBL_REGISTER_ORDER,$data)
            ->where_equal_to($condi)
            ->run();
       
}

function addOrderPrice($data)
{
	 //echo$data; die();
	$q=new Query();
	
	$q->insert_into(TBL_SALE_PRICE,$data)
	->run();
	//print_r($q);die();
	common::set_message(3);
}

function getSale($login_id)
{
	//$from_date = date("Y-m-d")." 00:00:00";
    //$to_date = date("Y-m-d")." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("orders.*, user_billing_address.name")
    ->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
    ->where_equal_to(array('orders.admin_id'=>$login_id,"orders.status"=>3))
    ->order_by("orders.id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getSaleCancel($login_id)
{
	//$from_date = date("Y-m-d")." 00:00:00";
    //$to_date = date("Y-m-d")." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("orders.*, user_billing_address.name")
    ->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
    ->where_equal_to(array('orders.admin_id'=>$login_id,"orders.status"=>2))
    ->order_by("orders.id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getRegisterSale($login_id)
{
	//$from_date = date("Y-m-d")." 00:00:00";
    //$to_date = date("Y-m-d")." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("register_user_order.*, register_billing_address.name")
    ->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
    ->where_equal_to(array('register_user_order.admin_id'=>$login_id,"register_user_order.status"=>3))
    ->order_by("register_user_order.id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getRegisterSaleCancel($login_id)
{
	//$from_date = date("Y-m-d")." 00:00:00";
    //$to_date = date("Y-m-d")." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("register_user_order.*, register_billing_address.name")
    ->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
    ->where_equal_to(array('register_user_order.admin_id'=>$login_id,"register_user_order.status"=>2))
    ->order_by("register_user_order.id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getSaleUserType()
{
	
	$date = date("Y-m-d");
    $q = new Query();
   /* $q->select("orders.*, user_billing_address.name")
    ->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
    ->where_equal_to(array("orders.status"=>3))
    ->order_by("orders.id DESC")
	 ->run(); */
	  $q->select()
    ->from(TBL_ORDER)
    ->where_equal_to(array("status"=>3))
    ->order_by("id DESC")
	 ->run();
	return  $q->get_selected(); 
}

function getSaleUserTypeCancel()
{
	
	$date = date("Y-m-d");
    $q = new Query();
    $q->select()
    ->from(TBL_ORDER)
    ->where_equal_to(array("status"=>2))
    ->order_by("id DESC")
	 ->run();     

return  $q->get_selected(); 
}

function getRegisterSaleUserType()
{
	
	$date = date("Y-m-d");
    $q = new Query();
   /* $q->select("register_user_order.*, register_billing_address.name")
    ->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
    ->where_equal_to(array("register_user_order.status"=>3))
    ->order_by("register_user_order.id DESC")
	->run(); */
	
	$q->select()
    ->from(TBL_REGISTER_ORDER)
    ->where_equal_to(array("status"=>3))
    ->order_by("id DESC")
	->run();

	return  $q->get_selected(); 
}

function getRegisterSaleUserTypeCancel()
{
	
	$date = date("Y-m-d");
    $q = new Query();
    $q->select()
    ->from(TBL_REGISTER_ORDER)
    ->where_equal_to(array("status"=>2))
    ->order_by("id DESC")
	->run(); 

return  $q->get_selected(); 
}


function searchSale($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
	$date = date("Y-m-d");
    /*$q = new Query();
    $q->select("orders.*, user_billing_address.name")
    ->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
	->where_equal_to(array('orders.admin_id'=>$login_id,"orders.status"=>3))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("orders.id DESC")
	->run(); 
	*/
	
	$q = new Query();
    $q->select()
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,"status"=>3))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("id DESC")
	->run();
	
	return  $q->get_selected(); 
}

function searchSaleCancel($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select()
    ->from(TBL_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,"status"=>2))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function searchRegisterSale($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
	$date = date("Y-m-d");
    /*$q = new Query();
    $q->select("register_user_order.*, register_billing_address.name")
    ->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
	->where_equal_to(array('register_user_order.admin_id'=>$login_id,"register_user_order.status"=>3))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("register_user_order.id DESC")
	->run(); 
	*/
	$q = new Query();
    $q->select()
    ->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,"status"=>3))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("id DESC")
	->run();
	return  $q->get_selected(); 
}

function searchRegisterSaleCancel($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select()
    ->from(TBL_REGISTER_ORDER)
	->where_equal_to(array('admin_id'=>$login_id,"status"=>2))
    ->where_greater_than_or_equal_to(array('invice_date'=>$from_date))
    ->where_less_than_or_equal_to(array('invice_date'=>$to_date))
    ->order_by("id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getConsignment_ByUser($user_id)
{
	//$from_date = date("Y-m-d")." 00:00:00";
    //$to_date = date("Y-m-d")." 23:59:59";
	$date = date("Y-m-d");
    $q = new Query();
    $q->select("orders.*, register.name")
    ->from(TBL_ORDER." inner join ".TBL_REGISTERS." on ".TBL_REGISTERS.".id = ".TBL_ORDER.".user_id")
    ->where_equal(array('orders.user_id'=>$user_id))
    ->order_by("orders.id DESC")
    
 ->run(); 
return  $q->get_selected(); 
}

function getOrderById($id,$login_id)
{
	$q = new Query();
	$q->select("orders.*, user_billing_address.name,user_billing_address.number,user_billing_address.billing_address,user_billing_address.shipping_address,user_billing_address.state")
	->from(TBL_ORDER." inner join ".TBL_USER_INFORMATION." on ".TBL_ORDER.".id = ".TBL_USER_INFORMATION.".order_id")
	->where_equal_to(array('orders.id'=>$id,'orders.admin_id'=>$login_id))
	->limit(1)
	->run();
	return  $q->get_selected();

}
function getRegisterOrderById($id,$login_id)
{
	$q = new Query();
	$q->select("register_user_order.*, register_billing_address.name,register_billing_address.number,register_billing_address.billing_address,register_billing_address.shipping_address,register_billing_address.state")
	->from(TBL_REGISTER_ORDER." inner join ".TBL_REGISTER_BILLING_ADDRESS." on ".TBL_REGISTER_ORDER.".id = ".TBL_REGISTER_BILLING_ADDRESS.".order_id")
	->where_equal_to(array('register_user_order.id'=>$id,'register_user_order.admin_id'=>$login_id))
	->limit(1)
	->run();
	return  $q->get_selected();

}

function getOrderByDetails($id)
{
	$q = new Query();
	$q->select("order_item.*, products.title,products.hsn_code,products.discount")
	->from(TBL_ORDER_ITEM." inner join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_ORDER_ITEM.".product_id")
	->where_equal_to(array('order_item.order_id'=>$id))
 	->run();
	return  $q->get_selected();
}

function getRegisterOrderByDetails($id)
{
	$q = new Query();
	$q->select("register_user_order_item.*, products.title,products.hsn_code")
	->from(TBL_REGISTER_ORDER_ITEM." inner join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_REGISTER_ORDER_ITEM.".product_id")
	->where_equal_to(array('register_user_order_item.order_id'=>$id))
 	->run();
	return  $q->get_selected();
}

//get sale.......................

function getSaleToday($search_date,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $search_date." 00:00:00";
    $to_date = $search_date." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("orders.*, order_item.product_id,order_item.price,order_item.qty")
    ->from(TBL_ORDER." inner join ".TBL_ORDER_ITEM." on ".TBL_ORDER_ITEM.".order_id = ".TBL_ORDER.".id")
	->where_greater_than_or_equal_to(array('order_date'=>$from_date))
    ->where_less_than_or_equal_to(array('order_date'=>$to_date))
	->where_equal_to(array('orders.admin_id'=>$login_id))
	->run(); 
	return  $q->get_selected(); 
}
function getSale_this_mounth($start,$end,$login_id)
{
	date_default_timezone_set('Asia/Kolkata');
	$from_date = $start." 00:00:00";
    $to_date = $end." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("orders.*, order_item.product_id,order_item.price,order_item.qty")
    ->from(TBL_ORDER." inner join ".TBL_ORDER_ITEM." on ".TBL_ORDER_ITEM.".order_id = ".TBL_ORDER.".id")
	->where_greater_than_or_equal_to(array('order_date'=>$from_date))
    ->where_less_than_or_equal_to(array('order_date'=>$to_date))
	->where_equal_to(array('orders.admin_id'=>$login_id))
	->run(); 
	return  $q->get_selected(); 
}
function getSale_all($login_id)
{
	//date_default_timezone_set('Asia/Kolkata');
	//$from_date = $start." 00:00:00";
    //$to_date = $end." 23:59:59";
	//echo "from ".$from_date." to ".$to_date;die();
	
    $q = new Query();
    $q->select("orders.*, order_item.product_id,order_item.price,order_item.qty")
    ->from(TBL_ORDER." inner join ".TBL_ORDER_ITEM." on ".TBL_ORDER_ITEM.".order_id = ".TBL_ORDER.".id")
	->where_equal_to(array('orders.admin_id'=>$login_id))
	->run(); 
	return  $q->get_selected(); 
}

function getAddress($login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_ADDRESS)
->where_equal_to(array('admin_id'=>$login_id))
->limit(1)
->run();
return  $q->get_selected();
}
?>