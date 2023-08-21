<?php // common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$start="";
$end="";
$user_type="";
if(isset($_POST['search']))
{
	
	form_validation::add_validation('form_date', 'required', 'Form Date');
	form_validation::add_validation('to_date', 'required', 'To Date');
	if(form_validation::validate_fields())
	{
		$start = common::get_control_value("form_date");
		$end = common::get_control_value("to_date");

		
			$data = searchSale($start,$end,$login_id);
			$data1 = searchRegisterSale($start,$end,$login_id);
			
			$marge_data = array_merge($data,$data1);
			foreach($marge_data as $k=>$v)
			{
				$sort['id'][$k] = $v['id'];
				$sort['invice_date'][$k] = $v['invice_date'];
			}
			if($data || $data1)
			{
				array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$marge_data);
			}
			

	}
	
}
else
{
	$data = array();
	
	$data = getSale($login_id);
	$data1 = getRegisterSale($login_id);
	
	$marge_data = array_merge($data,$data1);
	foreach($marge_data as $k=>$v) {
    $sort['id'][$k] = $v['id'];
    $sort['invice_date'][$k] = $v['invice_date'];
	}
	
	if($data || $data1)
	{
		array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$marge_data);
	}
	

}

$product_count_for_width = new Query();
$product_count_for_width->select()
->from(TBL_PRODUCTS)
->where_equal_to(array('admin_id'=>$login_id))
->run();
$all_product_for_width=  $product_count_for_width->get_selected_count();
$all_product_for_width=$all_product_for_width+7;
//$all_product_for_width=30;
$div_width=$all_product_for_width/15*100;
$div_width=$div_width+5;
	//print_r($data);die();
	//$size_ofdata=sizeof($data);
	//echo $size_ofdata;die();
?>