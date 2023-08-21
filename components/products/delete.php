 <?php  
 //common::user_access_only("admin");
 $login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
    $id=common::get_control_value('id');
 ?>
  
 <?php
   
    if($id!="")
    {
       // removeData($id,$login_id);
	    $q = new Query();
        $q->select()
        ->from("products")
        ->where_equal_to(array("id"=>$id,"admin_id"=>$login_id))
        ->limit(1)
        ->run();
        $data = $q->get_selected();
        if(!empty($data))
        {
           $q=new Query();
			$q->update(TBL_PRODUCTS,array("status"=>0))
			->where_equal_to(array("id"=>$id,"admin_id"=>$login_id))
			->run();
            //updateProductStatus(array("status"=>0),array("id"=>$id,"admin_id"=>$login_id));
            
        }
        common::redirect_to(common::get_component_link(array("products","list")));
    }
    

?>