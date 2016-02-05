<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">

			<ul class="mainnav">
			    <!-- <li class="dropdown <?php if($subnav == '0') echo 'active'?>">
                    <a href="<?php echo base_url('index.php/administrator/home')?>">
                        <i class="icon-dashboard"></i>
                        <span>Trang chủ</span>
                    </a>
                </li> -->

				<li class="dropdown <?php if($subnav == '1') echo 'active'?>">
					<a href="<?php echo base_url('index.php/administrator/manager')?>">
						<i class="icon-barcode"></i>
						<span>Sản phẩm</span>
					</a>
				</li>
                
                <li class="<?php if($subnav == '2') echo 'active'?>">
					<a href="<?php echo base_url()?>index.php/administrator">
						<i class="icon-plus"></i>
						<span>Thêm sản phẩm</span>
					</a>	    				
				</li>
                
				<li class="dropdown <?php if($subnav == '3') echo 'active'?>">					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-list"></i>
						<span>SP Thể loại</span>
						<b class="caret"></b>
					</a>	
				    
					<ul class="dropdown-menu">
                        <?php
                            function buildNavigation($items, $parent = 0)
                            {
                                $hasChildren = false;
                                $childrenHtml = '';
                                $outputHtml = '<ul class="dropdown-menu">%s</ul>';
                                if ($parent == 0) {
                                    $outputHtml = '%s';
                                }

                                foreach($items as $item)
                                {
                                    if ($item['parent_id'] == $parent) {                                        
                                        $hasChildren  = true;
                                        $temp         = buildNavigation($items, $item['id']);
                                        $dropdown     = $temp ? 'class="dropdown-submenu"' : '';
                                        $childrenHtml .= '<li '.$dropdown.'><a tabindex="-1" href="'.base_url('/administrator/category/'.$item['id']).'">'.$item['title'].'</a>';
                                        $childrenHtml .= $temp;         
                                        $childrenHtml .= '</li>';           
                                    }
                                }

                                // Without children, we do not need the <ul> tag.
                                if (!$hasChildren) {
                                    $outputHtml = '';
                                }

                                // Returns the HTML
                                return sprintf($outputHtml, $childrenHtml);
                            }

                            $categories = $this->temp['category'];
                            $html = buildNavigation($categories);
                            echo $html;
                        ?>
                    </ul>    				
				</li>
                <li class="dropdown <?php if($subnav == '4') echo 'active'?>">                  
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-group"></i>
                        <span>Quản trị viên</span>
                        <b class="caret"></b>
                    </a>    
                
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/moderator/add">Thêm</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/moderator/manager">Quản lý</a></li>
                    </ul>                   
                </li> 
                <li class="dropdown <?php if($subnav == '5') echo 'active'?>">                  
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-file-text"></i>
                        <span>Tin</span>
                        <b class="caret"></b>
                    </a>    
                
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/news/add">Thêm</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/news/manager">Quản lý</a></li>
                    </ul>                   
                </li>
                <li class="<?php if($subnav == '6') echo 'active'?>">                  
                    <a href="<?php echo base_url('/administrator/orders')?>">
                        <i class="icon-shopping-cart"></i>
                        <span>Đơn hàng</span>
                    </a>                 
                </li>
                <li class="dropdown <?php if($subnav == '7') echo 'active'?>">                  
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list-alt"></i>
                        <span>Quản lý Thể loại</span>
                        <b class="caret"></b>
                    </a>    
                
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/category/add">Thêm</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/category/manager">Quản lý</a></li>
                    </ul>                   
                </li>
                <li class="dropdown <?php if($subnav == '8') echo 'active'?>">                  
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-truck"></i>
                        <span>Thương hiệu</span>
                        <b class="caret"></b>
                    </a>    
                
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>index.php/administrator/brandes/add">Thêm</a></li>
                        <li><a href="<?php echo base_url()?>index.php/administrator/brandes/manager">Quản lý</a></li>
                    </ul>                   
                </li>
                <li class="<?php if($subnav == '9') echo 'active'?>">                  
                    <a href="<?php echo base_url('/administrator/reviews')?>">
                        <i class="icon-star"></i>
                        <span>Reviews</span>
                    </a>                 
                </li>
			</ul>

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->