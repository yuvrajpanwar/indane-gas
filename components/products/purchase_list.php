<?php 
 //common::user_access_only("admin");
 $login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$data = getStock($login_id);
?>