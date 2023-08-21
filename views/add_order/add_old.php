<!DOCTYPE html>
<html>

<head>
<?php 
echo common::load_view("common","head"); 

?>
<link rel="stylesheet" href="i-css/jquery-ui.css">
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
							<label>Security Deposit For All Cylinder</label>
							<input class="text-input form-control" type="hidden" name="cylinder_name" value="Security Deposit cylinder" autocomplete="off" id="cylinder_name" placeholder="Security Deposit cylinder" readonly />
						</div>
						<div class="col-lg-2">
							<input class="text-input form-control" type="text" name="cylinder_rate" value="" autocomplete="off" id="cylinder_rate" placeholder="SUM"/>
							
						</div>
						<div class="col-lg-2">
						<label>Cylinder Count</label>
						</div>
						<div class="col-lg-1" style="width: 95px;">
						<select name="cylinder_pice" id="cylinder_pice" class="cylinder_pice form-control">
							<?php
							  for($j=1;$j<=50;$j++)
							  {
								  echo"<option value='$j'>$j</option>";
							  }
							?>
							
						</select>
						</div>
					</div>
					
					<div class="form-group row_con_mrg">
						<div class="col-lg-4">
							<label>Security Deposit For All Regulator</label>
							<input class="text-input form-control" type="hidden" name="regulator_name" value="Security Deposit regulator" autocomplete="off" id="regulator_name" placeholder="Security Deposit regulator" readonly />
						</div>
						<div class="col-lg-2">
							<input class="text-input form-control" type="text" name="regulator_rate" value="" autocomplete="off" id="regulator_rate" placeholder="SUM"/>

						</div>
						<div class="col-lg-2">
						<label>Regulator Count</label>
						</div>
						<div class="col-lg-1" style="width: 95px;">
						<select name="regulator_pice" id="regulator_pice" class="form-control">
							<?php
							  for($j=1;$j<=50;$j++)
							  {
								  echo"<option value='$j'>$j</option>";
							  }
							?>
							
						</select>
						</div>
					</div>
					
					<div class="form-group row_con_mrg">
						<div class="col-lg-6">
							<label>Select User Type</label>
							<select class="text-input form-control" name="user_type" id="user_type">
							<option value="">Select User Type</option>
							<option value="General">General</option>
							<option value="Registered">Registered</option>
							</select>
						</div>
					</div>
					
					
					<div class="form-group row_con_mrg" id="rowCount0">
						<h4><b>Product Details</b></h4>
								<?php
									$q = new Query();
									$q->select()
									->from(TBL_PRODUCTS)
									->where_equal_to(array('admin_id'=>$login_id,'status'=>1))
									->order_by("title asc")
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
												$count=1;
												foreach ($disti as $catename)
												{
													$id=$catename["id"];
													$rate=$catename["price"];
													$cgst_tax=$catename["cgst_tax"];
													$sgst_tax=$catename["sgst_tax"];
													
													$cgst_amount=$rate*$cgst_tax/100;
													$sgst_amount=$rate*$sgst_tax/100;
													
													$amount=$rate+$cgst_amount+$sgst_amount;

												?>  
												<tr class="odd gradeX">
													<td>
													<input type='checkbox' name='pro_name[]' class='contact_check roles' id="product-<?=$count?>" value='<?php echo $catename["id"]; ?>'> <?php echo ucfirst($catename["title"]); ?>
													
													</td>
													
													<td>
													<label id="price_lb-<?=$count?>"><?php echo $catename["price"]; ?></label>
													<!--<input type="hidden" name="price[]" id="price-<?=$id?>" value="<?php echo $catename["price"]; ?>" readonly>
													<input type="hidden" name="per_rate[]" id="" value="<?php echo $catename["price"]; ?>" readonly>
													<input type="hidden" name="cgst_tax[]" id="" value="<?php echo $catename["cgst_tax"]; ?>" readonly>
													<input type="hidden" name="sgst_tax[]" id="" value="<?php echo $catename["sgst_tax"]; ?>" readonly>-->
													</td>
													
													<td>
													<label id="cgst_lb-<?=$count?>"><?php echo $cgst_amount; ?></label>
													<!--<input type="hidden" name="cgst[]" id="cgst-<?=$id?>" value="<?php echo $cgst_amount; ?>" readonly>-->
													</td>
													
													<td>
													<label id="sgst_lb-<?=$count?>"><?php echo $sgst_amount; ?></label>
													<!--<input type="hidden" name="sgst[]" id="sgst-<?=$id?>" value="<?php echo $sgst_amount; ?>" readonly>-->
													</td>
													
													<td>
													<label id="total_amount_lb-<?=$count?>"><?php echo $amount; ?></label>
													<!--<input type="hidden" name="total_amount[]" id="total_amount-<?=$id?>" value="<?php echo $amount; ?>" readonly >-->
													</td>
													
													<td>
													<!--<input type="hidden" name="amount" value="<?=$amount?>">-->
													<select name="<?=$id?>" class="total_pices total_pices-<?=$id?>" id="total_pices-<?=$count?>">
														<?php
														  for($i=1;$i<=200;$i++)
														  {
															  echo"<option value='$i'>$i</option>";
														  }
														?>
														
													
													</select></td>
												</tr>
												<?php
												$count++;
												}
												?>
											</table>
										</div>
									</div>
									
							<div class="form-group">
								<div class="col-lg-4">
									<label>Discount</label>
									<input class="text-input form-control" type="text" name="discount" value="" autocomplete="off" id="discount" placeholder="Discount"/>
								</div>
							</div>
								
                    </div>
					<div class="col-lg-12">
						<div class="col-lg-6">
						</div>
                        <div class="col-lg-6">
						<!--<input class="btn col-md-12 btn-primary" id="final_done" type="submit" name="add" value="Next" />-->
						<a class="btn col-md-12 btn-primary" id="products_sceren_next">Next</a>
						</div>
						
					</div>
				</div>
				<div class="col-lg-12" id="userdetails_container" style="display:none;">
					<h4><b>User Details</b></h4>
					<div class="form-group row_con_mrg">
					
					<h5>Billing Address</h5>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_name" value="" autocomplete="off" id="billing_name" placeholder="Name"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_number" value="" autocomplete="off" id="billing_number" placeholder="Mobile Number"/>

						</div>
						
						
					</div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_address" value="" autocomplete="off" id="billing_address" placeholder="Address"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_state" value="Uttarakhand" autocomplete="off" id="billing_state" readonly placeholder="State"/>
						</div>
					 
					 </div>
					 <div class="col-lg-12">
						<div class="col-lg-6">
							<a class="btn col-md-12 btn-primary" id="back_product_details">Back</a>
						</div>
                        <div class="col-lg-6">
						<!--<input class="btn col-md-12 btn-primary" id="final_done" type="submit" name="add" value="Next" />-->
						<a class="btn col-md-12 btn-primary" id="user_sceren_next">Next</a>
						</div>
						
					</div>
				</div>
				
				<div class="col-lg-12" id="invoice_details_container" style="display:none;">
					<h4><b>Invoice Detail</b></h4>
				
					<div class="form-group row_con_mrg">
						<div class="col-lg-6">
							 <label>Invoice Date </label>
							<input class="text-input form-control datepicker" type="text" name="invoice_date" value="" autocomplete="off" id="invoice_date" placeholder="Invoice Date"/>
							<input type="hidden" name="hdninvoice_date" id="hdninvoice_date" value="">
						</div>
						<div class="col-lg-6">
							<label>Reverse Charge </label>
							<select class="text-input form-control" name="r_charge" id="r_charge">
							<option value="No">No</option>
							<option value="Yes">Yes</option>
							</select>

						</div>
						
						
					</div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<label>Connection Type </label>
							<select class="text-input form-control" name="con_type" id="con_type">
							<option value="">Select Connection Type</option>
							<option value="NC">NC</option>
							<option value="DBC">DBC</option>
							<option value="Incoming TV">Incoming TV</option>
							<option value="NC-DBC">NC-DBC</option>
							<option value="Other">Other</option>
							</select>
						</div>
						<div class="col-lg-6">
							<label>SV Number </label>
							<input class="text-input form-control" type="text" name="sv_numver" value="" autocomplete="off" id="sv_numver" placeholder="SV Number"/>
						</div>
					 
					 </div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<label>Consumer Number </label>
							<input class="text-input form-control" type="text" name="consumer_number" value="" autocomplete="off" id="consumer_number" placeholder="Consumer Number"/>
						</div>
						<div class="col-lg-6">
							<label>Cust. GST Number </label>
							<input class="text-input form-control" type="text" name="gst_number" value="" autocomplete="off" id="gst_number" placeholder="Cust. GST Number"/>
						</div>
					 
					 </div>
					 
					<div class="form-group row_con_mrg">
							<div class="col-lg-6">
								<label for="text1" class="control-label col-lg-12" style="text-align: left;">Mode of payment</label>
								<input class="mode_control" type="radio" name="mode" value="cash" style="width: 40px; height: 1.2em;">Cash
								
								<input class="mode_control" type="radio" name="mode" id="bank_link" value="Bank" style="margin-left:15px; width: 40px; height: 1.2em;">Bank
								
								<input class="mode_control" type="radio" name="mode" id="both_link" value="Both" style="margin-left:15px; width: 40px; height: 1.2em;">Both
								
								<input class="mode_control" type="radio" name="mode" id="" value="Credit" style="margin-left:15px; width: 40px; height: 1.2em;">Credit
								

							</div>
							<div class="col-lg-6">
								<label>Remark </label>
								<textarea class="form-control col-lg-12" name="remark_text" ></textarea>
							</div>
					</div>
					<div class="form-group amount_block" style="display:none;">
					<label>Total Amount:  <label id="order_amounts"></label></label>
					</div>
					<div class="form-group amount_block" style="display:none;">
						
						<div class="col-lg-6">
							<label>Cash Amount </label>
							<input type="hidden" name="total_amount" id="total_amount" value="">
							<input class="text-input form-control" type="text" name="cash_amount" value="" autocomplete="off" id="cash_amount" placeholder="Cash Amount"/>
						</div>
						<div class="col-lg-6">
							<label>Bank Amount </label>
							<input class="text-input form-control" type="text" name="bank_amount" value="" autocomplete="off" id="bank_amount" placeholder="Bank Amount"/>
						</div>
					 
					 </div>
					 
					 <div class="col-lg-12">
						<div class="col-lg-6">
							<a class="btn col-md-12 btn-primary" id="back_user_details">Back</a>
						</div>
                        <div class="col-lg-6">
							<input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="add" value="Done" />
						</div>
						
					</div>
				
				</div>
				
                    <!--<div class="col-lg-12">
                        <div class="col-lg-4">
						</div>
						<input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="add" value="Next" />
					</div>-->
					
            </form>
