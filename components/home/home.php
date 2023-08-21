<?php
    if($_POST['login'])
    {
        $username=common::get_control_value("username");
        $password=common::get_control_value("password");
        $res=common::login_user($username,$password);
        if($res)
        {
            /*if(common::get_session(ADMIN_LOGIN_TYPE)=="admin")
                common::redirect_to(common::get_component_link(array('user','dashboard')));
            else
                common::redirect_to(common::get_component_link(array('user','dashboard')));*/

			if(common::get_session(ADMIN_LOGIN_TYPE)=="admin")
                common::redirect_to(common::get_component_link(array('add_order','add')));
            else
                common::redirect_to(common::get_component_link(array('add_order','add')));
        }else
        {
            echo "<P style='text-align: center; font-size: 18px;color: red;'>Incorrect Username and Password,Please try Again.</p>";
        }
    }
    if($_POST['register'])
    {
        validate("register");
        if(form_validation::validate_fields())
        {
            $username=common::get_control_value("username");
            $password=common::get_control_value("password");
            $email=common::get_control_value("email");
            
            $q = new Query();
            $q->insert_into("user",array("username"=>$username,"password"=>md5($password),"email"=>$email,"active"=>0,"type"=>"user"))
            ->run();
            common::set_message(3);
            common::redirect_to(common::get_component_link(array("home","home")));
             
        }
            
    }
  
    
 
?>