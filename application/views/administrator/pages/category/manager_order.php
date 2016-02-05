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
              <h3>Bảng danh sách thứ tự ưu tiên Categories (Từ lớn đến bé)</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <?php
                if(isset($list_category) && $list_category)
                {
              ?>
              <table id="tableDnD" class="table table-striped table-bordered item-list center">
                <thead>
                  <tr>
                    <th> STT </th>
                    <th> Tên</th>
                    <th> Quốc gia </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i =1;
                  foreach($list_category as $k=>$v)
                  {
                  ?>
                  <tr>
                    <td> <?php echo $i?> </td>
                    
                    <td> <a href="<?php echo base_url().'index.php/music/category/update/item/'.$v['CategoryId']?>"> <?php echo $v['CategoryName']?> </a> </td>

                    <td class="max-width"> <?php echo $v['CountryCode']?> </td>

                    <input type="hidden" value="<?php echo $v['CategoryId']?>" name="categoryid[]" />
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
            <button type="submit" class="btn btn-info" value="Save" name="save"><i class="icon-pencil"></i> Save !</button>
          </ul>
          </form>
          
        </div>
    </div>