<!DOCTYPE html>
<html lang="en">
  <head>
   <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#5bc0de">
    <meta name="msapplication-TileImage" content="<?php echo ADMIN_THEME; ?>img/metis-tile.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/Font-Awesome/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>css/main.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>css/theme.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/uniform/themes/default/css/uniform.default.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/inputlimiter/jquery.inputlimiter.1.0.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/chosen/chosen.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/colorpicker/css/colorpicker.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/tagsinput/jquery.tagsinput.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/datepicker/css/datepicker.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/switch/build/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>lib/jasny/css/jasny-bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
      <script src="<?php echo ADMIN_THEME; ?>lib/html5shiv/html5shiv.js"></script>
	      <script src="<?php echo ADMIN_THEME; ?>lib/respond/respond.min.js"></script>
	    <![endif]-->

    <!--Modernizr 3.0-->
    <script src="<?php echo ADMIN_THEME; ?>lib/modernizr-build.min.js"></script>
  </head>
  <body>
  <div class="" id="wrap">
        <?php echo common::elements("header"); ?>
       	<?php echo common::elements("sidebar");  ?>
        
        <div id="content">
            <div class="outer">
                <div class="inner">
                    
                    
            <div class="row">
              <div class="col-lg-6">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5>Add New User</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
                      <nav style="padding: 8px;">
                        <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                          <i class="fa fa-minus"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-default btn-xs full-box">
                          <i class="fa fa-expand"></i>
                        </a> 
                        <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                          <i class="fa fa-times"></i>
                        </a> 
                      </nav>
                    </div><!-- /.toolbar -->
                  </header>
			<?php if ( common::do_show_message() ) {
		          echo common::show_message();	
            } ?>

			<!-- Page Head -->
			 <div id="div-1" class="body">
			<form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">User Name</label>
                        <div class="col-lg-8">
						<input class="text-input" name="username" type="text" />
					   </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Password</label>
                        <div class="col-lg-8">
						<input class="text-input" name="password" type="password" />
					</div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Email</label>
                        <div class="col-lg-8">
						<input class="text-input" name="email" type="email" />
					</div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Type</label>
                        <div class="col-lg-8">
						<select name="type">
                            <option>admin</option>
                            <option>user</option>
                        </select>
					</div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Active</label>
                        <div class="col-lg-8">
						<select name="active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
					</div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-8">
						<input class="btn" type="submit" name="submit" value="Add" />
					       </div>
                    </div>
                    </div>
            </form>
				</div>
                </div>
                </div>
                    
                </div>
            </div>
        </div>
          
            
 </div>
 			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2013 Tile Store | Powered by <a href="http://waywebsolution.com">way tech</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
    <script src="<?php echo ADMIN_THEME; ?>lib/jquery.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/tagsinput/jquery.tagsinput.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/validVal/src/js/jquery.validVal.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/daterangepicker/moment.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/switch/build/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/autosize/jquery.autosize.min.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>lib/jasny/js/jasny-bootstrap.min.js"></script>
    <script>
      $(function() {
        formGeneral();
      });
    </script>
    <script src="<?php echo ADMIN_THEME; ?>lib/screenfull/screenfull.js"></script>
    <script src="<?php echo ADMIN_THEME; ?>js/main.min.js"></script>

   

  </body>
</html>
