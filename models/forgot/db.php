<?php
function get_email($email)
{
    $q = new Query();
    $q->select()
->from(TBL_USER)
->where_equal_to(array('email'=>$email,'active'=>1))
->limit(1)
->run();
return  $q->get_selected();
}


?>