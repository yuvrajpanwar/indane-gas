<?php  
//common::user_access_only("admin");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }
    $id = common::get_control_value("id");
    common::load_model("db");
    $data = getProductsById($id);
   //print_r($data);die();
	//echo $data["hsn_code"];die();
   $code=$data["hsn_code"];
   
    if(isset($_POST['add']))
    {
        form_validation::add_validation('title', 'required', 'Product Title');
		form_validation::add_validation('price', 'required', 'Price');
        
        
        if(form_validation::validate_fields())
        {
            //$imgfun=new imagecomponent();
            
			$title=common::get_control_value("title");

			$description=common::get_control_value("content");
			$price=common::get_control_value("price");
			$discount=common::get_control_value("discount");

			//$product_type=common::get_control_value("product_type");
			//$gmqty=common::get_control_value("gmqty");
			//$unit=common::get_control_value("unit");
			$hsn_code=common::get_control_value("hsn_code");
			$cgst_tax = common::get_control_value("cgst_tax");
			$sgst_tax = common::get_control_value("sgst_tax");
            
            
			//updateProduct(array("title"=>$title,"description"=>strip_tags($description),"price"=>$price,"gmqty"=>'',"unit"=>'',"product_type"=>$product_type,"cgst_tax"=>$cgst_tax,"sgst_tax"=>$sgst_tax,"currency"=>CURRENCY),array("id"=>$id));
			
			updateProduct(array("title"=>$title,"description"=>strip_tags($description),"price"=>$price,"discount"=>$discount,"gmqty"=>'',"unit"=>'',"hsn_code"=>$hsn_code,"cgst_tax"=>$cgst_tax,"sgst_tax"=>$sgst_tax,"currency"=>CURRENCY),array("id"=>$id));
             
            common::set_message(4);
            
            common::redirect_to(common::get_component_link(array("products","list")));
            
        }
    }
?>