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
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Query  <div class="action pull-right">
    
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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Comments</th>  
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                   
                                  
                                    foreach($data as $d){ ?>
                                        <tr class="odd gradeX">
                                            <td width="30px"><?php echo $d["id"]; ?></td>                                              
                                            <td width="60px" ><?php echo $d["name"]?></td>
                                            <td width="60px" ><?php echo $d["email"]?></td> 
                                            <td width="60px" ><?php echo $d["comments"]?></td>  
                                            <td class="center"  width="100px"> 
    										  <a onclick="return confirm('Are you sure Delete?')" href="<?php echo common::get_component_link(array('satisfaction','delete'),array("id"=>$d['id'])); ?>" class="btn btn-sm"  title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
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
                                                   url: "<?php echo common::get_component_link(array("appuser","active")); ?>",
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
