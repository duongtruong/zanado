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
          <div class="widget">
            <div class="widget-header"> <i class="icon-picture"></i>
              <h3 style="min-width: 50%">Danh sách reviews <span style="color: rebeccapurple; float: right"><?php if(isset($alert)) echo $alert?></span></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <ul class="messages_layout">
                  <?php
                  foreach ($list_item as $key => $value) {
                    if($value['status'] == 0) {
                      /*Images*/
                      $image_html = '';
                      $images = explode('|', $value['product']['images']);
                      foreach ($images as $img) {
                        if ($img) {
                          $info       = pathinfo($img);
                          $img        = $info['dirname'].'/110x110-'.$info['filename'].'_thumb.'.$info['extension'];
                          $image_html = '<img src="'.base_url('/public/uploads/products/'.$img).'" class="img-responsive" title="image_thumb" />';
                          break;
                        }
                      }
                    ?>
                    <li class="from_user left border-none" style="border: none">
                      <div class="product">
                        <?php echo $image_html?>
                        <span><a target="_blank" href="<?php echo base_url()?>index.php/administrator/update/item/<?php echo $value['product']['id']?>"><?php echo $value['product']['title']?></a></span>
                      </div>
                    </li>
                    <li class="from_user left" <?php if (isset($value['childs'])) echo 'style="border: none"'?>>
                      <a href="#" class="avatar"><img src="<?php echo base_url('public/assets/images/ht-chat-icon.png')?>"></a>
                      <div class="message_wrap"> <span class="arrow"></span>
                        <div class="info"> <a class="name"><?php echo $value['fullname'].' | Email: '.$value['email'].' | Phone: '.$value['phone']?></a> <span class="time"><?php echo date('H:i d/m/Y', $value['created_at'])?></span>
                            <div class="options_arrow">
                              <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                                  <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel" style="position: relative">
                                    <?php if(!isset($value['childs'])) { echo '<li class="reply-review" item_id="'.$value['item_id'].'" parent_id="'.$value['id'].'"><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>' ;}?>
                                    <li><a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$value['id'].'/type/7'?>');"><i class=" icon-trash icon-large"></i> Delete</a></li>
                                  </ul>
                              </div>
                            </div>
                        </div>
                        <div class="text"> <?php echo $value['comment']?> </div>
                      </div>
                    </li>
                    <?php
                    if (isset($value['childs'])) {
                    ?>
                    <li class="by_myself right"> <a href="#" class="avatar"><img src="<?php echo base_url('public/assets/images/chat-icon.jpg')?>"></a>
                      <div class="message_wrap"> <span class="arrow"></span>
                        <div class="info"> <a class="name"> <?php echo $value['childs'][0]['fullname']?> </a> <span class="time"><?php echo date('H:i d/m/Y', $value['childs'][0]['created_at'])?></span>
                          <div class="options_arrow">
                            <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                              <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel" style="position: relative">
                                <li><a href="javascript:void(0)" onclick="del_item('<?php echo base_url().'index.php/administrator/delete/item/'.$value['id'].'/type/7'?>');"><i class=" icon-trash icon-large"></i> Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="text"> <?php echo $value['childs'][0]['comment']?> </div>
                      </div>
                    </li>
                    <?php
                    }
                    }
                  }
                  ?>
                </ul>
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