<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$mobile_number=common::get_control_value("mob");

$data = details_base_on_mobile($mobile_number,$login_id);
//echo $login_id." ".$mobile_number;die();
//print_r($data);die();
if($data)
{
	$return_content="";
	$username =$data['username'];
	$email =$data['email'];
	$address =$data['address'];
	$city =$data['city'];
	$return_content=$username."=".$email."=".$city."=".$address;
}
else
{
	$return_content="";
}

echo $return_content;die();

?> 