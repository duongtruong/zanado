    <div class="row">
        <div class="span12">
            <div class="widget widget-nopad">
                <div class="widget-header"> <i class="icon-plus"></i>
                  <h3>Thêm sản phẩm</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                        <div class="alert alert-success display-none">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Thông báo: </strong> Thêm sản phẩm thành công.
                        </div>

                        <form id="form_validate" class="form-horizontal left-align cmxform" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Tên sản phẩm (*)</label>
                                <div class="controls">
                                    <input type="text" maxlength="255" class="span5 left {validate:{required:true}} item-text-value" name="pname" required="required" id="pname">
                                    <div class="span5">
                                        <select class="selectpicker sl-max-135 left" name="ptype" id="ptype">
                                            <option value="1">Hàng order</option>
                                            <option value="0" selected="">Hàng sẵn có</option>
                                        </select>

                                        <select class="selectpicker sl-max-135 left" name="pstatus" id="pstatus">
                                            <option value="1" selected="">Public</option>
                                            <option value="0">UnPublic</option>
                                        </select>

                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" value="1" id="pfeature">
                                            Nổi bật?
                                            </label>
                                        </div>

                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" value="1" id="phot">
                                            Hot?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="control-group cate">
                                <label class="control-label">Category</label>
                                <div class="controls category">
                                    <select id="categories" multiple="multiple" name="cate[]">
                                        <?php
                                            if (isset($category) && !empty($category)) {
                                                foreach ($category as $c) {
                                                    if($c['parent_id'] == 0 && $c['level'] == 1 && !isset($c['childs'])) {
                                                        echo '<option value="|'.$c['id'].'|" data-section="">'.$c['title'].'</option>';
                                                    }

                                                    if(isset($c['childs'])) {
                                                        foreach ($c['childs'] as $c_child) {
                                                            if (!isset($c_child['childs']))
                                                                echo '<option value="|'.$c['id'].'|'.$c_child['id'].'|" data-section="/'.$c['title'].'">'.$c_child['title'].'</option>';
                                                            if(isset($c_child['childs'])) {
                                                                foreach ($c_child['childs'] as $c_child_1) {
                                                                    echo '<option value="|'.$c['id'].'|'.$c_child['id'].'|'.$c_child_1['id'].'|" data-section="/'.$c['title'].'/'.$c_child['title'].'">'.$c_child_1['title'].'</option>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>

                                    <div class="span5">
                                        <select id="pbrande" class="selectpicker left" name="pbrande">
                                            <option value="0" selected="">Chọn thương hiệu</option>
                                            <?php if(isset($temp) && !empty($temp)) {
                                                foreach ($temp as $t) {
                                                    if ($t['t_type'] == T_BRANDE) {
                                                        echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                    }
                                                }
                                            }?>
                                        </select>

                                        <input type="text" name="pbrande-custom" id="pbrande-custom" class="form-control span2 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Số lượng</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 qty item-text-value" placeholder="0" name="pqty" id="pqty" />
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Giá ban đầu</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="ppreprice" id="ppreprice"/>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Giá bán</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="pbuyprice" id="pbuyprice"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Khuyến mãi</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="psale" id="psale"/>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả ngắn</label>
                                <div class="controls">
                                    <textarea name="psortdesc" id="psortdesc" class="item-text-area span5" rows="5"></textarea>
                                    <!-- <input type="text" maxlength="255" class="span5 item-text-value" name="psortdesc" id="psortdesc"> -->
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Thông số Kỹ thuật</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <div class="row">
                                            <div class="span10 techinfo">
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">MÀU SẮC</span></label>
                                                    <select class="selectpicker left" name="pcolors[]" id="pcolors" multiple="" data-live-search="true" title="Chọn màu">
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_COLOR) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="pcolors-custom" id="pcolors-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">CHẤT LIỆU</span></label>
                                                    <select class="selectpicker left" name="pmaterials" id="pmaterials">
                                                        <option value="0" selected="">Chọn chất</option>
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_MATERIAL) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="pmaterials-custom" id="pmaterials-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">KIỂU DÁNG</span></label>
                                                    <select class="selectpicker left" name="pstyles[]" id="pstyles" multiple="" title="Chọn kiểu">
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_STYLE) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="pstyles-custom" id="pstyles-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">MỤC ĐÍCH SỬ DỤNG</span></label>
                                                    <select class="selectpicker left" name="puses[]" id="puses" multiple="" title="Mục đích">
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_USES) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="puses-custom" id="puses-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">MÙA PHÙ HỢP</span></label>
                                                    <select class="selectpicker left" name="pseasons[]" id="pseasons" multiple="" title="Chọn mùa">                                                        
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_SEASON) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="pseasons-custom" id="pseasons-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="attr">SIZES</span></label>
                                                    <select class="selectpicker left" name="psizes[]" id="psizes" multiple="" title="Chọn sizes">                                                        
                                                        <?php if(isset($temp) && !empty($temp)) {
                                                            foreach ($temp as $t) {
                                                                if ($t['t_type'] == T_SIZE) {
                                                                    echo '<option value="'.$t['id'].'">'.$t['t_value'].'</option>';
                                                                }
                                                            }
                                                        }?>
                                                    </select>
                                                    <input type="text" name="psizes-custom" id="psizes-custom" class="form-control span4 item-text-value" value="" placeholder="Custom Field" pattern="[a-zA-Z]" title="">
                                                </div>
                                            </div>
                                            <!-- <p><span>CHẤT LIỆU:</span> <input type="text" name="" id="input" class="form-control span4" value="" pattern="" title=""></p>
                                            <p><span>KIỂU DÁNG:</span> <input type="text" name="" id="input" class="form-control span4" value="" pattern="" title=""></p>
                                            <p><span>MỤC ĐÍCH SỬ DỤNG:</span> <input type="text" name="" id="input" class="form-control span4" value="" pattern="" title=""></p>
                                            <p><span>MÙA PHÙ HỢP:</span> <input type="text" name="" id="input" class="form-control span4" value="" pattern="" title=""></p>
                                            <p><span>SIZES:</span> <input type="text" name="" id="input" class="form-control span4" value="" pattern="" title=""></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Đặc điểm</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="pattributes" id="pattributes" class="item-text-area textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="fulldesc" id="fulldesc" class="item-text-area textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">											
								<label class="control-label" for="upload_images">File ảnh</label>
								<div class="controls span9">
								    <div class="upload_images">Your browser doesn't support native upload.</div>
				                </div> <!-- /controls -->				
                            </div> <!-- /control-group -->
                            <input type="hidden" value="default" id="dir" />
                            <input type="hidden" value="0" id="status" />
                            <input type="hidden" value="administrator" id="project" />
                        </form>
                      
                    </div>
                    <!-- /widget-content --> 
                    
                  </div>
                </div>
                
            </div>
        </div>
       </div>