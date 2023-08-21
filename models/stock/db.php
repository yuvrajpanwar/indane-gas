<?php  
function addStock($data)
{
	$q=new Query();
	$q->insert_into(TBL_STOCK,$data,array("gmqty = gmqty + ".$data["gmqty"])) 
	->run();
	common::set_message(3);
	return $q->get_inserted_id();
}
function getStockByrowId($id,$login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_STOCK)
->where_equal_to(array('id'=>$id,'admin_id'=>$login_id))
    ->limit(1)
->run();
return  $q->get_selected();

}

function getPurchaseStockById($id,$login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_STOCK_DETAILS)
->where_equal_to(array('id'=>$id,'admin_id'=>$login_id))
    ->limit(1)
->run();
return  $q->get_selected();

}
/*function updateStock($data,$condi)
{
    $q=new Query();
            $q->update(TBL_PRODUCTS,$data)
            ->where_equal_to($condi) 
            ->run(); 
}
*/
function getStock($login_id)
{
	
$q = new Query();
$q->select(TBL_STOCK.".*,".TBL_PRODUCTS.".title,".TBL_PRODUCTS.".gmqty as proqty,".TBL_PRODUCTS.".unit as prounit")
	->from(TBL_STOCK." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK.".product_id")
	->where_equal_to(array('stock.admin_id'=>$login_id,'products.status'=>1))
	->run(); 
 return  $q->get_selected(); 

}
function getStockDetails($login_id)
{
	
	$q = new Query();
	$q->select(TBL_STOCK_DETAILS.".*,".TBL_PRODUCTS.".title")
	->from(TBL_STOCK_DETAILS." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK_DETAILS.".product_id")
	->order_by("stock_details.invoice_date DESC")
	->run(); 
	 return  $q->get_selected(); 

}
function getStockById($id)
{
    $q = new Query();
    $q->select()
->from(TBL_STOCK)
->where_equal_to(array('product_id'=>$id))
    ->limit(1)
->run();
return  $q->get_selected();

}
function updateStock($data,$condi)
{
	$q=new Query();
	$q->update(TBL_STOCK,$data)
	->where_equal_to($condi)
	->run();
	common::set_message(3);
}
function updateStockDetails($data,$condi)
{
	$q=new Query();
	$q->update(TBL_STOCK_DETAILS,$data)
	->where_equal_to($condi)
	->run();
	common::set_message(3);
}
?>