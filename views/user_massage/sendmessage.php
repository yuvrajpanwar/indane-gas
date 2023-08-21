<!DOCTYPE html>
<html>

<head>
<?php echo  common::load_view("common","head"); ?>
</head>

<body>

<div id="wrapper">

	<?php echo  common::elements("adminnav"); ?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-folder fa-fw"></i>User Notification  
				<div class="action pull-right">
					
				</div>
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div class="panel panel-default">
					<div class="panel-heading">
										<i class="fa fa-plus-circle fa-fw"></i>  <?php 
						if(!empty($userdata)){
							echo "Send Notification for <b> $userdata[name] </b>";
						}
						?>
					</div>
										<!-- /.panel-heading -->
					<div class="panel-body">
							<?php if ( common::do_show_message() ) {
								  echo common::show_message();	
							} ?> 
						   
						<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
							  
							<div class="form-group col-lg-12">
								<div class="form-group">
										<div class="col-md-9">
										  <label>Title</label>
										  <input class="text-input form-control" name="title" id="txttitle" type="text"  /> (Ex. ABC )
										</div>   
								</div>
								<div class="form-group">
								<div class="col-lg-9">
									<label>Message</label>
									<textarea name="message" class="form-control"></textarea>	   	
							   </div>
							   </div>
								<div class="form-group">
									<div class="col-sm-10">
										<input type="radio" name="smsTO" value="sms" checked> Only SMS &nbsp; &nbsp; &nbsp; &nbsp; 
										<input type="radio" name="smsTO" value="mail" > Only Email &nbsp; &nbsp; &nbsp; &nbsp; 
										<input type="radio" name="smsTO" value="both" > Both
									  
									</div>
								</div>
								<?php
								$q = new Query();
								$q->select()
								->from(TBL_REGISTERS)
								->where_equal_to(array('admin_id'=>$login_id))
								->run();
								$disti=  $q->get_selected();
								?>
								<div class="col-lg-12">
									<div class="form-group">
										
									<!--<table class='table invite_contact_list'>-->
										<div class="table-responsive" style="margin-top: 80px;">
											<table class="table table-striped table-bordered table-hover" id="dataTables-example" >
												<thead>
													<tr>
														<th>Name</th><th>Mobile</th><th>Email</th>
													</tr>
												</thead>
												<tbody>
												<tr class="odd gradeX">
													<td><input type='checkbox' name='all' id='allcheck' value="all"> All</td>
													<td></td>
													<td></td>
												</tr>
												<?php 
												foreach ($disti as $catename)
												{
													

												?>  
												<tr class="odd gradeX">
													<td><input type='checkbox' name='contacts[]' class='contact_check' value='<?php echo $catename["id"]; ?>'> Mr.<?php echo ucfirst($catename["username"]); ?></td>
													<td><?php echo $catename["mobile"]; ?></td>
													<td><?php echo $catename["email"]; ?></td>
												</tr>
												<?php
												}
												?>
											</table>
										</div>
									</div>
								</div>
								
							</div>
							   
									
							<input class="btn btn-primary pull-left" type="submit" name="submit" value="Send Message" />
							
						</form>
					</div>
				</div>

			</div>
			

			
		</div>		
	</div>
</div>
<?php echo  common::load_view("common","footer"); ?>
<?php //echo  common::load_view("common","load_editor"); ?>
<script>
$(function(){
	
$("#allcheck").click(function(){
	//alert("here");
	
		if($("#allcheck").is(":checked")) {
		$(".contact_check").prop('checked', true);
		}
		else
		{
		$(".contact_check").prop('checked', false);
		}
	
});	
});
</script>

</body>
</html>
