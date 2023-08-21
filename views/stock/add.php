 <!DOCTYPE html>
<html>

<head>
<?php echo common::load_view("common","head"); ?>
  <link href="<?php echo ADMIN_THEME ?>css/chosen.min.css" rel="stylesheet">
  <link rel="stylesheet" href="i-css/jquery-ui.css">
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-plus-square"></i> Add Stock
<div class="action pull-right">
    <a href="<?php echo common::get_component_link(array("stock","list")); ?>" class="btn btn-primary btn-small"><i class="fa fa-list"></i> List </a>
</div>
</h1>
</div>
</div>
<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
<div class="row">
    <div class="col-md-9">

        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-plus-circle fa-fw"></i> Add Level
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                    <?php if ( common::do_show_message() ) {
        		          echo common::show_message();	
                    } ?> 
        			      
                            
                             <?php
                            $q = new Query();
                            $q->select()
                            ->from(TBL_PRODUCTS)
							->where_equal_to(array('admin_id'=>$login_id,'status'=>1))
                            ->run();
                            $data1=  $q->get_selected();
                            ?>
                            <div class="form-group">
                            	<div class="col-md-9">
        						  <label>Product</label>
                                  <select data-placeholder="Choose a country..." name="prid" id="prid" class="form-control chosen-select">
                                  	<option selected disabled value="">Choose Product Name</option>
                                  	<?php 
                                  		foreach ($data1 as $title)
                                  		{
                                  			 
                                  	?> 
                                  	
                                     <option  value="<?php echo $title["id"]; ?>" ><?php echo $title["title"];?> 
                                    	
                                    </option>  
                                    <?php
                                  		}
                                    ?>
                                  </select>
                                </div>
                            </div>   
							<div class="form-group">
								<div class="col-lg-4">
									  <label>Invoice No.</label>
									  <input type="text"  class="form-control"  name="in_number" id="in_number" />
								</div>
								<div class="col-lg-4">
									  <label>Invoice Date</label>
									  <input type="text"  class="form-control datepicker" name="invoice_date" id="invoice_date" />
								</div>
								 <div class="col-lg-4">
									  <label>Party Name</label>
									  <input type="text"  class="form-control" name="name" id="name" />
								</div>
							</div>
                            <div class="form-group">
							
                             <div class="col-lg-2">
        						  <label>Qty</label>
                                  <input type="number"  class="form-control" name="gmqty" id="gmqty" />
							</div>
                            <div class="col-lg-2">
        						  <label>Unit</label>
                                  <select name="unit" class="form-control">
                                    <option value="QTY" >QTY</option>
                                    <!--
									<option value="GM" >GM</option>
									<option value="KG" >KG</option>
									<option value="ML" >ML</option>
									<option value="L" >L</option>-->
                                  </select>
							</div>
							<div class="col-lg-2">
								<!--<label>Base quantity</label>-->
								<input type="hidden"  class="form-control" name="base_qty" />
							</div>
							
                            </div>
                            
                            
                            
                          
                            <div class="form-group">
                                 
                                
                            </div>
                            
                            
                            <p>
                                <div class="col-lg-4"></div>
        						<input class="btn col-md-8 btn-primary" type="submit" id="final_done" name="add" value="Add" />
        					</p>
                    
        </div>
        </div>

    </div>
    
</div>
</form>
            
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
<script src="<?php echo ADMIN_THEME ?>js/chosen.jquery.js"></script>
<script src="i-js/jquery-ui.js"></script>
   <script>
  $( function() {
	  
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
	
  } );
  </script>
 
<script>


$(function(){
	
	var clickedOnce = false;
	
	$("#final_done").click(function(){
		
		if(clickedOnce) {
			return false;
		}
		
		var invoice_date = $("#invoice_date").val();
		var product = $("#prid").val();
		var invoice_nember = $("#in_number").val();
		var name = $("#name").val();
		var qty = $("#gmqty").val();
		
		if(product=="")
		{
			
			alert("Please select product");
			return false;
			
		}
		else if(invoice_nember=="")
		{
			alert("please Provide Invoice Number");
			return false;
		}
		else if(invoice_date=="")
		{
				alert("please Select Invoice Date");
				return false;
		}
		else if(name=="")
		{
			alert("please Provide Vendor Name");
			return false;
		}
		else if(qty =="")
		{
			alert("please Provide Product Quantity");
			return false;
		}
		
		clickedOnce = true;
		return true;

	});
	


	
});
                                
</script> 

<script type="text/javascript"> $(function(){$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});});</script>
<?php echo common::load_view("common","load_editor"); ?>
</body>

</html>
 