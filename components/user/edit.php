<?php  common::user_access_only("admin");
common::load_model("user","add");
    $q=new Query();
    $q->select()
    ->from("user")
    ->where_equal_to(array("id"=>common::get_control_value("id")))
    ->limit(1)
    ->run()
    ;

    $data=$q->get_selected();
    
    if(isset($_POST['submit']))
    {
		form_validation::add_validation('name', 'required', 'Name');
        form_validation::add_validation('username', 'required', 'Username');
		//form_validation::add_validation('password', 'required', 'Password');
        form_validation::add_validation('email', 'required', 'Provide Email');
        form_validation::add_validation('email', 'email', 'Email not valid');
		form_validation::add_validation('mob_number', 'required', 'Provide Mobile Number');
		
        if(form_validation::validate_fields())
        {
			$Name=common::get_control_value("name");
            $username=common::get_control_value("username");
           // $password=common::get_control_value("password");
            //if($password!=common::get_control_value("temppassword"))
			//$password = md5($password);
                
            $email=common::get_control_value("email");
			$mob_number=common::get_control_value("mob_number");
            $active = common::get_control_value("active");
            $type = common::get_control_value("type");
            
            $q = new Query();
            //$q->update("user",array("name"=>$Name,"username"=>$username,"password"=>$password,"email"=>$email,"active"=>$active,"type"=>$type))
			$q->update("user",array("name"=>$Name,"username"=>$username,"email"=>$email,"mobile_number"=>$mob_number,"active"=>$active,"type"=>$type))
            ->where_equal_to(array("id"=>common::get_control_value("id")))
            ->run();
            common::set_message(3);
            common::redirect_to(common::get_component_link(array("user","add")));
             
        }
    }
?>