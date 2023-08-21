<?php  
//common::user_access_only("admin");
common::load_model("db");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }	 
   if(isset($_POST['add']))
    {
        
        form_validation::add_validation('title', 'required', 'Product Title'); 
        form_validation::add_validation('price', 'required', 'Price');
        //form_validation::add_validation('category', 'required', 'Main Category');
		//form_validation::add_validation('sub_category', 'required', 'Sub Category');
        
        
        if(form_validation::validate_fields())
        {
            if(empty($_REQUEST["add"])){
            }else{
            $imgfun=new imagecomponent();
            $title=common::get_control_value("title"); 
			//$brand=common::get_control_value("brand"); 
            $description=common::get_control_value("content");
			//$product_type=common::get_control_value("product_type");
			$hsn_code=common::get_control_value("hsn_code");
			
            $price = common::get_control_value("price"); 
            $discount = common::get_control_value("discount"); 
           
            //$gmqty =common::get_control_value("gmqty");
            //$unit = common::get_control_value("unit");
           $cgst_tax = common::get_control_value("cgst_tax");
		   $sgst_tax = common::get_control_value("sgst_tax");
			
			//addProduct(array("admin_id"=>$login_id,"title"=>$title,"description"=>strip_tags($description),"price"=>$price,"gmqty"=>'',"unit"=>'',"product_type"=>$product_type,"cgst_tax"=>$cgst_tax,"sgst_tax"=>$sgst_tax,"status"=>"1","currency"=>CURRENCY));
            
           addProduct(array("admin_id"=>$login_id,"title"=>$title,"description"=>strip_tags($description),"price"=>$price,"discount"=>$discount,"gmqty"=>'',"unit"=>'',"hsn_code"=>$hsn_code,"cgst_tax"=>$cgst_tax,"sgst_tax"=>$sgst_tax,"status"=>"1","currency"=>CURRENCY));
            
            common::redirect_to(common::get_component_link(array("products","list")));
           
            }
        }
    }
?>