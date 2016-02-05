    <?php
        $attr = unserialize($item['attributes']);
    ?>
    <div class="row">
        <div class="span12">
            <div class="widget widget-nopad">
                <div class="widget-header"> <i class="icon-plus"></i>
                  <h3>Cập nhật sản phẩm</h3>
                </div>
                
                <!-- /widget-header -->
                <div class="widget-content upload-div">
                  <div class="widget big-stats-container">
                    <div class="widget-content noborder noradius">
                        <div class="alert alert-success <?php if(!isset($success)) echo 'display-none'?>">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Thông báo: </strong> Thao tác thành công.
                        </div>

                        <form id="form_validate" class="form-horizontal left-align cmxform" novalidate="novalidate" action="" method="POST" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Tên sản phẩm (*)</label>
                                <div class="controls">
                                    <input type="text" maxlength="255" class="span5 left {validate:{required:true}} item-text-value" name="pname" required="required" id="pname" value="<?php echo $item['title']?>">
                                    <div class="span5">
                                        <select class="selectpicker sl-max-135 left" name="ptype" id="ptype">
                                            <option value="1" <?php if($item['type'] == 1) echo 'selected="selected"'?>>Hàng order</option>
                                            <option value="0" <?php if($item['type'] == 0) echo 'selected="selected"'?>>Hàng sẵn có</option>
                                        </select>

                                        <select class="selectpicker sl-max-135 left" name="pstatus" id="pstatus">
                                            <option value="1" <?php if($item['status'] == 1) echo 'selected="selected"'?>>Public</option>
                                            <option value="0" <?php if($item['status'] == 0) echo 'selected="selected"'?>>UnPublic</option>
                                        </select>

                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" value="1" name="pfeature" id="pfeature" <?php if($item['is_featured'] == 1) echo 'checked="checked"'?>>
                                            Nổi bật?
                                            </label>
                                        </div>

                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" value="1" name="phot" id="phot" <?php if($item['is_hot'] == 1) echo 'checked="checked"'?>>
                                            Hot?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="control-group cate">
                                <label class="control-label">Category</label>
                                <div class="controls category">
                                    <select id="categories" multiple="multiple" name="categories[]">
                                        <?php
                                            if (isset($category) && !empty($category)) {
                                                foreach ($category as $c) {
                                                    if($c['parent_id'] == 0 && $c['level'] == 1 && !isset($c['childs'])) {
                                                        $s = '';
                                                        if (strpos($item['category_id'], $c['id']) !== FALSE) {
                                                            $s = 'selected="selected"';
                                                        }
                                                        echo '<option value="|'.$c['id'].'|" data-section="" '.$s.'>'.$c['title'].'</option>';
                                                    }

                                                    if(isset($c['childs'])) {
                                                        foreach ($c['childs'] as $c_child) {
                                                            if (!isset($c_child['childs'])){
                                                                $s_child = '';
                                                                if (strpos($item['category_id'], $c_child['id']) !== FALSE) {
                                                                    $s_child = 'selected="selected"';
                                                                }
                                                                echo '<option value="|'.$c['id'].'|'.$c_child['id'].'|" data-section="/'.$c['title'].'" '.$s_child.'>'.$c_child['title'].'</option>';
                                                            }
                                                            if(isset($c_child['childs'])) {
                                                                foreach ($c_child['childs'] as $c_child_1) {
                                                                    $s_child_1 = '';
                                                                    if (strpos($item['category_id'], $c_child_1['id']) !== FALSE) {
                                                                        $s_child_1 = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="|'.$c['id'].'|'.$c_child['id'].'|'.$c_child_1['id'].'|" data-section="/'.$c['title'].'/'.$c_child['title'].'" '.$s_child_1.'>'.$c_child_1['title'].'</option>';
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
                                                        $s = '';
                                                        if (strpos($item['brande'], $t['id']) !== FALSE) {
                                                            $s = 'selected="selected"';
                                                        }
                                                        echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                        <input type="text" class="form-control span5 qty item-text-value" placeholder="0" name="pqty" id="pqty" value="<?php echo $item['amount']?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Giá ban đầu</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="ppreprice" id="ppreprice" value="<?php echo $item['pre_price']?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Giá bán</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="pbuyprice" id="pbuyprice" value="<?php echo $item['buy_price']?>"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Khuyến mãi</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" class="form-control span5 price item-text-value" placeholder="0" name="psale" id="psale" value="<?php echo $item['deal']?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả ngắn</label>
                                <div class="controls">
                                    <textarea name="psortdesc" id="psortdesc" class="item-text-area span5" rows="5"><?php echo $attr['sort_desc']?></textarea>
                                    <!-- <input type="text" maxlength="255" class="span5 item-text-value" name="psortdesc" id="psortdesc" value="<?php echo $attr['sort_desc']?>"> -->
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
                                                                    $s = '';
                                                                    if (strpos($item['colors'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                                                    $s = '';
                                                                    if (strpos($item['materials'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                                                    $s = '';
                                                                    if (strpos($item['styles'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                                                    $s = '';
                                                                    if (strpos($item['uses'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                                                    $s = '';
                                                                    if (strpos($item['seasons'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                                                    $s = '';
                                                                    if (strpos($item['sizes'], $t['id']) !== FALSE) {
                                                                        $s = 'selected="selected"';
                                                                    }
                                                                    echo '<option value="'.$t['id'].'" '.$s.'>'.$t['t_value'].'</option>';
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
                                        <textarea name="pattributes" id="pattributes" class="item-text-area textarea"><?php echo urldecode($attr['attributes'])?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <div class="controls">
                                    <div class="input-group span9 mgr-left-0">
                                        <textarea name="fulldesc" id="fulldesc" class="item-text-area textarea"><?php echo urldecode($attr['fulldesc'])?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save</button> 
                                <button type="reset" class="btn">Cancel</button>
                            </div> <!-- /form-actions -->

                            <div class="control-group">
                                <label class="control-label" for="upload_images">Files ảnh SP</label>
                                <div class="controls span9">
                                    <?php
                                        $lImages = explode('|', $item['images']);
                                        foreach ($lImages as $img) {
                                            if (trim($img)) {
                                                echo '<div class="list-img-item"><img class="img-item" src="'.base_url('/public/uploads/products/'.$img).'" alt="images SP"><button itemId = "'.$item['id'].'" imgName="'.$img.'" type="button" class="close remove-img-item" data-dismiss="alert" title="Remove this image">&times;</button></div>';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="control-group">                                         
                                <label class="control-label" for="upload_images">Upload ảnh</label>
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