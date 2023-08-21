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
<h1 class="page-header"><i class="fa fa-list-alt"></i> Purchased Stock<div class="action pull-right">
     <a href="<?php echo common::get_component_link(array("stock","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
										<th>Invoice Date</th>
										<th>Invoice Number</th>
										<th>Party Name</th>
										<th>Product Name</th>
										<th>Product Quantity</th> 
										<th>Option</th>
											<!--<th>Base Quantity</th> 
											<th style="width: 37.778px;">Option</th>--> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php  
                                    foreach($data as $d){ 
										$availablle_stock = $d['gmqty'];
										$invoice_date=$d["invoice_date"];
										if($availablle_stock<0)
										{
											$availablle_stock =0;
										}
										if($invoice_date!="0000-00-00")
										{
											$date_display=date("d-M-Y",strtotime($invoice_date));
										}
										else
										{
											$date_display=$invoice_date;
										}
									?>
                                        <tr class="odd gradeX"> 
											<td width="60px" ><?php echo $date_display;?></td>
											<td width="60px" ><?php echo $d["invoice_number"]?></td>
											<td width="60px" ><?php echo $d["vendor_name"]?></td>
                                            <td width="60px" ><?php echo $d["title"]?></td>
                                            <td width="60px" ><?php echo $availablle_stock; ?></td>
											<td width="60px">
											<a href="<?php echo common::get_component_link(array('stock','edit'),array("id"=>$d['id'])); ?>" class="btn btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
											</td>
                                        </tr>
                                     <?php } ?>   
                                    </tbody>
                                </table>
								<a class="btn btn-primary" href="<?php echo common::get_component_link(array("stock","get_excel_formate")); ?>">Download Excel</a>
                            </div> 
    </div>
    
</div>  
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
 
</body>

</html>
