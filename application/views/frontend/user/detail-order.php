<div class="page one-column">
    <!-- /.em-wrapper-header -->

    <div class="wrapper-breadcrums">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <div class="breadcrumbs">
                        <ul>
                            <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
                            <li class="product"> <strong>CHI TIẾT ĐƠN HÀNG</strong></li>
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
                        <div class="col-sm-20 col-sm-push-2 em-col-main">
                            <div id="block-left" style="width:100%;">
                                <div class="block-content" style="background:#fff;">
                                    <div class="page-title title-buttons">
                                        <h4 class="sub-title" style="color:grey">Đơn đặt hàng #<?php echo $detail[0]['order_id'].' - '.$detail[0]['status']?></h4>
                                    </div>
                                    <div id="product-distributed" class="block block-related">
                                        <div class="page-title title-buttons">
                                            <h2 class="uppercase">Thông tin đơn hàng</h2>
                                        </div>
                                        <div class="block-content">
                                            <p class="order-date">Ngày đặt hàng: <?php echo date('H:i d/m/Y', $detail[0]['time_created'])?></p>
                                            <div class="col2-set order-info-box">
                                                <div class="col-1">
                                                    <div class="box">
                                                        <div class="page-title title-buttons">
                                                            <h2 class="uppercase">Thông tin thanh toán</h2>
                                                        </div>
                                                        <div class="box-content">
                                                            <address>
                                                            <?php echo $detail[0]['buyer_username'].'<br>'.$detail[0]['buyer_address'].'<br>Điện thoại: '.$detail[0]['buyer_phone']?>
                                                            </address>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="box box-payment">
                                                        <div class="page-title title-buttons">
                                                            <h2 class="uppercase">Hình thức giao hàng</h2>
                                                        </div>
                                                        <div class="box-content">
                                                            <p>
                                                                <?php if ($detail[0]['buyer_payment_method'] == '1') echo 'Thanh toán khi nhận hàng (COD)'; else echo 'Thanh toán tại cửa hàng';?>
                                                            </p>
                                                            <b>Lưu ý:</b><br>
                                                            - Quý khách thanh toán tiền trước khi nhận và xem hàng<br>
                                                            - Quý khách có 7 ngày đổi trả miễn phí sau khi nhận hàng
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2-set order-info-box">
                                                <div class="col-1">
                                                    <div class="box">
                                                        <div class="page-title title-buttons">
                                                            <h2 class="uppercase">Thông tin giao hàng</h2>
                                                        </div>
                                                        <div class="box-content">
                                                            <address>
                                                            <?php echo $detail[0]['buyer_username'].'<br>'.$detail[0]['buyer_address'].'<br>Điện thoại: '.$detail[0]['buyer_phone']?>
                                                            </address>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="box">
                                                        <div class="box-title">
                                                            <div class="page-title title-buttons">
                                                                <h2 class="uppercase">Thời gian giao hàng</h2>
                                                            </div>
                                                        </div>
                                                        <div class="box-content">
                                                            Quý khách nhận được hàng trong vòng từ <b>6-12 giờ</b> không kể CN và ngày lễ <br><br>
                                                            Sau thời gian trên nếu quý khách vẫn chưa nhận được hàng hãy liên hệ ngay với <b>19006049</b> để được hỗ trợ
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="page-title title-buttons">
                                                <h2 class="uppercase">Chi tiết đơn hàng</h2>
                                            </div>
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
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="subtotal first">
                                                        <td colspan="6" class="a-right">Thành tiền</td>
                                                        <td class="last a-right"><span class="price"><?php echo number_format((float) $detail[0]['total_price'])?>&nbsp;₫</span></td>
                                                    </tr>    
                                                    <tr class="shipping">
                                                        <td colspan="6" class="a-right">Chi phí vận chuyển</td>
                                                        <td class="last a-right"><span class="price">0&nbsp;₫</span></td>
                                                    </tr>
                                                    <tr class="grand_total last">
                                                        <td colspan="6" class="a-right"><strong>Tổng tiền thanh toán:</strong></td>
                                                        <td class="last a-right"><strong><span class="price"><?php echo number_format((float) $detail[0]['total_price'])?>&nbsp;₫</span></strong></td>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    foreach ($detail as $key => $value) {
                                                    echo '
                                                    <tr class="even">
                                                        <td rowspan="2">
                                                            <div class="cart-product">
                                                                <a href="'.$value['item_link'].'" title="'.$value['item_title'].'" class="product-image"><img src="'.$value['item_image'].'" alt="'.$value['item_title'].'"></a>
                                                            </div>
                                                        </td>
                                                        <td class="a-center"> '.number_format((float) $value['item_buy_price']).'&nbsp;₫ </td>
                                                        <td class="a-center"> '.$value['item_sale_percent'].'%</td>
                                                        <td class="a-center"> '.number_format((float) $value['item_price']).'&nbsp;₫ </td>
                                                        <td class="a-center">
                                                            <span>'.number_format((float) $value['item_quantity']).'</span>
                                                        </td>
                                                        <td class="a-center last"> <span class="cart-price"> <span class="price">'.number_format((float) $value['item_price']).'&nbsp;₫</span> </span>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <h2 class="product-name text-center" style="margin-top:0"> '.$value['item_title'].'</h2>
                                                        </td>
                                                    </tr>
                                                    ';    
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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
</div>