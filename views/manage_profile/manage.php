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
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Profile
 
</h1>
</div>
</div>
<div class="row">
    <div class="col-md-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle fa-fw"></i> Update
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
			<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                  
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">User Name</label>
                        <div class="col-lg-8">
						<input class="text-input form-control" name="name" value="<?php echo $data["username"]; ?>" id="txttitle" type="text"  />
					</div>
                    </div>
                     
                   <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Email Id</label>
                        <div class="col-lg-8">
						<input class="text-input form-control" name="email" value="<?php echo $data["email"]; ?>" id="txttitle" type="text" readonly /> 
					</div>
                    </div>
                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Mobile Number</label>
                        <div class="col-lg-8">
						<input class="text-input form-control" name="mobile_num" value="<?php echo $data["mobile_number"]; ?>" id="txttitle" type="text"  /> 
					</div>
                    </div>
					<div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Address</label>
                        <div class="col-lg-8">
						<input class="form-control" name="address" value="<?php echo $data["address"]; ?>" type="text" />
						</div>
                    </div>
                     
                     
                    <p>
                        <div class="col-lg-4"></div>
						<input class="btn col-md-8 btn-primary" type="submit" name="add" value="Add" />
					</p>
            </form>
</div>
</div>

    </div>
    

    
</div>

            
            
			</div>
                  </div>
<?php echo common::load_view("common","footer"); ?>
<?php echo common::load_view("common","load_editor"); ?>
</body>

</html>
