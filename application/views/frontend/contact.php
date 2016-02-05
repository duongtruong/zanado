<div class="wrapper">
<div class="page one-column">
    <!-- /.em-wrapper-header -->

    <div class="wrapper-breadcrums">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-24">
	                <div class="breadcrumbs">
	                    <ul>
	                        <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
	                        <li class="product"> 
	                        <strong>Liên hệ</strong></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div><!-- /.wrapper-breadcrums --><!-- /.wrapper-breadcrums -->

    <div class="em-wrapper-main">
        <div class="container container-main">
            <div class="em-inner-main">
                <div class="em-main-container em-col1-layout">
                	<div class="row">
                		<div class="em-col-main col-sm-24">
                            <div id="messages_product_view"></div>
                            <div class="page-title">
                                <h1>Liên hệ</h1>
                            </div>
                            <div id="map-canvas" style="width: 100%px; height: 500px"></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="contactForm" method="post" data-toggle="validator" role="form">
                                        <div class="fieldset">
                                            <h2 class="legend">Thông tin liên hệ</h2>
                                            <?php if(isset($alert_error) && $alert_error) {?>
                                            <div class="alert alert-danger">
											  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											  	<strong>Lỗi! Vui lòng thử lại</strong> <ul><?php echo $alert_error?></ul>
											</div>
											<?php }?>

											<?php if(isset($alert_success) && $alert_success) {?>
                                            <div class="alert alert-success">
											  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											  	<strong>Gửi tin thành công!</strong> Cám ơn quý khách, chúng tôi sẽ liên hệ lại với quý khách trong thời gian sớm nhất. <ul><?php echo $alert_error?></ul>
											</div>
											<?php }?>

                                            <ul class="form-list">
                                                <li class="fields">
                                                    <div class="field form-group has-feedback">
                                                        <label for="name" class="required"><em>*</em>Họ tên</label>
                                                        <div class="input-box">
                                                            <input name="name" id="name" pattern="{3,25}$" maxlength="25" title="Họ tên" value="" class="form-control input-text required-entry" type="text" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 33px"></span>
                                                        </div>
                                                    </div>
                                                    <div class="field form-group has-feedback">
                                                        <label for="email" class="required"><em>*</em>Email</label>
                                                        <div class="input-box">
                                                            <input name="email" id="email" title="Email" value="" class="input-text required-entry validate-email" type="email" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 33px"></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="telephone">Điện thoại</label>
                                                    <div class="input-box form-group has-feedback">
                                                        <input name="telephone" id="telephone" title="Telephone" value="" class="input-text" type="tel" required>
                                                        <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                    </div>
                                                </li>
                                                <li class="wide">
                                                    <label for="comment" class="required"><em>*</em>Nội dung</label>
                                                    <div class="input-box form-group has-feedback">
                                                        <textarea name="comment" id="comment" title="Comment" class="required-entry input-text" cols="5" rows="3" required></textarea>
                                                        <span class="glyphicon form-control-feedback" aria-hidden="true" style="z-index: 9; top: 3px"></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="buttons-set">
                                            <input type="text" name="hideit" id="hideit" value="" style="display:none !important;">
                                            <button type="submit" title="Submit" class="button"><span><span>Gửi</span></span>
                                            </button>
                                        </div>
                                    </form><!-- /#contactForm -->
                                </div><!-- /.col-sm-12 -->
                                <div class="col-sm-12">
                                    <div class="em-maps-wrapper">
                                        <h1>Thông tin chủ quản</h1>
                                        <p>ESHOP</p>
                                    </div> <address><span class="fa fa-map-marker secondary2">&nbsp;</span>Địa chỉ: Hà Nội - Việt Nam</address>
                                    <p class="em-phone"><span class="fa fa-phone secondary2">&nbsp;</span>Phone: <span class="primary"> 01649613659</span>
                                    </p>
                                    <p class="em-fax"><span class="fa fa-fax secondary2">&nbsp;</span>Fax: <span class="primary">777777</span>
                                    </p>
                                    <p class="em-email"><span class="fa fa-envelope secondary2">&nbsp;</span>Email: <span class="secondary2">owner@example.com</span>
                                    </p>
                                </div><!-- /.col-sm-12 -->
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>