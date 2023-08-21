<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$date_per=common::get_control_value("key");
$data = get_product_name($date_per,$login_id);
// print_r($data);die();
//echo"here";die();
$return_content ="<ul style='max-height: 180px; overflow: auto; border:1x solid black !important;'>";
if($data)
{
	foreach($data as $d)
	{
		$status_text ="";
		$id = $d['id'];
		$name = ucwords($d['title']);
		$gm_qty = $d['gmqty'];
		$unit = $d['unit'];
		$price = $d['price'];
		$disconut_percent = $d['discount'];
		$discount_amount = $price*$disconut_percent/100;
		$final_amount=$price-$discount_amount;
		$final_amount=round($final_amount,2);
		$rel_value=$name."=".$gm_qty."=".$unit."=".$final_amount;
		$return_content.="<li rel='$rel_value' value='$id' style='list-style-type: none;     border-bottom: 1px solid; margin-left: -40px;' class='ac_even searchvalue'><b><a>$name</a></b></li>";
		
	}	
}
else
{
	$return_content.="<li rel='' style='list-style-type: none;' class='ac_even searchvalue'>No matching records...</li>";
}

$return_content.="</ul>";
//$return_content.="</tbody></table>";
echo $return_content;die();	 

?> 