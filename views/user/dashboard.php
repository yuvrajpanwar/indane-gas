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
					<div class="col-lg-6">
                    <h1 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h1>
					</div>
					<div class="col-lg-6" style="text-align: right; border-bottom: 1px solid #eee;">
					<a class="btn btn-default" style="margin-top: 30px; margin-bottom: 7px;width: 150px; background:#484848; color:white;" href="<?php echo common::get_component_link(array("add_order","add")); ?>"> Retail sale</a>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row">
                 <div class="col-md-12 col-sm-12 col-lg-12">
               
                    <h4 class="heading"><strong>Today</strong> Order <span></span></h4>
                    <div class="row">
 
                        <?php 
                         if(isset($_REQUEST["cancle"]))
                                    {
                                         $id=common::get_control_value("ordrid");
                                        $q=new Query();
                                        $q->update(TBL_ORDER,array('status'=>"2"))
                                        ->where_equal_to(array('orders.id'=>$id))
                                        ->run();
                                       
                                    }
                        
                        ?>    
                            <div class="col-md-12">
                        
                        <?php  if ( common::do_show_message() ) {
                        		          echo common::show_message();	
                                    } ?> 
                                    
                                      <div class="dataTable_wrapper">
                                                     
                                                        <table class="table table-striped table-bordered" id="dataTables-example">
                                                            <thead>
                                                               <tr>
                                                                     <th>ID</th>
                                                                    <th>Invoice No</th>
                                                                     <th>User Name</th>   
                                                                    <th>Address</th> 
                                                                    <th>City</th>
                                                                    <th>Pincode</th>
                                                                    <th>Order Date</th> 
                                                                    <th>Order Status /<br /> Confirm Order</th>
                                                                    <th>Options</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach($data as $d){ ?>
                                                                 <tr>
                                                                 <form action="" method="post">
                                                                
                                                                    <td><?php echo $d["id"]; ?></td>                                              
                                                                    <td><?php echo $d["recipt_no"]?></td>
                                                                    <td><?php echo $d["name"]?></td>
                                                                    <td><?php echo $d["address"]?></td>
                                                                    <td><?php echo $d["city"]?></td>
                                                             
                                                                    <td><?php echo $d["zipcode"]?></td>
                                                                    
                                                                    <td><?php echo $d["order_date"]?></td> 
                                                                     <td>
                                                                        <label class="switch">
                                                                          <input type="checkbox" class="switch-input"  data-id="<?php echo $d["id"]; ?>" <?php if($d["status"] == 1){echo "checked";} ?> >
                                                                          <span class="switch-label" data-on="On" data-off="Off"></span>
                                                                          <span class="switch-handle"></span>
                                                                        </label>
                                                                    </td> 
                                                                    <td class="center" > 
                                                                    <a href="<?php echo common::get_component_link(array('order','details'),array("id"=>$d['id'])); ?>" class="btn btn-default"  title="Details"><i class="glyphicon glyphicon-list"></i> Invoice </a>
                            									 <input type="submit" name="cancle" value="Cancel" onclick="return confirm('Are Yoy Sure To Cancle..?')" />
                                                                  <input type="hidden" name="ordrid" value="<?php echo $d["id"]; ?>" />
                                                                 </td>
                        										 </form>
                                                                </tr>
                                                                <?php }?>
                                                                
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                         
                        
                            </div>
                            
                        </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php echo common::load_view("common","footer"); ?>
<script>
     
                                $(document).ready(function(){
                                        $('body').on("click",".switch-input",function(){
                                            var bin=0;
                                         if($(this).is(':checked')){
                                            bin = 1;
                                         }
                                            $.ajax({
                                                   url: "<?php echo common::get_component_link(array("order","active")); ?>",
                                                   type: "POST",
                                                   data: { id : $(this).data("id"), value : bin},
                                                   success: function(result) {
                                                       // alert("Update Successfully");
                                                   },
                                                   error: function() {
                                                      // alert("Something went wrong");
                                                   }
                                               });
                                        });
                                      // $('.switch-input').change( function(){
                                        // alert("Update Successfully");
                                         
                                      // });
                                    });
                                
                               </script>
</body>

</html>
