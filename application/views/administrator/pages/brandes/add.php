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
                  <h3>Thêm Thương Hiệu</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                                            
                      <form class="form-validate form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>

                            <div class="forms-content">

                              <div class="control-group">											
                                <label class="control-label" for="t_value">Tên</label>
                                <div class="controls">
                                    <input name="t_value" type="text" class="span4 form-control" required="required" placeholder="" value="<?php if(isset($predata)) echo $predata['t_value']?>" />
                                </div> <!-- /controls -->				
                              </div> <!-- /control-group -->
                                        				
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