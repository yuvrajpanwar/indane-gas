<?php  common::user_access_only("admin");

    $q = new Query();
    $settings = $q->select()
    ->from("settings")
    ->run();
    $settings = $q->get_selected();
    
    if(isset($_POST['add']))
    {
        $sql = "Insert into settings(`title`,`value`) values";
        $i =0;
        foreach($_REQUEST['setting'] as $key=>$val){
            $sql.="($key,'".trim($val)."')";
            if($i<count($_REQUEST["setting"])-1)
            {
                $sql.=",";
            }
            $i++;
        }
        
        $sql.=" ON DUPLICATE KEY UPDATE value=VALUES(value)";
       // echo $sql;
        mysql_query($sql);
        
        common::redirect_to(common::get_component_link(array("settings","add")));
    }
    
?>