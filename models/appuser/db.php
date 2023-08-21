<?php 
function get_appuser($login_id)
{
	$q = new Query();
	$q->select()
	->from(TBL_APPUSER) 
	->where_equal_to(array('admin_id'=>$login_id))
	->order_by("username asc")
	->run();
	return  $q->get_selected();

}
function getAppuserById($id,$login_id)
{
	$q = new Query();
	$q->select()
	->from(TBL_REGISTERS)
	->where_equal_to(array('id'=>$id,'admin_id'=>$login_id))
	->limit(1)
	->run();
	return  $q->get_selected();

}
function updateServices($data,$condi)
{
    $q=new Query();
            $q->update(TBL_REGISTERS,$data)
            ->where_equal_to($condi)
            ->run();
            
            
}
function updateParty($data,$condi)
{
	$q=new Query();
	$q->update(TBL_PARTY,$data)
	->where_equal_to($condi)
	->run();
       
}

?>
 