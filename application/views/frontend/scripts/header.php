<div class="container">
	<div class="row">
		<div class="header-top col-md-24">
			<div class="row">
				<div class="col-md-6 pull-left">
					<a href="<?php echo base_url('/')?>" title="Thời trang Online Mua quần áo nam nữ Đẹp Rẻ" class="logo"><img src="<?php echo base_url('/public/assets/images/logo-noen.png')?>" alt="Thời trang Online Mua quần áo nam nữ Đẹp Rẻ" class="img-responsive"></a>
				</div>

				<div class="header-block col-md-18">
					<div class="row">
						<div class="header-search col-md-9 pull-left">
							<form action="<?php echo base_url('search.html')?>" method="GET" role="form">
								<div class="form-group">
									<div class="inner-addon right-addon">
									    <i class="glyphicon glyphicon-search"></i>
									    <input type="search" name="q" id="input" class="form-control" value="" required="required" title="" placeholder="Tìm kiếm toàn bộ cửa hàng ...">
									</div>
								</div>
							</form>
						</div>
						<div class="header-hotline col-md-5 pull-left">
							<img src="<?php echo base_url('/public/assets/images/head_phone.png')?>" alt="HotLine" />
							<span>01649.613.659 <br> <i>Từ 8h00 - 22h00</i></span>
						</div>
						<?php if (isset($logger) && !empty($logger)) {?>
						<div class="header-user col-md-4 pull-left">
							<div class="dropdown">
							  	<a href="#" data-toggle="dropdown" class="dropdown-toggle">Tài khoản <b class="caret"></b></a>
							  	<ul class="dropdown-menu" id="setting-user">
								    <li><a href="<?php echo base_url('/u/setting')?>" fancybox="true" class="fancybox">Thông tin</a></li>
								    <li><a href="<?php echo base_url('/u/order')?>" fancybox="true" class="fancybox">Đơn hàng của tôi</a></li>
								    <li><a href="<?php echo base_url('/signout')?>" fancybox="false">Thoát</a></li>
							  	</ul>
							</div>
						</div>
						<?php } else {?>
						<div class="header-user col-md-4 pull-left">
							<a class="btn-header-login-top" data-toggle="modal" data-target="#myModallogin"><p>Đăng nhập <span class="glyphicon glyphicon-triangle-bottom"></span></p></a>
						</div>
						<?php }?>
						<div class="header-cart col-md-6 pull-left">
							<a href="<?php echo base_url('/checkout/cart.html')?>"><span class="qty header-qty-number"><?php echo $this->cart->total_items()?> SP </span> <span class="glyphicon glyphicon-shopping-cart"></span>Giỏ hàng <span class="glyphicon glyphicon-triangle-bottom"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
	<div class="row">
		<div class="header-bottom">
			<div class="nav-block">
				<div class="navigation-menu navigation-menu-block">
					<div class="menu-top nav-hori">
						<div class="nav-container showmenunav">
                            <ul class="nav-container-menu level1">
                            <?php
                            function buildMenu($items, $currentId = 0, $parent = 0, $level = 2)
                            {
                                $hasChildren = false;
                                $childrenHtml = '';
                                $outputHtml = '<ul class="level'.$level.'">%s</ul>';
                                if ($parent == 0) {
                                    $outputHtml = '%s';
                                }

                                foreach($items as $item)
                                {
                                    $s = ($item['id'] == $currentId) ? 'selected' : '';
                                    if ($item['parent_id'] == $parent) {                                        
                                        $hasChildren  = true;
                                        $temp         = buildMenu($items, $currentId, $item['id'], $item['level']+1);
                                        $c_left       = $item['level'] == 1 ? 'left' : '';
                                        $dropdown     = $temp ? 'class="parent '.$c_left.'"' : '';
                                        $lv3_li_class = $item['level'] == 3 ? 'class="cat-menu-sub-show"' : '';
                                        $spanclass    = $item['level'] == 1 ? '<span class="menucenter">' : '';
                                        $endspanclass = $item['level'] == 1 ? '</span>' : '';

                                        $childrenHtml .= '<li id="cat-menu-'.$item['id'].'" '.$dropdown.' '.$lv3_li_class.'>'.$spanclass.'<a class="'.$s.'" tabindex="-1" href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id']).'.html">'.$item['title'].'</a>'.$endspanclass;

                                        if ($item['level'] == 2) {
                                            $childrenHtml .= '<div class="nav-layerSpec">
                                            <div class="nav-menu-col nav-menu-col1"><h3>Danh mục</h3>';
                                        }

                                        $childrenHtml .= $temp;

                                        if ($item['level'] == 2) {
                                            $childrenHtml .= '
                                            <h3>Sắp xếp</h3>
                                            <ul class="level3">
                                                <li class="cat-menu-sub-show"><a href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'?sortlist=product_new_desc">Mới nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'?sortlist=product_sale_desc">Hot nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'?sortlist=product_saleoff_desc">Rẻ nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'?sortlist=product_sale_buy">Hàng đẹp</a></li>
                                                <li class="cat-menu-sub-show"><a href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'?sortlist=product_view_desc">Yêu thích</a></li>
                                            </ul>';
                                            $childrenHtml .= '</div></div>';

                                        }

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
                            $html = buildMenu($categories, 0, 0, 2);
                            echo $html;
                            ?>
                            <!-- <li id="cat-menu-15" class="parent left">
                                <span class="menucenter"><a href="<?php echo base_url('p/cat/thoi-trang-tre-em-3.html')?>">Trẻ em</a></span>
                                <ul class="level2">
                                    <li id="cat-menu-155" class="parent"><a href="http://zanado.com/be-gai-155.html" class="cat-menu-sub-show-main" id-cat="155">Bé Gái</a>
                                        <div class="nav-layerSpec">
                                            <div class="nav-menu-col nav-menu-col1">
                                            <h3>Danh mục</h3>
                                            <ul class="level3">
                                                <li id="cat-menu-176" class="cat-menu-sub-show"><a href="http://zanado.com/ao-be-gai-176.html" id-cat="176">Áo bé gái</a></li>
                                            </ul>
                                            <h3>Sắp xếp</h3>
                                            <ul class="level3">
                                                <li class="cat-menu-sub-show"><a href="http://zanado.com/be-gai-155.html?sortlist=product_new_desc">Mới nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="http://zanado.com/be-gai-155.html?sortlist=product_sale_desc">Hot nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="http://zanado.com/be-gai-155.html?sortlist=product_saleoff_desc">Rẻ nhất</a></li>
                                                <li class="cat-menu-sub-show"><a href="http://zanado.com/be-gai-155.html?sortlist=product_sale_buy">Hàng đẹp</a></li>
                                                <li class="cat-menu-sub-show"><a href="http://zanado.com/be-gai-155.html?sortlist=product_view_desc">Yêu thích</a></li>
                                            </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> -->
                            <li id="" class="left"><a href="<?php echo base_url('/brande-.html')?>">Thương hiệu</a></li>
                            <li id="tin-tuc" class="parent right"><span class="menucenter"><a href="<?php echo base_url('tin-tuc.html')?>">Tin tức</a></span>
                                <ul class="level2">
                                    <li id="" class="right"><a href="<?php echo base_url('tin-tuc/cat/mac-dep-3.html')?>">Xu hướng</a></li>
                                    <li id="" class="right"><a href="<?php echo base_url('tin-tuc/cat/mac-dep-4.html')?>">Mặc đẹp</a></li>
                                    <li id="" class="right"><a href="<?php echo base_url('tin-tuc/cat/mac-dep-1.html')?>">Khuyến mãi</a></li>
                                    <li id="" class="right"><a href="<?php echo base_url('tin-tuc/cat/mac-dep-2.html')?>">Thông báo</a></li>
                                </ul>
                            </li>
                            <li id="" class="right"><a href="<?php echo base_url('/hot-deal.html')?>">Hot deal</a></li>
                            <li id="" class="right"><a href="<?php echo base_url('/xu-huong.html')?>">Xu hướng</a></li>
                            <li id="" class="right"><a href="<?php echo base_url('/mua-nhieu.html')?>">HOT nhất</a></li>
                            <li id="" class="right"><a href="<?php echo base_url('/hang-moi.html')?>">Hàng mới</a></li>
                            <!-- <li id="" class="right"><a href="<?php echo base_url('/khuyen-mai.html')?>">Khuyến mãi</a></li> -->
                            </ul>
                        </div>
					</div>
				</div>
				<div class="nav-containersub nav-hori"></div>
			</div>
	</div>
	</div>
</div>