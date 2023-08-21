<!DOCTYPE html>
<html>

<head>

<?php echo common::load_view("common","head"); ?>
   <link rel="stylesheet" href="i-css/jquery-ui.css">
   <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-list-alt"></i> Receipt List <div class="action pull-right">
    <!--<a href="<?php echo common::get_component_link(array("consignment","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>-->
</div>
</h1>
</div>
</div>
<div class="row">
  
    <div class="col-md-12">

<?php  if ( common::do_show_message() ) {
		          echo common::show_message();	
            }
			
			?> 
            
              <div class="dataTable_wrapper">
			  <div class="col-lg-12" style="margin-bottom: 25px;">
				<form  action="" method="post" enctype="multipart/form-data">
				<div class="col-lg-2">
							<!--<label for="text1" class="control-label col-lg-12 title_allign">Mobile Number</label>-->
					<input class="text-input form-control datepicker" type="text" name="form_date" autocomplete="off" id="form_date" value="<?=$start?>" placeholder="From Date"/>

				</div>
				<div class="col-lg-2">
							<!--<label for="text1" class="control-label col-lg-12 title_allign">Mobile Number</label>-->
					<input class="text-input form-control datepicker" type="text" name="to_date" autocomplete="off" id="to_date" value="<?=$end?>" placeholder="To Date"/>
					<input type="hidden" name="user_type" id="user_type" value="" />

				</div>
				<div class="col-lg-2">
					<input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="search" value="Search" />

				</div>
				</form>
			  </div>
				 <div class="form-group dataTables_filter">
					  <select name="distributer" id="distributer" name="user" class="form-control input-sm">
						  <option value="">User Type</option> 
							
							<option value="General" <?php if($user_type=="General") echo"selected";?>>General</option>  
							<option value="Registered" <?php if($user_type=="Registered") echo"selected";?>>Registered</option> 
							
						  </select>
				</div>            
							<div id="table_content">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                       <tr>
											 <th>Invoice No.</th>
                                            <th style="width:150px;">Name</th>
											<th>No. Item</th>
											<th>Discount</th>
											<th>Amount</th>
											<th>MOD</th>
                                            <th>Invoice Date</th> 
											<th style="width:200px;">Remark</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody id ="ebdy_content">
									<?php 
									if($data)
									{	
										foreach($data as $d)
										{ 
												$order_id=$d['id'];
												$total_amount=$d["totalprice"];
												$discount=$d["discount"];
												if($discount)
												{
													$final_amount=$total_amount-$discount;
												}
												else
												{
													$final_amount=$total_amount;
												}
												$invoice_date=$d["invice_date"];
												if($invoice_date!="0000-00-00")
												{
													$date_display=date("d-M-Y",strtotime($invoice_date));
												}
												else
												{
													$date_display=$invoice_date;
												}
												if($type_for_edit=="General")
												{
													$sel_other_details= new Query();
													$sel_other_details->select("payment_mode")
													->from(TBL_ORDER_BASIC_DETAILS)
													->where_equal_to(array('o_id'=>$order_id))
													->limit(1)
													->run();
													
													$sel_user_details= new Query();
													$sel_user_details->select("name")
													->from(TBL_USER_INFORMATION)
													->where_equal_to(array('order_id'=>$order_id))
													->limit(1)
													->run();
												}	
												if($type_for_edit=="Registered")
												{
													$sel_other_details= new Query();
													$sel_other_details->select("payment_mode")
													->from(TBL_REGISTER_OTHER_BASIC_DETAILS)
													->where_equal_to(array('o_id'=>$order_id))
													->limit(1)
													->run();
													
													$sel_user_details= new Query();
													$sel_user_details->select("name")
													->from(TBL_REGISTER_BILLING_ADDRESS)
													->where_equal_to(array('order_id'=>$order_id))
													->limit(1)
													->run();
												}
												$other_data=$sel_other_details->get_selected();
												$mod=$other_data['payment_mode'];
												
												$user_data=$sel_user_details->get_selected();
												$user_anme=$user_data['name'];
												
										?>
											 <tr>
											 <form action="" method="post">
											
												<!--<td><?php echo $d["recipt_no"]; ?></td>-->                                             
												<td><?php echo $d["recipt_no"];?></td>
												<td><?php echo ucfirst($user_anme);?></td>
												<!--<td><?php echo $all_product;?></td>-->
												<td><?php echo $d["totalitem"];?></td>
												<td><?php echo $discount;?></td>
												<td><?php echo round($final_amount);?></td>
												<td><?php echo ucfirst($mod);?></td>
												<td><?php echo $date_display;?></td>
												<td style="width:200px;"><?php echo $d["order_remark"];?></td>
												
												<td class="center" >
												<!--<a href="<?php echo common::get_component_link(array('add_order','details'),array("id"=>$d['id'],"type"=>$d['user_type'])); ?>" class="btn btn-default" target="_blank"  title="Details"><i class="glyphicon glyphicon-list"></i> Invoice </a>-->
												<a href="<?php echo common::get_component_link(array('add_order','details'),array("id"=>$d['id'],"type"=>$d['user_type'])); ?>" class="btn btn-primary" target="_blank"  title="Details">View</a>
												<a class="btn btn-primary" href="<?php echo common::get_component_link(array('add_order','edit_products_details'),array("id"=>$d['id'],"type"=>$type_for_edit,"order_type"=>'old')); ?>" class="btn btn-sm" title="Edit">Edit</a>
												<a class="btn btn-primary" href="<?php echo common::get_component_link(array('add_order','download_pdf_formate'),array("id"=>$d['id'],"type"=>$type_for_edit)); ?>" class="btn btn-sm" title="Edit">Pdf</a>
												<a onclick="return confirm('Confirm to Cancel Order?')" href="<?php echo common::get_component_link(array('add_order','delete'),array("id"=>$d['id'],"type"=>$d['user_type'])); ?>" class="btn btn-primary"  title="Delete">Cancel</a>
												<!--<a onclick="return confirm('Are you sure Delete?')" href="<?php echo common::get_component_link(array('add_order','delete'),array("id"=>$d['id'],"type"=>$d['user_type'])); ?>" class="btn btn-primary"  title="Delete"><i class="glyphicon glyphicon-remove"></i></a>--> 
											 </td>
											 </form>
											</tr>
									<?php }
								
								} else {?>
									
									<tr>
									<td>No Record Found</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									</tr>
								<?php } ?>	
                                   
                                    </tbody>
                                </table>
							</div>	
                                   <?php
										$max_date=date("Y-m-d");
										$min_date = date("Y-m-d", strtotime('-1 day', time()));
								?>
                            </div>
 

    </div>
    
