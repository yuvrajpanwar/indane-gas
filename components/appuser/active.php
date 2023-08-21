<?php common::user_access_only("admin");
   
    $q = new Query();
    $q->update(TBL_APPUSER,array("status"=>common::get_control_value("value")))
    ->where_equal_to(array("id"=>common::get_control_value("id")))
    ->run();
    
    
    
?>