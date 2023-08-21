<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
	common::redirect_to(common::get_component_link(array("home","home")));die();
}
common::load_model("db");

$start = common::get_control_value("st");
$end = common::get_control_value("end");

if($start && $end)
{
	$data = searchSale($start,$end,$login_id);
	$data1 = searchRegisterSale($start,$end,$login_id);
	$merge_data = array_merge($data,$data1);
	foreach($merge_data as $k=>$v)
	{
		$sort['id'][$k] = $v['id'];
		$sort['invice_date'][$k] = $v['invice_date'];
	}
	array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$merge_data);
    
	$form_date_formate=date("d-M-Y",strtotime($start));
	$to_date_formate=date("d-M-Y",strtotime($end));
	
	$filename = "Jakhan_gas_$form_date_formate-$to_date_formate.xls";
}
else
{
    $date = date("Y-m-d");
    
    $start = $date;
    $end =$date;
    
	$data = searchSale($start,$end,$login_id);
	$data1 = searchRegisterSale($start,$end,$login_id);
	$merge_data = array_merge($data,$data1);
	
	foreach($merge_data as $k=>$v)
	{
		$sort['id'][$k] = $v['id'];
		$sort['invice_date'][$k] = $v['invice_date'];
	}
	array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$merge_data);

    $date_formate=date("d-M-Y",strtotime($date));
	$filename = "Jakhan_gas_$date_formate.xls";

}

$generalOrderDataItems = getGeneralOrderItem($start,$end,$login_id);
$registerOrderDataItems = getRegisterOrderItem($start, $end, $login_id);

$generalOrderItemArray = array();
$registerOrderItemArray = array();
	
$old_order_id=0;
foreach($generalOrderDataItems as $v) 
{

    $order_id = $v['od_id'];

    if($old_order_id==0)
    {
        $old_order_id=$order_id;
        $generalOrderItemArray[$order_id] = array();
        //$generalOrderItemArray[$order_id] = array($v);
        array_push($generalOrderItemArray[$order_id],$v);
    }
    else if($order_id!=$old_order_id)
    {
        $old_order_id=$order_id;
        $generalOrderItemArray[$order_id] = array();
        array_push($generalOrderItemArray[$order_id],$v);
    }
    else if($order_id==$old_order_id)
    {
        array_push($generalOrderItemArray[$order_id],$v);
    }

}

