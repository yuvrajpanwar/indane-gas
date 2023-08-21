<?php  common::user_access_only("admin");
    common::load_model("db");
   
    if(isset($_POST['add']))
    {
        form_validation::add_validation('title', 'required', 'Product Title'); 
        form_validation::add_validation('price', 'required', 'Price');
       // form_validation::add_validation('category', 'required', 'Main Category');
		//form_validation::add_validation('sub_category', 'required', 'Sub Category');
        
        
        if(form_validation::validate_fields())
        {
            if(empty($_REQUEST["add"])){
            }else{
				
            //$imgfun=new imagecomponent();
            $title=common::get_control_value("title"); 
			//echo $title;die();
			//$brand=common::get_control_value("brand"); 
            $description=common::get_control_value("content");
            $bannerimage = "";
           /* if($_FILES['image']['size']>0)                
                $bannerimage=$imgfun->upload_image_and_thumbnail('image',450,240,'userfiles','products',false); 
	   else 
		$bannerimage["imagename"] ='';
          */  
            //$cate_id = common::get_control_value("category");
			//$sub_category=common::get_control_value("sub_category"); 
            //$price = common::get_control_value("price"); 
            //$discount = common::get_control_value("discount"); 
            //$gmqty =common::get_control_value("gmqty");
            //$unit = common::get_control_value("unit");
            //$tax = common::get_control_value("tax_per");
            //addProduct(array("title"=>$title,"brand"=>$brand,"slug"=>common::generateSlug(TBL_PRODUCTS,$title),"image"=>$bannerimage["imagename"],"description"=>strip_tags($description),"category_id"=>$cate_id,"subcategory_id"=>$sub_category,"price"=>$price,"discount"=>$discount,"gmqty"=>$gmqty,"unit"=>$unit,"tax"=>$tax,"status"=>"1","currency"=>CURRENCY));
			$result=addOrderPrice(array("title"=>$title));		
            print_r($result);die();
            
            common::redirect_to(common::get_component_link(array("products","add")));
           
            }
        }
    }
?>