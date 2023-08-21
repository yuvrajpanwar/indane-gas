<?php
// Get sub category by main category
function getSubcategoryById($id)
{
    $q = new Query();
    $q->select()
->from(TBL_CATEGORIES)
->where_equal_to(array('parent_id'=>$id))
 //   ->limit(1)
->run();
return  $q->get_selected();

}

// Get product for purchase................
function getStock($login_id)
{
	$q = new Query();
	$q->select(TBL_STOCK.".*,".TBL_PRODUCTS.".title,".TBL_PRODUCTS.".gmqty as `product_size`,".TBL_PRODUCTS.".unit,".TBL_PRODUCTS.".brand")
	->from(TBL_STOCK." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK.".product_id")
	->where_equal_to(array('products.admin_id'=>$login_id))
	->run(); 
/*	 $q = new Query();
    $q->select(TBL_STOCK.".*,".TBL_PRODUCTS.".title,SUM(".TBL_STOCK.".gmqty) as `total_qty_stock`, cus_stock.consume_qty_stock")
    ->from(TBL_STOCK." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK.".product_id left outer join (Select ".TBL_ORDER_ITEM.".product_id, SUM(".TBL_ORDER_ITEM.".gmqty * ".TBL_ORDER_ITEM.".qty) as `consume_qty_stock` from ".TBL_ORDER_ITEM." group by ".TBL_ORDER_ITEM.".product_id) as cus_stock on cus_stock.product_id = ".TBL_STOCK.".product_id")
    ->group_by(TBL_STOCK.".product_id")

 ->run(); 
  */   
 return  $q->get_selected(); 

}

function getStock_in_excel()
{
	$q = new Query();
	$q->select(TBL_STOCK.".*,".TBL_PRODUCTS.".title,".TBL_PRODUCTS.".gmqty as `product_size`,".TBL_PRODUCTS.".unit,".TBL_PRODUCTS.".brand")
		->from(TBL_STOCK." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK.".product_id")
		->run(); 
/*	 $q = new Query();
    $q->select(TBL_STOCK.".*,".TBL_PRODUCTS.".title,SUM(".TBL_STOCK.".gmqty) as `total_qty_stock`, cus_stock.consume_qty_stock")
    ->from(TBL_STOCK." left outer join ".TBL_PRODUCTS." on ".TBL_PRODUCTS.".id = ".TBL_STOCK.".product_id left outer join (Select ".TBL_ORDER_ITEM.".product_id, SUM(".TBL_ORDER_ITEM.".gmqty * ".TBL_ORDER_ITEM.".qty) as `consume_qty_stock` from ".TBL_ORDER_ITEM." group by ".TBL_ORDER_ITEM.".product_id) as cus_stock on cus_stock.product_id = ".TBL_STOCK.".product_id")
    ->group_by(TBL_STOCK.".product_id")

 ->run(); 
  */   
 return  $q->get_selected(); 

}
function getProducts($login_id)
{
    $q = new Query();
    $q->select()
	->from(TBL_PRODUCTS)
	->where_equal_to(array('admin_id'=>$login_id,'status'=>1))
	->order_by("title asc")
	->run();
	return  $q->get_selected();
}


function getProductsById($id)
{
    $q = new Query();
    $q->select()
->from(TBL_PRODUCTS)
->where_equal_to(array('id'=>$id))
    ->limit(1)
->run();
return  $q->get_selected();

}
function getProductDescription($prod_id){
    $q = new Query();
    $q->select()
->from(TBL_PRODUCT_SPACIFICATION)
->where_equal_to(array('product_id'=>$prod_id))
    ->limit(1)
->run();
return  $q->get_selected();
}
function setProductDescription($data){
    $q=new Query();
            $q->insert_into(TBL_PRODUCT_SPACIFICATION,$data,$data)
            ->run();
            common::set_message(3);
        return $q->get_inserted_id();
}
function getAttributesGroups(){
    $q = new Query();
    $q->select()
->from(TBL_ATTRIBUTES_GROUP)
->run();
return  $q->get_selected();
}
function setAttributes($product_id,$array){
    $q = new Query();
    $q->delete(TBL_PRODUCT_ATTRIBUTE)
    ->where_equal_to(array("product_id"=>$product_id))
    ->run();
    
    $sql = "INSERT INTO `".TBL_PRODUCT_ATTRIBUTE."` (`product_id`, `attribute_id`) VALUES";
       if(is_array($array)){
        $i = 0 ;
        foreach($array as $attr_id){
            $sql .="('".$product_id."','".$attr_id."')";
            $i++;
            if($i<count($array))
                $sql .=",";
                
            
        }
       }else{
            $sql .="('".$product_id."','".$array."')";
       }
    mysql_query($sql);
}

function getAttributes($prod_id,$group){
    $q = new Query();
    $q->select()
    ->from(TBL_ATTRIBUTES." as attr left join ".TBL_PRODUCT_ATTRIBUTE." as prod on prod.attribute_id = attr.id and prod.product_id = '".$prod_id."' where attr.attribute_group = '".$group."'")
    ->show()
    ->run();
    return  $q->get_selected();
}


function getCategories($prod_id){
    $q = new Query();
    $q->select()
    ->from(TBL_PRODUCTS)
    ->where_equal_to(array('id'=>$prod_id))
    ->limit(1)
    ->run();
    return  $q->get_selected();
}

function getCategoriescheck($p_id){
    $q = new Query();
    $q->select()
    ->from(TBL_PRODUCT_CATEGORY)
    ->where_equal_to(array('product_id'=>$p_id))
    ->run();
    return  $q->get_selected();
}

function setCategory($product_id,$category){
    $q = new Query();
    $q->delete(TBL_PRODUCT_CATEGORY)
    ->where_equal_to(array("product_id"=>$product_id))
    ->run();
    
    $sql = "INSERT INTO `".TBL_PRODUCT_CATEGORY."` (`product_id`, `category_id`) VALUES";
       if(is_array($category)){
        $i = 0 ;
        foreach($category as $attr_id){
            $sql .="('".$product_id."','".$attr_id."')";
            $i++;
            if($i<count($category))
                $sql .=",";
                
            
        }
       }else{
            $sql .="('".$product_id."','".$category."')";
       }
    mysql_query($sql);
}


function addProduct($data)
{
	//print_r($data);die();
        $q=new Query();
            $q->insert_into(TBL_PRODUCTS,$data)
            ->run();
            common::set_message(3);
        return $q->get_inserted_id();
}

function addOrderPrice($data)
{
	 //echo$data; die();
	$q=new Query();
	
	$q->insert_into(TBL_PRODUCTS,$data)
	->run();
	//print_r($q);die();
	common::set_message(3);
}
function setProductsCategory($product_id,$categories)
{
    $sql = "INSERT INTO `".TBL_PRODUCT_CATEGORY."` (`product_id`, `category_id`) VALUES";
       if(is_array($categories)){
        $i = 0 ;
        foreach($categories as $cat_id){
            $sql .="('".$product_id."','".$cat_id."')";
            $i++;
            if($i<count($categories))
                $sql .=",";
                
            
        }
       }else{
            $sql .="('".$product_id."','".$categories."')";
       }
    mysql_query($sql);
}
function updateProduct($data,$condi)
{
    $q=new Query();
            $q->update(TBL_PRODUCTS,$data)
            ->where_equal_to($condi) 
            ->run(); 
}
function getEStoreList(){
     $q = new Query();
    $q->select()
->from(TBL_ECOMMETCE_STORE)
->run();
return  $q->get_selected();
}
function getStores($prod_id)
{
    $q = new Query();
    $q->select("p_store.*, store.title,store.logo")
->from(TBL_PRODUCT_STORE." as p_store inner join ".TBL_ECOMMETCE_STORE." as store on store.id = p_store.store_id")
->where_equal_to(array("product_id"=>$prod_id))
->run();
return  $q->get_selected();

}
function getStoresById($prod_id,$id)
{
    $q = new Query();
    $q->select()
->from(TBL_PRODUCT_STORE)
->where_equal_to(array("product_id"=>$prod_id,"id"=>$id))
->limit(1)
->run();
return  $q->get_selected();

}

function addStore($data)
{
        $q=new Query();
            $q->insert_into(TBL_PRODUCT_STORE,$data)
            ->run();
            common::set_message(3);
        return $q->get_inserted_id();
}
?>