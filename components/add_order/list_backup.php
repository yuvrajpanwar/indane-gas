<?php // common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$start="";
$end="";
if(isset($_POST['search']))
{
	
	form_validation::add_validation('form_date', 'required', 'Form Date');
	form_validation::add_validation('to_date', 'required', 'To Date');
	if(form_validation::validate_fields())
	{
		$start = common::get_control_value("form_date");
		$end = common::get_control_value("to_date");
		
		$data = searchSale($start,$end,$login_id);
	}
	
}
else
{
	$data = getSale($login_id);
}
	//print_r($data);die();
	
?>