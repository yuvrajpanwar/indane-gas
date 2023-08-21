<!DOCTYPE html>
<html>

<head>
<?php 
echo common::load_view("common","head"); 

?>
<style>
.add_delete_box
{
	width: 5%;
	float: left;
	position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
}
.row_con_mrg
{
	margin-bottom: 35px;
}
.sel_distri
{
	display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.title_allign
{
	text-align: left !important;
}
</style>
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><i class="fa fa-plus-square"></i> Generate Receipt
		<!--<div class="action pull-right">
		    <a href="<?php echo common::get_component_link(array("add_order","list")); ?>" class="btn btn-primary btn-small"><i class="fa fa-list"></i> List </a>
		</div>-->
		</h1>
	</div>
</div>
<div class="row">
    <div class="col-md-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle fa-fw"></i> Add Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
			<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				   
			<div class="col-lg-12" id="row_container">		
                    <div class="form-group row_con_mrg">
						<div class="col-lg-4">
							<label>Security Deposit Cylinder</label>
							<input class="text-input form-control" type="hidden" name="cylinder_name" value="Security Deposit cylinder" autocomplete="off" id="cylinder_name" placeholder="Security Deposit cylinder" readonly />
						</div>
						<div class="col-lg-2">
							<input class="text-input form-control" type="text" name="cylinder_rate" value="<?=$cylinder_rate?>" autocomplete="off" id="cylinder_rate" placeholder="SUM"/>

						</div>
						<div class="col-lg-2">
						<label>Cylinder Count</label>
						</div>
						<div class="col-lg-1" style="width: 95px;">
						<select name="cylinder_pice" id="cylinder_pice" class="cylinder_pice form-control">
							<?php
							  for($j=1;$j<=10;$j++)
							  {
								   if($cylinder_quantity==$j)
								   {
									    echo"<option value='$j' selected>$j</option>";
								   }
								   else
								   {
									    echo"<option value='$j'>$j</option>";
								   }
								 
							  }
							?>
							
						
						</select>
						</div>
					</div>
					
					<div class="form-group row_con_mrg">
						<div class="col-lg-4">
							<label>Security Deposit Regulator</label>
							<input class="text-input form-control" type="hidden" name="regulator_name" value="Security Deposit regulator" autocomplete="off" id="regulator_name" placeholder="Security Deposit regulator" readonly />
						</div>
						<div class="col-lg-2">
							<input class="text-input form-control" type="text" name="regulator_rate" value="<?=$regulator_rate?>" autocomplete="off" id="regulator_rate" placeholder="SUM"/>

						</div>
						<div class="col-lg-2">
						<label>Regulator Count</label>
						</div>
						<div class="col-lg-1" style="width: 95px;">
						<select name="regulator_pice" id="regulator_pice" class="form-control">
							<?php
							  for($k=1;$k<=10;$k++)
							  {
								  if($regulator_quantity==$k)
								  {
									  echo"<option value='$k' selected>$k</option>";
								  }
								  else
								  {
									  echo"<option value='$k'>$k</option>";
								  }
								  
							  }
							?>
							
						
						</select>
						</div>
					</div>
					
					<!--<div class="form-group row_con_mrg">
						<div class="col-lg-6">
							<label>Select User Type</label>
							<select class="text-input form-control" name="user_type" id="user_type">
							<option value="">Select User Type</option>
							<option value="General">General</option>
							<option value="Registered">Registered</option>
							</select>
						</div>
					</div>-->
					
					
					<div class="form-group row_con_mrg" id="rowCount0">
						<h4><b>Product Details</b></h4>
								<?php
									$q = new Query();
									$q->select()
									->from(TBL_PRODUCTS)
									->where_equal_to(array('admin_id'=>$login_id))
									->run();
									$disti=  $q->get_selected();
								?>
									<div class="form-group">
										
									<!--<table class='table invite_contact_list'>-->
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover" id="" >
												<thead>
													<tr>
														<th>Name</th><th>Rate</th><th>CGST</th><th>SGST</th><th>Amount</th><th>Qty</th>
													</tr>
												</thead>
												<tbody>
												<tr class="odd gradeX">
													<td><input type='checkbox' name='all' id='allcheck' value="all"> All</td>
													<td></td>
													<td></td>
												</tr>
												<?php 
												foreach ($disti as $catename)
												{
													$id=$catename["id"];
													$rate=$catename["price"];
													$cgst_tax=$catename["cgst_tax"];
													$sgst_tax=$catename["sgst_tax"];
													$status=$catename["status"];
													$cgst_amount=$rate*$cgst_tax/100;
													$sgst_amount=$rate*$sgst_tax/100;
													
													$amount=$rate+$cgst_amount+$sgst_amount;
													if($user_type=="General")
													{
														$order_item = new Query();
														$order_item->select()
														->from(TBL_ORDER_ITEM)
														->where_equal_to(array('order_id'=>$order_id,'product_id'=>$id))
														->limit(1)
														->run();

													}
													if($user_type=="Registered")
													{
														$order_item = new Query();
														$order_item->select()
														->from(TBL_REGISTER_ORDER_ITEM)
														->where_equal_to(array('order_id'=>$order_id,'product_id'=>$id))
														->limit(1)
														->run();
													}
													
													
													$order_item_data=  $order_item->get_selected();
													$item_qua=$order_item_data['qty'];
													if($status==0)
													{

														if($order_item_data)
														{

												?>  
												<tr class="odd gradeX">
														<td>
															<input type='checkbox' name='pro_name[]' checked class='contact_check roles' id="product-<?=$id?>" value='<?php echo $catename["id"]; ?>'> <?php echo ucfirst($catename["title"]); ?>
														</td>
														<?php
															if($order_item_data)
															{
																$get_rate=$order_item_data['rate'];
																$get_qty=$order_item_data['qty'];
																$rateamount=$get_rate*$get_qty;
																$get_cgst_amount=$order_item_data['cgst_amount'];
																$get_sgst_amount=$order_item_data['sgst_amount'];
																$get_total_amount=$order_item_data['price'];
														?>
														<td>
														<label id="price_lb-<?=$id?>"><?php echo $rateamount; ?></label>
														
														</td>
														
														<td>
														<label id="cgst_lb-<?=$id?>"><?php echo $get_cgst_amount; ?></label>
														</td>
														
														<td>
														<label id="sgst_lb-<?=$id?>"><?php echo $get_sgst_amount; ?></label>
														</td>
														
														<td>
														<label id="total_amount_lb-<?=$id?>"><?php echo $get_total_amount; ?></label>
														</td>
														<?php } else {?>
														<td>
														<label id="price_lb-<?=$id?>"><?php echo $catename["price"]; ?></label>
														
														</td>
														
														<td>
														<label id="cgst_lb-<?=$id?>"><?php echo $cgst_amount; ?></label>
														</td>
														
														<td>
														<label id="sgst_lb-<?=$id?>"><?php echo $sgst_amount; ?></label>
														</td>
														
														<td>
														<label id="total_amount_lb-<?=$id?>"><?php echo $amount; ?></label>
														</td>
														<?php }?>
														
														<td>
														<select name="<?=$id?>" class="total_pices" id="total_pices-<?=$id?>">
															<?php
															  for($i=1;$i<=200;$i++)
															  {
																  if($item_qua==$i)
																  {
																	  echo"<option value='$i' selected>$i</option>";
																  }
																  else
																  {
																	  echo"<option value='$i'>$i</option>";
																  }
																  
															  }
															?>
															
														
														</select></td>
													</tr>
												<?php
														} 
												}else
												{
												?>
												<tr class="odd gradeX">
													<td>
														<?php
															if($order_item_data)
															{
														?>
														<input type='checkbox' name='pro_name[]' checked class='contact_check roles' id="product-<?=$id?>" value='<?php echo $catename["id"]; ?>'> <?php echo ucfirst($catename["title"]); ?>
														
														<?php } else {?>
														<input type='checkbox' name='pro_name[]' class='contact_check roles' id="product-<?=$id?>" value='<?php echo $catename["id"]; ?>'> <?php echo ucfirst($catename["title"]); ?>

														<?php }?>
													</td>
													<?php
														if($order_item_data)
														{
															$get_rate=$order_item_data['rate'];
															$get_qty=$order_item_data['qty'];
															$rateamount=$get_rate*$get_qty;
															$get_cgst_amount=$order_item_data['cgst_amount'];
															$get_sgst_amount=$order_item_data['sgst_amount'];
															$get_total_amount=$order_item_data['price'];
													?>
													<td>
													<label id="price_lb-<?=$id?>"><?php echo $rateamount; ?></label>
													
													</td>
													
													<td>
													<label id="cgst_lb-<?=$id?>"><?php echo $get_cgst_amount; ?></label>
													</td>
													
													<td>
													<label id="sgst_lb-<?=$id?>"><?php echo $get_sgst_amount; ?></label>
													</td>
													
													<td>
													<label id="total_amount_lb-<?=$id?>"><?php echo $get_total_amount; ?></label>
													</td>
													<?php } else {?>
													<td>
													<label id="price_lb-<?=$id?>"><?php echo $catename["price"]; ?></label>
													
													</td>
													
													<td>
													<label id="cgst_lb-<?=$id?>"><?php echo $cgst_amount; ?></label>
													</td>
													
													<td>
													<label id="sgst_lb-<?=$id?>"><?php echo $sgst_amount; ?></label>
													</td>
													
													<td>
													<label id="total_amount_lb-<?=$id?>"><?php echo $amount; ?></label>
													</td>
													<?php }?>
													
													<td>
													<select name="<?=$id?>" class="total_pices" id="total_pices-<?=$id?>">
														<?php
														  for($i=1;$i<=200;$i++)
														  {
															  if($item_qua==$i)
															  {
																  echo"<option value='$i' selected>$i</option>";
															  }
															  else
															  {
																  echo"<option value='$i'>$i</option>";
															  }
															  
														  }
														?>
														
													
													</select></td>
												</tr>
												
												<?php } }?>
											</table>
										</div>
									</div>
									
							<div class="form-group">
								<div class="col-lg-4">
									<label>Discount</label>
									<input class="text-input form-control" type="text" name="discount" value="<?=$discount?>" autocomplete="off" id="discount" placeholder="Discount"/>
								</div>
							</div>
								
                    </div>
				</div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
						<a class="col-md-6"></a>
						<input class="btn col-md-6 btn-primary" id="final_done" type="submit" name="add" value="Update" />
						</div>
						<div class="col-lg-6">
						<a href="<?php echo $next_url; ?>" class="btn col-md-6 btn-primary">Next</a>
						</div>
						
						
					</div>
					
            </form>
</div>
</div>

    </div>
    

    
</div>

            
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
<?php echo common::load_view("common","load_editor"); ?>


<script>


$(function(){
	
	$("#final_done").click(function(){
		var user_type = $("#user_type").val();
		var regulator_rate = $("#regulator_rate").val();
		
		if(user_type=="")
		{
			alert("Please Select User Type");
			return false;
		}
		
		if($('.roles:checkbox:checked').length ==0)
		{
			alert("please Select at least one Product");
			return false;
		}	
		/*for(i=0; i < rowCount; i++)
		{
			//alert();
			if($("#product_container-"+i).val()=="")
			{
				alert("please provide product Name");
				return false;
			}
			if($("#total_pices-"+i).val()=="")
			{
				alert("please provide Total Qty");
				return false;
			}
		}*/
		


	});
	
	$(".mode_control").click(function(){
		//alert("hello");
		
		if($('.mode_control').is(":checked"))
		{
			var mode=$('input[name=mode]:checked').val();
			if(mode=="cash" || mode=="card")
			{
				$("#check_number").hide();
			}
			if(mode=="Cheque")
			{
				$("#check_number").show();
			}
		}	
		//if($('#check_link').is(":checked"))   
        //$("#check_number").show();
        

	});
	
	$("#allcheck").click(function(){
	//alert("here");
	
		if($("#allcheck").is(":checked")) {
		$(".contact_check").prop('checked', true);
		}
		else
		{
		$(".contact_check").prop('checked', false);
		}
	
	});	
	
	
$(".total_pices").change(function(){
	
	var id_of_gm_qty=$(this).attr("id");
	var pices=$("#"+id_of_gm_qty).val();
	var get_id = id_of_gm_qty.split('-');
	var count = get_id[1];
	var product_id =$("#product-"+count).val();

	if(product_id!="")
	{	
		var data = 'pro_id=' + product_id+'&pcs=' + pices;
		//alert(data);
		$.ajax({
			//this is the php file that processes the data and send mail
			url: '<?php echo common::get_component_link(array("add_order","calculate_amount_handler")); ?>',
			type: "POST",		
			data: data,		
			cache: false,
			success: function (html) {
			 //alert(html);
			 //var amount = parseInt(pices)*parseInt(html);
				if(html)
				{
					var get_return_value = html.split('-');
					//alert(get_return_value);
					var rate= get_return_value[0];
					var cgst=get_return_value[1];
					var sgst=get_return_value[2];
					var total=get_return_value[3];
					
					$("#price-"+count).val(rate);
					$("#cgst-"+count).val(cgst);
					$("#sgst-"+count).val(sgst);
					$("#total_amount-"+count).val(total);
					
					$("#price_lb-"+count).html(rate);
					$("#cgst_lb-"+count).html(cgst);
					$("#sgst_lb-"+count).html(sgst);
					$("#total_amount_lb-"+count).html(total);
				}
			}
		});//End Ajax
	}
	
});

/* change the quantity of the refill */

$("#cylinder_pice").change(function(){
	var product_to_change = <?=$refill_charges_product_id?>;
	var change=$("#total_pices-<?=$refill_charges_product_id?>").val();
	var qty=$("#cylinder_pice").val();
	$("#total_pices-<?=$refill_charges_product_id?>").val(qty).change();	
});	
	
});
                                
</script>

</body>

</html>
