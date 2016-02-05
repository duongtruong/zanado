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
              <h3 style="min-width: 50%">Bảng danh sách sản phẩm <span style="color: rebeccapurple; float: right"><?php if(isset($alert)) echo $alert?></span></h3>
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
                    <th> STT </th>
                    <th> Ảnh</th>
                    <th> Tên</th>
                    <th> Giá bán </th>
                    <th> Type </th>
                    <th> Trạng thái </th>
                    <th> Danh mục</th>
                    <th> Đã bán </th>
                    <th> Còn </th>
                    <th> SP Hot? </th>
                    <th> View </th>
                    <th> </th>
                    <th class="check_all"><input type="checkbox" title="Check all" name="all" id="all" onclick="checkAll();"/></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $realpath = PUBPATH.'uploads/products/';
                  $i =1;
                  foreach($list_item as $k=>$v)
                  {
                    /*Images*/
                    $image_html = '';
                    $images = explode('|', $v['images']);
                    foreach ($images as $img) {
                      if ($img) {
                        $info       = pathinfo($img);
                        $img        = $info['dirname'].'/110x110-'.$info['filename'].'_thumb.'.$info['extension'];
                        $image_html = '<img src="'.base_url('/public/uploads/products/'.$img).'" title="image_thumb" />';
                        break;
                      }
                    }
                    //Get categories
                    $categories = $this->Mcategory->getCategoryNameById(trim($v['category_id']));
                  ?>
                  <tr>
                    <td> <?php echo $i?> </td>
                    
                    <td> <?php echo $image_html?> </td>
                    
                    <td> <a href="<?php echo base_url()?>index.php/administrator/update/item/<?php echo $v['id']?>"> <?php echo $v['title']?> </a> </td>
                    
                    <td class="max-width"> <?php echo number_format((float) $v['buy_price'])?> VND</td>
                    
                    <td class="max-width"> <?php if($v['type'] == 0) echo 'SP sẵn có'; else echo 'SP Order'?> </td>
                    
                    <td> <?php if($v['status'] == 1) echo '<i class="btn-icon-only icon-unlock" title="Đang bán"> </i>'; else echo '<i class="btn-icon-only icon-lock" title="Tạm ngưng"> </i>'?> </td>
                    
                    <td> <?php echo $categories?> </td>

                    <td class="max-width"> <?php echo $v['transaction_num']?> </td>

                    <td class="max-width"> <?php echo $v['amount']?> </td>
                    
                    <td> <?php if($v['is_hot'] == 1) echo '<i class="btn-icon-only icon-ok" title="HOT"> </i>'; else echo '<i class="btn-icon-only icon-off" title="Không HOT"> </i>'?> </td>

                    <td> <?php echo number_format((float)$v['view_num'])?> </td>
                    
                    <td>
                        <a href="<?php echo base_url().'index.php/administrator/update/item/'.$v['id']?>" class="btn btn-success btn-small"><i class="btn-icon-only icon-pencil"> </i></a>
                        <a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$v['id'].'/type/1'?>');" class="btn btn-danger btn-small"><span><i id="mb_upd" class="icon-trash"></i></span></a>

                        <?php
                        if($v['status'] == 0) {
                        ?>
                        <a href="<?php echo base_url().'index.php/administrator/pub/item/'.$v['id']?>/type/1" class="btn btn-warning btn-small" title="Publish This Item"><i class="btn-icon-only icon-lock"> </i></a>
                        <?php
                        }
                        elseif($v['status'] == 1) {
                        ?>
                        <a href="<?php echo base_url().'index.php/administrator/pub/item/'.$v['id']?>/type/0" class="btn btn-info btn-small" title="UnPublish This Item"><i class="btn-icon-only icon-unlock"> </i></a>
                        <?php
                        }
                        else {
                        ?>
                        <i class="btn-icon-only icon-lock"> </i>
                        <?php
                        }
                        ?>
                    </td>
                    
                    <td class="check_all"> <input type="checkbox" name="vl_check[]" value="<?php echo $v['id']?>"/> </td>
                  </tr>
                  <?php
                  $i++;
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
                    <i class="icon-exclamation-sign"></i><strong>Thông báo !</strong> Không có sản phẩm nào hoặc hệ thống chưa cập nhật.
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