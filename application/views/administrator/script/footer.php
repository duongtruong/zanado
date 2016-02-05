<div class="footer">
	
	<div class="footer-inner">
		
		<div class="container">
			
			<div class="row">
				
    			<div class="span12">
    				&copy; 2015 <a href="#">ESHOP - ADMINISTRATOR MANAGER</a>.
    			</div> <!-- /span12 -->
    			
    		</div> <!-- /row -->
    		
		</div> <!-- /container -->
		
	</div> <!-- /footer-inner -->
	
</div> <!-- /footer -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery.js"></script>

<script src="<?php echo base_url()?>public/assets/administrator/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/base.js"></script>

<!-- Load Tree multi select -->
<script src="<?php echo base_url()?>public/assets/administrator/js/tree-multiselect/jquery.tree-multiselect.min.js" type="text/javascript" charset="utf-8"></script>
<!-- production -->
<script type="text/javascript" src="<?php echo base_url()?>public/assets/administrator/js/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/administrator/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<!-- Rate JS -->
<script type="text/javascript" src="<?php echo base_url('public/assets/administrator/js/rate-bootstrap.js')?>"></script>

<!-- ====================================================== -->
<!-- Drag & Drop table -->
<link rel="stylesheet" href="<?php echo base_url()?>public/assets/administrator/css/tablednd.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url()?>public/assets/administrator/js/jquery.tablednd.js"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/public.js"></script>
<!-- Dialog -->
<script src="<?php echo base_url()?>public/assets/administrator/js/bootbox.min.js"></script>
<!-- Bootstrap Selected -->
<script type="text/javascript" src="<?php echo base_url()?>public/assets/administrator/js/bootstrap-select.min.js"></script>
<!-- Vadilate Form -->
<script src="<?php echo base_url()?>public/assets/administrator/js/jquery.validate.js"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/jquery.metadata.js"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/jquery.maskMoney.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url()?>public/assets/administrator/js/bootstrap-datetimepicker.min.js" type="text/javascript" charset="utf-8"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript">
    $(function()
    {
        $("#tableDnD").tableDnD();

        var options = { startCollapsed: true };
        $("select#categories").treeMultiselect(options);
        
        var container = $('div.error-container ');
        // validate the form when it is submitted
        var validator = $("#form_validate").validate({
            errorContainer: container,
            errorLabelContainer: $("ol", container),
            wrapper: 'li',
            meta: "validate"
        });

        $(".cancel").click(function () {
            validator.resetForm();
        });

        $('.selectpicker').on('change', function(){
            $('.selectpicker').selectpicker('refresh');
        });
        
        $(".price").maskMoney({thousands:'.', allowZero:true, defaultZero:false, precision: 0, suffix: ' VND'});

        tinymce.init({
            selector: '.textarea',
            entity_encoding : "raw",
            height: 150,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste code textcolor responsivefilemanager"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| image | forecolor backcolor  | print preview code ",
            image_advtab: true ,
           
            external_filemanager_path: '<?php echo base_url("/public/plugins/filemanager")?>/',
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : '<?php echo base_url("/public/plugins/filemanager/plugin.min.js")?>'}
        });

        tinymce.init({
            selector: '.textarea-550',
            entity_encoding : "raw",
            height: 550,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste code textcolor responsivefilemanager"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| image | forecolor backcolor  | print preview code ",
            image_advtab: true ,
           
            external_filemanager_path: '<?php echo base_url("/public/plugins/filemanager")?>/',
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : '<?php echo base_url("/public/plugins/filemanager/plugin.min.js")?>'}
        });
        
        $('.datetimepicker').datetimepicker({});
        $('.datetimepicker-notime').datetimepicker({format: 'dd/MM/yyyy'});
    });
</script>
<script src="<?php echo base_url()?>public/assets/administrator/js/scripts.js"></script>
