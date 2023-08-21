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
<h1 class="page-header"><i class="fa fa-list-alt"></i> Product List <div class="action pull-right">
    <a href="<?php echo common::get_component_link(array("products","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
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
                                            <!--<th>ID</th>
                                            <th>Image</th>-->
                                            <th>Title</th>
											<th>HSN Code</th>
                                            <th>Price</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <!--<th>Category</th>
                                            <th>status</th>-->
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                   
                                  
                                    foreach($data as $d){ ?>
                                        <tr class="odd gradeX">
                                            <!--<td><?php echo $d["id"]; ?></td>
                                            
                                            <td><img src="userfiles/products/icon/<?php echo $d["image"]; ?>" /></td>-->
                                            <td ><?php echo $d["title"]; ?></td>
											<td ><?php echo $d["hsn_code"]; ?></td>
											<td><?php echo $d["price"]; ?></td>
                                             <td><?php echo $d["cgst_tax"]; ?></td>
                                             <td><?php echo $d["sgst_tax"]; ?></td>
                                             
                                            
                                             
                                            <!--<td>
                                                <label class="switch">
                                                  <input type="checkbox" class="switch-input"  data-id="<?php echo $d["id"]; ?>" <?php if($d["status"] == 1){echo "checked";} ?> >
                                                  <span class="switch-label" data-on="On" data-off="Off"></span>
                                                  <span class="switch-handle"></span>
                                                </label>
                                            </td>-->
                                            <td class="center" >
                                             <a href="<?php echo common::get_component_link(array('products','edit'),array("id"=>$d['id'])); ?>" class="btn btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
    										 <a onclick="return confirm('Are you sure Delete?')" href="<?php echo common::get_component_link(array('products','delete'),array("id"=>$d['id'])); ?>" class="btn btn-sm"  title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
										
                                            </td>
                                        </tr>
                                     <?php } ?>   
                                    </tbody>
                                </table>
                            </div>




    </div>
    
</div>

            
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
<script>
     
                                $(document).ready(function(){
                                        $('body').on("click",".switch-input",function(){
                                            var bin=0;
                                         if($(this).is(':checked')){
                                            bin = 1;
                                         }
                                            $.ajax({
                                                   url: "<?php echo common::get_component_link(array("products","active")); ?>",
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
