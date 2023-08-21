<?php  common::user_access_only("admin");
    $id=common::get_control_value('id');
 ?>
  
 <?php
   
    if($id!="")
    {
        removeData($id);
        common::redirect_to(common::get_component_link(array("satisfaction","list")));
    }
    
    function removeData($id)
    {  
            $q = new Query();
                    $q->delete(TBL_SATISFACTION)
                    ->where_equal_to(array("id"=>$id))
                    ->run(); 
        }
        
    
?>