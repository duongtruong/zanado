<div class="wrapper">
<div class="page one-column">
    <!-- /.em-wrapper-header -->

    <div class="wrapper-breadcrums">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-24">
	                <div class="breadcrumbs">
	                    <ul>
	                        <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
	                        <li class="product"> 
	                        <strong>Giỏ hàng</strong></li>
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
                		<div class="em-col-main col-sm-24">
                            <div class="cart">
                                <div class="page-title title-buttons">
                                    <h1>Giỏ hàng</h1>
                                </div><!-- /.page-title -->
                                <?php
                                if (isset($list_item) && !empty($list_item)) {
                                ?>
                                <form method="post" action="<?php echo base_url('checkout/cart')?>">
                                    <input name="form_key" type="hidden" value="inYgLvzSpOOWWVoP">
                                    <fieldset>
                                        <table id="shopping-cart-table" class="data-table cart-table">
                                            <thead>
                                                <tr class="em-block-title">
                                                    <th><span class="nobr">Sản phẩm</span>
                                                    </th>
                                                    <th>&nbsp;</th>
                                                    <th>Giá gốc</th>
                                                    <th class="a-center"><span class="nobr">Khuyến mãi</span>
                                                    </th>
                                                    <th class="a-center" colspan="1"><span class="nobr">Giá còn</span>
                                                    </th>
                                                    <th class="a-center">Số lượng</th>
                                                    <th class="a-center">Sizes</th>
                                                    <th class="a-center">Màu</th>
                                                    <th class="a-center last" colspan="1">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="9" class="a-right">
                                                    	<?php if (!isset($show_button)) {?>
                                                        <a href="<?php echo base_url('/index.html')?>"><button type="button" title="Continue Shopping" class="button btn-continue"><span><span>Tiếp tục mua hàng</span></span>
                                                        </button></a>
                                                        <?php }?>
                                                        <button type="submit" name="update_cart_action" value="update_qty" title="Cập nhật giỏ hàng" class="button btn-update"><span><span>Cập nhật giỏ hàng</span></span>
                                                        </button>
                                                        <a href="<?php echo base_url('/checkout.html')?>"><button type="button" name="update_cart_action" value="checkout_cart" title="Thanh toán" class="button btn-checkout pull-right" id="checkout_cart_button"><span><span>Thanh toán</span></span>
                                                        </button></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            	<?php
                                        		foreach ($list_item as $key => $value) {
                                        			$class = 'even'; $max_qty = intval($value['option']['max-qty']) > 5 ? 5 : intval($value['option']['max-qty']);
                                                    $sizes_html = $colors_html = ''; $sizes = explode('|', $value['option']['sizes']); $colors = explode('|', $value['option']['colors']);

                                                    foreach ($this->temp['temp'] as $k => $v) {
                                                        if ($v['t_type'] == T_SIZE) {
                                                            foreach ($sizes as $size) {
                                                                if ($size && $size == $v['id']) {
                                                                    $s = $size == $value['option']['size'] ? 'selected="selected"' : '';
                                                                    $sizes_html .= '<option value="'.$size.'" '.$s.'>'.$v['t_value'].'</option>';
                                                                }
                                                            }
                                                        }
                                                        elseif ($v['t_type'] == T_COLOR) {
                                                            foreach ($colors as $color) {
                                                                if ($color && $color == $v['id']) {
                                                                    $s = $color == $value['option']['color'] ? 'selected="selected"' : '';
                                                                    $colors_html .= '<option value="'.$color.'" '.$s.'>'.$v['t_value'].'</option>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                        			echo '
                                        			<tr class="'.$class.'">
                                        				<td>
	                                                        <div class="cart-product"><a href="'.base_url('remove-from-cart/'.$value['id'].'-'.$value['rowid'].'.html').'" title="Remove item" class="btn-remove btn-remove2">Remove item</a>
	                                                            <a href="'.base_url('product-'.$value['option']['slug'].'-'.$value['id']).'.html" title="'.$value['option']['name'].'" class="product-image"><img src="'.$value['option']['images'].'" width="100" alt="'.$value['option']['name'].'">
	                                                            </a>
	                                                        </div>
	                                                    </td>
	                                                    <td>
	                                                        <h2 class="product-name" style="margin-top:0"> <a href="'.base_url('product-'.$value['option']['slug'].'-'.$value['id']).'.html"> '.$value['option']['name'].' </a></h2>
	                                                        <p class="sku"><b>SKU_'.$value['id'].'</b></p>
	                                                    </td>
	                                                    <td class="a-center"> '.number_format((float) $value['option']['price']).' đ</td>
	                                                    <td class="a-center"> '.$value['option']['deal_percent'].'%</td>
	                                                    <td class="a-center"> '.number_format((float) $value['price']).' đ</td>
	                                                    <td class="a-center">
	                                                        <div class="qty_cart" style="margin-top:0">
	                                                            <div class="qty-ctl">
	                                                                <button title="Decrease Qty" onclick="qtyDown('.$value['id'].'); return false;" class="decrease">decrease</button>
	                                                            </div>
	                                                            <input id="cart['.$value['id'].'][qty]" name="cart['.$value['id'].'][qty]" value="'.$value['qty'].'" size="4" title="Qty" max-value="'.$max_qty.'" class="input-text qty" maxlength="12">
	                                                            <input type="hidden" id="cart['.$value['id'].'][rowid]" name="cart['.$value['id'].'][rowid]" value="'.$value['rowid'].'">
	                                                            <div class="qty-ctl">
	                                                                <button title="Increase Qty" onclick="qtyUp('.$value['id'].'); return false;" class="increase">increase</button>
	                                                            </div>
	                                                        </div>
	                                                    </td>
                                                        <td class="a-center">
                                                            <select name="cart['.$value['id'].'][size]">
                                                                <option value="">Chọn size</option>
                                                                '.$sizes_html.'
                                                            </select>
                                                        </td>
                                                        <td class="a-center">
                                                            <select name="cart['.$value['id'].'][color]">
                                                                <option value="">Chọn màu</option>
                                                                '.$colors_html.'
                                                            </select>
                                                        </td>
	                                                    <td class="a-center last"> <span class="cart-price"> <span class="price">'.number_format((float) ($value['price']*$value['qty'])).' đ</span> </span>
	                                                    </td>
                                        			</tr>';
                                        		}
                                            	?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </form><!-- /form -->
                                <?php
                            	}
                            	else {
                            		echo '
                            		<div class="cart-empty">
										<div class="cart-empty-content">
											<img width="108" height="106" alt="Empty cart" src="'.base_url('public/assets/images/cart.png').'">
											</a>
											<div id="iwd-emptycart-writeup">
												<p class="writeup">Cảm ơn bạn đã ghé thăm ESHOP.<br>Nếu bạn có bất cứ vấn đề gì về giỏ hàng, <br>Vui lòng liên hệ qua <a href="mailto:support@eshop.com">email hỗ trợ: support@eshop.com</a> hoặc gọi tới <b>19006049</b>.</p>
												<div id="buttonwrapper">
												<div class="iwdbutton"><a href="'.base_url('index.html').'"><span>&nbsp;</span>Tiếp tục mua hàng</a></div>
											</div>
											</div>
										</div>
									</div>
                            		';
                            	}
                                ?>
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>