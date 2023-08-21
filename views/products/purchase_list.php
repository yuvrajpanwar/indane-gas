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
<h1 class="page-header"><i class="fa fa-list-alt"></i> Product for purchase<div class="action pull-right">
     <!--<a href="<?php echo common::get_component_link(array("stock","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>-->
</div>
</h1>
</div>
</div>
<div class="row">
 
    
    <div class="col-md-12">

<?php  if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                                    <thead>
                                        <tr> 
                                            <th>Product Name</th> 
											<!--<th>Company Name</th>
											<th>Gm/Qty</th>
                                            <th>Unit Type</th>--> 
                                            <th>Available Stock</th> 
											<th>Base Quantity</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php  
									
                                    foreach($data as $d)
									{ 
										/*$brand_id =$d['brand'];
										$q = new Query();
										$q->select()
										->from(TBL_BRAND)
										->where_equal_to(array('id'=>$brand_id))
										->limit(1)
										->run();
										$disti=  $q->get_selected();
										$brand_name=$disti['name'];*/
										$availablle_stock =$d['gmqty'];
										$base_qty=$d['base_qty'];
										//$stock_limit=5;
										//$stock_limit=($base_qty*20)/100;
										if($availablle_stock<=$base_qty)
										{
											if($availablle_stock<0)
											{
												$availablle_stock =0;
											}
									?>
                                        <tr class="odd gradeX"> 
                                            <td width="60px" ><?php echo $d["title"]?></td>
											<!--<td width="60px" ><?php echo $brand_name; ?></td>
                                            <td width="60px" > 
                                            		<?php echo $d["product_size"]?>
                                            </td> 
											<td width="60px" > 
                                            		<?php echo $d["unit"]?>
                                            </td>-->
                                            <td width="60px" ><?php echo $availablle_stock ?></td>
                                            <td width="60px" ><?php echo $d['base_qty']; ?></td>
                                        </tr>
									<?php } } ?>   
                                    </tbody>
                                </table>
								<a href="<?php echo common::get_component_link(array("products","get_excel_formate")); ?>">Download Excel</a>
                            </div> 
    </div>
    
</div>  
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
 
</body>

</html>
