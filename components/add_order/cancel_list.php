<?php // common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$start="";
$end="";
$user_type=common::get_control_value("user_type");
if(isset($_POST['search']))
{
	
	form_validation::add_validation('form_date', 'required', 'Form Date');
	form_validation::add_validation('to_date', 'required', 'To Date');
	if(form_validation::validate_fields())
	{
		$start = common::get_control_value("form_date");
		$end = common::get_control_value("to_date");
		$type = common::get_control_value("user_type");
		if(!$type)
		{
			$type=common::get_control_value("user");
			
		}
		$type_for_edit = $type;
		//echo $type;die();
		if($type=="General")
		{
			//echo $type;die();
			$data = searchSaleCancel($start,$end,$login_id);
		}

		if($type=="Registered")
		{
			$data = searchRegisterSaleCancel($start,$end,$login_id);
			
			
		}
		
		//print_r($data);die();
	}
	
}
else
{
	
	if($user_type=="General")
	{
		$data = getSaleUserTypeCancel();
		$type_for_edit = "General";
	}
	else if($user_type=="Registered")
	{
		$data = getRegisterSaleUserTypeCancel();
		$type_for_edit = "Registered";
		
	}else{
		$data = getSaleUserTypeCancel();
		$type_for_edit = "General";
	}
	
}
	//print_r($data);die();
	
?>