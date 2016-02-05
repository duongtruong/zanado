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
            ?>
            <div class="widget widget-nopad">
                <div class="widget-header"> <i class="icon-plus"></i>
                  <h3>Cập nhật Moderator</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                                            
                      <form class="form-validate form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>

                            <div class="forms-content">
                              <img class='icon-news-abs' src="<?php echo $details['avatar']?>" alt="Ảnh đại diện">
                              <div class="control-group">                     
                                <label class="control-label" for="">Ảnh đại diện</label>
                                <div class="controls">
                                  <div style="position:relative;">
                                    <div class="input-append">
                                      <input readonly="" id="icon-field" type="text" value="<?php if(isset($details)) echo $details['avatar']?>" class="span4" name="icon">
                                      <a data-toggle="modal" href="javascript:;" data-target="#ChooseIcon" class="btn" type="button">Chọn ảnh</a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="control-group">                     
                                <label class="control-label" for="fullname">Họ và tên</label>
                                <div class="controls">
                                    <input name="fullname" type="text" class="span4 form-control" required="required" placeholder="" value="<?php if(isset($details)) echo $details['fullname']?>" />
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->

                              <div class="control-group">                     
                                <label class="control-label">Nhóm - Level</label>
                                <div class="controls category">
                                  <select id="" name="level" class="selectpicker span3 mg-top">
                                    <?php
                                      foreach ($modes as $key => $value) {
                                        $s = '';
                                        if (isset($details)) {
                                          if ($details['level'] == $key) {
                                            $s = 'selected="selected"';
                                          }
                                        }
                                        echo '<option value="'.$key.'" '.$s.'>'.$value.'</option>';
                                      }
                                    ?>
                                  </select>       
                                </div>
                              </div> <!-- /control-group -->

                              <div class="control-group">
                                  <label class="control-label">Email</label>
                                  <div class="controls">
                                      <div class="input-group span9 mgr-left-0">
                                          <input type="email" name="email" id="inputSource" class="form-control span4" required="required" value="<?php if(isset($details)) echo $details['email']?>" title="">
                                      </div>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Tài khoản đăng nhập</label>
                                  <div class="controls">
                                      <div class="input-group span9 mgr-left-0">
                                          <input type="text" name="username" id="inputSource" class="form-control span4" required="required" value="<?php if(isset($details)) echo $details['username']?>" title="">
                                      </div>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Password</label>
                                  <div class="controls">
                                      <div class="input-group span9 mgr-left-0">
                                          <input type="password" name="password" id="inputSource" class="form-control span4" value="" title="">
                                      </div>
                                  </div>
                              </div>

                              <div class="control-group">
                                  <label class="control-label">Nhập lại password</label>
                                  <div class="controls">
                                      <div class="input-group span9 mgr-left-0">
                                          <input type="password" name="repassword" id="inputSource" class="form-control span4" value="" title="">
                                      </div>
                                  </div>
                              </div>
                                                
                            <div class="form-actions">
                              <button type="submit" class="btn btn-primary">Save</button> 
                              <button type="reset" class="btn">Cancel</button>
                            </div> <!-- /form-actions -->

                        </fieldset>
                      </form>
                    </div>
                    <!-- /widget-content --> 
                    
                  </div>
                </div>
                
            </div>
        </div>
    </div>