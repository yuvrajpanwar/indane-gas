<?php 
// common::user_access_only("admin");
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	 if(!$login_id)
	 {
		  common::redirect_to(common::get_component_link(array("home","home")));die();
	 }
    $id = common::get_control_value("id");
    common::load_model("db");
    
    $data = getProfile($login_id);
    if(isset($_POST['add']))
    {
         
        
        if(form_validation::validate_fields())
        {
            
            $name=common::get_control_value("name");
            //$email=common::get_control_value("email");
            $mobile_num=common::get_control_value("mobile_num");
			$address=common::get_control_value("address");
			
			$update_address=new Query();
			//$update_address->update("user",array("username"=>$name,"email"=>$email,"mobile_number"=>$mobile_num,"address"=>$address))
			$update_address->update("user",array("username"=>$name,"mobile_number"=>$mobile_num,"address"=>$address))
			->where_equal_to(array("id"=>$login_id))
			->run();
			
            common::set_message(4);
            common::redirect_to(common::get_component_link(array("manage_profile","manage")));
          
        }
    }
?>