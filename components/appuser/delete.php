<?php  
//common::user_access_only("admin");
    $id=common::get_control_value('id');
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 ?>
  
 <?php
   
    if($id!="")
    {
        removeData($id,$login_id);
        common::redirect_to(common::get_component_link(array("appuser","list")));
    }
    
    function removeData($id,$login_id)
    {  
		$q = new Query();
		$q->delete(TBL_APPUSER)
		->where_equal_to(array("id"=>$id,"admin_id"=>$login_id))
		->run(); 
	}
        
    
?>