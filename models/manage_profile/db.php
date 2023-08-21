<?php
function getProfile($login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_USER)
->where_equal_to(array('id'=>$login_id))
->limit(1)
->run();
return  $q->get_selected();
}

function get_details($login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_USER)
->where_equal_to(array('id'=>$login_id))
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
?>