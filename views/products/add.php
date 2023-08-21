<!DOCTYPE html>
<html>

<head>
<?php echo common::load_view("common","head"); ?>
</head>

<body>

    <div id="wrapper">

        <?php 
		$page_name="product";
		echo common::elements("adminnav"); 
		?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-plus-square"></i> Add Product
<div class="action pull-right">
    <a href="<?php echo common::get_component_link(array("products","list")); ?>" class="btn btn-primary btn-small"><i class="fa fa-list"></i> List </a>
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
                            ->from(TBL_PRODUCT_TYPE)
                            ->run();
                            $data=  $q->get_selected();
                            ?>
        			      
                            <div class="form-group">
                                <div class="col-md-8">
                                  <label>Product Name *</label>
        						  <input class="text-input form-control product_name" name="title" id="txttitle" type="text"  /> (Ex. ABC )
        					    </div> 
								 <div class="col-md-4">
        						  <label>HSN Code *</label>
                                  <!--<select name="product_type" class="form-control main_category">
									<option value="">Select Product Type</option>
                                  	<?php 
                                  		foreach ($data as $catename)
                                  		{
                                  			
                                  		
                                  	?>
                                    <option value="<?php echo $catename["id"]; ?> "><?php echo $catename["title"]; ?></option>  
                                    <?php
                                  		}
                                    ?>
                                  </select>-->
								  <Input type="text" id="hsn_code" class="text-input form-control" name="hsn_code">
								</div>
								
                            </div>
                               
                            <!--<div class="form-group">
                                <div class="col-lg-12">
        						  <input type="file" name="image" />
                                </div>
                            </div>-->
                            
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label>Details</label>
        						<textarea id="elm12" class="text-input form-control" name="content"></textarea>    
								</div>
							</div>
                            
                            
							<div class="form-group">
                                <div class="col-lg-3">
        						  <label>Price</label>
									<div class="input-group">
									<input type="text"  class="form-control" name="price" id="price" />
									<span class="input-group-addon">INR</span>
									</div>
                                </div>
								<div class="col-lg-3">
        						  <label>Discount</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="discount" id="discount" />
                                    <span class="input-group-addon">INR</span>
									</div>
                                </div>
								<div class="col-lg-3">
        						  <label>CGST</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="cgst_tax" id="cgst_tax" />
                                    <span class="input-group-addon">%</span>
									</div>
                                </div>
                                <div class="col-lg-3">
        						  <label>SGST</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="sgst_tax" id="sgst_tax" />
                                    <span class="input-group-addon">%</span>
									</div>
                                </div>
                                 
                            </div>
                            <!--<div class="form-group">
                              <div class="col-lg-4">
        						  <label>Qty</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="gmqty" id="proqty"/>
                                    <span class="input-group-addon">
                                    <select name="unit" >
                                    <option value="GM" >GM</option>
                                    <option value="QTY" >QTY</option>
                                    <option value="KG" >KG</option>
									<option value="ML" >ML</option>
									<option value="L" >L</option>
									</select>
                                    </span>
								</div>
                                </div>
                            </div>-->
                            
                            
                            
                            
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
<?php echo common::load_view("common","load_editor"); ?>
</body>
<script type="text/javascript">
$(function(){
	var clickedOnce = false;
$(".main_category").change(function(){
	var category_id=$(".main_category").val();
	var data = 'cat=' + category_id;
	if(category_id)
	{
		$.ajax({
		//this is the php file that processes the data and send mail
		url: '<?php echo common::get_component_link(array("products","fetch_sub_category")); ?>',
		type: "POST",		
		data: data,		
		cache: false,
		success: function (html) {
			//alert(html);
			if(html!="")
			{
				$('#sub_category').html(html);

			}
		 
		}
		});//End Ajax
	}

		
	});
	
	$("#final_done").click(function(){
		
		if(clickedOnce) {
			return false;
		}
		
		var name = $(".product_name").val();
		var price = $("#price").val();
		var proqty =$("#proqty").val();
		var cgst_tax =$("#cgst_tax").val();
		var sgst_tax =$("#sgst_tax").val();
		
		if(name=="")
		{alert("please provide Product Name"); return false;}
		else if(price=="")
		{alert("please provide Product Price"); return false;}
		else if(cgst_tax=="")
		{alert("please provide CGST"); return false;}
		else if(sgst_tax=="")
		{alert("please provide SGST"); return false;}

		clickedOnce = true;
		return true;
	});	
});
</script>

</html>
