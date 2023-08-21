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
	$table_other_item="TBL_OTHER_ORDER_ITEM";
	$table_order_item="TBL_ORDER_ITEM";
}

if($user_type=="Registered")
{
	$data = getRegisterSale($login_id);
	$table_other_item="TBL_REGISTER_OTHER_ORDER_ITEM";
	$table_order_item="TBL_REGISTER_ORDER_ITEM";
}

$pro_id_bulk="";
$head="";
$product = new Query();
$product->select()
->from(TBL_PRODUCTS)
->run();
$product_bulck=$product->get_selected();
foreach($product_bulck as $prodata)
{
	$product_name=$prodata['title'];
	$product_id=$prodata['id'];
	$pro_id_bulk.=$product_id."-";
	$head.="<th style='width:30px;'>$product_name</th>";
	//echo"<th style='width:30px;'>$product_name</th>";
}

$return_content="";

$return_content="<table class='table table-striped table-bordered' id='dataTables-example'>
	<thead>
	   <tr>
			 <th>Invoice Date</th>
			<th>Invoice No.</th>
			<th>SV</th>
			$head
			<th>Total GST</th>
			<th>Discount</th>
			<th>Total Amount</th> 
		</tr>
	</thead>
	<tbody id ='ebdy_content'>";

if($data)
{

	
	//echo "here";die();
		foreach($data as $d)
		{
			$total_amount=0;

			$order_id=$d['id'];
			$total_amount=$d["totalprice"];
			$invoice_date=$d["invice_date"];
			$invoice_number=$d['recipt_no'];
			$discount=$d['discount'];
			
			if($invoice_date!="0000-00-00")
			{
				$date_display=date("d-M-Y",strtotime($invoice_date));
			}
			else
			{
				$date_display=$invoice_date;
			}
			if($user_type=="General")
			{
				$sel_secuirty= new Query();
				$sel_secuirty->select("SUM(`amount`) as today_sv")
				->from(TBL_OTHER_ORDER_ITEM)
				->where_equal_to(array('order_id'=>$order_id))
				->limit(1)
				->run();
			}
			if($user_type=="Registered")
			{
				$sel_secuirty= new Query();
				$sel_secuirty->select("SUM(`amount`) as today_sv")
				->from(TBL_REGISTER_OTHER_ORDER_ITEM)
				->where_equal_to(array('order_id'=>$order_id))
				->limit(1)
				->run();
			}
			 
			
			$secuirt_data=$sel_secuirty->get_selected();
			$sv_amount=$secuirt_data['today_sv'];
			
			$total_amount=$sv_amount;
			
			
			$id_array=explode("-",$pro_id_bulk);
			$size_array=sizeof($id_array);
			//echo $size_array;die();
			$item_content="";
			$gst_amount=0;
			for($i=0;$i<$size_array-1;$i++)
			{
				$product_id=$id_array[$i];
				if($user_type=="General")
				{
						$order_item = new Query();
					$order_item->select()
					->from(TBL_ORDER_ITEM)
					->where_equal_to(array('order_id'=>$order_id,'product_id'=>$product_id))
					->limit(1)
					->run();
				}
				if($user_type=="Registered")
				{
						$order_item = new Query();
					$order_item->select()
					->from(TBL_REGISTER_ORDER_ITEM)
					->where_equal_to(array('order_id'=>$order_id,'product_id'=>$product_id))
					->limit(1)
					->run();
				}
				
				
				
				$item_bulck=  $order_item->get_selected();
				if($item_bulck)
				{
					//$amount=$item_bulck['price'];
					$amount=$item_bulck['rate'];
					$quantity=$item_bulck['qty'];
					$amount_with_quantity=$amount*$quantity;
					$cgst_amount=$item_bulck['cgst_amount'];
					$sgst_amount=$item_bulck['sgst_amount'];
					$total_tax_amount=$cgst_amount+$sgst_amount;
					$gst_amount=$gst_amount+$total_tax_amount;
					$total_amount=$total_amount+$amount_with_quantity+$total_tax_amount;
				}
				else
				{
					$amount_with_quantity="";
				}
				
				$item_content.="<td>$amount_with_quantity</td>";
			}
			
			if($discount)
			{
				$total_amount=round($total_amount-$discount);
			}	

			
			$return_content.="<tr>
					<td>$date_display</td>									  
					<td>$invoice_number</td>
					<td>$sv_amount</td>
					$item_content
					<td>$gst_amount</td>
					<td>$discount</td>
					<td>$total_amount</td>
					</tr>";
			
		//$old_date=$invoice_date;
		}
	$download_url=common::get_component_link(array('reports','get_type_excel_formate'),array("type"=>$user_type));
			
	$return_content.="</tbody></table><a class='btn btn-primary' href='$download_url'>Download Excel</a>";				
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
									</tr></tbody></table>";
}
//$return_content.="</tbody></table>";
echo $return_content;die();
?>