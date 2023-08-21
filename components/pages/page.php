<?php common::user_access_only("admin");
    $q = new Query();
    $q->select()
    ->from("pages")
    ->where_equal_to(array("slug"=>common::get_control_value("slug")))
    ->limit(1)
    ->run();
    $data = $q->get_selected();
    
    if(isset($_POST['add']))
    {
        form_validation::add_validation('title', 'required', 'Title');
        
        if(form_validation::validate_fields())
        {
            
            $title = common::get_control_value("title");
            $content = common::get_control_value("content");
            $q = new Query();
            $q->insert_into("pages",array("title"=>$title,"slug"=>common::get_control_value("slug"),"content"=>$content),array(
            "title"=>$title,
            "content"=>$content
            ))
            ->run();
            
            common::redirect_to(common::get_component_link(array("pages","page"),array("slug"=>common::get_control_value("slug"))));
        }
    }
?>