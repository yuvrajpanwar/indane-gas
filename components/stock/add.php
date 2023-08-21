<?php  //common::user_access_only("admin");
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	 if(!$login_id)
	 {
		  common::redirect_to(common::get_component_link(array("home","home")));die();
	 }
    common::load_model("db");
   
    if(isset($_POST['add']))
    {
        form_validation::add_validation('prid', 'required', 'Product Title'); 
		form_validation::add_validation('in_number', 'required', 'Invoice Number');
		form_validation::add_validation('invoice_date', 'required', 'Invoice Date');
		form_validation::add_validation('name', 'required', 'Vendor Name');
		form_validation::add_validation('gmqty', 'required', 'Stock Quantity');
        
        
        
        if(form_validation::validate_fields())
        {
            if(empty($_REQUEST["add"])){
            }else{
				
            $imgfun=new imagecomponent();
            $product_id=common::get_control_value("prid");
			$in_number =common::get_control_value("in_number");
            $invoice_date = common::get_control_value("invoice_date"); 
			//echo $invoice_date;die();
			$vender_name = common::get_control_value("name");
			
            $gmqty =common::get_control_value("gmqty");
            $unit = common::get_control_value("unit"); 
			$base_qty = common::get_control_value("base_qty");
			$chcek_product = getStockById($product_id);
			if($chcek_product && $gmqty==0)
			{
				$id = $chcek_product['id'];
				updateStock(array("base_qty"=>$base_qty),array("id"=>$id,"product_id"=>$product_id));
				
			}
			else 
			{
				addStock(array("admin_id"=>$login_id,"product_id"=>$product_id,"gmqty"=>$gmqty,"unit"=>$unit,"base_qty"=>$base_qty)); 
				//common::redirect_to(common::get_component_link(array("stock","add")));
			}
			
			$q = new Query();
			$q->insert_into("stock_details",array(
			"admin_id"=>$login_id,
			"product_id"=>$product_id,
			"gmqty"=>$gmqty,
			"unit"=>$unit,
			"invoice_number"=>$in_number,
			"vendor_name"=>$vender_name,
			"invoice_date"=>$invoice_date
			))
			->run();
            
            common::redirect_to(common::get_component_link(array("stock","list")));
            
           
            }
        }
    }
?>