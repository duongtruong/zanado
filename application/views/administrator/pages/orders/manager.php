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
          ?>
          <form action="" method="GET">
            <div class="input-append date datetimepicker-notime span2" style="margin-left: 0">
              <span> Từ </span>
              <input class="span4" data-format="dd/MM/yyyy" type="text" name="s" style="width: 85px" value="<?php echo $_GET['s']?>" />
              <span class="add-on" style="margin-top: -10px">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
              </span>
            </div>
            
            <div class="input-append date datetimepicker-notime span2">
              <span> Đến </span>
              <input class="span4" data-format="dd/MM/yyyy" type="text" name="e" style="width: 85px" value="<?php echo $_GET['e']?>"/>
              <span class="add-on" style="margin-top: -10px">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
              </span>
            </div>
            <button type="submit" class="btn btn-success">Lọc</button>
          </form>
          <form action="" method="POST">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-picture"></i>
              <h3 style="min-width: 50%">Danh sách đơn hàng <span style="color: rebeccapurple; float: right"><?php if(isset($alert)) echo $alert?></span></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <?php
                if(isset($list_item) && $list_item)
                {
              ?>
              <table class="table table-striped table-bordered item-list center">
                <thead>
                  <tr>
                    <th> Mã ĐH </th>
                    <th> Ngày tháng </th>
                    <th> Số lượng </th>
                    <th> Tổng tiền </th>
                    <th> Khách hàng </th>
                    <th> Tình trạng </th>
                    <th> Nhân viên </th>
                    <th> Hình thức thanh toán </th>
                    <th> </th>
                    <th class="check_all"> <input type="checkbox" title="Check all" name="all" id="all" onclick="checkAll();"/></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($list_item as $key => $value) {
                  ?>
                    <tr <?php if($value['status'] == 0) echo 'class="orders-new"'; if($value['status'] == 4) echo 'class="orders-complete"';?>>
                      <td><a title="Chi tiết" href="<?php echo base_url('administrator/orders/view/item/'.$value['id'])?>">#<?php echo $value['id']?></a></td>
                      <td><?php echo date('H:i d/m/Y', $value['time_created'])?></td>
                      <td><?php echo $value['total_item']?></td>
                      <td class="max-width"><?php echo number_format((float) $value['total_price'])?>đ</td>
                      <td><?php echo 'Họ tên: <b>'.$value['buyer_username'].'</b><br> Email: <b>'.$value['buyer_email'].'</b><br> Phone: <b>'.$value['buyer_phone']?></b></td>
                      <td><?php if($value['status'] == 0) echo 'Mới'; elseif($value['status'] == 1) {echo 'Đã xem - bởi: ' . $value['mod_view'];} elseif($value['status'] == 2) echo 'Đã thanh toán'; elseif($value['status'] == 4) echo 'Hoàn tất'?></td>
                      <td> <?php if ($value['mod_id']) echo $value['mod_name']; else echo ''?></td>
                      <td><?php if ($value['buyer_payment_method'] == '1') echo 'Ship hàng - COD'; else echo 'Tại cửa hàng';?></td>
                      <td>
                            <a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$value['id'].'/type/5'?>');" class="btn btn-danger btn-small"><span><i id="mb_upd" class="icon-trash"></i></span></a>
                      </td>
                        
                        <td class="check_all"> <input type="checkbox" name="vl_check[]" value="<?php echo $value['id']?>"> </td>
                    </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
                <?php
                }
                else
                {
                ?>
                <!-- BEGIN: errNull -->
                <div class="alert alert-error">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <i class="icon-exclamation-sign"></i><strong>Thông báo !</strong> Không có item nào hoặc hệ thống chưa cập nhật.
                </div>
                <!-- END: errNull -->
                <?php
                }
                ?>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget --> 
          <ul class="bottom_right" style="margin: 0;">
            <button type="submit" class="btn btn-danger" onclick="return dropmb();" value="drop" name="drop"><i class="icon-remove-sign"></i> Xóa !</button>
          </ul>
          </form>
          <div class="paginations">
            <?php
                echo $this->pagination->create_links(); // tạo link phân trang
            ?>
          </div>
        </div>
    </div>