<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
	common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");

/*if($start && $end)
{
	$data = searchSale($start,$end,$login_id);
	$data1 = searchRegisterSale($start,$end,$login_id);
	$merge_data = array_merge($data,$data1);
	function cmp($a, $b)
	{
		if ($a["invice_date"] == $b["invice_date"]) {
			return 0;
		}
		return ($a["invice_date"] < $b["invice_date"]) ? -1 : 1;
	}

	usort($merge_data,"cmp");
}
else
{
	$data = getSale_report_excel();
	$data1 = getRegisterSale_report_excel();
	$merge_data = array_merge($data,$data1);
	function cmp($a, $b)
	{
		if ($a["invice_date"] == $b["invice_date"]) {
			return 0;
		}
		return ($a["invice_date"] < $b["invice_date"]) ? -1 : 1;
	}

	usort($merge_data,"cmp");
}
*/
$data=getStockDetails($login_id);
	
$filename = "purchase_report.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");	
	echo "Invoice Date \t Invoice NO \t Vendor Name \t Product Name \t Product Quantity \r\n";
	

	foreach($data as $d) 
	{
			
		$availablle_stock = $d['gmqty'];
		$invoice_date=$d["invoice_date"];
		$invoice_number=$d["invoice_number"];
		$vendor_name=$d["vendor_name"];
		$product_name=$d["title"];
		
		if($availablle_stock<0)
		{
			$availablle_stock =0;
		}
		if($invoice_date!="0000-00-00")
		{
			$date_display=date("d-M-Y",strtotime($invoice_date));
		}
		else
		{
			$date_display=$invoice_date;
		}
			
		echo "$date_display \t $invoice_number \t $vendor_name \t $product_name \t $availablle_stock \r\n";

	}


?>