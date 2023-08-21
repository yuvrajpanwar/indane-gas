<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Way Admin</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo ADMIN_THEME ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo ADMIN_THEME ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo ADMIN_THEME ?>css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEME ?>css/style.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Settings

</h1>
</div>
</div>
<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="row">
    <div class="col-md-6">

<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle fa-fw"></i> Settings
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?> 
			
            <?php
            foreach($settings as $setting){
                ?>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4"><?php echo $setting["title"]; ?></label>
                        <div class="col-lg-8">
							<input class="text-input form-control" name="setting['<?php echo $setting["title"]; ?>']" value="<?php echo $setting["value"]; ?>" id="txttitle" type="text"  /> 
						</div>
                    </div>
                <?php
            }
            ?>
                   
</div>
</div>

    </div>
    
    
</div>

                    <p>
                        
						<input class="btn btn-primary" type="submit" name="add" value="Add" />
					</p>
            
 </form>           
			</div>
                  </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo ADMIN_THEME ?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo ADMIN_THEME ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_THEME ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>


    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="<?php echo ADMIN_THEME ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo ADMIN_THEME ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo ADMIN_THEME ?>js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    
        <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
       
    });
    </script>
    <script>
    </script>
</body>

</html>
