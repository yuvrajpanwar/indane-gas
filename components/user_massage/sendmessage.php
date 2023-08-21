<?php
$userdata =array();
//$uid=common::get_control_value("id");
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
if(!$login_id)
{
  common::redirect_to(common::get_component_link(array("home","home")));die();
}

if(isset($_REQUEST["submit"]))
{    
    
    form_validation::add_validation('message', 'required', 'Message');
    if(form_validation::validate_fields())
    {
		$title=$_POST['title'];
		$message_text = $_POST['message'];
		$contacts = $_POST['contacts'];
		$decider= $_POST['smsTO'];
		$all=$_POST['all'];
		//echo $all;die();
		//print_r($contacts);die();
		
		//$all_number = implode($contacts, ',');
		//echo $all_number;die();
		function send_SMS_user($uName,$mobile,$text) 
		{

			//$authKey='97104AExpfwasdfsdR8NS5639e7eb';
			$authKey='88943AVL8Cuwlno58e38135';
			$mobile =$mobile;
			$userIDMod = "KLsdf";
			$sender = 'KBPLTD';
			//$sender = 'KLINKA';
			$route = '4';
			$name = $uName;
			//echo"https://control.msg91.com/api/sendhttp.php?authkey=$authKey&mobiles=$mobile&message=Dear $name, Thank you for registration.&sender=$sender&route=$route";die();
			$response = file_get_contents("https://control.msg91.com/api/sendhttp.php?authkey=$authKey&mobiles=$mobile&message=Dear Mr. $name, $text.&sender=$sender&route=$route");
			//return $response;
		}
		

		if($contacts || $all)
		{
			
			if($all)
			{
				$q = new Query(); 
				$q->select("id")
				->from(TBL_REGISTERS)
				->run();
				$userdata = $q->get_selected();
				$contacts=$userdata;
			}
			
			foreach($contacts as $d)
			{
				$user_id=$d;
				//echo $user_id;die();
				$q = new Query(); 
				$q->select("name,mobile,email")
				->from(TBL_REGISTERS)
				->where_equal_to(array('id'=>$user_id))
				->limit(1)
				->run();
				$userdata = $q->get_selected();
				//echo $user_mobile;die();
				$user_name=$userdata['name'];
				$user_mobile=$userdata['mobile'];
				$user_email=$userdata['email'];
				if($decider=="sms")
				{
					
					if($user_mobile)
					{
						//echo$user_mobile;die();
						$send_sms=send_SMS_user($user_name,$user_mobile,$message_text);
						//echo $send_sms;die();
					}
				}
				else if($decider=="mail")
				{
					if($user_email)
					{
						$to = $user_email;
						$subject = $title;
						//$from_name="KALINKA BUILDTEK";
						$from_name="KALINKA";
						$from_email="kalinkabuildtek@yahoo.com";
						//$from_email="contact@witds.com";
						//$message ="<p>$message_text</p>";
						$message ="<html><head><title>Welcome To KALINKA BUILDTEK </title></head>
									<body>
									<div class='usermailer'><table style='background:#f2f2f2;border:5px solid #196796;width:100%;border-collapse:collapse;' cellpadding='10'>
									<tr style='background:#555;'><td style='font-size:1.3em; color:#efefef;'>KALINKA BUILDTEK</td><td style='text-align:right;'></td></tr>

									<tr><td td colspan='2' style='line-height:1.5em;'>Dear $user_name,<br/><br/>
									$message_text
									<br/><br/>
									</td></tr>

									</table></div>
									</body></html>";
									
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
						//$headers .= 'From: Kalinka' . "\r\n";
						$headers .= 'From: '.$from_name."\r\n".
									'Reply-To: '.$from_email."\r\n" .
									'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
					}
					
				}
				else if($decider=="both")
				{
					if($user_mobile)
					{
						$send_sms=send_SMS_user($user_name,$user_mobile,$message_text);
					}
					
					if($user_email)
					{
						$to = $user_email;
						$subject = $title;
						//$from_name="KALINKA BUILDTEK";
						$from_name="KALINKA";
						$from_email="kalinkabuildtek@yahoo.com";
						//$from_email="contact@witds.com";
						//$message ="<p>$message_text</p>";
						$message ="<html><head><title>Welcome To KALINKA BUILDTEK </title></head>
									<body>
									<div class='usermailer'><table style='background:#f2f2f2;border:5px solid #196796;width:100%;border-collapse:collapse;' cellpadding='10'>
									<tr style='background:#555;'><td style='font-size:1.3em; color:#efefef;'>KALINKA BUILDTEK</td><td style='text-align:right;'></td></tr>

									<tr><td td colspan='2' style='line-height:1.5em;'>Dear $user_name,<br/><br/>
									$message_text
									<br/><br/>
									</td></tr>

									</table></div>
									</body></html>";
						
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
						//$headers .= 'From: Kalinka' . "\r\n";
						$headers .= 'From: '.$from_name."\r\n".
									'Reply-To: '.$from_email."\r\n" .
									'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
					}
				}	
				
				
			}
			common::set_message(22);
			common::redirect_to(common::get_component_link(array("user_massage","sendmessage")));
			
		}

    }
}

?>