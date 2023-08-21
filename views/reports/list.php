<!DOCTYPE html>
<html>

<head>

<?php echo common::load_view("common","head"); ?>
   <link rel="stylesheet" href="i-css/jquery-ui.css"> 
   
<style>
.comman_box
{
	color:white; text-align: center; margin-bottom:50px; height:120px; padding: 20px; 
}
</style>
   
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Reports <div class="action pull-right">
    
</div>
</h1>
</div>
</div>
<div class="row">
   
    <div class="col-md-12">

<?php  if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
            
              <div class="dataTable_wrapper">
				  <!--<div class="col-lg-12" style="margin-bottom: 20px;">
					<div class="col-lg-4">
							<label for="exampleInputEmail1">Select Distributer</label>
				  
						  <select name="distributer" id="distributer" class="form-control input-sm">
						  <option value="">Select Distributer</option> 
							<?php 
								foreach ($disti as $catename)
								{
									
								
							?>
							<option value="<?php echo $catename["id"]; ?> "><?php echo $catename["company_name"]; ?></option>  
							<?php
								}
							?>
						  </select> 
					</div>
				  </div>-->
			    <div id="table_content">
					<div class='col-lg-12'>
						<!--<div class='col-lg-6'>
							<a href="<?php echo common::get_component_link(array('consignment','search_purchase'),array("dec"=>"today")); ?>">
							<div class='col-lg-12 comman_box' style='background: #da542e;'>
							<h3>Purchase(Today) : <?=$purchase_today?></h3>
							</div>
							</a>
							<a href="<?php echo common::get_component_link(array('consignment','search_purchase'),array("dec"=>"this mounth")); ?>">
							<div class='col-lg-12 comman_box' style='background: #28b779;'>
							<h3>Purchase(This Month) : <?=$purchase_this_mounth?></h3>
							</div>
							</a>
							<a href="<?php echo common::get_component_link(array('consignment','search_purchase'),array("dec"=>"till")); ?>">
							<div class='col-lg-12 comman_box' style='background: #ffb848;'>
							<h3>Purchase(Till Date) : <?=$purchase_till?></h3>
							</div>
							</a>
						</div>-->
						<div class='col-lg-12'>
							
							<div class='col-lg-12 comman_box' style='background: #27a9e3;'>
							<h3>Sale(Today) : <?=$final_today_sale?></h3>
							</div>
							<!--<a href="<?php echo common::get_component_link(array('add_order','sale_search'),array("dec"=>"today")); ?>"></a>-->
							
							<div class='col-lg-12 comman_box' style='background: #2255a4;'>
							<h3>Sale(This Month) : <?=$final_month_sale?></h3>
							</div>
							<!--<a href="<?php echo common::get_component_link(array('add_order','sale_search'),array("dec"=>"this mounth")); ?>">
							</a>-->
							
							<div class='col-lg-12 comman_box' style='background: #f74d4d;'>
							<h3>Sale(Till Date) : <?=$final_sale_till?></h3>
							</div>
							<!--<a href="<?php echo common::get_component_link(array('add_order','sale_search'),array("dec"=>"till")); ?>">
							</a>-->
						</div>
						
					</div>
					
					
					<!--<table class="table table-striped table-bordered" id="dataTables-example">
						<thead>
						   <tr>
								 <th>ID</th>
								 <th>Invoice</th>
								 <th>Company Name</th>
								<th>Mode of Payment</th>
								<th>Check Number</th>
								 <th>Debit</th>   
								<th>credit</th> 
								<th>Date</th> 
							</tr>
						</thead>
						<tbody id ="ebdy_content">
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>

						   
						</tbody>
					</table>-->
		
			</div>
			</div>
 

    </div>
    
</div>

            
            
			</div>
                  </div>
<script>
$(document).ready(function() {
        $('#dataTables-example').dataTable({
    "bSort": false,
	"searching": true,
  });
       
    });
</script>				  
				  
<?php echo common::load_view("common","footer"); ?>

<script src="i-js/jquery-ui.js"></script>

<script>

$(function(){

	$("#distributer").change(function(){
		//alert("hello");
		var date_val = $("#distributer").val();
		//var status = parseInt("0");
			var data='dt=' + date_val;
				$.ajax({
					url: '<?php echo common::get_component_link(array("purchase_ledger","distributer_search_handler")); ?>',
					type: 'POST',
					data: data,
					cache: false,
					success: function(data)
					{
						//alert(data);
						//$("#ebdy_content").html(data);
						$("#table_content").html(data);
						
					}
				});
	});

});
  </script>
</body>

</html>

