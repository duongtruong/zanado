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
	                        	$currentLink = $slug;
	                        	echo '<li class="product"> <strong>'.$title.'</strong></li>';
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
                <div class="em-main-container em-col1-layout">
                    <div class="row">
                        <div class="col-sm-24 em-col-main">
                            <div class="category-products">
                                <div id="em-grid-mode" class="emcatalog-desktop-5">
                                	<ul class="tablist" style="margin-left:10px">
                                		<?php $params_sort = isset($params) ? $params : array(); if (isset($params['sortlist'])) unset($params_sort['sortlist'])?>
                                		<li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_new_desc') echo 'selected'?>"><a href="<?php echo base_url(''.$currentLink.'.html')?>?sortlist=product_new_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Mới nhất">Mới nhất</a></li>
                                		<li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_sale_desc') echo 'selected'?>"><a href="<?php echo base_url(''.$currentLink.'.html')?>?sortlist=product_sale_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Hot nhất">Hot nhất</a></li>
                                		<li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_saleoff_desc') echo 'selected'?>"><a href="<?php echo base_url(''.$currentLink.'.html')?>?sortlist=product_saleoff_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Rẻ nhất">Rẻ nhất</a></li>
                                		<li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_sale_buy') echo 'selected'?>"><a href="<?php echo base_url(''.$currentLink.'.html')?>?sortlist=product_sale_buy<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Hàng đẹp">Hàng đẹp</a></li>
                                		<li class="tabclick <?php if(isset($index_tab_sort) && $index_tab_sort == 'product_view_desc') echo 'selected'?>"><a href="<?php echo base_url(''.$currentLink.'.html')?>?sortlist=product_view_desc<?php if(isset($params_sort)) echo '&'.http_build_query($params_sort)?>" title="Yêu thích">Yêu thích</a></li>
                                		</ul>
                                    <ul class="emcatalog-grid-mode products-grid emcatalog-disable-hover-below-mobile">
                                    	<?php
                                            if (isset($list_item)) {
                                                $i = 1;
                                                foreach ($list_item as $key => $value) {
                                                    $class = '';
                                                    if ($i == 1) {
                                                        $class = 'first';
                                                    }
                                                    elseif ($i == 5) {
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
                                                    if ($i == 6) {
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
                        
                    </div>
                </div><!-- /.em-main-container -->
            </div>
        </div>
    </div><!-- /.em-wrapper-main -->
</div>