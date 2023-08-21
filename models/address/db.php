<?php
function getBanners($login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_ADDRESS)
->where_equal_to(array('admin_id'=>$login_id))
->limit(1)
->run();
return  $q->get_selected();
}

function get_billing_address($login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_ADDRESS)
->where_equal_to(array('admin_id'=>$login_id))
->limit(1)
->run();
return  $q->get_selected();
}
function addBillingAddress($data)
{
	 //echo$data; die();
	$q=new Query();
	
	$q->insert_into(TBL_ADDRESS,$data)
	->run();
	//print_r($q);die();
	common::set_message(3);
}

function getBannerById($id)
{
    $q = new Query();
    $q->select()
->from(TBL_ADDRESS)
->where_equal_to(array('id'=>$id))
    ->limit(1)
->run();
return  $q->get_selected();

}
 
function updateBanner($data)
{
    $q=new Query();
	$q->update(TBL_ADDRESS,$data)
	 
	->run();
            
            
}
function updateAddress($data,$condi)
{
    $q=new Query();
	$q->update(TBL_ADDRESS,$data)
	->where_equal_to($condi) 
	->run(); 
}
?>