<?php 
function get_satisfaction()
{
    $q = new Query();
    $q->select()
->from(TBL_SATISFACTION) 
->run();
return  $q->get_selected();

}
 
?>