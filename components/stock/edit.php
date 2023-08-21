<?php
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
$ab= common::load_model("db");
$id = common::get_control_value("id");
$data = getPurchaseStockById($id,$login_id);
$product_id=$data['product_id'];
$old_quantity=$data['gmqty'];

//echo $product_id;die();
    if(isset($_POST['add']))
    {
        //form_validation::add_validation('prid', 'required', 'Product Title'); 
		form_validation::add_validation('in_number', 'required', 'Invoice Number');
		form_validation::add_validation('invoice_date', 'required', 'Invoice Date');
		form_validation::add_validation('name', 'required', 'Vendor Name');
		form_validation::add_validation('gmqty', 'required', 'Stock Quantity');
        
        //echo"here";die();
        
        if(form_validation::validate_fields())
        {
            if(empty($_REQUEST["add"])){
            }else{
				
            //$imgfun=new imagecomponent();
            //$product_id=common::get_control_value("prid");     
			
            $gmqty =common::get_control_value("gmqty");
            $unit = common::get_control_value("unit"); 
			$invoice_number = common::get_control_value("in_number");
			$invoice_date = common::get_control_value("invoice_date");
			$party_name = common::get_control_value("name");
			
			$chcek_product = getStockById($product_id);
			
			if($gmqty>$old_quantity)
			{
				$diference_qty=$gmqty-$old_quantity;
				if($chcek_product)
				{
					//$record_id=$chcek_product['id'];
					$old_stock=$chcek_product['gmqty'];
					$new_stock=$old_stock+$diference_qty;
				}
				
				//$update_qty=$gmqty-$old_quantity;
			}
			
			if($gmqty<$old_quantity)
			{
				$diference_qty=$old_quantity-$gmqty;
				if($chcek_product)
				{
					$old_stock=$chcek_product['gmqty'];
					$new_stock=$old_stock-$diference_qty;
				}	
				
			}
			
			updateStockDetails(array("gmqty"=>$gmqty,"invoice_number"=>$invoice_number,"invoice_date"=>$invoice_date,"vendor_name"=>$party_name),array("id"=>$id));
			
			updateStock(array("gmqty"=>$new_stock),array("product_id"=>$product_id));
			common::set_message(25);
			common::redirect_to(common::get_component_link(array("stock","stock_reports")));die();
			
			
            }
        }
    }
?>