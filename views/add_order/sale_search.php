<!DOCTYPE html>
<html>

<head>

<?php echo common::load_view("common","head"); ?>
   <link rel="stylesheet" href="i-css/jquery-ui.css"> 
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i><?=ucfirst($decider);?> Sale List <div class="action pull-right">
    <a href="<?php echo common::get_component_link(array("consignment","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
			 <div class="form-group dataTables_filter">
				  
			</div>            
			    <div id="table_content">
                                <table class="table table-striped table-bordered" id="dataTables-example">
                                    <thead>
                                       <tr>
                                             <!--<th>ID</th>-->
											 <th>Invoice</th>
                                            <th>User Name</th>
											<th>Product</th>
											<th>QTY</th>
											<th>Per Qty Price</th>
											<th>Total Amount</th>
                                            <th>Order Date</th> 
                                            <!--<th>Order Status /<br /> Confirm Order</th>
                                            <th>Option</th>-->
                                        </tr>
                                    </thead>
                                    <tbody id ="ebdy_content">
									
									
                                    <?php foreach($data as $d)
									{ 
										$product_id=$d["product_id"];
										$q = new Query();
										$q->select("title")
										->from(TBL_PRODUCTS)
										->where_equal_to(array('admin_id'=>$login_id,"id"=>$product_id))
										->limit(1)
										->run();
										$product =  $q->get_selected();
										$product_name=$product['title'];
											
									?>
                                         <tr>
                                         <form action="" method="post">                                             
                                            <td><?php echo $d["recipt_no"]?></td>
                                            <td><?php echo $d["person_name"]?></td>
											<td><?php echo $product_name ?></td>
											<td><?php echo $d["qty"]?></td>
                                            <td><?php echo $d["price"]?></td>
											<td><?php echo $d["price"]*$d["qty"]?></td>
											<td><?php echo $d["order_date"]?></td>
                                            <!-- <td>
                                                <label class="switch">
                                                  <input type="checkbox" class="switch-input"  data-id="<?php echo $d["id"]; ?>" <?php if($d["status"] == 1){echo "checked";} ?> >
                                                  <span class="switch-label" data-on="On" data-off="Off"></span>
                                                  <span class="switch-handle"></span>
                                                </label>
                                            </td> 
                                            <td class="center" > 
                                            <a href="<?php echo common::get_component_link(array('consignment','edit'),array("id"=>$order_id,"in"=>$invoice_number)); ?>" class="btn btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                         </td>-->
										 </form>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
							</div>	
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

$(function(){

	$("#distributer").change(function(){
		//alert("hello");
		var date_val = $("#distributer").val();
		//var status = parseInt("0");
			var data='dt=' + date_val;
				$.ajax({
					url: '<?php echo common::get_component_link(array("consignment","dis_search_handler")); ?>',
					type: 'POST',
					data: data,
					cache: false,
					success: function(html)
					{
						//alert(html);
						$("#ebdy_content").html(html);
						
						//$("#table_content").html(html);
						/*if(html!="")
						{
							tbody.appendChild(a);
							 e.preventDefault();
							  alert(html);
							  $('.forgetemail').val("");
						  
						  return false;
						}*/
					}
				});
	});

});
  </script>
</body>

</html>
