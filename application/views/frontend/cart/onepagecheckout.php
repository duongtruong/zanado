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
	                        <strong>Hoàn tất đơn hàng</strong></li>
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
                        <form method="post" action=""  data-toggle="validator" role="form">
                		<div class="em-col-main col-sm-14" style="border-right: 1px dashed #ddd">
                            <div class="cart">
                                <div class="page-title title-buttons">
                                    <h2 class="uppercase">1. Thông tin đơn hàng</h2>
                                </div><!-- /.page-title -->
                                <?php
                                if (isset($list_item) && !empty($list_item)) {
                                ?>
                                
                                    <input name="form_key" type="hidden" value="inYgLvzSpOOWWVoP">
                                    <fieldset>
                                        <table id="shopping-cart-table" class="data-table cart-table table-checkout-page">
                                            <thead>
                                                <tr class="em-block-title">
                                                    <th><span class="nobr">Sản phẩm</span>
                                                    </th>
                                                    <th>Giá gốc</th>
                                                    <th class="a-center"><span class="nobr">Giảm</span>
                                                    </th>
                                                    <th class="a-center" colspan="1"><span class="nobr">Giá còn</span>
                                                    </th>
                                                    <th class="a-center">Số lượng</th>
                                                    <th class="a-center last" colspan="1">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" class="a-right">
                                                    	<a href="<?php echo base_url('/index.html')?>"><button type="button" title="Continue Shopping" class="button btn-continue"><span><span>Mua thêm sản phẩm</span></span>
                                                        </button></a>
                                                        <a href="<?php echo base_url('/checkout/cart.html')?>"><button type="button" title="Edit Shopping Cart" class="button btn-continue"><span><span>Xem lại giỏ hàng</span></span>
                                                        </button></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            	<?php
                                        		foreach ($list_item as $key => $value) {
                                                    foreach ($this->temp['temp'] as $c) {
                                                        if ($c['t_type'] == T_COLOR && $c['id'] == $value['option']['color']) {
                                                            $color = $c['t_value'];
                                                        }
                                                        if ($c['t_type'] == T_SIZE && $c['id'] == $value['option']['size']) {
                                                            $size = $c['t_value'];
                                                        }
                                                    }
                                        			$class = 'even';
                                        			echo '
                                        			<tr class="'.$class.'">
                                        				<td rowspan="2">
	                                                        <div class="cart-product">
	                                                            <a href="'.base_url('product-'.$value['option']['slug'].'-'.$value['id']).'.html" title="'.$value['option']['name'].'" class="product-image"><img src="'.$value['option']['images'].'" alt="'.$value['option']['name'].'"></a>
	                                                        </div>
	                                                    </td>
	                                                    <td class="a-center"> '.number_format((float) $value['option']['price']).' đ</td>
	                                                    <td class="a-center"> '.$value['option']['deal_percent'].'%</td>
	                                                    <td class="a-center"> '.number_format((float) $value['price']).' đ</td>
	                                                    <td class="a-center">
                                                            <span>'.$value['qty'].'</span>
	                                                        <input type="hidden" id="cart['.$value['id'].'][qty]" name="cart['.$value['id'].'][qty]" value="'.$value['qty'].'" size="4" title="Qty" max-value="'.$max_qty.'" class="input-text qty" maxlength="12">
                                                            <input type="hidden" id="cart['.$value['id'].'][rowid]" name="cart['.$value['id'].'][rowid]" value="'.$value['rowid'].'">
	                                                    </td>
	                                                    <td class="a-center last"> <span class="cart-price"> <span class="price">'.number_format((float) $value['price']*$value['qty']).' đ</span> </span>
	                                                    </td>
                                        			</tr>
                                                    <tr>
                                                        <td colspan="6" style="width: 100%">
                                                            <h2 class="product-name text-center" style="margin-top:0"> '.$value['option']['name'].' - Màu: <span class="option-checkout">'.$color.'</span> - Size: <span class="option-checkout">'.$size.'</span> </h2>
                                                            <input type="hidden" name="cart['.$value['id'].'][name]" value="'.$value['option']['name'].' - Màu: '.$color.' - Size: '.$size.'">
                                                        </td>
                                                    </tr>
                                                    ';
                                        		}
                                            	?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                
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

                            <div class="row">
                                <div class="em-col-main col-sm-24">
                                    <div class="em-col-main col-sm-24">
                                    <div class="page-title title-buttons">
                                        <h2 class="uppercase">2. Đỉa chỉ nhận hàng</h2>
                                    </div>

                                    <div class="page-content">
                                        <div id="step_2_body" class="step-body">
                                        <div class="col-1">
                                            <input type="hidden" name="billing[register_account]" value="1">
                                        </div>

                                        <div style=" clear:both;"></div>
                                        <ul class="form-list" style="margin-top:5px;"> 
                                        <!-- start of Default Billing Address -->
                                            <li id="bill_form">
                                            <fieldset class="">
                                                <input type="hidden" name="billing[address_id]" id="billing:address_id" value="">
                                                <ul>
                                                    <li class="fields">
                                                        <div class="field">
                                                            <label for="billing:telephone" class="required">Điện thoại Di Động<em>*</em></label>
                                                            <div class="input-box form-group has-feedback">
                                                                <input type="text" pattern="^(?:0|\(?\1\)?\s?|9\s?)[0-9]{9,10}$" name="billing[telephone]" value="<?php if(isset($logger['telephone'])) echo $logger['telephone']?>" title="Điện thoại liên hệ" class="input-text required-entry validate-telephone minimum-length-10" id="billing:telephone" maxlength="15" required>
                                                                <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="field">
                                                            <div class="input-box form-group has-feedback">
                                                                <input type="text" id="billing:fullname" name="billing[fullname]" value="<?php if(isset($logger['nickname'])) echo $logger['nickname']?>" title="Họ và Tên" class="input-text  required-entry validate-fullname" placeholder="Họ và Tên" style="width:100%;" required>
                                                                <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="field">
                                                            <div class="input-box form-group has-feedback">
                                                                <input type="email" id="billing:email" name="billing[email]" value="<?php if(isset($logger['email'])) echo $logger['email']?>" title="Email" class="input-text  required-entry validate-fullname" placeholder="Email" style="width:100%;" required>
                                                                <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="fields cartcity">
                                                        <div class="field">
                                                            <div class="input-box">
                                                                <select id="billing_city_id" name="billing[city_id]" title="Tỉnh / Thành phố" class="validate-select required-entry" defaultvalue="1">
                                                                    <option value="">Tỉnh / Thành phố</option>
                                                                    <?php
                                                                        if (isset($provinces)) {
                                                                            foreach ($provinces as $p) {
                                                                                echo '<option value="'.$p['provinceid'].'">'.$p['name'].'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <!-- <input type="text" title="Tỉnh / Thành phố" name="billing[city]" value="Hồ Chí Minh" class="t1 required-entry " id="billing:city" style="display:none;"> -->
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <div class="fulldist">
                                                                <span><?php if(isset($logger['address'])) echo $logger['address']?></span>
                                                                <input type="hidden" name="fulldist" value="<?php if(isset($logger['address'])) echo $logger['address']?>">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    
                                                    <li class="fields cartdistrict">
                                                        <div class="field">
                                                            <div class="input-box">
                                                                <select id="billing_district_id" name="billing[district_id]" title="Quận / Huyện" class="validate-select required-entry" defaultvalue="">
                                                                    <option value="">Quận / Huyện</option>
                                                                </select>
                                                                <!-- <input type="text" id="billing:district" name="billing[district]" value="" title="Quận / Huyện" class="t1 required-entry" style="display:none;"> -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="fields cartward">                                        
                                                        <div class="field">                         
                                                            <div class="input-box">
                                                                <select id="billing_ward_id" name="billing[ward_id]" title="Phường / Xã" class="validate-select required-entry" style="display: block;" defaultvalue="">
                                                                    <option value="">Phường / Xã</option>
                                                                </select>
                                                                <!-- <input type="text" title="Phường / Xã" name="billing[ward]" value="" class="t1 required-entry " id="billing:ward" style="display:none;"> -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="wide clear">
                                                        <label for="billing:street1" class="required">Địa chỉ<em>*</em></label>
                                                        <div class="fields">
                                                        <div class="input-box field form-group has-feedback">
                                                            <input type="text" title="Lầu/tầng, Số nhà, Đường hoặc Ấp, Thôn, Xóm" placeholder="Lầu/tầng, Số nhà, Đường hoặc Ấp, Thôn, Xóm" name="billing[street][]" id="billing_street" value="<?php if(isset($logger['address'])) echo $logger['address']?>" class="input-text required-entry" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                        </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <input type="hidden" name="billing[use_for_shipping]" value="1">
                                            </fieldset>
                                            </li>
                                            <!-- End of Default Billing Address -->
                                        </ul>
                                        </div>
                                    </div>
                                </div>    
                                </div>
                            </div>
                        </div>

                        <div class="em-col-main col-sm-9 col-sm-offset-1">
                            <div class="page-title title-buttons">
                                <h2 class="uppercase">3. Thanh toán & Vận chuyển</h2>
                            </div>

                            <div class="page-content">
                                <div id="step_3_body" class="step-body">
                                    <div id="shipping-method" class="onepagecheckout_block">
                                    <div class="op_block_title"><label>Phương thức giao hàng</label></div>
                                    <div id="checkout-shipping-method-load">
                                        <dl class="sp-methods">
                                        <ul>
                                        <li><input data-billing="display_cashondelivery" name="shipping_method" type="radio" value="flatrate_flatrate" id="s_method_flatrate_flatrate" class="radio validate-one-required-by-name"><label for="s_method_flatrate_flatrate">Phí giao hàng tận nơi khu vực của bạn là: <span class="price">0&nbsp;₫</span></label></li>
                                        <li><input data-billing="display_paymentsm" name="shipping_method" type="radio" value="lanvo_lanvo" id="s_method_lanvo_lanvo" class="radio validate-one-required-by-name" checked="checked"><label for="s_method_lanvo_lanvo">Khách hàng vui lòng đến văn phòng eShop để nhận hàng </label></li>
                                        </ul>
                                        </dl>
                                    </div>
                                    <div class="bottom_line_methods"> </div>
                                </div>
                                    <p><label>Phương thức thanh toán</label></p>
                                    <dl class="sp-methods">
                                    <dt id="display_paymentsm" class="paymenthide" style="display: block;">
                                        <input id="p_method_paymentsm" value="paymentsm" type="radio" name="payment[method]" title="Thanh toán tại ESHOP" class="radio validate-one-required-by-name" checked="checked">
                                        <label for="p_method_paymentsm">Thanh toán tại ESHOP </label>
                                    </dt>
                                    <dt id="display_cashondelivery" class="paymenthide" style="display: none;">
                                        <input id="p_method_cashondelivery" value="cashondelivery" type="radio" name="payment[method]" title="Thanh toán khi nhận hàng (COD)" class="radio validate-one-required-by-name">
                                        <label for="p_method_cashondelivery">Thanh toán khi nhận hàng (COD) </label>
                                    </dt>
                                    </dl>
                                </div>

                                <div id="checkout-review" class="onepagecheckout_block" style="float: right; display: block;">
                                    <div id="checkout-review-submit">  
                                        <div class="order_total_info order_product">
                                            <div id="checkout-review-load" class="" style="width: auto; height: auto;">
                                            <div id="checkout-review-table-wrapper">
                                            <table class="order-totals pull-right" style="line-height: 2.2em">
                                                <tbody>
                                                    <tr>
                                                        <td style="" class="a-right" colspan="1">Thành tiền: </td>
                                                        <td style="" class="a-right"> <span class="price"><?php echo (number_format((float) $this->cart->total()))?>&nbsp;₫</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="" class="a-right" colspan="1">
                                                            <strong>Tổng tiền thanh toán: </strong>
                                                        </td>
                                                        <td style="" class="a-right">
                                                            <strong> <span class="price checkout-private-price"><?php echo (number_format((float) $this->cart->total()))?>&nbsp;₫</span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            </div>
                                        </div>
                                        <div style="clear:both; text-align:right; font-size:10px; margin:5px 10px 0 0;">Đặt hàng là bạn đã đồng ý với <a href="#" target="_blank" rel="nofollow"><b>quy chế</b></a> sàn giao dịch thương mại điện tử của ESHOP</div>
                                        <div id="review-buttons-container" class="">
                                            <div class="buttonaddtocart right"><button type="submit" title="Đặt hàng" class="button " style="font-size:20px;">Đặt hàng</button></div>
                                        </div>      
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                        </form><!-- /form -->
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>