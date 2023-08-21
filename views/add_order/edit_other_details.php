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
                            <i class="fa fa-plus-circle fa-fw"></i> Invoice Detail
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
			<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				 
			<div class="col-lg-12" id="row_container">	

					 <div class="form-group">
						<h4><b>Details</b></h4>
						
					 </div>
					 
                    <div class="form-group row_con_mrg">
					<?php 
					if(!$order_basic_details)
					{	
					?>
						<div class="col-lg-6">
							 <label>Invoice Date </label>
							<input class="text-input form-control datepicker" type="text" name="invoice_date" value="<?=$dateOfLastBill?>" autocomplete="off" id="invoice_date" placeholder="Invoice Date"/>
							<input type="hidden" name="hdninvoice_date" id="hdninvoice_date" value="<?=$dateOfLastBill?>">
						</div>
					<?php }  ?>	
						<div class="col-lg-12">
							<label>Reverse Charge </label>
							<select class="text-input form-control" name="r_charge" id="r_charge">
							<option value="No" <?php if($reverschage=="No") echo"selected"; ?>>No</option>
							<option value="Yes" <?php if($reverschage=="Yes") echo"selected"; ?>>Yes</option>
							</select>

						</div>
						
						
					</div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<label>Connection Type </label>
							<select class="text-input form-control" name="con_type" id="con_type">
							<option value="">Select Connection Type</option>
							<option value="NC" <?php if($content_type=="NC") echo"selected"; ?>>NC</option>
							<option value="DBC" <?php if($content_type=="DBC") echo"selected"; ?>>DBC</option>
							<option value="Incoming TV" <?php if($content_type=="Incoming TV") echo"selected"; ?>>Incoming TV</option>
							<option value="Other" <?php if($content_type=="Other") echo"selected"; ?>>Other</option>
							</select>
						</div>
						<div class="col-lg-6">
							<label>SV Number </label>
							<input class="text-input form-control" type="text" name="sv_numver" value="<?=$sv_number?>" autocomplete="off" id="sv_numver" placeholder="SV Number"/>
						</div>
					 
					 </div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<label>Consumer Number </label>
							<input class="text-input form-control" type="text" name="consumer_number" value="<?=$consumer_number?>" autocomplete="off" id="consumer_number" placeholder="Consumer Number"/>
						</div>
						<!--<div class="col-lg-6">
							<label>Cust. GST Number </label>
							<input class="text-input form-control datepicker" type="text" name="date_supply" value="" autocomplete="off" id="date_supply" placeholder="Date Of Supply"/>
						</div>-->
						
						<div class="col-lg-6">
							<label>Cust. GST Number </label>
							<input class="text-input form-control" type="text" name="gst_number" value="<?=$user_gst?>" autocomplete="off" id="gst_number" placeholder="Cust. GST Number"/>
						</div>
					 
					 </div>
					 
					<div class="form-group row_con_mrg">
							<div class="col-lg-6">
								<label for="text1" class="control-label col-lg-12" style="text-align: left;">Mode of payment</label>
								<input class="mode_control" type="radio" name="mode" <?=$cash_select?> value="cash" style="width: 40px; height: 1.2em;">Cash
								
								<input class="mode_control" type="radio" name="mode" <?=$bank_select?> id="bank_link" value="Bank" style="margin-left:15px; width: 40px; height: 1.2em;">Bank
								
								<input class="mode_control" type="radio" name="mode" <?=$both_select?> id="both_link" value="Both" style="margin-left:15px; width: 40px; height: 1.2em;">Both
								
								<input class="mode_control" type="radio" name="mode" id="" <?=$Credit_select?>  value="Credit" style="margin-left:15px; width: 40px; height: 1.2em;">Credit

							</div>
							<div class="col-lg-6">
							<label>Remark </label>
								<textarea class="form-control col-lg-12" name="remark_text" ><?=$order_remark?></textarea>
							</div>
					</div>
					<div class="form-group amount_block" style="display:none;">
					<label>Total Amount:  <?=round($final_amount);?></label>
					
					</div>
					<div class="form-group amount_block" style="display:none;">
						
						<div class="col-lg-6">
							<label>Cash Amount </label>
							<input type="hidden" name="total_amount" id="total_amount" value="<?=round($final_amount);?>">
							<input class="text-input form-control" type="text" name="cash_amount" value="<?=$cash_amount?>" autocomplete="off" id="cash_amount" placeholder="Cash Amount"/>
						</div>
						<div class="col-lg-6">
							<label>Bank Amount </label>
							<input class="text-input form-control" type="text" name="bank_amount" value="<?=$bank_amount?>" autocomplete="off" id="bank_amount" placeholder="Bank Amount"/>
						</div>
					 
					 </div>
					
					
				</div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
							<input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="add" value="Update" />
						</div>
						
						<div class="col-lg-6">
						<a href="<?php echo common::get_component_link(array('add_order','list'),array("user_type"=>$user_type)); ?>" class="btn col-md-8 btn-primary">Done</a>
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
<script src="i-js/jquery-ui.js"></script>
   <script>
  $( function() {
	  
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
	
	
  } );
  </script>

<script>


$(function(){
	
	$("#final_done").click(function(){
		
		//var invoice_date = $("#invoice_date").val();
		var hdninvoice_date = $("#hdninvoice_date").val();
		var con_type = $("#con_type").val();
		//var sv_numver = $("#sv_numver").val();
		//var consumer_number = $("#consumer_number").val();
		//var res = invoice_date.split("-");
		//var change_invoice_formate=res[2]+"-"+res[1]+"-"+res[0];
		//var res1 = hdninvoice_date.split("-");
		//var change_max_date=res1[2]+"-"+res1[1]+"-"+res1[0];
		
		
		
		if(con_type=="")
		{
			alert("please Select Content Type");
			return false;
		}
		/*else if(consumer_number =="")
		{
			alert("please Provide Consumer Number");
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
			alert("Please select Mod Of Payment");
			return false;
			
		}
		
		

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
	
	$("#cash_amount").change(function(){
		var total_amount=$("#total_amount").val();
		var cash_amount=$("#cash_amount").val();
		if(total_amount!="" && cash_amount!="")
		{
			var amount=parseInt(total_amount)-parseInt(cash_amount);
			
			$("#bank_amount").val(amount);
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
	


	
});
                                
</script>

<?php
if($payment_mode=="Both")
{	
?>
<script>
$(".amount_block").show();
</script>

<?php }?>
</body>

</html>
