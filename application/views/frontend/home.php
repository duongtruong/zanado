<div class="page one-columns">
<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col1-layout">
                <div class="row">
                    <div class="col-sm-24 em-col-main">
                        <div class="em-wrapper-area03">
                        </div><!-- /.em-wrapper-area03 -->
                        <div class="std"></div>

                        <div class="em-wrapper-new-arrivals-tabs">
                            <div class="em-new-arrivals-tabs em-line-01">
                                <div class="emtabs-ajaxblock-loaded">
                                    <div class="em-tabs-widget tabs-widget ">
                                        <div class="widget-title em-widget-title">
                                            <h3><span>Hot deal</span></h3>
                                        </div>
                                        <div id="emtabs" class="em-tabs emtabs r-tabs">
                                            <ul class="em-tabs-control tabs-control r-tabs-nav">
                                                <li class="r-tabs-tab">
                                                    <a class="r-tabs-anchor" href="<?php echo base_url('hot-deal.html')?>"> <span class="icon"></span>Trong ngày</a>
                                                </li>
                                                <li class="r-tabs-state-default r-tabs-tab">
                                                    <a class="r-tabs-anchor" href="<?php echo base_url('hot-deal.html')?>"> <span class="icon"></span>Tuần</a>
                                                </li>
                                                <li class="r-tabs-state-default r-tabs-tab">
                                                    <a class="r-tabs-anchor" href="<?php echo base_url('hot-deal.html')?>"> <span class="icon"></span>Tháng</a>
                                                </li>
                                                <li class="r-tabs-state-default r-tabs-tab">
                                                    <a class="r-tabs-anchor" href="<?php echo base_url('hot-deal.html')?>"> <span class="icon"></span>Tất cả</a>
                                                </li>
                                            </ul>
                                            <div id="tab_emtabs_1_1" class="tab-pane tab-item content_tab_emtabs_1_1 r-tabs-panel r-tabs-state-active">
                                                <div class="wrapper button-show01 button-hide-text em-wrapper-loaded">
                                                    <div class="emfilter-ajaxblock-loaded">
                                                        <div id="em_fashion_new_arrivals_tab01" class="em-grid-25">

                                                            <div class="widget em-filterproducts-grid">
                                                                <div class="widget-products em-widget-products">
                                                                    <div class="emcatalog-desktop-5" id="em-grid-mode-em_fashion_new_arrivals_tab01">
                                                                        <div class="products-grid ">
                                                                        <?php
                                                                            if (isset($deals)) {
                                                                                $i = 1;
                                                                                foreach ($deals as $key => $value) {
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
                                                                                                $link  = '<img class="img-responsive em-alt-org em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="350" width="350">';
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
                                                                                    <div class="item '.$class.'">
                                                                                        <div class="product-item">
                                                                                            <div class="product-shop-top" data-list-img="'.$data_list_img.'">
                                                                                                '.$link.'
                                                                                                <div class="em-element-display-hover bottom">
                                                                                                    '.$addCart.'
                                                                                                    <div class="quickshop-link-container">
                                                                                                        <a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" class="quickshop-link" title="Xem">Xem</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div><!-- /.product-shop-top -->

                                                                                            <div class="product-shop">
                                                                                                <div class="f-fix">
                                                                                                    <!--product name-->
                                                                                                    <h3 style="height: 36px; overflow: hidden" class="product-name"><a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'">'.$value['title'].'</a></h3><div class="ratings">
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
                                                                                        </div>
                                                                                    </div>';

                                                                                    $i++;
                                                                                    if ($i == 6) {
                                                                                        $i = 1;
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                        </div><!-- /.products-grid -->
                                                                    </div><!-- /.emcatalog-desktop-5 -->
                                                                </div><!-- /.widget-products -->
                                                            </div><!-- /.widget -->

                                                        </div><!-- /#em_fashion_new_arrivals_tab01 -->
                                                    </div>
                                                </div>
                                            </div><!-- /#tab_emtabs_1_1 -->
                                        </div><!-- /#emtabs_1 -->
                                    </div>
                                </div>
                            </div><!-- /.em-new-arrivals-tabs -->
                        </div><!-- /.em-wrapper-new-arrivals-tabs -->

                        <?php foreach ($items as $item) { ?>
                        <div class="em-wrapper-new-arrivals-tabs">
                            <div class="em-new-arrivals-tabs em-line-01">
                                <div class="emtabs-ajaxblock-loaded">
                                    <div class="em-tabs-widget tabs-widget ">
                                        <div class="widget-title em-widget-title">
                                            <h3><span><?php echo $item['name']?></span></h3>
                                        </div>
                                        <div id="emtabs" class="em-tabs emtabs r-tabs">
                                            <ul class="em-tabs-control tabs-control r-tabs-nav">
                                                <?php
                                                if (isset($categories) && is_array($categories)){
                                                    foreach ($categories as $v) {
                                                    if($v['parent_id'] == $item['id']){
                                                            echo '
                                                            <li class="r-tabs-tab">
                                                                <a class="r-tabs-anchor" href="'.base_url('p/cat/'.$v['slug'].'-'.$v['id'].'.html').'"> <span class="icon"></span>'.$v['title'].'</a>
                                                            </li>';
                                                        }
                                                    }

                                                    echo '
                                                        <li class="r-tabs-tab">
                                                            <a class="r-tabs-anchor" href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id'].'.html').'"> <span class="icon"></span>Tất cả</a>
                                                        </li>';
                                                }
                                                ?>

                                            </ul>
                                                <div id="tab_emtabs_1_1" class="tab-pane tab-item content_tab_emtabs_1_1 r-tabs-panel r-tabs-state-active">
                                                    <div class="wrapper button-show01 button-hide-text em-wrapper-loaded">
                                                        <div class="emfilter-ajaxblock-loaded">
                                                            <div id="em_fashion_new_arrivals_tab01" class="em-grid-20 ">

                                                                <div class="widget em-filterproducts-grid">
                                                                    <div class="widget-products em-widget-products">
                                                                        <div class="emcatalog-desktop-5" id="em-grid-mode-em_fashion_new_arrivals_tab01">
                                                                            <div class="products-grid ">
                                                                            <?php
                                                                            if (isset($item['items']) && $item['items']) {
                                                                                $i = 1;
                                                                                foreach ($item['items'] as $key => $value) {
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
                                                                                                $link  = '<img class="img-responsive em-alt-org em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="350" width="350">';
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
                                                                                    <div class="item '.$class.'">
                                                                                        <div class="product-item">
                                                                                            <div class="product-shop-top" data-list-img="'.$data_list_img.'">
                                                                                                '.$link.'
                                                                                                <div class="em-element-display-hover bottom">
                                                                                                    '.$addCart.'
                                                                                                    <div class="quickshop-link-container">
                                                                                                        <a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" class="quickshop-link" title="Xem">Xem</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div><!-- /.product-shop-top -->

                                                                                            <div class="product-shop">
                                                                                                <div class="f-fix">
                                                                                                    <!--product name-->
                                                                                                    <h3 style="height: 36px; overflow: hidden" class="product-name"><a href="'.base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'">'.$value['title'].'</a></h3><div class="ratings">
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
                                                                                        </div>
                                                                                    </div>';

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
                                                                            </div><!-- /.products-grid -->
                                                                        </div><!-- /.emcatalog-desktop-5 -->
                                                                    </div><!-- /.widget-products -->
                                                                </div><!-- /.widget -->

                                                            </div><!-- /#em_fashion_new_arrivals_tab01 -->
                                                        </div>
                                                    </div>
                                                </div><!-- /#tab_emtabs
                                        </div><!-- /#emtabs_1 -->
                                    </div>
                                </div>
                            </div><!-- /.em-new-arrivals-tabs -->
                        </div><!-- /.em-wrapper-new-arrivals-tabs -->
                        <?php }?>
                        <div class="em-wrapper-banners hidden-xs">
                            <div class="em-effect06">
                                <a class="em-eff06-03" title="" href="#"> <img class="img-responsive" alt="em-sample-alt" src="<?php echo base_url()?>/public/assets/images/wysiwyg/em_ads_10.jpg" /> </a>
                            </div>
                        </div><!-- /.em-wrapper-banners -->

                        <div class="em-best-sales em-wrapper-product-15">
                            <div class="emfilter-ajaxblock-loaded">
                                <div class="em-grid-15 custom-product-list">
                                    <div class="widget-title em-widget-title">
                                        <h3><span>Bạn quan tâm</span></h3>
                                    </div>

                                    <div class="widget em-filterproducts-list">
                                        <div class="widget-products em-widget-products">
                                            <?php
                                            if ($items_related) {
                                                $i = 1;
                                                foreach ($items_related as $key => $value) {
                                                    $class = '';
                                                    if ($i === 1) {
                                                        echo '<div class="products-list ">';
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
                                                    $p_url        = base_url('product-'.vn_str_filter($value['title']).'-'.$value['id']).'.html'; 

                                                    if ($value['is_hot']) {
                                                        $is_hot = '<li class="label hot"><p> Hot </p></li>';
                                                    }

                                                    if ($value['deal'] && $value['type'] == 0) {
                                                        $deal_price   = '<p class="old-price"><span class="price-label">Regular Price:</span><span class="price" id="old-price-182-emprice-c095817cdda4bcb80055091211aacad7">'.number_format((float) $value['buy_price']).' đ</span></p>';
                                                        $deal_percent = '<ul class="productlabels_icons">'.$is_hot.'<li class="label special"><p><span>-'.intval(100*$value['deal']/$value['buy_price']).'%</span> </p></li></ul>';
                                                    }

                                                    if ($value['type'] == 0) {
                                                        $s_price = number_format((float) (intval($value['buy_price'] - $value['deal']))) . ' đ';
                                                    }
                                                    else {
                                                        $s_price = 'LIÊN HỆ';
                                                    }
                                                    
                                                    $data_list_img = '';
                                                    foreach ($images as $img) {
                                                        if ($img) {
                                                            $info = pathinfo($img);
                                                            $img  = $info['dirname'].'/110x110-'.$info['filename'].'_thumb.'.$info['extension'];
                                                            $img  = base_url('/public/uploads/products/'.$img);
                                                            if ($k == 0) {
                                                                $link  = '<img class="img-responsive em-alt-org em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="110" width="110">';
                                                                $b_img = $img; 
                                                            }
                                                            elseif ($k == 1)
                                                            {
                                                                $link  = '<a href="'.$p_url.'" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="110" width="110">'.$deal_percent.$link.'</a>';
                                                                $fLink = TRUE;
                                                            }
                                                            $data_list_img .= $img.';';
                                                            $k++;
                                                        }
                                                    }
                                                    if (!$fLink) {
                                                        $link  = '<a href="'.$p_url.'" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$b_img.'" data-original="'.$b_img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                                                    }

                                                    echo '
                                                    <div class="item '.$class.'">
                                                        '.$link.'
                                                        <div class="product-shop">
                                                            <div class="f-fix">
                                                                <!--product name-->
                                                                <h3 class="product-name"><a href="'.$p_url.'" title="'.$value['title'].'">'.$value['title'].'</a></h3>
                                                                <!--product description-->
                                                                <!--product reviews-->
                                                                <div class="ratings">
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:'.floatval($value['ratePoint']*20).'%"></div>
                                                                    </div>
                                                                    <span class="amount"><a href="#">('.$value['rateCount'].')</a></span>
                                                                </div>
                                                                <!--product price-->
                                                                <div class="price-box '.$class_price.'">
                                                                    '.$deal_price.'
                                                                    <p class="special-price">
                                                                        <span class="price-label">Special Price</span>
                                                                        <span class="price" id="product-price-184-emprice-9c7acb644d253ae8c0c656d97ce7a00f"> '.$s_price.' </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.item -->
                                                    ';

                                                    if ($i === 5) {
                                                        echo '</div>';
                                                    }
                                                    /**/
                                                    $i++;
                                                    if ($i === 6) {
                                                        $i = 1;
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div><!-- /.widget -->

                                </div><!-- /.em-grid-15 -->
                            </div>
                        </div><!-- /.em-best-sales -->
                    </div><!-- /.em-col-main -->
                </div>
            </div><!-- /.em-main-container -->
        </div><!-- /.em-inner-main -->
    </div><!-- /.container -->
</div><!-- /.em-wrapper-main -->
</div>