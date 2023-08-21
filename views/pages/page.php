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
    <link href="<?php echo ADMIN_THEME ?>css/jquery-ui.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <?php echo common::elements("adminnav"); ?>
        <div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Page <div class="action pull-right">
    
</div>
</h1>
</div>
</div>
<div class="row">
    <div class="col-md-12">

<?php  if ( common::do_show_message() ) {
		          echo common::show_message();	
} ?>

<form id="form" action="" class="col-md-12" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label for="text1" class="control-label ">Title</label>
                        <div class="">
						<input class="text-input form-control" name="title" id="txttitle" type="text" value="<?php echo $data["title"]; ?>"  /> (Ex. Zarry patel)
					</div></div>
                    
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="text1" class="control-label">Description</label>
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-file"></i> Add Media</button>
                        <div class="">
                    <textarea id="elm1" name="content"><?php echo $data["content"]; ?></textarea>        
</div></div>
<input class="btn col-md-8 btn-primary" type="submit" name="add" value="Add" />
                    </div>
                                </form>

    </div>
    
</div>

            
            
			</div>
                  </div>
   
    <!-- /#wrapper -->
<div class="modal fade bs-example-modal-lg" id="mediaModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="panel">
            <div class="panel-body">
                
                <div class="mediafiles" id="mediaContents">
                    <form>
            		  <input class="pull-left" id="file_upload" name="file_upload" type="file" multiple="true" />
                
            	   </form>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-heading">
                            <label class="panel-title">Media Files</label>
                        </div>
                        <div id="mediafiles">
                            
                        </div>
                   	</div>
                </div>
                </div>
             </div>
        </div>
    </div>
  </div>
</div>
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo ADMIN_THEME ?>js/jquery-1.10.2.js"></script>
    <?php common::plugins("tinymce/tinymce"); ?>
    <script src="<?php echo ADMIN_THEME ?>js/bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_THEME ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo ADMIN_THEME ?>js/jquery-ui.js"></script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="<?php echo ADMIN_THEME ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo ADMIN_THEME ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo ADMIN_THEME ?>js/sb-admin.js"></script>
<script src="<?php echo SITE_URL."/".PLUGIN_DIR."uploadify/"; ?>jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL."/".PLUGIN_DIR."uploadify/"; ?>uploadify.css">

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    
        <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $( "#datepicker" ).datepicker({
            dateFormat : "yy-mm-dd"
        });
        $(".publishedorNot-checkbox").change(function(){
            var val = 0;
            var id = $(this).data("id");
            
            if($(this).is(":checked"))
            {  
                
                val = 1;
            }else{
                val = 0;
            }
            $.ajax({
              method: "POST",
              url: "<?php echo SITE_URL ;?>/index.php?component=jobs&action=status",
              data: { id: id, val: val }
            })
              .done(function( msg ) {
                //alert( "Data Saved: " + msg );
            });
        });
    });
    </script>
    <script>
           $('#mediaModel').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          $('#file_upload').uploadify({
    				'formData'     : {
    					'timestamp' : '<?php echo $timestamp;?>',
    					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
    				},
    				'swf'      : '<?php echo SITE_URL."/".PLUGIN_DIR."uploadify/"; ?>uploadify.swf',
    				'uploader' : '<?php echo SITE_URL."/".PLUGIN_DIR."uploadify/"; ?>uploadmedia.php',
                    'onUploadSuccess' : function(file, data, response) {
                        modal.find('#mediafiles').prepend(data); 
                    }
    			});
          $.ajax({
              type: "POST",
              url: "<?php echo SITE_URL."/".PLUGIN_DIR."media/load.php"; ?>",
              data: {  }
            })
              .done(function( msg ) {
                modal.find('#mediafiles').html(msg);
              });
        });
        
        $('#mediafiles').on('click','.media-img',function(event){
               var name = $(this).data("name");
               tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '<img src="'+name+'" />');
            $('#mediaModel').modal('hide')
        });
        tinymce.init({
    selector: "textarea#elm1",
    theme: "modern",
    width: '100%',
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    convert_urls: false
 }); 
    </script>
</body>

</html>
