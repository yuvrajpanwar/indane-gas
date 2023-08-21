<script src="js/jquery-2.2.3.min.js"></script>
<script>
/*$(function(){
	$("li").click(function(){
		// alert("hello");
		$('li a.selected').parents('li').css("height", "auto");​
		// $(this).parent().css("height", "auto" );
	});
});*/

</script> 
<style>
.label{margin: 0 20px 0 10px;

padding: 3px 5px 2px;
background-color: #F66;
}
</style>     
 <?php
$name=common::get_session(ADMIN_LOGIN_NAME);
$login_id=common::get_session(ADMIN_LOGIN_USER_ID);
$login_type=common::get_session(ADMIN_LOGIN_TYPE);


$user = new Query();
$user->select()
->from(TBL_REGISTERS)
->where_equal_to(array('admin_id'=>$login_id))
->run();
$all_user=  $user->get_selected_count();

$bill_add = new Query();
$bill_add->select()
->from(TBL_ADDRESS)
->where_equal_to(array('admin_id'=>$login_id))
->limit(1)
->run();
$data_company= $bill_add->get_selected();
//print_r($data_company);die();
$company_name=$data_company['companyname'];
//echo $company_name;die();
$converter_s = new Encryption;
$company_name = $converter_s->decode($company_name);
//echo $company_name;die();

$all_add=  $bill_add->get_selected_count();
//echo $all_add;die();

$product = new Query();
$product->select()
->from(TBL_PRODUCTS)
->where_equal_to(array('admin_id'=>$login_id,'status'=>1))
->run();
$all_product=  $product->get_selected_count();
//echo $page_name;die();
$product_class="";
	switch ($page_name) {
    case "product":
        $product_class="active";
        break;
    case "myinvitations":
        $invitations_class="active";
        break;
    case "myledger":
        $myledger_class="active";
        break;
	case "myaccount":
        $myaccount_class="active";
        break;
	case "dashboard":
        $dashboard_class="active";
        break;
	case "howitwork":
	{
        $howitwork_class="active";
		$user_class="";
        break;
	}
	case "create_event":
        $create_event_class="active";
        break;
    default:
        $front_page="active";
}

