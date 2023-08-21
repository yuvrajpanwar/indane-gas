 <?php 
//echo"here";die(); 
 //common::user_access_only("admin");
 //$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
 $ab= common::load_model("db");
/* if(!$login_id)
 {
	  common::redirect_to(common::get_component_link(array("home","home")));die();
 }*/
    $id=common::get_control_value('id');
	$user_type=common::get_control_value("type");
 ?>
  
 <?php
   
    if($id!="")
    {
        removeData($id,$login_id,$user_type);
        common::redirect_to(common::get_component_link(array("add_order","list")));
    }
    
    function removeData($id,$login_id,$user_type)
    {
		if($user_type=="General")
		{
			$order_item = new Query();
			$order_item->select("order_item.*, stock.gmqty")
						->from(TBL_ORDER_ITEM." inner join ".TBL_STOCK." on ".TBL_ORDER_ITEM.".product_id = ".TBL_STOCK.".product_id")
						->where_equal_to(array('order_item.order_id'=>$id))
						->run(); 
			$data_order_item = $order_item->get_selected();
			foreach($data_order_item as $data)
			{
				$product_id=$data['product_id'];
				$sale_product_qty=$data['qty'];
				$product_stock=$data['gmqty'];
				
				$new_stock=$product_stock+$sale_product_qty;
				
				$update_stock=new Query();
				$update_stock->update("stock",array("gmqty"=>$new_stock))
				->where_equal_to(array("product_id"=>$product_id))
				->run();
			}
			
			
			updateRecipt_number(array("status"=>2),array("id"=>$id));
		}
		if($user_type=="Registered")
		{
			$order_item = new Query();
			$order_item->select("register_user_order_item.*, stock.gmqty")
						->from(TBL_REGISTER_ORDER_ITEM." inner join ".TBL_STOCK." on ".TBL_REGISTER_ORDER_ITEM.".product_id = ".TBL_STOCK.".product_id")
						->where_equal_to(array('register_user_order_item.order_id'=>$id))
						->run(); 
			$data_order_item = $order_item->get_selected();
			foreach($data_order_item as $data)
			{
				$product_id=$data['product_id'];
				$sale_product_qty=$data['qty'];
				$product_stock=$data['gmqty'];
				
				$new_stock=$product_stock+$sale_product_qty;
				
				$update_stock=new Query();
				$update_stock->update("stock",array("gmqty"=>$new_stock))
				->where_equal_to(array("product_id"=>$product_id))
				->run();
			}
			updateRegisterRecipt_number(array("status"=>2),array("id"=>$id));
		}
		
       /* $q = new Query();
        $q->select()
        ->from("orders")
        ->where_equal_to(array("id"=>$id,"admin_id"=>$login_id))
        ->limit(1)
        ->run();
        $data = $q->get_selected();
        if(!empty($data))
        {
              
			$q = new Query();
			$q->delete("orders")
			->where_equal_to(array("id"=>$id,"admin_id"=>$login_id))
			->run();
			
			$order_item = new Query();
			$order_item->delete("order_item")
			->where_equal_to(array("order_id"=>$id))
			->run();
			
			$other_order_item = new Query();
			$other_order_item->delete("other_order_item")
			->where_equal_to(array("order_id"=>$id))
			->run();
			
			$user_address = new Query();
			$user_address->delete("user_billing_address")
			->where_equal_to(array("order_id"=>$id))
			->run();
			
			$order_basic_details = new Query();
			$user_address->delete("oredr_basic_details")
			->where_equal_to(array("o_id"=>$id))
			->run();
                   

            
        }
		*/
        
    }
?>