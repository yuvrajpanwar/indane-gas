<!DOCTYPE html>
<html>
<head>
<?php echo common::load_view("common","head"); ?>
   <link rel="stylesheet" href="i-css/jquery-ui.css">
   <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
</head>
<body>
<div id="wrapper">
    <?php echo common::elements("adminnav"); ?>
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h1 class="page-header"><i class="fa fa-list-alt"></i> Sale Reports 
                    <div class="action pull-right">
                        <!--<a href="<?php echo common::get_component_link(array("consignment","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>-->
                    </div>
                        </h1>
                </div>
            </div>
<div class="row">  
    <div class="col-md-12">
        <?php  if ( common::do_show_message() )
        {
        echo common::show_message();	
        }
        ?>             
            <div class="dataTable_wrapper">
                    <div class="col-lg-12" style="margin-bottom: 25px;">
                        <form  action="" method="post" enctype="multipart/form-data">
                        <div class="col-lg-1">
                                    <!--<label for="text1" class="control-label col-lg-12 title_allign">Mobile Number</label>-->
                            <input class="text-input form-control datepicker" type="text" name="form_date"   id="form_date" value="<?=$start?>" placeholder="From Date"/>

                        </div>
                        <div class="col-lg-1">
                                    <!--<label for="text1" class="control-label col-lg-12 title_allign">Mobile Number</label>-->
                            <input class="text-input form-control datepicker" type="text" name="to_date"  id="to_date" value="<?=$end?>" placeholder="To Date"/>
                            <input class="text-input form-control" type="hidden" name="user_type" autocomplete="off" id="user_type" value="" />

                        </div>
                        <div class="col-lg-1">
                            <input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="search" value="Search" />

                        </div>
                        </form>
                    </div>			           
			        <div id="table_content">
                                <table class="table table-striped table-bordered" id="dataTables-example" style="font-size: 13px;">
                                    <thead>
                                       <tr>
                                             <th style="vertical-align: top;">Invoice Date</th>
											 <th style="vertical-align: top;">Invoice No.</th>
											 <th style="vertical-align: top;">Name</th>
											<th style="vertical-align: top;">Connection Type</th>
											  <th style="vertical-align: top;">SV</th>
											 <?php
											 $pro_id_bulk="";
											 $product = new Query();
												$product->select()
												->from(TBL_PRODUCTS)
                                                ->where_equal_to(array('admin_id'=>$login_id,'status'=>1))    
												->run();
												$product_bulck=$product->get_selected();
												foreach($product_bulck as $prodata)
												{
													$product_name=$prodata['title'];
													$product_id=$prodata['id'];
													$pro_id_bulk.=$product_id."-";
													echo"<th style='width:30px;vertical-align: top;'>$product_name</th>";
												}												
												?>											
											<th style="vertical-align: top;">5% GST</th> 
											<th style="vertical-align: top;">18% GST</th>
											<th style="vertical-align: top;">Discount</th>
                                            <th style="vertical-align: top;">Total Amount</th> 
                                        </tr>
                                    </thead>
                                    <tbody id ="ebdy_content">
                                    <?php 
										$old_date="";
										
										foreach($marge_data as $d)
										{
                                            $total_amount=0;

                                            $order_id=$d['id'];
                                            //$name=ucfirst($d['name']);
                                            $total_amount=$d["totalprice"];
                                            $invoice_date=$d["invice_date"];
                                            $invoice_number=$d['recipt_no'];
                                            $discount=$d['discount'];
                                            $user_type=$d['user_type'];

                                            if($invoice_date!="0000-00-00")
                                            {
                                                $date_display=date("d-M-Y",strtotime($invoice_date));
                                            }
                                            else
                                            {
                                                $date_display=$invoice_date;
                                            }
												
                                            $user_name=ucfirst($d['name']);
                                            $sv_amount=$d['total_sv'];
                                            $total_amount=$sv_amount;
                                            $id_array=explode("-",$pro_id_bulk);
                                            $size_array=sizeof($id_array);
                                            //echo $size_array;die();
                                            $item_content="";
                                            $gst_amount=0;
                                            $two_amount=0;
                                            $nine_amount=0;
                                            
                                            for($i=0;$i<$size_array-1;$i++)
                                            {
                                                $product_id=$id_array[$i];
                                                $item_bulck =array();
                                                if($user_type=="General")
                                                {
                                                    foreach ($generalOrderItemArray as $key => $val) 
                                                    {
                                                        if($key==$order_id)
                                                        {
                                                            foreach ($val as $inner_key=> $value)
                                                            {
                                                                if($value['product_id']==$product_id)
                                                                {
                                                                    $item_bulck=  $value;
                                                                    unset($val[$inner_key]);
                                                                    break;
                                                                }

                                                            }
                                                        }

                                                    }

                                                }
                                                if($user_type=="Registered")
                                                {
                                                    foreach ($registerOrderItemArray as $key => $val) 
                                                    {
                                                        if($key==$order_id)
                                                        {
                                                            foreach ($val as $inner_key=> $value)
                                                            {
                                                                if($value['product_id']==$product_id)
                                                                {
                                                                    $item_bulck=  $value;
                                                                    unset($val[$inner_key]);
                                                                    break;
                                                                }

                                                            }
                                                        }

                                                    }

                                                }


                                                if($item_bulck)
                                                {
                                                    $cgst_tax=$item_bulck['cgst_tax'];
                                                    $sgst_tax=$item_bulck['sgst_tax'];
                                                    $amount=$item_bulck['rate'];
                                                    $quantity=$item_bulck['qty'];
                                                    $amount_with_quantity=$amount*$quantity;
                                                    $cgst_amount=$item_bulck['cgst_amount'];
                                                    $sgst_amount=$item_bulck['sgst_amount'];
                                                    $total_tax_amount=$cgst_amount+$sgst_amount;
                                                    $gst_amount=$gst_amount+$total_tax_amount;
                                                    $total_amount=$total_amount+$amount_with_quantity+$total_tax_amount;

                                                    if($cgst_tax==2.50)
                                                    {
                                                        $two_amount=$two_amount+$cgst_amount;
                                                    }
                                                    if($cgst_tax==9.00)
                                                    {
                                                        $nine_amount=$nine_amount+$cgst_amount;
                                                    }
                                                    if($sgst_tax==2.50)
                                                    {
                                                        $two_amount=$two_amount+$sgst_amount;
                                                    }
                                                    if($sgst_tax==9.00)
                                                    {
                                                        $nine_amount=$nine_amount+$sgst_amount;
                                                    }
                                                }
                                                else
                                                {
                                                    $amount_with_quantity="";
                                                }

                                                $item_content.="<td style='width:30px;'>$amount_with_quantity</td>";
                                            }
												
                                            if($discount)
                                            {
                                                $total_amount=round($total_amount-$discount);
                                            }	


                                            echo"<tr>
                                            <td style='width:30px;'>$date_display</td>									  
                                            <td style='width:30px;'>$invoice_number</td>
                                            <td style='width:30px;'>$user_name</td>
                                            <td style='width:30px;'>$connection_type</td>
                                            <td style='width:30px;'>$sv_amount</td>
                                            $item_content
                                            <td style='width:30px;'>$two_amount</td>
                                            <td style='width:30px;'>$nine_amount</td>
                                            <td style='width:30px;'>$discount</td>
                                            <td style='width:30px;'>$total_amount</td>
                                            </tr>";

                                            $old_date=$invoice_date;
                                    }

									
									?>
                                    
                                    </tbody>
                                </table>
								<a class="btn btn-primary" href="<?php echo common::get_component_link(array("reports","get_excel_formate"),array('st'=>$start,'end'=>$end,'type'=>$user_type)); ?>">Download Excel</a>
								<?php
									if($size_ofdata)
									{
								?>
								<a class="btn btn-primary" href="<?php echo common::get_component_link(array("reports","get_excel_formate"),array('st'=>$start,'end'=>$end,'type'=>$user_type)); ?>">Download Excel</a>
								<?php } ?>
							</div>	
							
							
							<!--<a class="btn btn-primary" target="_blank" href="<?php echo common::get_component_link(array("reports","details"),array('st'=>$start,'end'=>$end)); ?>">Print</a>-->
                                   <?php
										$max_date=date("Y-m-d");
										$min_date = date("Y-m-d", strtotime('-1 day', time()));
								?>
                            </div>
 

            </div>
    
    </div>           
            
</div>
</div>
<!--<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable({
    "bSort": false,
	"searching": false,
  });       
    });
</script>-->
<?php echo common::load_view("common","footer"); ?>
   <script src="i-js/jquery-ui.js"></script>
   <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$("#dataTables-example_filter").hide();
  } );
  </script>
<!--<script src="i-js/jquery-ui.js"></script>-->
<script>
$(function(){
	
	var divwidth=165;//<?php echo $div_width;?>;
	//alert(divwidth);
	//divwidth=165;
	//$("#wrapper").css("width", divwidth);
	$("#wrapper").width(+ divwidth +'%');
// Search validation.................................	
		$("#final_done").click(function()
		{			
			var start_date = $("#form_date").val();
			var to_date = $("#to_date").val();
			//var type = $("#distributer").val();
			if(start_date=="")
			{ alert("please provide From Date"); return false;}
			else if(to_date=="")
			{ alert("please provide To Date"); return false;}
			/*else if(type=="")
			{ alert("please Select User Type"); return false;}
			*/
		});
});
  </script>  
</body>
</html>