</div>

            
            
</div>
</div>
<!--<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
    "bSort": false,
	"searching": false,
  });
       
    });
</script>-->
<?php echo common::load_view("common","footer"); ?>


   <script src="i-js/jquery-ui.js"></script>
   <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
<!--<script src="i-js/jquery-ui.js"></script>-->
<script>

$(function(){
	
$("#distributer").change(function(){
		//alert("hello");
		var date_val = $("#distributer").val();
		//alert(date_val);
		//return false;
		$("#user_type").val(date_val);
		var start_date = $("#form_date").val();
		var to_date = $("#to_date").val();
		if(start_date=="" && to_date=="")
		{
			if(date_val=="General")
			{
				window.location.replace ('<?php echo common::get_component_link(array("add_order","list"),array("user_type"=>'General')); ?>');
			}
			if(date_val=="Registered")
			{
				window.location.replace('<?php echo common::get_component_link(array("add_order","list"),array("user_type"=>'Registered')); ?>');
			}
			
			/*var data='dt=' + date_val;
				$.ajax({
					url: '<?php echo common::get_component_link(array("add_order","user_search_handler")); ?>',
					type: 'POST',
					data: data,
					cache: false,
					success: function(data)
					{
						//alert(data);
						$("#ebdy_content").html(data);
						//$("#table_content").html(data);
						
					}
				});
				*/
		}	
			
	});


// Search validation.................................	
		$("#final_done").click(function()
		{
			
			var start_date = $("#form_date").val();
			var to_date = $("#to_date").val();
			var type = $("#distributer").val();
			
			if(start_date=="")
			{ alert("please provide From Date"); return false;}
			else if(to_date=="")
			{ alert("please provide To Date"); return false;}
			else if(type=="")
			{ alert("please Select User Type"); return false;}


		});
		
		 $( '#table_content' ).on( 'click', '.delete', function () {
			 var result=confirm("Confirm to Cancel Order?");
			if(result==true)
			{
				return true;
			}
			else
			{
				return false;
			}
		 });

});
  </script>
  
</body>

</html>