?> 

	   <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
			
            <div class="navbar-header" style="width:92%;">
                <div class="col-lg-4">
				  <a class="navbar-brand logo" href="#" ><img src="<?php echo ADMIN_THEME ?>/images/2.png" height="40px" width="200px" /> </a>
				</div>
				<div class="col-lg-8">
				<a class="navbar-brand logo" href="#" style="height: 25px; padding: 3px; color:white; font-size: 30px; width: 100%;text-align: center;"><strong>Welcome <?=ucfirst($company_name);?></strong> </a>
				</div>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
               <!--<li><a href="#">Help</a></li>-->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
					   <?php
							if(common::get_session(ADMIN_LOGIN_TYPE)=="user")
							{
						?>
								<!--<li><a href="<?php echo common::get_component_link(array("manage_profile","manage")); ?>"><i class="fa fa-users fa-fw"></i> Manage Profile</a></li>-->
								<?php
									if(!$all_add)
									{
								?>
								<li><a href="<?php echo common::get_component_link(array("address","edit")); ?>"><i class="fa fa-users fa-fw"></i> Manage Billing Address</a></li>   
									<?php } ?>
									
									<!--<li><a href="<?php echo common::get_component_link(array("address","edit")); ?>"><i class="fa fa-users fa-fw"></i> Manage Billing Address</a></li>-->
						<?php
							}
						?>
                         
                         <li><a href="<?php echo common::get_component_link(array("user","changepassword")); ?>"><i class="fa fa-lock fa-fw"></i> Change Password</a></li>
                        <li><a href="<?php echo common::get_component_link(array("home","logout")); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" id="navbar-default" role="navigation">
                <div class="sidebar-collapse">
                <?php //if(common::get_session(ADMIN_LOGIN_TYPE)=="user"){
                    
                //}else if(common::get_session(ADMIN_LOGIN_TYPE)=="admin"){ 
				?>
                    <ul class="nav" id="side-menu">
                        <?php
						if(common::get_session(ADMIN_LOGIN_TYPE)!="admin")
						{
						?>
                        <li>
                            <a href="<?php echo common::get_component_link(array("add_order","add")); ?>"><!--<i class="fa fa-dashboard fa-fw"></i>--><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                        </li>
                        
                         <!--<li>
                            <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Users<span class="label label-important"><?=$all_user?></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("appuser","list")); ?>"><i class="fa fa-list-alt"></i>List</a>
								</li>
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("appuser","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
								</li>   
                                    
                            </ul>

                        </li>-->
						<!--<li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Categories<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                            <a href="<?php echo common::get_component_link(array("category","list")); ?>"><i class="fa fa-list-alt"></i>List</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo common::get_component_link(array("category","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                        </li> 
                            </ul> 
                        </li> 
						<li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Brand<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                            <a href="<?php echo common::get_component_link(array("brand","list")); ?>"><i class="fa fa-list-alt"></i>List</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo common::get_component_link(array("brand","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                        </li> 
                            </ul> 
                        </li>-->
                        
                         <!--<li>
                            <a href="#"><i class="fa fa-first-order" aria-hidden="true"></i> Ledger<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("create_ledger","add")); ?>"><i class="fa fa-plus-square"></i> Create Ledger</a>
								</li> 
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("sale","add")); ?>"><i class="fa fa-plus-square"></i> Sale</a>
								</li> 
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("add_order","list")); ?>"><i class="fa fa-list-alt"></i> Sale List</a>
								</li>
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("sale_payment","add")); ?>"><i class="fa fa-money" aria-hidden="true"></i> Reciept</a>
								</li>
								
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("party_invoice","list")); ?>"><i class="fa fa-list-alt"></i> Reciept List</a>
								</li>
								
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("pay_payment","add")); ?>"><i class="fa fa-money" aria-hidden="true"></i> Payment</a>
								</li>
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("payment_list","list")); ?>"><i class="fa fa-money" aria-hidden="true"></i> Payment list</a>
								</li>
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("sale_ledger","list")); ?>"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Party Ledger</a>
								</li>
								
								
                            </ul> 
                        </li>-->
						<li class="<?=$product_class?>">
                            <a href="#"><!--<i class="glyphicon glyphicon-book"></i>--><i class="fa fa-product-hunt" aria-hidden="true"></i> Products<span class="label label-important"><?=$all_product?></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("products","list")); ?>"><i class="fa fa-list-alt"></i> List</a>
								</li>
								<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("products","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
								</li> 
								<!--<li style="border-top:1px solid white !important;">
									<a href="<?php echo common::get_component_link(array("products","purchase_list")); ?>"><i class="fa fa-list-alt"></i> Product for purchase</a>
								</li>-->
                            </ul> 
                        </li>
						<li>
                            <a href="#"><!--<i class="glyphicon glyphicon-book"></i>--><i class="fa fa-database" aria-hidden="true"></i> Manage Receipt<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               		 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("add_order","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                     </li>
                                   	 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("add_order","list")); ?>"><i class="fa fa-list-alt"></i> List</a>
                                     </li> 
									 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("add_order","cancel_list")); ?>"><i class="fa fa-list-alt"></i> Cancel List</a>
                                     </li> 
                            </ul> 
                        </li>
						<!--<li>
                            <a href="#"><i class="fa fa-database" aria-hidden="true"></i> Journal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               		 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("general","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                     </li> 
                            </ul> 
                        </li>-->
						
                       <li>
                            <a href="#"><i class="fa fa-database" aria-hidden="true"></i> Stock<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               		 
                                   	 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("stock","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                     </li> 
									<li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("stock","list")); ?>"><i class="fa fa-list-alt"></i> Availablle Stock</a>
                                     </li>
									 <li style="border-top:1px solid white !important;">
                                            <a href="<?php echo common::get_component_link(array("stock","stock_reports")); ?>"><i class="fa fa-list-alt"></i> Purchased Stock</a>
                                     </li>
                            </ul> 
                        </li>
                        
                          <!--<li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Slider<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               		 <li>
                                            <a href="<?php echo common::get_component_link(array("banners","list")); ?>"><i class="fa fa-list-alt"></i>List</a>
                                     </li>
                                   	 <li>
                                            <a href="<?php echo common::get_component_link(array("banners","add")); ?>"><i class="fa fa-list-alt"></i>Add New</a>
                                     </li>    
                            </ul> 
                        </li>-->
						
						<!--<li>
                            <a href="#"><i class="fa fa-building" aria-hidden="true"></i> Distributer<span class="label label-important"><?=$all_dist?></span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("distributer","add")); ?>"><i class="fa fa-plus-square"></i> Add New</a>
                                </li> 
                                <li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("distributer","list")); ?>"><i class="fa fa-list-alt"></i> List</a>
                                </li> 
								
								
                            </ul>

                        </li>-->
						<!--<li>
                            <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchase<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								 
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("consignment","add")); ?>"><i class="fa fa-plus-square"></i> Add Purchase</a>
                                </li> 
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("consignment","list")); ?>"><i class="fa fa-list-alt"></i> Purchase List</a>
                                </li>
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("payment","add")); ?>"><i class="fa fa-money" aria-hidden="true"></i> Payment</a>
                                </li>
								
								
                            </ul>

                        </li>-->
						<li>
							<a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Report<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("reports","sale_report")); ?>"><i class="fa fa-list-alt"></i> Sale Report</a>
                                </li>
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("reports","list")); ?>"><i class="fa fa-list-alt"></i> General Report</a>
                                </li>
							</ul>
						</li>
						<!--<li>
							<a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Amount Status<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("final_calculation","list")); ?>"><i class="fa fa-list-alt"></i> List</a>
                                </li>
							</ul>
						</li>-->
						<!--<li>
							<a href="#"><i class="glyphicon glyphicon-book"></i> Ledger<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
                                    <a href="<?php echo common::get_component_link(array("purchase_ledger","list")); ?>"><i class="fa fa-list-alt"></i> Purchase Ledger</a>
                                </li>
								<li>
                                    <a href="<?php echo common::get_component_link(array("payment","add")); ?>"><i class="fa fa-list-alt"></i> Payment</a>
                                </li>
							</ul>
						</li>-->
						<!--<li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Point History<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo common::get_component_link(array("point_history","history-list")); ?>"><i class="fa fa-list-alt"></i> Point History</a>
                                </li> 
                            </ul>

                        </li>-->
                        <!-- <li>
                            <a href="#"><i class="glyphicon glyphicon-book"></i> Query<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo common::get_component_link(array("satisfaction","list")); ?>"><i class="fa fa-list-alt"></i>List</a>
                                </li> 
                            </ul>

                        </li>-->
                        
                       <!-- <li>
                            <a href="#"> <i class="fa fa-commenting-o" aria-hidden="true"></i> Send Notification<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li style="border-top:1px solid white !important;">
                                    <a href="<?php echo common::get_component_link(array("user_massage","sendmessage")); ?>"> User</a>
                                </li> 
                            </ul>

                        </li>-->
				<?php }?>
                    </ul>
                <?php 
				//}
				?>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
