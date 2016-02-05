<div class="page one-column">
    <!-- /.em-wrapper-header -->

    <div class="wrapper-breadcrums">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-24">
	                <div class="breadcrumbs">
	                    <ul>
	                        <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
	                        <?php
	                        	$currentLink = '';
	                        	if ($nodes && count($nodes)) {
                                    foreach ($nodes as $node) {
                                        if ($node['id'] != $currentId)
                                            echo '<li class="home"> <a href="'.base_url('p/cat').'/'.$node['slug'].'-'.$node['id'].'.html" title="'.$node['title'].'"><span>'.$node['title'].'</span></a> <span class="separator">/ </span></li>';
                                        else {
                                            $currentLink = $node['slug'].'-'.$node['id'];
                                            echo '<li class="product"> <strong>'.$node['title'].'</strong></li>';
                                        }   
                                    }
                                }
                                else {
                                    echo '<li class="product"> <strong>'.$title.'</strong></li>';
                                }
	                        ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div><!-- /.wrapper-breadcrums --><!-- /.wrapper-breadcrums -->

    <div class="em-wrapper-main">
        <div class="container container-main">
            <div class="em-inner-main">
                <div class="em-main-container em-col2-left-layout">
                    <div class="row">
                        <div class="col-sm-18 col-sm-push-6 em-col-main">
                            <div class="category-products">

                                <div id="em-grid-mode" class="emcatalog-desktop-4">
                                    <ul class="tablist list-inline" style="margin-left:10px">
                                        <?php $params_sort = isset($params) ? $params : array(); if (isset($params['sortlist'])) unset($params_sort['sortlist'])?>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_new_desc') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_new_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Mới nhất">Mới nhất</a></li>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_sale_desc') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_sale_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Hot nhất">Hot nhất</a></li>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_saleoff_desc') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_saleoff_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Rẻ nhất">Rẻ nhất</a></li>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_sale_buy') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_sale_buy<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Hàng đẹp">Hàng đẹp</a></li>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_view_desc') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_view_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Yêu thích">Yêu thích</a></li>
                                        <li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_brand') echo 'selected'?>"><a href="<?php echo base_url('p/cat/'.$currentLink.'.html')?>?sortlist=product_brand<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Hàng hiệu">Hàng hiệu</a></li>
                                    </ul>
                                    <div class="clear both"></div>
                                    <ul class="emcatalog-grid-mode products-grid emcatalog-disable-hover-below-mobile">
                                    	<?php
                                            if (isset($list_item)) {
                                                $i = 1;
                                                foreach ($list_item as $key => $value) {
                                                    $class = '';
                                                    if ($i == 1) {
                                                        $class = 'first';
                                                    }
                                                    elseif ($i == 4) {
                                                        $class = 'last';
                                                    }
                                                    /*link*/
                                                    $link         = '';
                                                    $images       = explode('|', $value['images']);
                                                    $fLink        = FALSE;
                                                    $k            = 0;
                                                    $deal_percent = '';
                                                    $deal_price   = '';
                                                    $is_hot       = '';

                                                    if ($value['is_hot']) {
                                                        $is_hot = '<li class="label hot"><p> Hot </p></li>';
                                                    }

                                                    if ($value['deal'] && $value['type'] == 0) {
                                                        $deal_price   = '<p class="old-price"><span class="price-label">Regular Price:</span><span class="price" id="old-price-182-emprice-c095817cdda4bcb80055091211aacad7">'.number_format((float) $value['buy_price']).' đ</span></p>';
                                                        $deal_percent = '<ul class="productlabels_icons">'.$is_hot.'<li class="label special"><p><span>-'.intval(100*$value['deal']/$value['buy_price']).'%</span> </p></li></ul>';
                                                    }

                                                    if ($value['type'] == 0) {
                                                        $s_price = number_format((float) (intval($value['buy_price'] - $value['deal']))) . ' đ';
                                                        $addCart = '<div class="em-btn-addto">
                                                                        <!--product add to cart-->
                                                                        <button type="button" title="Mua hàng" class="button btn-cart btn-cart-home" href="'.base_url('cart-product-'.$value['id']).'"><span><span>Mua</span></span></button>
                                                                    </div>';
                                                    }
                                                    else {
                                                        $s_price = 'LIÊN HỆ';
                                                        $addCart = '';
                                                    }
                                                    $data_list_img = '';
                                                    foreach ($images as $img) {
                                                        if ($img) {
                                                            $info = pathinfo($img);
                                                            $img  = $info['dirname'].'/350x350-'.$info['filename'].'_thumb.'.$info['extension'];
                                                            $img  = base_url('/public/uploads/products/'.$img);
                                                            if ($k == 0) {
                                                                $link  = '<img class="img-responsive em-alt-org em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt=" Embellished Mirror Pastel" height="350" width="350">';
                                                                $b_img = $img; 
                                                            }
                                                            elseif ($k == 1)
                                                            {
                                                                $link  = '<a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                                                                $fLink = TRUE;
                                                            }
                                                            $data_list_img .= $img.';';
                                                            $k++;
                                                        }
                                                    }
                                                    if (!$fLink) {
                                                        $link  = '<a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$b_img.'" data-original="'.$b_img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                                                    }

                                                    echo '
                                                    <li class="item '.$class.'">
			                                            <div class="product-item">
			                                                <div class="product-shop-top" data-list-img="'.$data_list_img.'">
			                                                    '.$link.'
			                                                    <div class="bottom">
			                                                        '.$addCart.'
			                                                        <div class="quickshop-link-container">
                                                                        <a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" class="quickshop-link" title="Mua">Mua</a>
                                                                    </div>
			                                                    </div>
			                                                </div>

			                                                <!-- /.product-shop-top -->
                                                            <div class="product-shop">
                                                                <div class="f-fix">
                                                                    <!--product name-->
                                                                    <h3 style="min-height: 19px;" class="product-name"><a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'">'.$value['title'].'</a></h3><div class="ratings">
                                                                        <div class="rating-box">
                                                                            <div class="rating" style="width:'.floatval($value['ratePoint']*20).'%"></div>
                                                                        </div>
                                                                        <span class="amount"><a href="#">('.$value['rateCount'].')</a></span>
                                                                    </div>
                                                                    <!--product price-->
                                                                    <div class="price-box">
                                                                        '.$deal_price.'
                                                                        <span class="regular-price" id="product-price-170-emprice-2fd1cdd203d2809e7354d43dcdbdb613"> <span class="price">'.$s_price.'</span> </span>
                                                                    </div>

                                                                </div>
                                                            </div><!-- /.product-shop -->
			                                            </div><!-- /.product-item -->
			                                        </li>
                                                    ';

                                                    $i++;
                                                    if ($i == 5) {
                                                        $i = 1;
                                                    }
                                                }
                                            }
                                            else {
                                            	echo '<span class="home-no-items">Chưa có sản phẩm.</span>';
                                            }
                                        ?>
                                        
                                    </ul>
                                </div><!-- /.em-grid-mode -->
                                
                                <div class="toolbar-bottom em-box-03">
                                    <div class="toolbar">
                                        <div class="pager">
                                            <div class="paginations col-sm-24">
				                                <div class="pages">
				                                <?php
				                                    echo $this->pagination->create_links(); // tạo link phân trang
				                                ?>
				                                </div>
				                            </div>
                                        </div><!-- /.pager -->
                                        
                                    </div>
                                </div><!-- /.toolbar-bottom -->
                            </div><!-- /.category-products -->
                        </div><!-- /.em-col-main -->
                        <div class="col-sm-6 col-sm-pull-18 em-col-left em-sidebar">
                            <div class="em-wrapper-area02"></div>
                            <div class="em-line-01 block block-layered-nav">
                                <div class="em-block-title block-title"> <strong><span>Danh mục</span></strong>
                                </div>
                                <div class="block-content">
                                    <dl id="narrow-by-list">
                                        <dd>
                                            <ol class="filter tree-filter">
                                            	<ul class="s-dropdown-menu" style="padding: 0 20px; font-size: 12px; color: #222">
							                        <?php
							                            function buildNavigation($items, $currentId = 0, $parent = 0)
							                            {
							                                $hasChildren = false;
							                                $childrenHtml = '';
							                                $outputHtml = '<ul class="c-dropdown-menu">%s</ul>';
							                                if ($parent == 0) {
							                                    $outputHtml = '%s';
							                                }

							                                foreach($items as $item)
							                                {
							                                	$s = ($item['id'] == $currentId) ? 'selected' : '';
							                                    if ($item['parent_id'] == $parent) {                                        
							                                        $hasChildren  = true;
							                                        $temp         = buildNavigation($items, $currentId, $item['id']);
							                                        $dropdown     = $temp ? 'class="c-dropdown-submenu"' : '';
							                                        $childrenHtml .= '<li '.$dropdown.'><a class="'.$s.'" tabindex="-1" href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id']).'.html">'.$item['title'].'</a>';
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
							                            $html = buildNavigation($categories, $currentId, 0);
							                            echo $html;
							                        ?>
							                    </ul>
                                            </ol>
                                        </dd>
                                        <?php if(isset($params_sort) && $params_sort) {
                                        	$params_color = isset($params) ? $params : array();
											if (isset($params['color'])) unset($params_color['color']);
                                        	$url_color_params = base_url('p/cat/'.$currentLink.'.html').'?'.http_build_query($params_color);

                                        	$params_size = isset($params) ? $params : array();
											if (isset($params['size'])) unset($params_size['size']);
                                        	$url_size_params = base_url('p/cat/'.$currentLink.'.html').'?'.http_build_query($params_size);

                                        	$params_material = isset($params) ? $params : array();
											if (isset($params['material'])) unset($params_material['material']);
                                        	$url_material_params = base_url('p/cat/'.$currentLink.'.html').'?'.http_build_query($params_material);

                                        	$params_price = isset($params) ? $params : array();
											if (isset($params['price'])) unset($params_price['price']);
                                        	$url_price_params = base_url('p/cat/'.$currentLink.'.html').'?'.http_build_query($params_price);
                                        ?>
                                        <dt> Bạn đã chọn</dt>
                                        <dd>
                                            <ol>
                                                <?php
                                                foreach ($this->temp['temp'] as $temp) {
                                                	foreach ($params_sort as $k => $p) {
	                                                	if ($p) {
	                                                		if ($temp['t_type'] == T_COLOR && $p == $temp['id'] && $k == 'color') {
		                                                		echo '<li>Màu: '.$temp['t_value'].' <a href="'.$url_color_params.'"><span class="glyphicon glyphicon-remove pull-right" style="top:3px"></span></a></li>';
		                                                	}
		                                                	elseif ($temp['t_type'] == T_SIZE && $p == $temp['id']  && $k == 'size') {
		                                                		echo '<li>Size: '.$temp['t_value'].' <a href="'.$url_size_params.'"><span class="glyphicon glyphicon-remove pull-right" style="top:3px"></span></a></li>';
		                                                	}
		                                                	elseif ($temp['t_type'] == T_MATERIAL && $p == $temp['id']  && $k == 'material') {
		                                                		echo '<li>Chất: '.$temp['t_value'].' <a href="'.$url_material_params.'"><span class="glyphicon glyphicon-remove pull-right" style="top:3px"></span></a></li>';
		                                                	}
		                                                	elseif ($temp['t_type'] == T_PRICE && $p == $temp['id']  && $k == 'price') {
		                                                		echo '<li>Giá: '.$temp['t_value'].' <a href="'.$url_price_params.'"><span class="glyphicon glyphicon-remove pull-right" style="top:3px"></span></a></li>';
		                                                	}
	                                                	}
	                                                }
                                                }
                                                ?>
                                            </ol>
                                        </dd>
                                        <?php
                                        }?>
                                        <dt> Lọc Theo</dt>
                                        <dd>
                                            <ol>
                                            	<?php

                                            	if(!isset($params['color'])) {

                                            	?>
                                                <li> 
                                                	<a href="javascript:;" data-toggle="collapse" data-target="#collapse-colors">Màu sắc</a>
													<div id="collapse-colors" class="collapse">
														<select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
															<option value="#">Chọn màu</option>
															<?php
																$params_color = isset($params) ? $params : array();
																if (isset($params['color'])) unset($params_color['color']);
																$url_params = '&'.http_build_query($params_color);
																foreach ($this->temp['temp'] as $temp) {
																	if ($temp['t_type'] == T_COLOR) {
																		echo '<option value="'.base_url('p/cat/'.$currentLink.'.html').'?color='.$temp['id'].$url_params.'">'.$temp['t_value'].'</option>';
																	}
																}
															?>
														</select>
													</div>
												</li>
												<?php
												}
												if(!isset($params['size'])) {
                                            	?>
                                                <li>
                                                	<a href="javascript:;" data-toggle="collapse" data-target="#collapse-sizes">Sizes</a>
													<div id="collapse-sizes" class="collapse">
														<select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
															<option value="#">Chọn size</option>
															<?php
																$params_size = isset($params) ? $params : array();
																if (isset($params['size'])) unset($params_size['size']);
																$url_params = '&'.http_build_query($params_size);
																foreach ($this->temp['temp'] as $temp) {
																	if ($temp['t_type'] == T_SIZE) {
																		echo '<option value="'.base_url('p/cat/'.$currentLink.'.html').'?size='.$temp['id'].$url_params.'">'.$temp['t_value'].'</option>';
																	}
																}
															?>
														</select>
													</div>
                                                </li>
                                                <?php
												}
												if(!isset($params['material'])) {
                                            	?>
                                                <li>
                                                	<a href="javascript:;" data-toggle="collapse" data-target="#collapse-materials">Chất</a>
													<div id="collapse-materials" class="collapse">
														<select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
															<option value="#">Chọn chất</option>
															<?php
																$params_material = isset($params) ? $params : array();
																if (isset($params['material'])) unset($params_material['material']);
																$url_params = '&'.http_build_query($params_material);
																foreach ($this->temp['temp'] as $temp) {
																	if ($temp['t_type'] == T_MATERIAL) {
																		echo '<option value="'.base_url('p/cat/'.$currentLink.'.html').'?material='.$temp['id'].$url_params.'">'.$temp['t_value'].'</option>';
																	}
																}
															?>
														</select>
													</div>
                                                </li>
                                                <?php
												}
												if(!isset($params['price'])) {
                                            	?>
                                                <li>
                                                	<a href="javascript:;" data-toggle="collapse" data-target="#collapse-prices">Giá còn</a>
													<div id="collapse-prices" class="collapse">
														<select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
															<option value="#">Chọn giá</option>
															<?php
																$params_price = isset($params) ? $params : array();
																if (isset($params['price'])) unset($params_price['price']);
																$url_params = '&'.http_build_query($params_price);
																foreach ($this->temp['temp'] as $temp) {
																	if ($temp['t_type'] == T_PRICE) {
																		echo '<option value="'.base_url('p/cat/'.$currentLink.'.html').'?price='.$temp['id'].$url_params.'">'.$temp['t_value'].'</option>';
																	}
																}
															?>
														</select>
													</div>
                                                </li>
                                                <?php
                                            	}
                                                ?>
                                            </ol>
                                        </dd>
                                    </dl>
                                </div>
                            </div><!-- /.block-layered-nav -->
                            
                            <div class="em-wrapper-banners">
                                <div class="img-banner">
                                    <div class="em-effect06">
                                        <a class="em-eff06-04" href="#"><img class="img-responsive retina-img" alt="em_ads_01.jpg" src="<?php echo base_url('public/assets')?>/images/wysiwyg/em_ads_01.jpg">
                                        </a>
                                    </div>
                                </div>
                                <div class="img-banner" style="text-align: center;">
                                    <div class="effect-hover-text2">
                                        <a class="banner-img" title="em-sample-title" href="#"> <img class="img-responsive retina-img" alt="em-sample-alt" src="<?php echo base_url('public/assets')?>/images/wysiwyg/em_ads_05.jpg"> </a>
                                        <a class="banner-text" title="em-sample-title" href="#"> <img class="img-responsive" alt="em-sample-alt" src="<?php echo base_url('public/assets')?>/images/wysiwyg/em_ads_text_05.png"> </a>
                                    </div>
                                </div>
                            </div><!-- /.em-wrapper-banners -->
                        </div><!-- /.em-sidebar -->
                    </div>
                </div><!-- /.em-main-container -->
            </div>
        </div>
    </div><!-- /.em-wrapper-main -->
</div>