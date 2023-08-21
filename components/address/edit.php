<?php 
// common::user_access_only("admin");
	$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
	 if(!$login_id)
	 {
		  common::redirect_to(common::get_component_link(array("home","home")));die();
	 }
    $id = common::get_control_value("id");
    common::load_model("db");
    
    $data = getBanners($login_id);
	$converter = new Encryption;
	$companyname = $converter->decode($data["companyname"]);
	$address = $converter->decode($data["address"]);
	$city = $converter->decode($data["city"]);
	$statezip = $converter->decode($data["statezip"]);
	$phone = $converter->decode($data["phone"]);
	$country = $converter->decode($data["country"]);
	$gst_number = $converter->decode($data["gst_number"]);
	$email_id = $converter->decode($data["email"]);
	
    if(isset($_POST['add']))
    {
         
        
        if(form_validation::validate_fields())
        {
            
            
            $title=common::get_control_value("title");
            $address=common::get_control_value("address");
            $city=common::get_control_value("city");
            $statezip=common::get_control_value("statezip");
            $country=common::get_control_value("country");
            $phone=common::get_control_value("phone");
			$gst=common::get_control_value("gst_num");
            $email=common::get_control_value("email");
			$converter = new Encryption;
			$title = $converter->encode($title);
			$address = $converter->encode($address);
			$city = $converter->encode($city);
			$statezip = $converter->encode($statezip);
			$country = $converter->encode($country);
			$phone = $converter->encode($phone);
			$gst_num = $converter->encode($gst);
			$email_add =$converter->encode($email);
			//echo $password;die();
            
			$check_address=get_billing_address($login_id);
			
			if($check_address)
			{
				
				$update_address=new Query();
				$update_address->update("billing_address",array("companyname"=>$title,"gst_number"=>$gst_num,"address"=>$address,"city"=>$city,"statezip"=>$statezip,"country"=>$country,"phone"=>$phone,"email"=>$email_add))
				->where_equal_to(array("admin_id"=>$login_id))
				->run();
				
				/*$result=updateAddress(array("address"=>$address,"city"=>$city,"statezip"=>$statezip,"country"=>$country,"phone"=>$phone,"companyname"=>$title,"gst_number"=>$gst_num),array("admin_id"=>$login_id));
				echo$result;die();*/
			}
			else
			{
				addBillingAddress(array("admin_id"=>$login_id,"companyname"=>$title,"gst_number"=>$gst_num,"address"=>$address,"city"=>$city,"statezip"=>$statezip,"country"=>$country,"phone"=>$phone,"email"=>$email_add));
			}
           
            
            
            
            
            common::set_message(4);
            common::redirect_to(common::get_component_link(array("products","add")));
            
            
        }
    }
?>