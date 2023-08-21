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
        //echo '<pre>';
        //print_r($data1);
        //echo '</pre>';
        $marge_data = array_merge($data,$data1);
        if($marge_data)
        {
            foreach($marge_data as $k=>$v)
            {
                $sort['id'][$k] = $v['id'];
                $sort['invice_date'][$k] = $v['invice_date'];
            }
            array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$marge_data);
        }
        $generalOrderDataItems = getGeneralOrderItem($start,$end,$login_id);
        $registerOrderDataItems = getRegisterOrderItem($start, $end, $login_id);		

	}
	
}
else
{
    $date = date("Y-m-d");
	$data = array();	
	$data = getSale($login_id);
    $data1 = getRegisterSale($login_id);	
	$generalOrderDataItems = getGeneralOrderItem($date,$date,$login_id);
	$registerOrderDataItems = getRegisterOrderItem($date, $date, $login_id);
	$marge_data = array_merge($data,$data1);
	if($marge_data)
	{
		foreach($marge_data as $k=>$v) {
		$sort['id'][$k] = $v['id'];
		$sort['invice_date'][$k] = $v['invice_date'];
		}
		array_multisort($sort['invice_date'], SORT_ASC, $sort['id'], SORT_ASC,$marge_data);
	}
}

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