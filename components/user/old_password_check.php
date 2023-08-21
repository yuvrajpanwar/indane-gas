<?php 
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	 if(!$login_id)
	 {
		  common::redirect_to(common::get_component_link(array("home","home")));die();
	 }
	common::load_model("db");
	
	$password=common::get_control_value("dt");
	$old_pass=md5($password);
	$data = check_password($old_pass,$login_id);
	$name=$data['name'];
	//$return_content ="";

echo $name;die();	 

?> 