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
              <h3 style="min-width: 50%">Mục tin tức <span style="color: rebeccapurple; float: right"><?php if(isset($alert)) echo $alert?></span></h3>
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
                    <th> Tiêu đề</th>
                    <th> Loại </th>
                    <th> Nội dung </th>
                    <th> Nguồn </th>
                    <th> Trạng thái </th>
                    <th> Publish </th>
                    <th> Khởi tạo </th>
                    <th> Cập nhật cuối </th>
                    <th> </th>
                    <th class="check_all"> <input type="checkbox" title="Check all" name="all" id="all" onclick="checkAll();"/></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($list_item as $key => $value) {
                      $iconPublish= $value['status'] ? '<a href="'.base_url('/administrator/news/pub/item/'.$value['id'].'/type/0').'" class="btn btn-success btn-small last-btn-td" title="UnPublish This Item"><i class="btn-icon-only icon-unlock"> </i></a>' : '<a href="'.base_url('/administrator/news/pub/item/'.$value['id'].'/type/1').'" class="btn btn-warning btn-small last-btn-td" title="Publish This Item"><i class="btn-icon-only icon-lock"> </i></a>';
                  ?>
                    <tr>
                      <td><img src="<?php echo $value['icon']?>"></td>
                      <td><a href="<?php echo base_url('/administrator/news/update/item/'.$value['id'])?>"><?php echo $value['title']?></a></td>
                      <td><?php foreach ($types as $k => $v) {
                        if ($value['type'] == $k) echo $v;
                      }?></td>
                      <td class="max-width"><span class="overflow-text"><?php echo $value['sort_description']?></span></td>
                      <td><?php echo $value['source']?></td>
                      <td><?php echo $iconPublish?></td>
                      <td> <?php if ($value['published_at']) echo date("H:i d-m-Y", $value['published_at']); else echo 'None'?></td>
                      <td> <?php echo $value['created_by'].' | '.date("H:i d-m-Y", $value['created_at']) ?></td>
                      <td> <?php echo  $value['updated_by'].' | '.date("H:i d-m-Y", $value['updated_at']) ?></td>

                      <td>
                            <a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$value['id'].'/type/3'?>');" class="btn btn-danger btn-small"><span><i id="mb_upd" class="icon-trash"></i></span></a>
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