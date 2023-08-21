<?php
	date_default_timezone_set('Asia/Kolkata');
	class connection {
		//date_default_timezone_set('Asia/Kolkata');
		public  $c_link;
		public function open_connection() {
		    global $c_link;  
			//mysql_connect(HOST,USERNAME,PASSWORD) or die(mysql_error());
			//mysql_select_db(DATABASE) or die(mysql_error());
		    $c_link = mysqli_connect("localhost","root","","Gas_Agency_doon_db");
			// $c_link = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }  
        }
		
		public function close_connection() {
			global $c_link;
            mysqli_close($c_link);
		}
		
	}
?>