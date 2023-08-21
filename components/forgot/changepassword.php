<?php 
common::load_model("db");
if(isset($_POST['add']))
{
   // form_validation::add_validation('newpassword', 'required', 'New Passowrd');
	//form_validation::add_validation('newpassword', 'no_space', 'New Passowrd');
	form_validation::add_validation('email', 'required', 'Registered Email');
	form_validation::add_validation('email', 'email', 'Registration email not valid');
	
    if(form_validation::validate_fields())
    {
		$email=common::get_control_value("email");
		$check_email=get_email($email);
		if($check_email)
		{
			$user_name=$check_email['username'];
			function password_genrate()
			{
				$token = "";
				$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
				$codeAlphabet.= "0123456789";
				$max = strlen($codeAlphabet); // edited

				for ($i=1; $i <=6; $i++) {
					$token .= $codeAlphabet[rand(0, $max-1)];
				}

				return $token;
			}
			$password= password_genrate();
			
			
			$to .= $email;
			$subject = "Change Password Request";
			//$message ="<p>$message_text</p>";
			$message ="<html><head><title></title></head>
						<body>
						<div class='usermailer'><table style='background:#f2f2f2;border:5px solid #196796;width:100%;border-collapse:collapse;' cellpadding='10'>
						<tr style='background:#555;'><td style='font-size:1.3em; color:#efefef;'>KALINKA BUILDTEK</td><td style='text-align:right;'></td></tr>

						<tr><td td colspan='2' style='line-height:1.5em;'>Dear $user_name,<br/><br/>Your New password is $password.
						<br/><br/>
						</td></tr>

						</table></div>
						</body></html>";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
			$headers .= 'From: ' . "\r\n";
			$mail_result=mail($to, $subject, $message, $headers);
			if($mail_result)
			{
				$password=md5($password);
				$update_address=new Query();
				$update_address->update("user",array("password"=>$password))
				->where_equal_to(array("email"=>$email))
				->run();
				common::set_message(24);
				common::redirect_to(common::get_component_link(array("forgot","changepassword")));
			}
			
		}
		else
		{
			common::set_message(23);
			common::redirect_to(common::get_component_link(array("forgot","changepassword")));
		}
		//$password=common::get_control_value("newpassword");
		//$password=md5($password);
    }
}
?>