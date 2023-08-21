<?php

?>
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
                            <i class="fa fa-plus-circle fa-fw"></i> User Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
			<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				   
			<div class="col-lg-12" id="row_container">	

					<!-- <div class="form-group">
						<h4><b>User Details</b></h4>
						<div class="col-lg-6">
							<input type='checkbox' style="width:20px;float: left;height: 2em;"  name='decider' id='decider' value="no">
							<p style="float: left;padding-top: 5px;padding-left: 10px;">Billing Address and Shipping Address is same?</p>
						</div>
					 
					 </div> -->
					 
                    <div class="form-group row_con_mrg">
					
					<h5>Billing Address</h5>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_name" value="<?=$user_name?>" autocomplete="off" id="billing_name" placeholder="Name"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_number" value="<?=$user_number?>" autocomplete="off" id="billing_number" placeholder="Mobile Number"/>

						</div>
						
						
					</div>
					 <div class="form-group">
						
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_address" value="<?=$user_address?>" autocomplete="off" id="billing_address" placeholder="Address"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="billing_state" value="Uttarakhand" autocomplete="off" id="billing_state" readonly placeholder="State"/>
						</div>
					 
					 </div>
					 
					<!--<div class="form-group row_con_mrg shipping_add_block">
						<h5>Shipping Address</h5>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="shippeing_name" value="" autocomplete="off" id="shippeing_name" placeholder="Name"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="shippeing_number" value="" autocomplete="off" id="shippeing_number" placeholder="Mobile Number"/>

						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="shippeing_address" value="" autocomplete="off" id="shippeing_address" placeholder="Address"/>
						</div>
						
						
					</div>-->
					<!--<div class="form-group shipping_add_block">
						
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="shippeing_address" value="" autocomplete="off" id="shippeing_address" placeholder="Address"/>
						</div>
						<div class="col-lg-6">
							<input class="text-input form-control" type="text" name="shippeing_state" value="" autocomplete="off" id="shippeing_state" placeholder="State"/>
						</div>
					 
					 </div>-->
					 
					
					
					
				</div>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
							<a class="btn col-md-6"></a>
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
		/*else if(billing_number=="")
		{
			alert("please Provide Billing Mobile Number");
			return false;
		}*/
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
		
		

	});
	
	$("#decider").click(function(){
		//alert("hello");
		
		if($('#decider').is(":checked"))
		{
				$("#decider").val("yes");
				$(".shipping_add_block").hide();
			
		}
		else
		{
			$("#decider").val("no");
			$(".shipping_add_block").show();
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
	
	/*var price =$("#price-"+count).val();
	var cgst =$("#cgst-"+count).val();
	var sgst =$("#sgst-"+count).val();
	var total_amount =$("#total_amount-"+count).val();*/
	
	/*if(product_id=="")
	{
		alert("please select product name");
		return false;
	}*/
	
	/*var change_price = parseInt(pices)*parseInt(price);
	var change_cgst = parseInt(pices)*parseInt(cgst);
	var change_sgst = parseInt(pices)*parseInt(sgst);
	var change_total_amount = parseInt(pices)*parseInt(total_amount);
	
	$("#price-"+count).val(change_price);
	$("#cgst-"+count).val(change_cgst);
	$("#sgst-"+count).val(change_sgst);
	$("#total_amount-"+count).val(change_total_amount);
	*/
	
	
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
				}
			}
		});//End Ajax
	}
	
});

	
});
                                
</script>

</body>

</html>
