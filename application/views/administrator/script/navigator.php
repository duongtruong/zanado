<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="#">
			    <?php echo $project_name?>					
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="dropdown">						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i>
							Account
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url('administrator/setting')?>">Settings</a></li>
							<li><a href="<?php echo base_url()?>index.php/administrator/logout">Logout</a></li>
						</ul>						
					</li>
				</ul>
			    <?php
                    if($project_dir == 'administrator')
                    {
                        $page = 'administrator';
                    }
                ?> 
				<form action="<?php echo base_url().'index.php/'.$page.'/search'?>" method="GET" class="navbar-search pull-right">
					<input type="text" class="search-query" placeholder="Search" name="value">
					<?php
						if (isset($option_search) && $option_search) {
						?>
						<div class="search-option-item">
							<a class="<?php if(!isset($option) || !is_numeric($option)) echo 'active'?>" href="<?php if(isset($currentUrl)) echo (str_replace('&o=0', '', str_replace('&o=1', '', $currentUrl)))?>" >Tất cả</a>
							<a class="<?php if(isset($option) && $option == 0) echo 'active'?>" href="<?php if(isset($currentUrl)) {if(strpos($currentUrl, '&o=0') !== FALSE) {echo str_replace('&o=1', '', $currentUrl);}else {echo str_replace('&o=1', '', $currentUrl).'&o=0';}}?>" >SP sẵn có</a>
							<a class="<?php if(isset($option) && $option == 1) echo 'active'?>" href="<?php if(isset($currentUrl)) {if(strpos($currentUrl, '&o=1') !== FALSE) {echo str_replace('&o=0', '', $currentUrl);}else {echo str_replace('&o=0', '', $currentUrl).'&o=1';}}?>" >SP Order</a>
						</div>
						<?php
						}
					?>
                    <input type="hidden" name="p" value="<?php if($this->uri->segment(2) != 'search')echo $this->uri->segment(2); else echo $searchpage?>" />
				</form>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
    

<?php 
    $this->load->view('administrator/pages/subnavbar');
?>