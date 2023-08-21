<?php common::user_access_only(common::get_session(ADMIN_LOGIN_TYPE)); 

    common::load_model("order","db");
    $data = get_today_order();
?>