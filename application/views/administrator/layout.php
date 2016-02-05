<!DOCTYPE html>
<html lang="en">
  
<head>
    <?php
        $adm_logged = $this->session->userdata('adm_logged');
        if($adm_logged['project'] == 'administrator')
        {
            $dir = 'administrator'; $project_name = 'eShop Management';
        }

        $project = array('project_dir' => $dir, 'project_name' => $project_name);
        $this->load->view('administrator/script/head');
    ?>
</head>

<body>
<?php $this->load->view('administrator/script/navigator', $project);?>    
    
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
        
	       <?php $this->load->view($page, $content);?>
           
	    </div> <!-- /container -->
    
	</div> <!-- /main-inner -->
	    
</div> <!-- /main -->
    
   
    
<?php $this->load->view('administrator/script/footer', $project);?>
<input type="hidden" id="domain" value="<?php echo base_url('/administrator')?>" />

<div class="modal fade" id="ChooseIcon" style="width: 850px; margin-left: -450px; display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Chọn hình ảnh</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 850px;">
              <iframe width="850" height="400" src="<?php echo base_url()?>/public/plugins/filemanager/dialog.php?type=2&field_id=icon-field'&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

</body>

</html>
