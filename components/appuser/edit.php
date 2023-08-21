<?php  
//common::user_access_only("admin");
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	if(!$login_id)
	{
	  common::redirect_to(common::get_component_link(array("home","home")));die();
	}
	
    $id = common::get_control_value("id");
    common::load_model("db");
    $data = getAppuserById($id,$login_id);
    if(isset($_POST['submit']))
    {
        form_validation::add_validation('username', 'required', 'Registration Name');
         //form_validation::add_validation('username', 'no_space', 'Registration Name');
         form_validation::add_validation('mobile', 'required', 'mobile');
        
        
        if(form_validation::validate_fields())
        {
			$surname= common::get_control_value("surname");
			$username=common::get_control_value("username");
			$full_name = $surname." ".$username;
            $mobile = common::get_control_value("mobile");
            $address=common::get_control_value("address");
			$city=common::get_control_value("city");
            $email=common::get_control_value("email");
            //$active = common::get_control_value("active");
			// echo $phone_number;die();
		   //addServices(array("company_name"=>$company_name,"contact_name"=>$person_name,"phone_number"=>$phone_number,"alternate_number"=>$alternate_number,"email_id"=>$email_id,"address"=>$address,"status"=>"1"));
			
            updateServices(array("username"=>$full_name,"name"=>$full_name,"mobile"=>$mobile,"email"=>$email,"address"=>$address,"city"=>$city),array("id"=>$id,"admin_id"=>$login_id));
			updateParty(array("username"=>$full_name,"email"=>$email,"address"=>$address,"city"=>$city),array("mobile"=>$mobile,"admin_id"=>$login_id));
            
            common::set_message(4);
            common::redirect_to(common::get_component_link(array("appuser","list")));
            
        }
    }
?>