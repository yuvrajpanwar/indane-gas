<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
	common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");
$data = getStock($login_id);
	
$filename = "product_for_purchase.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");	
	echo "Sr NO \t Product Name \t Comany Name \t  GM/QTY \t Unit Type \r\n";
	$count=1;
	foreach($data as $d) 
	{
		$brand_id =$d['brand'];
		$q = new Query();
		$q->select()
		->from(TBL_BRAND)
		->where_equal_to(array('id'=>$brand_id))
		->limit(1)
		->run();
		$disti=  $q->get_selected();
		$brand_name=$disti['name'];
		$product_name =$d["title"];
		$gm_qty=$d["product_size"];
		$unit_type=$d["unit"];
		$availablle_stock =$d['gmqty'];
		$base_qty=$d['base_qty'];
		//$stock_limit=5;
		//$stock_limit=($base_qty*20)/100;
		if($availablle_stock<=$base_qty)
		{
			echo "$count \t $product_name \t $brand_name \t $gm_qty \t $unit_type \r\n";
			$count++;
		}
		
		
    /*if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($d)) . "\r\n";
      $flag = true;
    }*/
	//print_r(array_values($d));die();
    //echo implode("\t", array_values($d)) . "\r\n";
	}
?>