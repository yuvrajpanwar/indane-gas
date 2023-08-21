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
<h1 class="page-header"><i class="fa fa-plus-square"></i> User <div class="action pull-right">
    <div class="action pull-right">
		    <a href="<?php echo common::get_component_link(array("appuser","list")); ?>" class="btn btn-primary btn-small"><i class="fa fa-list"></i> List </a>
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
 	<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
					<div class="col-lg-1" style="width:100px;">
							<label class="col-lg-12">SurName</label>
							<select name="surname" id="surname" class="form-control">
								<option value="Mr.">Mr.</option>
								<option value="Mrs.">Mrs.</option>
							</select>
					</div>
                    <div class="form-group col-lg-5">
                        <!--<label for="text1" class="control-label col-lg-4">User Name</label>-->
						<label class="col-lg-12">Full Name *</label>
                        <div class="col-lg-12">
						<input class="text-input form-control" name="username" type="text" />
					   </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <!--<label for="text1" class="control-label col-lg-4">Mobile Number</label>-->
						<label class="col-lg-12">Mobile Number *</label>
                        <div class="col-lg-12">
						<input class="text-input form-control" name="mobile" type="text" />
					   </div>
                    </div>
                    <!--<div class="form-group col-lg-6">
                        <label for="text1" class="control-label col-lg-4">Password</label>
						<label>Mobile Number *</label>
                        <div class="col-lg-8">
						<input class="text-input" name="password" type="password" />
					</div>
                    </div>-->
                    <div class="form-group col-lg-6">
						<label class="col-lg-12">Email </label>
                        <div class="col-lg-12">
						<input class="text-input form-control" name="email" type="email" />
					</div>
                    </div>
					<div class="form-group col-lg-6">
                        <!--<label for="text1" class="control-label col-lg-4">City</label>-->
						<label class="col-lg-12">City *</label>
                        <div class="col-lg-12">
						<input class="text-input form-control" name="city" type="text" />
					</div>
                    </div>
					<div class="form-group col-lg-6">
                        <!--<label for="text1" class="control-label col-lg-4">Address</label>-->
						<label class="col-lg-12">Address </label>
                        <div class="col-lg-12">
						<input class="text-input form-control" name="address" type="text" />
					</div>
                    </div>
                     
                    <!--<div class="form-group col-lg-6">
                        <label for="text1" class="control-label col-lg-4">Active</label>
						<label>City *</label>
                        <div class="col-lg-12">
						<select name="active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
					</div>
                    </div>-->
                    <div class="form-group col-lg-6">
                        <div class="col-lg-12" style="text-align:right;">
							<input class="btn btn-primary col-md-12" style="margin-top:25px;" type="submit" name="submit" value="Add" />
						</div>
                    </div>
				</div>
            </form>




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
