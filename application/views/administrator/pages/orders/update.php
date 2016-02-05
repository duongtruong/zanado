    <div class="row">
        <div class="span12">
            <?php
                if(isset($success))
                {
            ?>
            <div class="alert alert-success">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <i class="icon-ok-sign"></i> Thao tác thành công
            </div>
            <?php
                }

                elseif (isset($warning)) {
                ?>
                <div class="alert alert-error">
                  <button data-dismiss="alert" class="close" type="button">×</button>
                  <i class="icon-exclamation-circle"></i> Xảy ra lỗi - Vui lòng thử lại
              </div>
                <?php
                }
                $status = $details[0]['status'] == 4 ? 'Đã hoàn tất' : $details[0]['status'] == 6 ? 'Đơn hàng bị hủy' : 'Chờ xử lý';
            ?>
            <h3 class="sub-title" style="color:grey">Đơn đặt hàng #<?php echo $details[0]['order_id'].' - '.$status?></h3>
            <p class="order-date">Ngày đặt hàng: <?php echo date('H:i d/m/Y', $details[0]['time_created'])?></p>
            <div class="row">
              <div class="span6">
                <div class="widget widget-nopad">
                <div class="widget-header"> <i class="icon-list-alt"></i>
                  <h3> THÔNG TIN KHÁCH HÀNG</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                  <div class="widget big-stats-container">
                    <span style="padding: 10px; float: left">
                      <?php echo $details[0]['buyer_username'].'<br>'.$details[0]['buyer_address'].'<br>Điện thoại: '.$details[0]['buyer_phone']?>
                    </span>
                    <!-- /widget-content --> 
                  </div>
                </div>
              </div>

              </div>
              <div class="span6">
                <div class="widget widget-nopad">
                  <div class="widget-header"> <i class="icon-list-alt"></i>
                    <h3>HÌNH THỨC GIAO HÀNG</h3>
                  </div>
                  <!-- /widget-header -->
                  <div class="widget-content">
                    <div class="widget big-stats-container">
                      <p style="padding: 10px; float: left">
                          <?php if ($details[0]['buyer_payment_method'] == '1') echo 'Thanh toán khi nhận hàng (COD)'; else echo 'Thanh toán tại cửa hàng';?>
                      </p>
                      <!-- /widget-content -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="widget widget-nopad">
                <div class="widget-header"> <i class="icon-plus"></i>
                  <h3>Chi tiết đơn hàng</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                      <table id="shopping-cart-table" class="table table-striped table-bordered">
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
                            <tr class="subtotal first">
                                <td colspan="5" class="a-right">Thành tiền</td>
                                <td class="last a-right"><span class="price"><?php echo number_format((float) $details[0]['total_price'])?>&nbsp;₫</span></td>
                            </tr>    
                            <tr class="shipping">
                                <td colspan="5" class="a-right">Chi phí vận chuyển</td>
                                <td class="last a-right"><span class="price">0&nbsp;₫</span></td>
                            </tr>
                            <tr class="grand_total last">
                                <td colspan="5" class="a-right"><strong>Tổng tiền thanh toán:</strong></td>
                                <td class="last a-right"><strong><span class="price"><?php echo number_format((float) $details[0]['total_price'])?>&nbsp;₫</span></strong></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($details as $key => $value) {
                            echo '
                            <tr class="even">
                                <td rowspan="2">
                                    <div class="cart-product">
                                        <a target="_blank" href="'.$value['item_link'].'" title="'.$value['item_title'].'" class="product-image"><img src="'.$value['item_image'].'" alt="'.$value['item_title'].'"></a>
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
                                <td colspan="5">
                                    <h2 class="product-name text-center" style="margin-top:0"> '.$value['item_title'].'</h2>
                                </td>
                            </tr>
                            ';    
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php if(in_array($this->temp['adm_logged']['level'], array(1, 2))) { ?>
                    <form class="form-validate form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">                     
                            <label class="control-label">Nhân viên bán hàng</label>
                            <div class="controls">
                                <select id="" name="mods" class="selectpicker span3 mg-top">
                                <option value="0">Chọn nhân viên bán hàng</option>
                                <?php
                                    foreach ($mods as $key => $value) {
                                    $s = $value['id'] == $details[0]['mod_id'] ? 'selected = "selected"' : '';
                                    echo '<option value="'.$value['id'].'" '.$s.'>'.$value['fullname'].'</option>';
                                    }
                                ?>
                                </select>       
                            </div>
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label">Thao tác</label>
                            <div class="controls">
                                <select id="" name="status" class="selectpicker span3 mg-top">
                                    <option value="0">Chọn thao tác</option>
                                    <option value="6" <?php if($details[0]['status'] == 6) echo 'selected'?>>Hủy đơn hàng</option>
                                    <option value="4" <?php if($details[0]['status'] == 4) echo 'selected'?>>Hoàn tất đơn hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Comment</label>
                            <div class="controls">
                                <textarea class="span4" rows=5 name="comment"><?php echo $details[0]['comment']?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <button type="reset" class="btn">Cancel</button>
                        </div> <!-- /form-actions -->
                    </fieldset>
                    </form>
                    <?php }?>
                    </div>
                    <!-- /widget-content --> 
                    
                  </div>
                </div>
                
            </div>
        </div>
    </div>