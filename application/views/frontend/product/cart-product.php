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
            <li class="item">
                <a class="cloud-zoom-gallery" rel="useZoom: '.$useZoom.', smallImage: '.$rel_thumb_img.', adjustX:5, adjustY:-5, position:'.$inside.'" onclick="return false" href="'.$normal_img.'"> <img src="'.$thumb_tiny_img.'" alt=""/> </a>
            </li>';
            if (!$iZoom) {
                $iZoom = '<a class="cloud-zoom" id="image_zoom" rel="zoomWidth: 500,zoomHeight: 500,position: '.$inside.'" href="'.$normal_img.'"> <img class="em-product-main-img" src="'.$thumb_img.'" alt="" title="'.$detail['title'].'" /> </a>';
            }
        }
    }
?>
<form method="post" id="product_addtocart_form_ajax" action="<?php echo base_url('add-to-cart.html')?>">
    <input name="form_key" type="hidden" value="N4DL2crX27DuHSDk" />
    <div class="product-view-detail">
        <div class="em-product-view">
            <div class="em-product-view-primary em-product-img-box col-sm-10 first">
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
            <div class="col-sm-12">
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
                                <p class="rating-links"> <a href="#" class="r-lnk link_review_list"><?php echo $detail['rateCount']?> Review(s)</a> <span class="separator">
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

                        <div class="product-options" style="overflow-y: hidden;">
                            <dl class="last"><dt class="swatch-attr"> <label class="required" id="color_label"> <em>*</em>Chọn màu</dt>
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

                        <div class="add-to-box">
                            <div class="add-to-cart">
                                <label for="qty">Qty:</label>
                                <div class="qty_cart">
                                    <div class="qty-ctl">
                                        <button title="decrease" onclick="changeQty(0); return false;" class="decrease">decrease</button>
                                    </div>
                                    <input type="text" name="qty" id="qty_ajax" maxlength="12" value="1" title="Qty" class="input-text qty" />
                                    <div class="qty-ctl">
                                        <button title="increase" onclick="changeQty(1); return false;" class="increase">increase</button>
                                    </div>
                                </div>
                                <div class="input-hidden">
                                    <input type="hidden" id="item_id_ajax" name="item_id" value="<?php echo $detail['id']?>"/>
                                    <input type="hidden" name="ajax" value="1"/>
                                </div>
                                <div class="button_addto">
                                    <button type="button" title="Buy Now" id="em-buy-now" class="button btn-em-buy-now" href="<?php echo base_url('add-to-cart.html')?>"><span><span>Mua Ngay</span></span>
                                    </button>
                                    <button type="button" title="Add to Cart" id="product-addtocart-button" class="button btn-cart btn-cart-detail btn-cart-ajax" href="<?php echo base_url('checkout/cart-ajax')?>?p=ajaxpage"><span><span>Thêm vào giỏ</span></span>
                                    </button>
                                </div>
                            </div><!-- /.add-to-cart -->
                        </div><!-- /.add-to-box -->
                    </div><!-- /.em-product-info-basic -->
                </div>
            </div><!-- /.em-product-view-secondary -->
        </div>
        <div class="loader-addItem-cart">
            <img src="<?php echo base_url('/public/assets/images/bx_loader.gif')?>" class="img-responsive" alt="Image">
        </div>
        <div class="clearer"></div>
    </div><!-- /.product-view-detail -->
</form>

<script type="text/javascript">
    $(document).ready(function () {
        if (!isPhone) {
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
        }
        doSliderMoreview();
        $('.hidden-before-loaded').show('slow');
        jQuery('.cloud-zoom-gallery').click(function() {
            jQuery('#zoom-btn').attr('href', this.href);
        });
    });
</script>