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
	                        <strong>Đặt hàng thành công</strong></li>
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
                		<div class="em-col-main col-sm-18 first">
                			<div class="block-content">
							<div style="text-align:center; margin:10px auto;"><img src="<?php echo base_url('public/assets/images/checkout_complete_thank.jpg')?>" border="0"></div>
							<div style="clear:both"></div>
							    <p style="text-align:center;margin-bottom:10px;"><span class="order-title">Số Đơn hàng của bạn: #</span><span class="order-id"><?php echo $orders['id']?></span>. Để xem chi tiết đơn hàng bạn hãy
                                <a href="<?php echo base_url('sales/order/view-'.$orders['id'].'-phone-'.$orders['phone'])?>.html" class="order-id">BẤM VÀO ĐÂY</a>.</p>
								<p>Đơn hàng của quý khách đã được chúng tôi ghi nhận, chúng tôi sẽ tiến hàng giao hàng cho quý khách nhanh nhất có thể.<br><br>
								Quý khách nhận được hàng trong vòng từ <b>3-5 ngày</b> không kể CN và ngày lễ<br><br>			
								Nếu sau thời hạn trên quý khách vẫn chưa nhận được hàng xin hãy liên hệ trực tiếp với chúng tôi qua điện thoại <b>19006049</b> để được hỗ trợ nhanh nhất.
								</p>
								<p style="font-size:110%"><span style="color:#dc0309; font-weight:bold;">Lưu ý: </span><br>
								- <span style="color:blue">Để gửi hàng cho khách hàng được nhanh nhất có thể chúng tôi sẽ <b>gửi email</b> và <b>tin nhắn</b> để xác nhận đơn đặt hàng thành công <b>NGAY</b> cho quý khách sau khi đặt hàng mà không cần phải gọi điện thoại để xác nhận.</span><br>
								- Vì giao hàng cho quý khách là <b>người của Bưu Điện </b> nên đề nghị quý khách thanh toán tiền trước khi nhận và xem hàng<br>
								- Quý khách an tâm nhận hàng và có 7 ngày đổi trả miễn phí sau khi nhận hàng
								</p>
									
									<div class="chuthich xntc" style="display:none;">
								<div class="title-chuthich">Đơn hàng của bạn đã được xác nhận chúng tôi sẽ giao hàng cho bạn sớm nhất có thể.</div>
							</div>
							
											
									
									
							<div class="buttonaddtocart buttonorder">
								<button type="button" class="button" title="Tiếp tục mua hàng" onclick="window.location='<?php echo base_url('')?>'">Tiếp tục mua hàng</button>
							</div>
							<div style="clear::both;"></div>
							</div>
                		</div>
                		<div class="em-col-main col-sm-6 last" style="padding-top: 2em">
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
                                </div>
                            </div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>