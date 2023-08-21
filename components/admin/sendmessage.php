<?php
$userdata =array();
$uid=common::get_control_value("id");
//echo $uid;die();
if(common::get_control_value("id")!="") 
{
	$q = new Query(); 
	$q->select()
	->from(TBL_REGISTERS)
	->where_equal_to(array("id"=>common::get_control_value("id")))
	->limit(1)
	->run();
	$userdata = $q->get_selected(); 
	$user_mobile=$userdata['mobile'];
	$user_name=$userdata['name'];
}
if(isset($_REQUEST["submit"]))
{    
    
    form_validation::add_validation('message', 'required', 'Message');
    if(form_validation::validate_fields())
    {
		$message_text = $_POST['message'];
		function send_SMS_user($uName,$mobile,$text) 
		{

			//$authKey='97104AExpfwasdfsdR8NS5639e7eb';
			$authKey='88943AVL8Cuwlno58e38135';
			$mobile =$mobile;
			$userIDMod = "KLsdf";
			//$sender = 'NIGIND';
			$sender = 'RKMART';
			$route = '4';
			$name = $uName;
			//echo"https://control.msg91.com/api/sendhttp.php?authkey=$authKey&mobiles=$mobile&message=Dear $name, Thank you for registration.&sender=$sender&route=$route";die();
			$response = file_get_contents("https://control.msg91.com/api/sendhttp.php?authkey=$authKey&mobiles=$mobile&message=Dear $name, $text.&sender=$sender&route=$route");
			//return $response;
		}
		if($uid)
		{
			if($user_mobile)
			{
				$send_sms=send_SMS_user($user_name,$user_mobile,$message_text);
				common::set_message(22);
				common::redirect_to(common::get_component_link(array("admin","sendmessage")));
			}
		}
		else
		{
			$q = new Query(); 
			$q->select()
			->from(TBL_REGISTERS)
			->run();
			$userdata = $q->get_selected();
			foreach($userdata as $d)
			{
				$user_mobile=$d['mobile'];
				$user_name=$d['name'];
				if($user_mobile)
				{
					$send_sms=send_SMS_user($user_name,$user_mobile,$message_text);
				}
				
			}
			common::set_message(22);
			common::redirect_to(common::get_component_link(array("admin","sendmessage")));
			
		}


		
		/*$gcm = new GCM();
		$registatoin_ids = array();
		$imgfun=new imagecomponent();
		
		$bannerimage = "";
		if($_FILES['image']['size']>0) {               
			$banner=$imgfun->upload_image_and_thumbnail('image',450,240,'userfiles','notifaction',false); 
			if(!empty($banner)){
				$bannerimage = SITE_URL."/userfiles/notification/big/".$banner["imagename"];
			}
		}
		$message = array("message" => common::get_control_value("message"),"title"=> common::get_control_value("title"),"image"=>$bannerimage,"created_at"=>date('Y-m-d G:i:s'));
		//print_r($message);
		if(!empty($userdata)){
			 $result = $gcm->send_notification(array($userdata["gcm_code"]), $message);
		}
	    else
		{
			
		
		
			$q = new Query();
			//$res = mysql_query("select gcm_code from ".TBL_REGISTERS." where gcm_code!=''");
			//$registers = mysql_fetch_array($res,2);
			$q->select("gcm_code")
			->from(TBL_REGISTERS)
			->where_not_equal_to(array("gcm_code"=>""))
			->run();
			$registers = $q->get_selected();
		 
			foreach($registers as $regs){
				if($regs["gcm_code"]!="")
					$registatoin_ids[] = $regs["gcm_code"];
				
			   
			}
			if(count($registatoin_ids) > 1000){
						  
						  $chunk_array = array_chunk($registatoin_ids,1000);
						  foreach($chunk_array as $chunk){
						   $result = $gcm->send_notification($chunk, $message);
							
			}
						  
			 }else{

			   $result = $gcm->send_notification($registatoin_ids, $message);
				
			}
		}*/
    }
}
    //$gcm->send_notification($registatoin_ids, $message);
    //print_r($registatoin_ids);
//    foreach($registers as $reg){
//        if($reg["gcm_code"]!="")
//            $result = $gcm->send_notification($registatoin_ids, $message);
//    } 
?>