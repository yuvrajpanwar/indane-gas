 <?php
 //common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
  common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");
//echo $login_id;die();
$id = common::get_control_value("id");
$start = common::get_control_value("st");
$end = common::get_control_value("end");
if($start && $end)
{
	$data = searchSale($start,$end,$login_id);
}
else
{
	$data = getSale_report_excel();
}

?> 