$R_old_order_id=0;
foreach($registerOrderDataItems as $rv) 
{

    $Rorder_id = $rv['od_id'];
    //echo $Rorder_id;die();
    if($R_old_order_id==0)
    {
        $R_old_order_id=$Rorder_id;
        $registerOrderItemArray[$Rorder_id] = array();
        //$generalOrderItemArray[$order_id] = array($v);
        array_push($registerOrderItemArray[$Rorder_id],$rv);
    }
    else if($Rorder_id!=$R_old_order_id)
    {
        $R_old_order_id=$Rorder_id;
        $registerOrderItemArray[$Rorder_id] = array();
        array_push($registerOrderItemArray[$Rorder_id],$rv);
    }
    else if($Rorder_id==$R_old_order_id)
    {
        array_push($registerOrderItemArray[$Rorder_id],$rv);
    }

}
 

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");	
	echo "Invoice Date \t Invoice NO \t Name \t Connection Type \t SV";
	
	$pro_id_bulk="";
	$product = new Query();
	$product->select()
	->from(TBL_PRODUCTS)
    ->where_equal_to(array('admin_id'=>$login_id,'status'=>1))    
	->run();
	$product_bulck=$product->get_selected();
	foreach($product_bulck as $prodata)
	{
		$product_name=$prodata['title'];
		$product_id=$prodata['id'];
		$pro_id_bulk.=$product_id."-";
		echo" \t $product_name";
	}
	echo" \t 5% GST \t 18% GST \t Discount \t Total Amount \r\n";	
	
	$count=1;
	$total_amount=0;
	$check_cont=0;
	$rowTotal = array();
	$sumTotal = array();
	$row_invoice_date = '';
	foreach($merge_data as $d) 
	{

		$total_amount=0;
		$order_id=$d['id'];
		//$name=ucfirst($d['name']);
		$total_amount=$d["totalprice"];
		$invoice_date=$d["invice_date"];
		$invoice_number=$d['recipt_no'];
		$discount=$d['discount'];
		$user_type=$d['user_type'];
		$grand_total_discount=$grand_total_discount+$discount;

		if($invoice_date!="0000-00-00")
		{
			$date_display=date("d-M-Y",strtotime($invoice_date));
		}
		else
		{
			$date_display=$invoice_date;
		}
		if($row_invoice_date !='' && $row_invoice_date!=$invoice_date)
		{
			$row_join_string=implode("\t", $rowTotal);  
			echo "Total\t\t\t\t$row_join_string\r\n";
			$rowTotal = array();
			
		}
		$row_invoice_date = $invoice_date;

		$user_name=ucfirst($d['name']);
		$sv_amount=$d['total_sv'];
		$total_amount=$sv_amount;
		
		$date_by_sv_total=$date_by_sv_total+$sv_amount;
		
		
		
		$id_array=explode("-",$pro_id_bulk);
		$size_array=sizeof($id_array);
		//echo $size_array;die();
		$item_content="";
		$gst_amount=0;
		$two_amount=0;
		$nine_amount=0;

		$rowTotal[0] = $rowTotal[0] + $sv_amount;
		$sumTotal[0] = $sumTotal[0] + $sv_amount;
		
		for($i=0;$i<$size_array-1;$i++)
		{
			$product_id=$id_array[$i];
			$item_bulck =array();
            
			if($user_type=="General")
			{
				
				foreach ($generalOrderItemArray as $key => $val) 
                {
                    if($key==$order_id)
                    {
                        foreach ($val as $inner_key=> $value)
                        {
                            if($value['product_id']==$product_id)
                            {
                                $item_bulck =  $value;
                                unset($val[$inner_key]);
                                break;
                            }

                        }
                    }

                }
			}
			if($user_type=="Registered")
			{
				foreach ($registerOrderItemArray as $key => $val) 
                {
                    if($key==$order_id)
                    {
                        foreach ($val as $inner_key=> $value)
                        {
                            if($value['product_id']==$product_id)
                            {
                                $item_bulck=  $value;
                                unset($val[$inner_key]);
                                break;
                            }

                        }
                    }

                }
			}
			
			//$item_bulck=  $order_item->get_selected();
			if($item_bulck)
			{	
				$cgst_tax=$item_bulck['cgst_tax'];
				$sgst_tax=$item_bulck['sgst_tax'];
				
				$amount=$item_bulck['rate'];
				$quantity=$item_bulck['qty'];
				$amount_with_quantity=$amount*$quantity;
				$cgst_amount=$item_bulck['cgst_amount'];
				$sgst_amount=$item_bulck['sgst_amount'];
				$total_tax_amount=$cgst_amount+$sgst_amount;
				$gst_amount=$gst_amount+$total_tax_amount;
				$total_amount=$total_amount+$amount_with_quantity+$total_tax_amount;
				
				if($cgst_tax==2.50)
				{
					$two_amount=$two_amount+$cgst_amount;
					
				}
				if($cgst_tax==9.00)
				{
					$nine_amount=$nine_amount+$cgst_amount;
					
				}
				if($sgst_tax==2.50)
				{
					$two_amount=$two_amount+$sgst_amount;
				}
				if($sgst_tax==9.00)
				{
					$nine_amount=$nine_amount+$sgst_amount;
				}
				
				
			}
			else
			{
				$amount_with_quantity="";
			}
			
			$item_content.="\t$amount_with_quantity";
			
			
			$rowTotal[$i+1] = $rowTotal[$i+1]+$amount_with_quantity;
			$sumTotal[$i+1] = $sumTotal[$i+1]+$amount_with_quantity;
		}
		if($discount)
		{
			$total_amount=round($total_amount-$discount);
		}
		
		
			
			$i++;
			$rowTotal[$i+1] = $rowTotal[$i+1]+$two_amount;
			$sumTotal[$i+1] = $sumTotal[$i+1]+$two_amount;
			$i++;
			$rowTotal[$i+1] = $rowTotal[$i+1]+$nine_amount;
			$sumTotal[$i+1] = $sumTotal[$i+1]+$nine_amount;
			$i++;
			$rowTotal[$i+1] = $rowTotal[$i+1]+$discount;
			$sumTotal[$i+1] = $sumTotal[$i+1]+$discount;
			$i++;
			$rowTotal[$i+1] = $rowTotal[$i+1]+$total_amount;
			$sumTotal[$i+1] = $sumTotal[$i+1]+$total_amount;
			
		
		
		echo "$date_display\t$invoice_number\t$user_name\t$connection_type\t$sv_amount$item_content\t$two_amount\t$nine_amount\t$discount\t$total_amount\r\n";
	
		
		//$check_cont.=$count."-";
	}
	$row_join_string=implode("\t", $rowTotal);  
			echo "Total\t\t\t\t$row_join_string\r\n";
	echo "\t\t\r\n";
	$total_join_string=implode("\t", $sumTotal);  
			echo "Grand Total\t\t\t\t$total_join_string\r\n";
			
	
?>