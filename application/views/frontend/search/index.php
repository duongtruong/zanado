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
	                        	echo '<li class="product"> <strong>'.$title.'</strong></li>';
	                        ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div><!-- /.wrapper-breadcrums --><!-- /.wrapper-breadcrums -->

    <div class="em-wrapper-main" id="em-wrapper-main-search">
        <div class="container container-main">
            <div class="em-inner-main">
                <div class="em-main-container em-col1-layout">
                    <div class="row">
                        <div class="col-sm-24 em-col-main">
                            <div class="category-products">
                                <div class="toolbar-top">
                                    <div class="toolbar">
                                        <!-- <span class="glyphicon glyphicon-triangle-bottom" data-toggle="collapse" data-target=".demo"></span>
                                        
                                          <div id="demo" class="collapse demo">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                          </div> -->
                                        <div class="panel panel-default panel-search-form">
                                            <form action="" method="GET" id="frm-search">
                                                <div class="panel-heading pull-left" style="width: 100%">
                                                    <div class="col-sm-3">
                                                        <h3 class="panel-title pull-left search-title-form">LỌC THEO</h3>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                    <select class="sortby" name="sortlist" id="sortlist-search">
                                                        <option value="product_new_desc" <?php if (isset($sortlist) && $sortlist == 'product_new_desc') echo 'selected="selected"'?>>Mới nhất</option>
                                                        <option value="product_sale_desc" <?php if (isset($sortlist) && $sortlist == 'product_sale_desc') echo 'selected="selected"'?>>Hot nhất</option>
                                                        <option value="product_saleoff_desc" <?php if (isset($sortlist) && $sortlist == 'product_saleoff_desc') echo 'selected="selected"'?>>Rẻ nhất</option>
                                                        <option value="product_sale_buy" <?php if (isset($sortlist) && $sortlist == 'product_sale_buy') echo 'selected="selected"'?>>Hàng đẹp</option>
                                                        <option value="product_view_desc" <?php if (isset($sortlist) && $sortlist == 'product_view_desc') echo 'selected="selected"'?>>Yêu thích</option>
                                                    </select>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="inner-addon right-addon" style="float: left; max-width: 75%">
                                                            <i class="glyphicon glyphicon-search" style="right:10px"></i>
                                                            <input type="search" name="q" id="input" class="form-control" value="<?php echo $search_value?>" required="required" title="" placeholder="Nhập từ khóa...">
                                                        </div>
                                                        <button type="button" class="btn btn-danger" id="button-search">TÌM</button>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-filter-content">
                                                        <tr>
                                                            <td>Nhóm sản phẩm</td>
                                                            <td>
                                                                <?php
                                                                if (!isset($l_brandes)) {
                                                                    foreach ($categories as $category) {
                                                                        $c_active = in_array($category['id'], $selected['categories']) ? 'item-filter-active' : ''; $c_checked = in_array($category['id'], $selected['categories']) ? 'checked="checked"' : '';
                                                                        echo '<label class="category-attr item-filter '.$c_active.'">'.$category['title'].'<i>x</i><input '.$c_checked.' name="categories[]" class="display-none" type="checkbox" value="'.$category['id'].'"/></label>';
                                                                    }
                                                                }

                                                                if (isset($l_brandes) && $l_brandes) {
                                                                    echo '<label class="brande-attr item-filter item-filter-active">Thương hiệu<i>x</i><input checked="checked" name="brandes[]" class="display-none" type="checkbox" value="0"></label>';
                                                                    foreach ($this->temp['temp'] as $temp) {
                                                                        if ($temp['t_type'] == T_BRANDE){
                                                                            $c_active = in_array($temp['id'], $selected['brandes']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $selected['brandes']) ? 'checked="checked"' : '';
                                                                            echo '<label class="brande-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="brandes[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                                                                        }
                                                                    }
                                                                }
                                                                else {
                                                                    if (empty($selected['categories']))
                                                                        echo '<label class="brande-attr item-filter">Thương hiệu<i>x</i><input name="brandes[]" class="display-none" type="checkbox" value="0"></label>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Màu sắc</td>
                                                            <td>
                                                                <?php 
                                                                foreach ($this->temp['temp'] as $temp) {
                                                                    if ($temp['t_type'] == T_COLOR){
                                                                        $c_active = in_array($temp['id'], $selected['colors']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $selected['colors']) ? 'checked="checked"' : '';
                                                                        echo '<label class="color-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="colors[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Size</td>
                                                            <td>
                                                                <?php 
                                                                foreach ($this->temp['temp'] as $temp) {
                                                                    if ($temp['t_type'] == T_SIZE){
                                                                        $c_active = in_array($temp['id'], $selected['sizes']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $selected['sizes']) ? 'checked="checked"' : '';
                                                                        echo '<label class="size-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="sizes[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giá còn</td>
                                                            <td>
                                                                <?php 
                                                                foreach ($this->temp['temp'] as $temp) {
                                                                    if ($temp['t_type'] == T_PRICE){
                                                                        $c_active = in_array($temp['id'], $selected['prices']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $selected['prices']) ? 'checked="checked"' : '';
                                                                        echo '<label class="price-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="prices[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kiểu dáng</td>
                                                            <td>
                                                                <?php 
                                                                foreach ($this->temp['temp'] as $temp) {
                                                                    if ($temp['t_type'] == T_STYLE){
                                                                        $c_active = in_array($temp['id'], $selected['styles']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $selected['styles']) ? 'checked="checked"' : '';
                                                                        echo '<label class="style-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="styles[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                            <div class="loader-search" style="display: none;">
                                                <img src="<?php echo base_url('public/assets/images/bx_loader.gif')?>" class="img-responsive" alt="Image">
                                            </div>
                                        </div>  
                                    </div>
                                </div><!-- /.toolbar-top -->
                                <div id="em-grid-mode" class="emcatalog-desktop-5">
                                	
                                    <ul class="search-scroll emcatalog-grid-mode products-grid emcatalog-disable-hover-below-mobile" id="list-item-content">
                                    	<?php
                                            if (isset($list_item) && $list_item) {
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
                                                            $k++;
                                                        }
                                                    }
                                                    if (!$fLink) {
                                                        $link  = '<a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$b_img.'" data-original="'.$b_img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                                                    }

                                                    echo '
                                                    <li class="item '.$class.'">
			                                            <div class="product-item">
			                                                <div class="product-shop-top">
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
                                            	echo '<span class="home-no-items">Không tìm thấy sản phẩm phù hợp.</span>';
                                            }
                                        ?>
                                        <div class="search-scroll-loading display-none">
                                            <img src="<?php echo base_url('public/assets/images/bx_loader.gif')?>" class="img-responsive" alt="Image">
                                            <p>ĐANG XỬ LÝ</p>
                                        </div>
                                    </ul>
                                    <input type="hidden" class="search-scroll-url" value="<?php echo $currentLink?>" />
                                </div><!-- /.em-grid-mode -->
                                
                            </div><!-- /.category-products -->
                        </div><!-- /.em-col-main -->
                        
                    </div>
                </div><!-- /.em-main-container -->
            </div>
        </div>
    </div><!-- /.em-wrapper-main -->
</div>