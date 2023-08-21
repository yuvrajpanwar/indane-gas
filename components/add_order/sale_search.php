<?php  //common::user_access_only("admin");
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	 if(!$login_id)
	 {
		  common::redirect_to(common::get_component_link(array("home","home")));die();
	 }
    common::load_model("db");
	//$to_date=common::get_control_value("dt");
	$decider=common::get_control_value("dec");
	$current_date = date("Y-m-d");
	$first_day_this_month = date('Y-m-01', strtotime($current_date));
	if(!$decider)
	{
		common::redirect_to(common::get_component_link(array("reports","list")));
	}
	if($decider=="today")
	{
		$data = getSaleToday($current_date,$login_id);
		//print_r($data);die();
	}
	if($decider=="this mounth")
	{
		$data = getSale_this_mounth($first_day_this_month,$current_date,$login_id);
	}
	if($decider=="till")
	{
		$data = getSale_all($login_id);
	}
	
	//echo $decider;die();
	//echo $to_date;die();
    //$data = get_today_purchase();
	//print_r($data);die();
?>