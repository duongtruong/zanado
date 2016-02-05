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
          <form action="" method="POST">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-picture"></i>
              <h3>Thành viên quản trị</h3>
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
                    <th> Ảnh </th>
                    <th> Tên</th>
                    <th> Nhóm - Level </th>
                    <th> Email </th>
                    <th> Trạng thái </th>
                    <th> Last Login </th>
                    <th> </th>
                    <th class="check_all"> <input type="checkbox" title="Check all" name="all" id="all" onclick="checkAll();"/></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($list_item as $key => $value) {
                      if($value['id'] > 1) {
                      $iconPublish= $value['banned'] ? '<a href="'.base_url('/administrator/moderator/pub/item/'.$value['id'].'/type/0').'" class="btn btn-warning btn-small last-btn-td" title="UnBaned This Moderator"><i class="btn-icon-only icon-lock"> </i></a>' : '<a href="'.base_url('/administrator/moderator/pub/item/'.$value['id'].'/type/1').'" class="btn btn-success btn-small last-btn-td" title="Banded This Moderator"><i class="btn-icon-only icon-unlock"> </i></a>';
                  ?>
                    <tr>
                      <td><img src="<?php echo $value['avatar']?>"></td>
                      <td><a href="<?php echo base_url('/administrator/moderator/update/item/'.$value['id'])?>"><?php echo $value['fullname']?></a></td>
                      <td><?php foreach ($modes as $k => $v) {
                        if ($value['level'] == $k) echo $v;
                      }?></td>
                      <td class="max-width"><span class="overflow-text"><?php echo $value['email']?></span></td>
                      <td><?php echo $iconPublish?></td>
                      <td> <?php if ($value['last_login']) echo date("H:i d-m-Y", $value['last_login']); else echo 'None'?></td>
                      <td>
                            <a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$value['id'].'/type/4'?>');" class="btn btn-danger btn-small"><span><i id="mb_upd" class="icon-trash"></i></span></a>
                        </td>
                        
                        <td class="check_all"> <input type="checkbox" name="vl_check[]" value="<?php echo $value['id']?>"> </td>
                    </tr>
                  <?php
                    }
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