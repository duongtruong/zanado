<?php
    $imgs = explode('|', $detail['images']); $iZoom = ''; $moreViews = '';
    foreach ($imgs as $key => $value) {
        if ($value) {
            $normal_img     = base_url('public/uploads/products/'.$value);
            $i              = pathinfo($value); $inside = "'inside'"; $useZoom = "'image_zoom'";
            
            $thumb_img      = base_url('public/uploads/products/'.$i['dirname'].'/350x350-'.$i['filename'].'_thumb.'.$i['extension']); 
            $rel_thumb_img  = "'".$thumb_img."'";
            $thumb_tiny_img = base_url('public/uploads/products/'.$i['dirname'].'/110x110-'.$i['filename'].'_thumb.'.$i['extension']);
            $moreViews .= '
            <li class="item hidden-before-loaded">
                <a class="cloud-zoom-gallery" rel="useZoom: '.$useZoom.', smallImage: '.$rel_thumb_img.', adjustX:5, adjustY:-5, position:'.$inside.'" onclick="return false" href="'.$normal_img.'"> <img src="'.$thumb_tiny_img.'" alt="" class="lazyOwl" /> </a>
            </li>';
            if (!$iZoom) {
                $iZoom = '<a class="cloud-zoom" id="image_zoom" rel="zoomWidth: 500,zoomHeight: 500,position: '.$inside.'" href="'.$normal_img.'"> <img class="em-product-main-img" src="'.$thumb_img.'" alt="" title="'.$detail['title'].'" /> </a>';
            }
        }
    }
?>
<div class="wrapper-breadcrums">
    <div class="container">
        <div class="row">
            <div class="col-sm-24">
                <div class="breadcrumbs">
                    <ul>
                        <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
                        <?php echo $breadcrumbs?>
                        <!-- <li class="category36"> <a href="category-one-column.html"><span>Shoes</span></a> <span class="separator">/ </span></li>
                        <li class="product"> <strong>WIASSI Version 1</strong></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.wrapper-breadcrums -->

