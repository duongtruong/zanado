<div class="account-create" style="padding: 10px 20px">
    <form method="post" id="frm-setting-user" data-toggle="validator" role="form">
        <div class="fieldset">
            <input type="hidden" name="success_url" value="">
            <input type="hidden" name="error_url" value="">
            <h2 class="legend">Thông tin tài khoản</h2>
            <ul class="form-list">
                <li>
                    <div class="alert alert-danger alert-dismissible alert-error-hidden hidden" role="alert">
                        <strong>Lỗi!</strong> <span class="red-normal re-error err-ajax"></span>.
                    </div>
                    <div class="alert alert-success alert-dismissible alert-success-hidden hidden" role="alert">
                        <strong>Thành công!</strong> <span class="re-success success-ajax"></span>.
                    </div>   
                </li>
                <li class="fields">
                    <div class="customer-name-middlename">
                        <div class="field name-fullname">
                            <label for="fullname" class="required"><em>*</em>Họ tên</label>
                            <div class="input-box">
                                <input data-minlength="3" type="text" id="fullname" name="fullname" value="<?php echo $logger['nickname']?>" title="Họ & Tên" maxlength="255" class="input-text required-entry" required>
                            </div>
                        </div>
                        
                        <div class="field name-email">
                            <label for="email" class="required"><em>*</em>Email</label>
                            <div class="input-box">
                                <input type="email" readonly="" id="email" name="email" value="<?php echo $logger['email']?>" title="Email" maxlength="255" class="input-text required-entry">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="fields">
                    <div class="customer-name-middlename">
                        <div class="field name-firstname">
                            <label for="billing:telephone" class="required">Điện thoại Di Động<em>*</em></label>
                                <div class="input-box form-group has-feedback">
                                    <input type="text" value="<?php echo $logger['telephone']?>" pattern="^(?:0|\(?\1\)?\s?|9\s?)[0-9]{9,10}$" name="telephone" value="" title="Điện thoại liên hệ" class="input-text required-entry validate-telephone minimum-length-10" id="billing:telephone" maxlength="15" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                </div>
                        </div>
                        
                        <div class="field name-addr">
                            <label for="addr" class="required"><em>*</em>Địa chỉ</label>
                            <div class="input-box">
                                <input type="addr" id="addr" name="addr" value="<?php echo $logger['address']?>" title="Địa chỉ" maxlength="1024" class="input-text required-entry" required>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="fieldset">
            <h2 class="legend">Đổi mật khẩu ?</h2>
            <ul class="form-list">
                <li>
                    <div class="alert alert-danger alert-dismissible alert-error-changepass-hidden hidden" role="alert">
                        <strong>Lỗi!</strong> <span class="red-normal re-error err-ajax"></span>.
                    </div>
                    <div class="alert alert-success alert-dismissible alert-success-changepass-hidden hidden" role="alert">
                        <strong>Thành công!</strong> <span class="re-success success-ajax"></span>.
                    </div>   
                </li>
                <li class="fields">
                    <div class="field">
                        <label for="password" class="required"><em>*</em>Mật khẩu hiện tại</label>
                        <div class="input-box">
                            <input required data-minlength="6" type="password" name="current_password" id="password" title="Password" class="input-text required-entry validate-password">
                        </div>
                    </div>
                </li>
                <li class="fields">
                    <div class="field">
                        <label for="password" class="required"><em>*</em>Mật khẩu mới</label>
                        <div class="input-box">
                            <input data-minlength="6" type="password" name="password" id="inputNewPassword" title="Password" class="input-text required-entry validate-password">
                        </div>
                    </div>
                    <div class="field">
                        <label for="confirmation" class="required"><em>*</em>Nhập lại mật khẩu mới</label>
                        <div class="input-box">
                            <input data-minlength="6" data-match="#inputNewPassword" type="password" name="confirmation" title="Confirm Password" id="confirmation" class="input-text required-entry validate-cpassword">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="buttons-set">
                <button type="submit" title="Gửi" class="button" id="submit-setting-user"><span><span>Cập nhật</span></span>
                </button>
                <p class="required">* Bắt buộc</p>
            </div>
        </div>
        <div class="loader-setting-user" style="display: none;">
            <img src="<?php echo base_url('/public/assets/images/bx_loader.gif')?>" class="img-responsive" alt="Image">
        </div>
    </form>
</div>