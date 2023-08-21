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
<h1 class="page-header"><i class="fa fa-list-alt"></i> User List <div class="action pull-right">
    <div class="action pull-right">
		     <a href="<?php echo common::get_component_link(array("appuser","add")); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
		</div>
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
							<!--<th>Points</th>-->
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th> 
							<th>City</th>
							<!--<th>Zipcode</th>-->
							<th>Registration Date</th>
							<!--<th>Status</th>-->
							<th>Option</th>
							<th>Send Notification</th>
						</tr>
					</thead>
					<tbody>
					 <?php 
				   
					$total=0;
					foreach($data as $d)
					{
						$user_id = $d["id"];
						$reg_date =$d["reg_date"];
						$display_date =date("d-M-Y",strtotime($reg_date));
						
					?>
						<tr class="odd gradeX">
							<td width="30px"><?php echo $d["id"]; ?></td> 
							<!--<td width="30px"><?=$remaining_point; ?></td>-->                                             
							<td width="60px" ><?php echo ucfirst($d["name"]);?></td>
							<td width="60px" ><?php echo $d["email"]?></td>
							<td width="60px" ><?php echo $d["mobile"]?></td>
							<td width="60px" ><?php echo $d["city"]?></td>
							<!--<td width="60px" ><?php echo $d["zipcode"]?></td>-->
							<td width="60px" ><?php echo $display_date; ?></td>
							 <!--<td width="100px">
								<label class="switch">
								  <input type="checkbox" class="switch-input"  data-id="<?php echo $d["id"]; ?>" <?php if($d["status"] == 1){echo "checked";} ?> >
								  <span class="switch-label" data-on="On" data-off="Off"></span>
								  <span class="switch-handle"></span>
								</label>
							</td>--> 
							<td class="center"  width="100px">
							  <a href="<?php echo common::get_component_link(array('appuser','edit'),array("id"=>$d['id'])); ?>" class="btn btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
							  
							 <a onclick="return confirm('Are you sure Delete?')" href="<?php echo common::get_component_link(array('appuser','delete'),array("id"=>$d['id'])); ?>" class="btn btn-sm"  title="Delete"><i class="glyphicon glyphicon-remove"></i></a> 
						
							</td>
							<td class="center"  width="100px">
							  
							 <a href="<?php echo common::get_component_link(array('user_massage','sendmessage'),array("id"=>$d['id'])); ?>" class="btn btn-sm"  title="Send Notification"><i class="glyphicon glyphicon-bell"></i>Send Notification</a> 
						
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