<div class="em-wrapper-main">
    <div class="container-fluid container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col1-layout container">
                <div class="row">
                    <div class="em-col-main col-sm-24">
                        <div id="messages_product_view"></div>
                        <div class="product-view">
                            <div class="product-essential">
                                <form method="post" id="product_addtocart_form" action="<?php echo base_url('add-to-cart.html')?>">
                                    <input name="form_key" type="hidden" value="N4DL2crX27DuHSDk" />
                                    <div class="product-view-detail">
                                        <div class="em-product-view">
                                            <div class="em-product-view-primary em-product-img-box col-sm-8 first">
                                                <div id="em-product-shop-pos-top"></div>
                                                <div class="product-img-box">
                                                    <div class="media-left">
                                                        <p class="product-image">
                                                            <?php echo $iZoom?>
                                                        </p>
                                                    </div><!-- /.media-left -->
                                                    <div class="more-views">
                                                        <ul class="em-moreviews-slider ">
                                                            <?php echo $moreViews?>
                                                        </ul>
                                                    </div><!-- /.more-views -->
                                                </div>
                                            </div><!-- /.em-product-view-primary -->
                                            <div class="col-sm-10">
                                                <div class="product-shop">
                                                    <div id="em-product-info-basic">
                                                        <div class="product-name">
                                                            <h1><?php echo $detail['title']?></h1>
                                                        </div>
                                                        <div class="em-review-email">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width:<?php echo $detail['ratePoint']*20?>%"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#" class="r-lnk link_review_list"><?php echo $detail['rateCount']?> Review(s)</a> <span class="separator">|</span> <a href="#" class="r-lnk link_review_form">Viết phản hồi</a>
                                                                </p>
                                                                <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="true" style="margin-left:20px"></div>
                                                            </div><!-- /.ratings -->
                                                        </div>
                                                        <!-- <div class="em-sku-availability">
                                                            <p class="sku">Mã SP: SKU<?php echo $detail['id']?></p>
                                                        </div> -->
                                                        <div class="short-description">
                                                            <h2>Thông tin</h2>
                                                            <div class="std"><?php echo $detail['attributes']['sort_desc']?></div>
                                                        </div>

                                                        <?php if($detail['type'] == 0) {?>
                                                        <div>
                                                            <div class="price-box">
                                                                <span class="discount">-<?php $percent = round(100*$detail['deal']/$detail['buy_price']); echo $percent?>%</span>
                                                                <span class="regular-price" id="product-price-206"> <span style="color: black;text-decoration: line-through;font-size: 15px;" class="price"  content="<?php echo $detail['deal']?>"><?php echo number_format((float)$detail['deal'])?> đ</span> </span> <br>
                                                                <span class="regular-price" id="product-price-206"> <span class="price"  content="<?php echo $detail['buy_price']?>"><?php echo number_format((float)$detail['buy_price'] - $detail['deal'])?> đ</span> </span>
                                                                <div class="sprites pull-right">
                                                                    <span><?php echo $detail['transaction_num']?> </span>đã mua
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php  } else {?>
                                                        <p><label>MUA HÀNG: </label> <span class="call-order"><span class="glyphicon glyphicon-earphone"></span> 1900 561 256</span></p>
                                                        <?php }?>

                                                        <div class="product-options" style="overflow-y: hidden;">
                                                            <dl class="last"><dt class="swatch-attr"> <label class="required" id="color_label"> <em>*</em>Màu</dt>
                                                                <dd class="clearfix swatch-attr">
                                                                    <div class="input-box">
                                                                        <div id="colors_choosen">
                                                                        <?php
                                                                            $i = 0;
                                                                            foreach ($p_colors as $c) {
                                                                                $x = $i === 0 ? 'checked="checked"' : '';
                                                                                $cl = $i === 0 ? 'item-choosen-active' : '';
                                                                                echo '<label class="color-attr item-choosen '.$cl.'">'.$c['t_value'].'<input name="color" '.$x.' class="display-none color-choosen" type="radio" value="'.$c['id'].'"></label>';
                                                                                $i++;
                                                                            }
                                                                        ?>
                                                                        </div>
                                                                    </div>
                                                                </dd><dt class="swatch-attr"> <label class="required" id="color_label"> <em>*</em>Size</dt>
                                                                <dd class="last">
                                                                    <div class="input-box">
                                                                        <div id="sizes_choosen">
                                                                        <?php
                                                                            $i = 0;
                                                                            foreach ($p_sizes as $s) {
                                                                                $x = $i === 0 ? 'checked="checked"' : '';
                                                                                $cl = $i === 0 ? 'item-choosen-active' : '';
                                                                                echo '<label class="color-attr item-choosen '.$cl.'">'.$s['t_value'].'<input name="size" '.$x.' class="display-none size-choosen" type="radio" value="'.$s['id'].'"></label>';
                                                                                $i++;
                                                                            }
                                                                        ?>
                                                                        </div>
                                                                    </div>
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                        <?php if($detail['type'] == 0) {?>
                                                        <div class="add-to-box">
                                                            <div class="add-to-cart">
                                                                <label for="qty">Qty:</label>
                                                                <div class="qty_cart">
                                                                    <div class="qty-ctl">
                                                                        <button title="decrease" onclick="changeQty(0); return false;" class="decrease">decrease</button>
                                                                    </div>
                                                                    <input type="text" name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty" />
                                                                    <div class="qty-ctl">
                                                                        <button title="increase" onclick="changeQty(1); return false;" class="increase">increase</button>
                                                                    </div>
                                                                </div>
                                                                <div class="input-hidden">
                                                                    <input type="hidden" name="item_id" value="<?php echo $detail['id']?>"/>
                                                                </div>
                                                                <div class="button_addto">
                                                                    <button type="button" title="Buy Now" id="em-buy-now" class="button btn-em-buy-now" href="<?php echo base_url('add-to-cart.html')?>"><span><span>Mua Ngay</span></span>
                                                                    </button></a>
                                                                    <button type="submit" title="Add to Cart" id="product-addtocart-button" class="button btn-cart btn-cart-detail"><span><span>Thêm vào giỏ</span></span>
                                                                    </button>
                                                                </div>
                                                            </div><!-- /.add-to-cart -->
                                                        </div><!-- /.add-to-box -->
                                                        <?php }?>
                                                    </div><!-- /.em-product-info-basic -->
                                                </div>
                                            </div><!-- /.em-product-view-secondary -->

                                            <div class="col-sm-6 em-product-view-secondary em-product">
                                            	<div class="product-shop fix_menu product-shop-fixed-top">
                                                    <div id="em-product-info-basic">
                                                        <div class="info-product step">
                                                        <div class="block-info">
                                                            <div class="text">
                                                                <span class="point">1</span><span>Giao hàng TOÀN QUỐC</span>
                                                                <div style="clear:both"></div>
                                                                <span class="point">2</span><span>Thanh toán khi nhận hàng</span>
                                                                <div style="clear:both"></div>
                                                                <span class="point">3</span>Đổi trả trong <font color="#dc0309">7</font> ngày
                                                                <div style="clear:both"></div>
                                                                <span class="point">4</span><span>Hoàn ngay tiền mặt</span>
                                                                <div style="clear:both"></div>
                                                                <span class="point">5</span><span>Chất lượng đảm bảo</span>
                                                                <div style="clear:both"></div>
                                                                <span class="point">6</span><span>Cam kết hàng giống hình</span>
                                                                <div style="clear:both"></div>
                                                                <span class="point">7</span><span style="color: #EC6A54;">MIỄN PHÍ VẬN CHUYỂN</span>
                                                                <!--<div style="clear:both"></div>
                                                                <div style="margin-left: 20px; font-size: 12px; color: #dc0309;">
                                                                    » Đơn hàng từ 3 món trở lên
                                                                </div>-->
                                                                <div style="clear:both"></div>
                                                            </div>
                                                            <div class="product-diachilienhe">
                                                                <div class="title">Hướng Dẫn Mua Hàng</div>
                                                                <div class="text">
                                                                    <span style="font-weight:bold;">1.</span> Mua hàng trực tiếp tại website <span style="font-weight:bold;">eshop.com</span><br>
                                                                    <span style="font-weight:bold;">2.</span> Gọi điện thoại <span style="font-weight:bold;">19006049</span> để mua hàng<br>
                                                                    <!--<span style="font-weight:bold;">3.</span> Mua tại Trung tâm CSKH:<br><span style="font-weight:bold;">233B Bùi Thị Xuân, P.1, Q.Tân Bình, TP.HCM</span> (<a target="_blank" rel="nofollow" style="color:#dc0309" href="http://zanado.com/tro-giup/thanh-toan-tai-sieu-mua.html">Xem Bản Đồ</a>)<br>-->
                                                                    <span style="font-weight:bold;">3.</span> Mua sỉ/Buôn/Đặt may xin gọi <span style="font-weight:bold;">19006049</span> nhánh số <span style="font-weight:bold;">327</span> để được hỗ trợ.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rightbuy float">
                                                            <div class="buynow_value">
                                                                <div class="buttonaddtocart" style="display: none;"><button onclick="productAddToCartForm.submit(jQuery('.button.btn-cart.validation-passed')); (function(){showloadingbox()})();" class="button btn-cart validation-passed" title="Mua Ngay" type="button">MUA NGAY</button></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearer"></div>
                                    </div><!-- /.product-view-detail -->
                                </form>
                            </div><!-- /.product-essential -->
                            <div class="row">
                                <div class="em-product-view-primary col-sm-16 first"></div>
                            </div>
                            <div class="row">
                                <div class="em-product-view-primary col-sm-18 first">
                                    <div class="em-product-info ">
                                        <div class="em-product-details ">
                                            <div class="em-details-tabs product-collateral">
                                                <div class="em-details-tabs-content">
                                                    <div class="box-collateral em-line-01 box-description">
                                                        <div class="em-block-title">
                                                            <h2>CHI TIẾT</h2>
                                                        </div>
                                                        <div class="box-collateral-content">
                                                            <div class="std">
                                                                <p class="o-fix-w">Điểm nổi bật</p>
                                                                <?php echo urldecode($detail['attributes']['attributes'])?>

                                                                <p class="o-fix-w">Thông số kỹ thuật</p>
                                                                <?php echo urldecode($detail['attributes']['fulldesc'])?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.em-details-tabs-content -->
                                            </div><!-- /.em-details-tabs -->

                                            <div class="box-collateral box-reviews em-line-01" id="customer-reviews">
                                                <div id="customer_review_list" class="reviews">
                                                    <div class="em-block-title">
                                                        <h2>Reviews</h2>
                                                    </div>
                                                    <div class="em-box-review">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($reviews as $key => $value) {
                                                            $x = $i === 0 ? '' : 'bd-top-15';
                                                            if ($value['status'] == 0) { /*User*/
                                                                echo '
                                                                <div class="row '.$x.'">
                                                                    <div class="em-product-view-primary col-sm-2 first">
                                                                        <img alt="'.$value['fullname'].'" src="'.base_url('public/assets/images/ht-chat-icon.png').'">
                                                                    </div>
                                                                    <div class="em-product-view-primary col-sm-14" style="padding-top: 10px">
                                                                        <div class="spName" itemprop="author">
                                                                            <span>'.$value['fullname'].'</span>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:'.($value['point']*20).'%;"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="divContent" itemprop="description">'.$value['comment'].'</div>
                                                                    </div>
                                                                    <div class="em-product-view-primary col-sm-6 last" style="padding-top: 10px;">
                                                                        <span itemprop="datePublished" content="2015-12-11">Ngày gửi: '.date('d/m/Y H:i', $value['created_at']).'</span>
                                                                    </div>
                                                                </div>
                                                                ';
                                                                if ($value['childs']) {
                                                                    echo '
                                                                    <div class="row bd-top-15">
                                                                        <div class="em-product-view-primary col-sm-2 col-sm-offset-1 first">
                                                                            <img alt="'.$value['childs'][0]['fullname'].'" src="'.base_url('public/assets/images/chat-icon.jpg').'">
                                                                        </div>
                                                                        <div class="em-product-view-primary col-sm-21">
                                                                            <div class="spName" itemprop="author">
                                                                                <span>'.$value['childs'][0]['fullname'].'</span>
                                                                            </div>
                                                                            <div class="divContent" itemprop="description">
                                                                            '.$value['childs'][0]['comment'].'
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    ';
                                                                }
                                                            }
                                                            $i++;
                                                        }
                                                        ?>
                                                    </div><!-- /.em-box-review -->
                                                </div>
                                                <div class="form_review no_reviews">
                                                    <div class="form-add" id="customer_review_form">
                                                        <div class="em-block-title">
                                                            <h2>Đánh giá về sản phẩm</h2>
                                                        </div>
                                                        <form method="post" id="review-form" data-toggle="validator" role="form">
                                                            <fieldset>
                                                                <h3>Đánh giá: <span><?php echo $detail['title']?></span></h3>
                                                                <?php if(isset($alert_error) && $alert_error) {?>
                                                                <div class="alert alert-danger">
                                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                    <strong>Lỗi! Vui lòng thử lại</strong> <ul><?php echo $alert_error?></ul>
                                                                </div>
                                                                <?php }?>

                                                                <?php if(isset($alert_success) && $alert_success) {?>
                                                                <div class="alert alert-success">
                                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                    <strong>Gửi tin thành công!</strong> Cám ơn quý khách, chúng tôi sẽ liên hệ lại với quý khách trong thời gian sớm nhất. <ul><?php echo $alert_error?></ul>
                                                                </div>
                                                                <?php }?>
                                                                <ul class="form-list">
                                                                    <li>
                                                                        <div class="form-group has-feedback">
                                                                            <label for="nickname_field" class="control-label"><em>*</em>Họ tên</label>
                                                                            <div class="input-group input-box">
                                                                                <input type="text" name="name" maxlength="25" class="form-control" id="nickname_field" placeholder="" required>
                                                                            </div>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 29px"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="form-group has-feedback">
                                                                            <label for="email_field" class="control-label"><em>*</em>Email</label>
                                                                            <div class="input-group input-box">
                                                                                <input type="email" name="email" class="form-control" id="email_field" placeholder="Email" required data-error="Vui lòng nhập chính xác email">
                                                                            </div>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 29px"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="form-group has-feedback">
                                                                            <label for="tel_field" class="control-label"><em>*</em>Phone</label>
                                                                            <div class="input-group input-box">
                                                                                <input type="tel" name="telephone" class="form-control" id="tel_field" placeholder="Phone" required data-error="">
                                                                            </div>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 29px"></span>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="form-group">
                                                                            <label for="review_field" class="control-label"><em>*</em>Review</label>
                                                                            <div class="input-group input-box">
                                                                                <textarea name="comment" class="" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </fieldset>
                                                            <h4>Cho điểm sản phẩm này? <em class="required">*</em></h4> <span id="input-message-box"></span>
                                                            <table class="data-table" id="product-review-table">
                                                                <col style="width:1%;" />
                                                                <col style="width:1%;" />
                                                                <col style="width:1%;" />
                                                                <col style="width:1%;" />
                                                                <col style="width:1%;" />
                                                                <col style="width:1%;" />
                                                                <thead>
                                                                    <tr>
                                                                        <th><span class="nobr">1</span>
                                                                        </th>
                                                                        <th><span class="nobr">2</span>
                                                                        </th>
                                                                        <th><span class="nobr">3</span>
                                                                        </th>
                                                                        <th><span class="nobr">4</span>
                                                                        </th>
                                                                        <th><span class="nobr">5</span>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="value">
                                                                            <input type="radio" name="rating_point" id="Price_1" value="1" class="radio" />
                                                                        </td>
                                                                        <td class="value">
                                                                            <input type="radio" name="rating_point" id="Price_2" value="2" class="radio" />
                                                                        </td>
                                                                        <td class="value">
                                                                            <input type="radio" name="rating_point" id="Price_3" value="3" class="radio" />
                                                                        </td>
                                                                        <td class="value">
                                                                            <input type="radio" name="rating_point" id="Price_4" value="4" class="radio" />
                                                                        </td>
                                                                        <td class="value">
                                                                            <input type="radio" name="rating_point" id="Price_5" value="5" class="radio" checked/>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" name="validate_rating" class="validate-rating" value="" />
                                                            <div class="buttons-set">
                                                                <button type="submit" title="Submit Review" class="button"><span><span>Gửi</span></span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- /.form_review -->
                                            </div><!-- /.box-collateral -->
                                        </div><!-- /.em-product-details -->
                                    </div><!-- /.em-product-info -->
                                    <div id="em-product-shop-pos-bottom" style="display:inline-block;"></div>
                                </div>
                            </div>
                        </div><!-- /.product-view -->
                    </div>
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div><!-- /.em-wrapper-main -->