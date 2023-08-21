<?php  common::user_access_only("admin");
$q = new Query();
$q->select()
->from("user")
->run();
$data = $q->get_selected();
    if(isset($_POST['submit']))
    {
		form_validation::add_validation('name', 'required', 'Name');
        form_validation::add_validation('username', 'required', 'Username');
		form_validation::add_validation('password', 'required', 'Password');
        form_validation::add_validation('email', 'required', 'Provide Email');
        form_validation::add_validation('email', 'email', 'Email not valid');
		form_validation::add_validation('mob_number', 'required', 'Provide Mobile Number');
		
        if(form_validation::validate_fields())
        {
			//echo "here";die();
			$Name=common::get_control_value("name");
            $username=common::get_control_value("username");
            $password=common::get_control_value("password");
            $email=common::get_control_value("email");
			$mob_number=common::get_control_value("mob_number");
			$address=common::get_control_value("address");
            $active = common::get_control_value("active");
            $type = common::get_control_value("type");
			
			
            $q = new Query();
            $q->insert_into("user",array("name"=>$Name,"username"=>$username,"password"=>md5($password),"email"=>$email,"mobile_number"=>$mob_number,"address"=>$address,"active"=>$active,"type"=>$type))
            ->run();
            common::set_message(3);
            common::redirect_to(common::get_component_link(array("user","add")));
             
        }
    }
?>