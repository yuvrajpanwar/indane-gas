<?php  common::user_access_only("admin");
    common::load_model("db");
	$main_cat_id=common::get_control_value("cat");
	$data = getSubcategoryById($main_cat_id);
	// print_r($data);die();
	//echo"here";die();
	$return_content ="<option value=''>Select Category</option>";
	if($data)
	{
		foreach($data as $d)
		{
			//$status_text ="";
			$id = $d['id'];
			$name = ucwords($d['name']);
			$return_content.="<option value='$id'>$name</option>";
			
		}	
	}

echo $return_content;die();	 

?> 