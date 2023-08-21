<?php

	define('DIRECT_ACCESS', true);
	define('HOST','localhost');
	define('DATABASE','israel');
	define('USERNAME','root');
	define('PASSWORD','');
    define('DB_PREFIX','');
    define('SITE_URL', (@$_SERVER['HTTPS'] ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']."/fruitmarket/");
    
    //define('CURRENCY','USD');
	define('CURRENCY','INR');
    
    /*------ Google Api Key -------*/
    define('GOOGLE_API_KEY','AIzaSyDY-ENx7IuUIT3mbKtp4K0a5-xy5KaGzvU');
    
    define('PRODUCT_IMAGE_URL',SITE_URL."/admin/userfiles/products/");
    define('CONTENT_IMAGE_URL',SITE_URL."/admin/userfiles/contents/");
    define('PROFILE_IMAGE_URL',SITE_URL."/admin/userfiles/profile/");

    
    
	/*---------Mail Config--------------
    You are add BASE_EMAIL to get email new order in base email ID.
    OR
    You are add SMTP server information then you get new order SMTP_USER  Email ID.
    */
    define('BASE_EMAIL','');
    
    define('SMTP_SERVER','');
    define('SMTP_USER','');
    define('SMTP_PASSWORD','');
    define('SMTP_PORT',"25");
    /*---------Mail Config--------------*/
    
    /*----------TABLES-----------------*/
    define('TBL_USER',DB_PREFIX."user");
    define('TBL_CATEGORIES',DB_PREFIX."categories");
    define('TBL_PRODUCTS',DB_PREFIX."products");
    define('TBL_REGISTERS',DB_PREFIX."register");
	define('TBL_BRAND',DB_PREFIX."brand");
    define('TBL_DISTRIBUTER',DB_PREFIX."distributer");
    define('TBL_CITY',DB_PREFIX."city");
    define('TBL_APPUSER',DB_PREFIX."register");
	define('TBL_PARTY',DB_PREFIX."party_details");
    define('TBL_ORDER',DB_PREFIX."orders");
	define('TBL_SALE',DB_PREFIX."sale");
    define('TBL_ORDER_ITEM',DB_PREFIX."order_item");
	define('TBL_SALE_ITEM',DB_PREFIX."sale_item");
    define('TBL_STOCK',DB_PREFIX."stock");
	define('TBL_STOCK_DETAILS',DB_PREFIX."stock_details");
    define('TBL_BANNERS',DB_PREFIX."banners");
    define('TBL_ADDRESS',DB_PREFIX."billing_address");
	define('TBL_SATISFACTION',DB_PREFIX."satisfaction");
	define('TBL_HISTORY_OF_POINT',DB_PREFIX."history_of_points");
	define('TBL_CONSIGNMENT_DETAIL',DB_PREFIX."consignment_detail");
	define('TBL_ORDER_PRICE',DB_PREFIX."order_price");
	define('TBL_SALE_PRICE',DB_PREFIX."sale_price");
	define('TBL_PRODUCT_TYPE',DB_PREFIX."product_type");
	define('TBL_USER_INFORMATION',DB_PREFIX."user_billing_address");
	define('TBL_ORDER_BASIC_DETAILS',DB_PREFIX."oredr_basic_details");
	define('TBL_OTHER_ORDER_ITEM',DB_PREFIX."other_order_item");
	
	define('TBL_REGISTER_ORDER',DB_PREFIX."register_user_order");
	define('TBL_REGISTER_ORDER_ITEM',DB_PREFIX."register_user_order_item");
	define('TBL_REGISTER_OTHER_ORDER_ITEM',DB_PREFIX."register_other_order_item");
	define('TBL_REGISTER_BILLING_ADDRESS',DB_PREFIX."register_billing_address");
	define('TBL_REGISTER_OTHER_BASIC_DETAILS',DB_PREFIX."register_other_basic_details");
    /*----------TABLES-----------------*/
    
    
    
    
    
    define('LOGIN_USER_ID','register_user_id');
    define('LOGIN_USER_NAME','register_user_name');
    define('LOGIN_USER_EMAIL','register_user_email');
    define('LOGIN_USER_IMAGE','register_user_image');
    
    define('LOGIN_USER_ID_COOKIES','register_user_id_cookies');
    define('LOGIN_USER_NAME_COOKIES','register_user_name_cookies');
    define('LOGIN_USER_EMAIL_COOKIES','register_user_email_cookies');

	define('COMPANY_NAME','WAY WEB SOLUTION');
    define('COMPANY_EMAIL',"info@waywebsolution.com");
	define('COPY_RIGHT_SENTENCE', '&copy; 2011-12 waywebsolution.com');

	define('PAGE_TITLE', 'waywebsolution.com - welcome to admin panel');

	

	define('REQUIRED','<span class="required">*</span>');

	define('REQUIRED_SENTENCE', '(' . REQUIRED . ' = Mandatory)');

	

	define('DEFAULT_PAGE_SIZE', 15);
    define('REWRITE_URL', false);
	

	define('SESSION_PREFIX','tkawy_session_');

	define('ADMIN_LOGIN_USER_ID','AccessToken');
    define('ADMIN_LOGIN_USER_NAME','UserName');
    define('ADMIN_LOGIN_TYPE','UserType');
    define('ADMIN_KEY',"key");
    define('ADMIN_COMPANY',"company");
    
    define('ADMIN_LOGIN_USER_ID_COOKIE','AccessTokenCookie');
	define('ADMIN_LOGIN_USER_NAME_COOKIE','UserNameCookie');
    define('ADMIN_LOGIN_TYPE_COOKIE','UserTypeCookie');
    
	define('ADMIN_LOGIN_USER_TYPE_ID','admin_login_user_type_id');

	define('USER_ID','user_id');

	define('MESSAGE_SESSION', 'message_session');

	

	define('DATE_SEPARATOR','-');

	

	define('NO_OF_DECIMAL_POINT', 2);

	

	define('SEO_ENABLED', true);

	

	define('ADMIN_THEME', 'themes/admin/');
    define('DEFAULT_THEME', 'themes/default/');
	

	define('ADMIN_PATH', 'admin/');
	define('COMPONENTS_DIR', 'components/');
    define('VIEW_DIR', 'views/');
    define('MODEL_DIR', 'models/');
    define('ELEMENT_DIR', 'elements/');
    define('PLUGIN_DIR', 'plugins/');
	define('COMPONENTS_INCLUDE_DIR', 'include/');
	define('MYSQL_DATE_FORMAT', '%d-%m-%Y');
	define('MYSQL_DATE_FORMAT2', '%M %d, %Y');

	
	

?>