</div>
</div>

    </div>
    

    
</div>

            
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
<?php echo common::load_view("common","load_editor"); ?>
<script src="i-js/jquery-ui.js"></script>
   <script>
  $( function() {
	  
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
	
	
  } );
  </script>

<script>


$(function(){
	var clickedOnce = false;
	$("#products_sceren_next").click(function(){
		var user_type = $("#user_type").val();
		var regulator_rate = $("#regulator_rate").val();
		
		if(user_type=="")
		{
			alert("Please Select User Type");
			return false;
		}
		else if($('.roles:checkbox:checked').length ==0)
		{
			alert("please Select at least one Product");
			return false;
		}
		else
		{
			/*$("#row_container").hide();
			$("#invoice_details_container").hide();
			$("#userdetails_container").show();
			*/
			var order_amount=0;
			var total_product=$('.roles:checkbox:checked').length;
			//alert(total_product);
			for(i=1; i <= total_product+1; i++)
			{
				
				if($('input#product-'+i).is(':checked'))
				{
					var amount=$("#total_amount_lb-"+i).html();
					//order_amount=parseFloat(order_amount)+parseFloat(amount);
					order_amount=parseFloat(order_amount)+parseFloat(amount);
					
				}
				
				
				
				//alert(amount);
				
				//var amount=$("#total_amount_lb-"+i).html();
				
				//order_amount=parseFloat(order_amount)+parseFloat(amount);
				//order_amount=parseFloat(order_amount)+parseFloat(amount);
				
			}
			//alert(order_amount);
			//return false;
			
			var cylinder_amount=$("#cylinder_rate").val();
			if(cylinder_amount)
			{
				order_amount=parseFloat(order_amount)+parseFloat(cylinder_amount);
			}
			var regulator_amount=$("#regulator_rate").val();
			if(regulator_amount)
			{
				order_amount=parseFloat(order_amount)+parseFloat(regulator_amount);
			}
			
			var order_discount=$("#discount").val();
			if(order_discount)
			{
				order_amount=parseFloat(order_amount)-parseFloat(order_discount);
			}
			
			
			//order_amount = order_amount.toFixed(2);
			order_amount = Math.round(order_amount);
			//Math.round(2.5);
			//alert(order_amount);
			$("#order_amounts").html(order_amount);
			$("#total_amount").val(order_amount);
			
			//regulator_rate
			//alert(order_amount);
			
			$("#row_container").hide();
			$("#invoice_details_container").hide();
			$("#userdetails_container").show();
			document.body.scrollTop = document.documentElement.scrollTop = 0;
			
		}	
		
		


	});
	
	$("#back_product_details").click(function(){
		$("#userdetails_container").hide();
		$("#invoice_details_container").hide();
		$("#row_container").show();
	});
	
	$("#back_user_details").click(function(){
		$("#userdetails_container").show();
		$("#invoice_details_container").hide();
		$("#row_container").hide();
	});
	
	
	
	$("#user_sceren_next").click(function(){
		var decider = $("#decider").val();
		var billing_name = $("#billing_name").val();
		var billing_number = $("#billing_number").val();
		var billing_address = $("#billing_address").val();
		var billing_state = $("#billing_state").val();
		
		if(billing_name=="")
		{
			alert("please Provide Billing Name");
			return false;
		}
		else if(billing_address =="")
		{
			alert("please Provide Billing Address");
			return false;
		}
		else if(billing_state =="")
		{
			alert("please Provide Billing State");
			return false;
		}
		else
		{
			$("#userdetails_container").hide();
			$("#row_container").hide();
			$("#invoice_details_container").show();
		}	
		
		

	});
	
	
	$("#final_done").click(function(){
		
		if(clickedOnce) {
			return false;
		}
		
		var invoice_date = $("#invoice_date").val();
		var hdninvoice_date = $("#hdninvoice_date").val();
		var con_type = $("#con_type").val();
		var res = invoice_date.split("-");
		var change_invoice_formate=res[2]+"-"+res[1]+"-"+res[0];
		var res1 = hdninvoice_date.split("-");
		var change_max_date=res1[2]+"-"+res1[1]+"-"+res1[0];
		
		
		if(invoice_date=="" || invoice_date=="00-00-0000")
		{
				alert("please Select Invoice Date");
				return false;
		}
		else if( (new Date(change_max_date).getTime() > new Date(change_invoice_formate).getTime()))
		{
			
					alert("You can not create invoice of date less than "+hdninvoice_date);
					return false;
			
		}
		else if(con_type=="")
		{
			alert("please Select Content Type");
			return false;
		}
		/*else if($('.mode_control:checkbox:checked').length ==0)
		{
			alert("Please select Mod Of Payment");
			return false;
		}*/
		
		
		if($('.mode_control').is(":checked"))
		{
			var mode=$('input[name=mode]:checked').val();
			if(mode=="Both")
			{
				var cash_amount = $("#cash_amount").val();
				var bank_amount = $("#bank_amount").val();
				if(cash_amount=="")
				{
					alert("Please provide Cash Amount.");
					return false;
				}
				else if(bank_amount=="")
				{
					alert("Please provide Bank Amount.");
					return false;
				}	
			}
			
		}
		else
		{
			alert("Please select Mode Of Payment");
			return false;
			
		}
		// disable buttion
		//$('#final_done').attr('disabled', 'disabled');
		clickedOnce = true;
		return true;

	});
	
	
	$(".mode_control").click(function(){
		if($('.mode_control').is(":checked"))
		{
			var mode=$('input[name=mode]:checked').val();
			if(mode=="Both")
			{
				$(".amount_block").show();
			}
			else
			{
				$(".amount_block").hide();
			}
			/*if(mode=="Cheque")
			{
				$("#cash_amount").hide();
			}*/
		}
        

	});
	
	
		$("#invoice_date").change(function(){
		
		var invoice_date = $("#invoice_date").val();
		var hdninvoice_date = $("#hdninvoice_date").val();
		var res = invoice_date.split("-");
		var change_invoice_formate=res[2]+"-"+res[1]+"-"+res[0];
		var res1 = hdninvoice_date.split("-");
		var change_max_date=res1[2]+"-"+res1[1]+"-"+res1[0];
		if( (new Date(change_max_date).getTime() > new Date(change_invoice_formate).getTime()))
		{
			
			alert("You can not create invoice of date less than "+hdninvoice_date);
			$("#invoice_date").val(hdninvoice_date);
			return false;
			
		}
	});
	
	$("#cash_amount").change(function(){
		var total_amount=$("#total_amount").val();
		var cash_amount=$("#cash_amount").val();
		if(total_amount!="" && cash_amount!="")
		{
			var amount=parseInt(total_amount)-parseInt(cash_amount);
			
			$("#bank_amount").val(amount);
		}

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
	                 //alert(html);
					var get_return_value = html.split('-');
					//alert(get_return_value);
					var rate= get_return_value[0];
					var cgst=get_return_value[1];
					var sgst=get_return_value[2];
					var total=get_return_value[3];
					//alert(sgst);
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

/*$(".cylinder_pice").change(function(){
	var qty=$(".cylinder_pice").val();
	var rate=$("#cylinder_rate").val();
	var amount=parseInt(qty)*parseInt(rate);
	$("#cylinder_rate").val(amount);
	
});	*/

/* change the quantity of the refill */

$("#cylinder_pice").change(function(){
	var product_to_change = <?=$refill_charges_product_id?>;
	//var change=$("#total_pices-<?=$refill_charges_product_id?>").val();
	var change=$(".total_pices-<?=$refill_charges_product_id?>").val();
	var qty=$("#cylinder_pice").val();
	//$("#total_pices-<?=$refill_charges_product_id?>").val(qty).change();	
	$(".total_pices-<?=$refill_charges_product_id?>").val(qty).change();
});	

$("#user_type").change(function(){
	
	var user_type = $("#user_type").val();
	if(user_type!="")
	{	
		var data = 'type=' + user_type;
		//alert(data);
		$.ajax({
			//this is the php file that processes the data and send mail
			url: '<?php echo common::get_component_link(array("add_order","get_max_date")); ?>',
			type: "POST",		
			data: data,		
			cache: false,
			success: function (html) {
			 //alert(html);
			 //var amount = parseInt(pices)*parseInt(html);
				if(html)
				{
					
					$("#hdninvoice_date").val(html);
					$("#invoice_date").val(html);
					
				}
				
			}
		});//End Ajax
	}
		
});

	
});
                                
</script>

</body>

</html>
