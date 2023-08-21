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
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Notification  
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

</body>
</html>
