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
                  <h3>Cập nhật Category</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                                            
                      <form class="form-validate form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>

                            <div class="forms-content">

                              <div class="control-group">                     
                                <label class="control-label" for="filename">Tên Category</label>
                                <div class="controls">
                                    <input name="catename" type="text" class="span4" placeholder="" value="<?php echo $details[0]['title']?>" />
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->

                              <div class="control-group">                     
                                <label class="control-label">Category Cha</label>
                                <div class="controls category">
                                  <select id="" name="parentcategory" class="selectpicker span3 mg-top" data-live-search="true">
                                    <option value="0"></option>
                                      <?php
                                        function render($category, $parent_id) {
                                        foreach ($category as $c) {
                                          if ($c['level'] < 3) {
                                            $s = ($c['id'] == intval($parent_id)) ? 'selected=""' : '';
                                            echo '<option value="'.$c['id'].'" '.$s.'>'.str_repeat ('-- ', ($c['level'])) . ' ' .$c['title'].'</option>'; 
                                            if(isset($c['childs'])) {
                                              render($c['childs'], $parent_id);
                                            }
                                          }
                                        }
                                      }
                                      render($category, $details[0]['parent_id']);
                                      ?>
                                  </select>       
                                </div>
                              </div> <!-- /control-group -->

                              <div class="control-group hr">                     
                                <label class="control-label" for="status">Trạng thái</label>
                                <div class="controls">
                                    <select id="status" name="status" class="span3 mg-top selectpicker">
                                      <option value="1" <?php if($details[0]['status'] == 1) echo 'selected=""'?>>Publish</option>
                                      <option value="0" <?php if($details[0]['status'] == 0) echo 'selected=""'?>>UnPublish</option>
                                    </select>
                                </div> <!-- /controls -->       
                              </div> <!-- /control-group -->
                            </div>

                            <div class="control-group">
                                <label class="control-label">Title trang</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="p_title" id="p_title" class="item-text-area span4" rows="4"><?php echo $details[0]['p_title']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả trang</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="p_desc" id="p_desc" class="item-text-area span4" rows="4"><?php echo $details[0]['p_description']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Keywords trang</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="p_keywords" id="p_keywords" class="item-text-area span4" rows="4"><?php echo $details[0]['keywords']?></textarea>
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