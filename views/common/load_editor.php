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
<?php common::plugins("tinymce/tinymce"); ?>
<script src="<?php echo PLUGIN_DIR."uploadify/"; ?>jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_DIR."uploadify/"; ?>uploadify.css">
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
    				'swf'      : '<?php echo PLUGIN_DIR."uploadify/"; ?>uploadify.swf',
    				'uploader' : '<?php echo PLUGIN_DIR."uploadify/"; ?>uploadmedia.php',
                    'onUploadSuccess' : function(file, data, response) {
                        modal.find('#mediafiles').prepend(data); 
                    }
    			});
          $.ajax({
              type: "POST",
              url: "<?php echo PLUGIN_DIR."media/load.php"; ?>",
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