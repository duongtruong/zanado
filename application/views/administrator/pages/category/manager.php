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
              <h3>Bảng danh sách Categories</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <?php
                if(isset($list_category) && $list_category)
                {
              ?>
              <table class="table table-striped table-bordered item-list center">
                <thead>
                  <tr>
                    <th> STT </th>
                    <th> Tên</th>
                    <th> Cấp </th>
                    <th> Title page </th>
                    <th> Keywords page </th>
                    <th> Show Home? </th>
                    <th> Trạng thái </th>
                    <th> Khởi tạo </th>
                    <th> Cập nhật cuối </th>
                    <th> </th>
                    <th class="check_all"> <input type="checkbox" title="Check all" name="all" id="all" onclick="checkAll();"/></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  function render($category, $index) {
                    foreach ($category as $c) {
                      # code...
                      $deleteLink = "'".base_url('index.php/administrator/delete/item/'.$c['id'].'/type/2')."'";
                      $iconPublish= $c['status'] ? '<a href="'.base_url('/administrator/category/pub/item/'.$c['id'].'/type/0').'" class="btn btn-success btn-small last-btn-td" title="UnPublish This Item"><i class="btn-icon-only icon-unlock"> </i></a>' : '<a href="'.base_url('/administrator/category/pub/item/'.$c['id'].'/type/1').'" class="btn btn-warning btn-small last-btn-td" title="Publish This Item"><i class="btn-icon-only icon-lock"> </i></a>';
                      $iconShowHome= $c['show_home'] ? '<a href="'.base_url('/administrator/category/showhome/item/'.$c['id'].'/type/0').'" class="btn btn-success btn-small last-btn-td" title="Not Show Home This Item"><i class="btn-icon-only icon-unlock"> </i></a>' : '<a href="'.base_url('/administrator/category/showhome/item/'.$c['id'].'/type/1').'" class="btn btn-warning btn-small last-btn-td" title="Show Home This Item"><i class="btn-icon-only icon-lock"> </i></a>';
                      echo '<tr>
                        <td> '.$index.' </td>
                        
                        <td> <a class="tree tree-level-'.$c['level'].'" href="'.base_url('/administrator/category/update/item/'.$c['id']).'"> '.str_repeat ('-- ', ($c['level'])) . ' ' . $c['title'].' </a> </td>

                        <td class="max-width"> '.$c['level'].' </td>

                        <td class="max-width"> '.$c['p_title'].' </td>

                        <td class="max-width"> '.$c['keywords'].' </td>

                        <td class="max-width"> '.$iconShowHome.' </td>

                        <td class="max-width"> '.$iconPublish.' </td>

                        <td> '.$c['created_by'].' | '.date("H:i d-m-Y", $c['created_at']).' </td>

                        <td> '.$c['updated_by'].' | '.date("H:i d-m-Y", $c['updated_at']).'</td>
                        
                        <td>
                            <a href="javascript:void(0)" onclick="del_item('.$deleteLink.');" class="btn btn-danger btn-small"><span><i id="mb_upd" class="icon-trash"></i></span></a>
                        </td>
                        
                        <td class="check_all"> <input type="checkbox" name="vl_check[]" value="'.$c['id'].'"> </td>
                        </tr>
                      ';

                      
                      if(isset($c['childs'])) {
                        render($c['childs'], $index++);
                      }
                    }
                  }
                  render($list_category, 1);
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
                    <i class="icon-exclamation-sign"></i><strong>Thông báo !</strong> Không có category nào hoặc hệ thống chưa cập nhật.
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
          
        </div>
    </div>