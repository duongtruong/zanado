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
                  <h3>Chỉnh sửa Bài Viết</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                                            
                      <form class="form-validate form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>

                            <div class="forms-content">
                              <img class='icon-news-abs' src="<?php echo $details['icon']?>" alt="Ảnh đại diện">
                              <div class="control-group">                     
                                <label class="control-label" for="newsname">Ảnh đại diện</label>
                                <div class="controls">
                                  <div style="position:relative;">
                                    <div class="input-append">
                                      <input id="icon-field" type="text" value="" class="span4" name="icon" readonly="">
                                      <a data-toggle="modal" href="javascript:;" data-target="#ChooseIcon" class="btn" type="button">Chọn ảnh</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="control-group">                     
                                <label class="control-label" for="newsname">Tên bài</label>
                                <div class="controls">
                                    <input name="newsname" type="text" class="span4 form-control" required="required" placeholder="" value="<?php echo $details['title']?>" />
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->

                              <div class="control-group">                     
                                <label class="control-label">Loại</label>
                                <div class="controls category">
                                  <select id="" name="type" class="selectpicker span3 mg-top">
                                    <?php
                                      foreach ($types as $key => $value) {
                                        $s = $key == $details['type'] ? 'selected = "selected"' : '';
                                        echo '<option value="'.$key.'" '.$s.'>'.$value.'</option>';
                                      }
                                    ?>
                                  </select>       
                                </div>
                              </div> <!-- /control-group -->

                              <div class="control-group">                     
                                <label class="control-label" for="publishAt">Thời gian muốn publish?</label>
                                <div class="controls">
                                    <div class="input-append date datetimepicker">
                                      <input class="span4" data-format="dd/MM/yyyy hh:mm:ss" type="text" name="publishAt" value="<?php if($details['published_at']) echo date('d/m/Y H:i:s', $details['published_at'])?>"></input>
                                      <span class="add-on">
                                        <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                        </i>
                                      </span>
                                    </div>
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->

                              <div class="control-group hr">                     
                                <label class="control-label" for="status">Trạng thái</label>
                                <div class="controls">
                                    <select id="status" name="status" class="span3 mg-top selectpicker">
                                      <option value="1" <?php if($details['status'] == 1) echo 'selected="selected"'?>>Publish</option>
                                      <option value="0" <?php if($details['status'] == 0) echo 'selected="selected"'?>>UnPublish</option>
                                    </select>
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả dạng ngắn</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="p_sortdesc" id="p_sortdesc" class="item-text-area span9 form-control" required="required" rows="4"><?php echo $details['sort_description']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Nội dung</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="p_fulldesc" id="p_fulldesc" class="item-text-area span4 textarea-550 form-control"><?php echo urldecode($details['description'])?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Nguồn</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <input type="text" name="source" id="inputSource" class="form-control span4" value="<?php echo $details['source']?>" title="">
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