<?php  common::user_access_only("admin");
    common::load_model("db");
	$user_id=common::get_control_value("dt");
	
	$data = getConsignment_ByUser($user_id);

	foreach($data as $row)
	{
		$invoice_number=$row['recipt_no'];
		$order_id=$row['order_id'];
		$comany_name=$row['name'];
		$total_amount=$row['totalprice'];
		$order_date=$row['order_date'];
		$total_item= $row['totalitem'];
		$display_date =date("d-M-Y",strtotime($order_date));
		
		$edit_link =common::get_component_link(array('add_order','edit'),array('id'=>$order_id,"in"=>$invoice_number));
		$pdf_link =common::get_component_link(array('add_order','download_pdf_formate'),array('id'=>$order_id));
		$return_content.="<tr>
					 <form action='' method='post'>
					
						                                              
						<td>$invoice_number</td>
						<td>$comany_name</td>
						<td>$total_item</td>
						<td>$total_amount</td>
						<td>$display_date</td>
						<td class='center' > 
						<a href='$edit_link' class='btn btn-sm' title='Edit'><i class='glyphicon glyphicon-pencil'></i></a>
						 <a href='$pdf_link' class='btn btn-sm' title='Download'>Download Pdf</a>
					 </td>
					 </form>
				</tr>";
	}


/*	foreach($data as $d)
	{
		$status_text ="";
		$id = $d['id'];
		$invoice = $d['invoice_no'];
		$order_id=$d['order_id'];
		$name = $d['title'];
		$Gm_Qty = $d['gm_qty'];
		$unit = $d['unit'];
		$total_pices = $d['total_pieces'];
		$per_qty_price =$d['per_qty_price'];
		$total_amount =$d['total_amount'];
		$tax_per =$d['tax_percentage'];
		$tax_amount =$d['tax_amount'];
		$order_date =$d['order_date'];
		$edit_link =common::get_component_link(array('order','details'),array('id'=>$order_id));

		$return_content.="<tr>
							 <form action='' method='post'>
							
								<td>$id</td>                                              
								<td>$invoice</td>
								<td>$name</td>
								<td>$Gm_Qty</td>
								<td>$unit</td>
								<td>$total_pices</td>
								<td>$per_qty_price</td> 
								<td>$tax_per</td>
								<td>$tax_amount</td>
								<td>$total_amount</td>
								<td>$order_date</td>
								<td class='center' > 
								<a href='$edit_link' class='btn btn-sm' title='Edit'><i class='glyphicon glyphicon-pencil'></i></a>
							 </td>
							 </form>
						</tr>";
		
	}	
	*/
//$return_content.="</tbody></table>";
echo $return_content;die();	 

?> 