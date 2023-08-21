<!DOCTYPE html>
<html>

<head>
<?php echo common::load_view("common","head"); ?>
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Edit Product
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
                                    <i class="fa fa-plus-circle fa-fw"></i> Edit Level
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
                            $data1=  $q->get_selected();
                            ?>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <label>Product Name *</label>
        						  <input class="text-input form-control product_name" name="title" id="txttitle" type="text" value="<?php echo $data["title"]; ?>"  /> (Ex. ABC )
        					    </div>
								<div class="col-md-4">
        						  <label>HSN Code *</label>
								  <Input type="text" id="hsn_code" class="text-input form-control" value="<?=$code?>" name="hsn_code">
								</div>
                            </div>
                           
                            
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label>Details</label>
        						<textarea id="elm12" name="content" class="form-control"><?php echo $data["description"]; ?></textarea>    
								</div>
							</div>
                            
                            
                             <div class="form-group">
                                <div class="col-lg-3">
									  <label>Price</label>
									<div class="input-group">
									  <input type="text"  class="form-control product_price" name="price" value="<?php echo $data["price"]; ?>" />
									 <span class="input-group-addon">INR</span>
									</div>
                                </div>
                                <div class="col-lg-3">
        						  <label>Discount</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="discount" id="discount"  value="<?php echo $data["discount"]; ?>"/>
                                    <span class="input-group-addon">INR</span>
									</div>
                                </div>
								<div class="col-lg-3">
        						  <label>CGST</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="cgst_tax" value="<?php echo $data["cgst_tax"]; ?>" />
                                    <span class="input-group-addon">%</span>
									</div>
                                </div>
                                <div class="col-lg-3">
        						  <label>SGST</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" name="sgst_tax" value="<?php echo $data["sgst_tax"]; ?>" />
                                    <span class="input-group-addon">%</span>
									</div>
                                </div> 
                                 
							</div>
                           <!--<div class="form-group">
                              <div class="col-lg-4">
        						  <label>Qty</label>
                                  <div class="input-group">
                                  
                                  <input type="text"  class="form-control" value="<?php echo $data["gmqty"]; ?>" name="gmqty" id="proqty"/>
                                    <span class="input-group-addon">
                                    <select name="unit" >
                                    <option value="GM" <?php if($data["unit"]=="GM") echo"selected"; ?>>GM</option>
                                    <option value="QTY" <?php if($data["unit"]=="QTY") echo"selected"; ?>>QTY</option>
                                    <option value="KG" <?php if($data["unit"]=="KG") echo"selected"; ?>>KG</option>
									<option value="ML" <?php if($data["unit"]=="ML") echo"selected"; ?>>ML</option>
									<option value="L" <?php if($data["unit"]=="L") echo"selected"; ?>>L</option>
									</select>
                                    </span>
								</div>
                                </div>
                            </div>-->
                            
                          
                            
                            
                            <p>
                                <div class="col-lg-4"></div>
        						<input class="btn col-md-8 btn-primary" type="submit" id="final_done" name="add" value="Update" />
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
		
		var name = $(".product_name").val();
		//var main_category = $(".main_category").val();
		//var sub_category = $("#sub_category").val();
		var price = $(".product_price").val();
		//alert(price);
		var proqty =$("#proqty").val();
		//alert(sub_category);
		//return false;
		if(name=="")
		{alert("please provide Product Name"); return false;}
		else if(proqty=="")
		{ alert("please provide product Qty"); return false;}
		else if(price=="")
		{alert("please provide Product Price"); return false;}

	});	
});
</script>

</html>
