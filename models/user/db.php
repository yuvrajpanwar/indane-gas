<?php
function get_email($email,$login_id)
{
    $q = new Query();
    $q->select()
->from(TBL_USER)
->where_equal_to(array('email'=>$email,'id'=>$login_id,'active'=>1))
->limit(1)
->run();
return  $q->get_selected();
}

function check_password($pass,$login_id)
{
    $q = new Query();
    $q->select()
	->from(TBL_USER)
	->where_equal_to(array('password'=>$pass,'id'=>$login_id,'active'=>1))
	->limit(1)
	->run();
	return  $q->get_selected();
}

?>