<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
//echo $login_id;die();
    if(isset($_POST['submit']))
    {
		
        form_validation::add_validation('username', 'required', 'Registration Name');
         //form_validation::add_validation('username', 'no_space', 'Registration Name');
         form_validation::add_validation('mobile', 'required', 'mobile');
        //form_validation::add_validation('email', 'required', 'Registration email');
        //form_validation::add_validation('email', 'email', 'Registration email not valid');
        if(form_validation::validate_fields())
        {
			$surname= common::get_control_value("surname");
            $username=common::get_control_value("username");
			$full_name = $surname.$username;
            $mobile = common::get_control_value("mobile");
            $address=common::get_control_value("address");
			$city=common::get_control_value("city");
            $email=common::get_control_value("email");
            $active = common::get_control_value("active"); 
            //echo $active;die(); 
            $q = new Query();
            $q->insert_into("register",array("admin_id"=>$login_id,"username"=>$full_name,"mobile"=>$mobile,"name"=>$full_name,"email"=>$email,"address"=>$address,"city"=>$city))
            ->run();
            common::set_message(3);
            common::redirect_to(common::get_component_link(array("appuser","list")));
             
        }
    }
?>