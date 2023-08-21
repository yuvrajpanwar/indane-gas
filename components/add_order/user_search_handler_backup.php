<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
common::load_model("db");
$user_type=common::get_control_value("dt");
if($user_type=="General")
{
	$data = getSale($login_id);
}

if($user_type=="Registered")
{
	$data = getRegisterSale($login_id);
}


$return_content="";

/*$return_content="<table class='table table-striped table-bordered' id='dataTables-example'>
	<thead>
	   <tr>
			 <th>Invoice No.</th>
			<th>Name</th>
			<th>Total Item</th>
			<th>Discount</th>
			<th>Total Amount</th>
			<th>MOD</th>
			<th>Invoice Date</th> 
			<th>Invoice</th>
		</tr>
	</thead>
	<tbody id ='ebdy_content'>";
	*/

if($data)
{
	
	//echo "here";die();
	$count =1;
	$total_debit=0;
	$total_credit=0;
	$tin_number =$data['tin_number'];
	$phone_number=$data['phone_number'];
	foreach($data as $d)
	{ 
		$order_id=$d['id'];
		$total_amount=$d["totalprice"];
		$discount=$d["discount"];
		if($discount)
		{
			$final_amount=$total_amount-$discount;
		}
		else
		{
			$final_amount=$total_amount;
		}
		$invoice_date=$d["invice_date"];
		if($invoice_date!="0000-00-00")
		{
			$date_display=date("d-M-Y",strtotime($invoice_date));
		}
		else
		{
			$date_display=$invoice_date;
		}
		
		$final_amount=round($final_amount);
		
		$invoice_number=$d["recipt_no"];
		$user_name=ucfirst($d["name"]);
		$total_item=$d["totalitem"];
		
		$download_link=common::get_component_link(array('add_order','download_pdf_formate'),array("id"=>$d['id'],"type"=>$user_type));
		$delete_link=common::get_component_link(array('add_order','delete'),array("id"=>$d['id'],"type"=>$user_type));
		$invoice_link=common::get_component_link(array('add_order','details'),array("id"=>$d['id'],"type"=>$user_type));
		$edit_link=common::get_component_link(array('add_order','edit_products_details'),array("id"=>$d['id'],"type"=>$user_type,"order_type"=>'old'));
		if($user_type=="General")
		{
			$sel_other_details= new Query();
			$sel_other_details->select("payment_mode")
			->from(TBL_ORDER_BASIC_DETAILS)
			->where_equal_to(array('o_id'=>$order_id))
			->limit(1)
			->run();
		}	
		if($user_type=="Registered")
		{
			$sel_other_details= new Query();
			$sel_other_details->select("payment_mode")
			->from(TBL_REGISTER_OTHER_BASIC_DETAILS)
			->where_equal_to(array('o_id'=>$order_id))
			->limit(1)
			->run();
		}
		$other_data=$sel_other_details->get_selected();
		$mod=ucfirst($other_data['payment_mode']);
		
		
		$return_content.="<tr>
							<form action='' method='post'> 
							<td>$invoice_number</td>
							<td style='width: 150px;'>$user_name</td>
							<td>$total_item</td>
							<td>$discount</td>
							<td>$final_amount</td>
							<td>$mod</td>
							<td>$date_display</td>
							
							<td class='center' style='width: 400px;'>
								<a href='$invoice_link' class='btn btn-primary' target='_blank'  title='Details'>Print</a>
								<a href='$edit_link' class='btn btn-primary' title='download'>Edit</a>
								<a href='$download_link' class='btn btn-primary' title='download'>Pdf</a>
								<a onclick='return confirm('Are you sure Cancel?')' href='$delete_link' class='btn btn-primary delete'  title='Delete'>Cancel</a>
							</td>
							</form>
						</tr>";
		$count++;
	}
	
			
					
}	
else
{
	$return_content.="<tr>
									<td>No Record Found</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									</tr>";
}
//$return_content.="</tbody></table>";
echo $return_content;die();
?>