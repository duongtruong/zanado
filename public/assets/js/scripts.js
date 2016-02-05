/**
 * Register
 */

$(document).ready(function(){
    
    var base_url = $('#baseUrl').val();
	$('._btnRegister').on('click', function(e) {
	    e.preventDefault();
	    var formRegister = $('#frm-register');
	    if(validateRegister(formRegister)===true) {
	        $.ajax({
	            url:  base_url+'frontend/register',
	            type: "POST",
	            data: $('#frm-register').serialize(),
	            beforeSend :function(){
	                $('.loader-login').show();
	                formRegister.find(".re-error.err-ajax").addClass('hidden');
	                formRegister.find("._btnRegister").addClass('disable');
	            },
	            success: function (msg) {
	                $('.loader-login').hide();
	                var data = JSON.parse(msg);                
	                if(data.type === 0){
	                    formRegister.find("."+data.element).removeClass('hidden');
	                    formRegister.find("#"+data.element).html(data.message);
	                    formRegister.find("._btnRegister").removeClass('disable');
	                }else{
	                    formRegister.find("#"+data.element).html(data.message);                    
	                    window.location.href = base_url;
	                }
	            }
	            
	        });
	    }
	    return false;
	});

    function validateRegister(formRegister){

        if(formRegister.find('#email').val().replace(/\s+/, '') === '')
        {
            formRegister.find('#email').addClass('form-myinput-warning');
            formRegister.find('.error-email').removeClass('hidden');
            formRegister.find('#error-email').html('Bạn chưa điền địa chỉ email !');
            return false;
        }

        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!filter.test(formRegister.find('#email').val().replace(/\s+/, '')))
        {
            formRegister.find('#email').addClass('form-myinput-warning');
            formRegister.find('.error-email').removeClass('hidden');
            formRegister.find('#error-email').html('Xin hãy nhập một địa chỉ email hợp lệ!');
            return false;
        }

        formRegister.find('#email').removeClass('form-myinput-warning');
        formRegister.find('.error-email').addClass('hidden');
        formRegister.find('#error-email').html('');

        if( formRegister.find('#username').val().replace(/\s+/, '') == '' || formRegister.find('#username').val().replace(/\s+/, '').length<4)
        {
            formRegister.find('#username').addClass('form-myinput-warning');
            formRegister.find('.error-username').removeClass('hidden');
            formRegister.find('#error-username').html('Tên đăng nhập phải lớn hơn 3 ký tự !');
            return false;
        }
        formRegister.find('.error-username').addClass('hidden');
        formRegister.find('#username').removeClass('form-myinput-warning');

        if(formRegister.find('#password').val().replace(/\s+/, '') == '' || formRegister.find('#password').val().replace(/\s+/, '').length<6)
        {
            formRegister.find('#password').addClass('form-myinput-warning');
            formRegister.find('.error-password').removeClass('hidden');
            formRegister.find('#error-password').html('Mật khẩu từ 6 ký tự trở lên !');
            return false;
        }
        formRegister.find('.error-password').addClass('hidden');
        formRegister.find('#password').removeClass('form-myinput-warning');
        formRegister.find('#error-password').html('');
        
        if(formRegister.find('#repassword').val().replace(/\s+/, '') == '')
        {
            formRegister.find('#repassword').addClass('form-myinput-warning');
            formRegister.find('.error-repassword').removeClass('hidden');
            formRegister.find('#error-repassword').html('Bạn chưa xác nhận lại mật khẩu !');
            return false;
        }

        if(formRegister.find('#repassword').val() !== formRegister.find('#password').val())
        {
            formRegister.find('#repassword').addClass('form-myinput-warning');
            formRegister.find('.error-repassword').removeClass('hidden');
            formRegister.find('#error-repassword').html('Mật khẩu xác nhận không khớp!');
            return false;
        }
        formRegister.find('.error-repassword').addClass('hidden');
        formRegister.find('#repassword').removeClass('form-myinput-warning');
        formRegister.find('#error-repassword').html('');
       
        return true;
    }

	//Check UserName Register for User

    $('#username').on('blur', function(e) {    
        e.preventDefault();        
        var name = $('#username').val();         
        var formRegister = $('#frm-register');
        if( name.replace(/\s+/, '') === '' || name.replace(/\s+/, '').length<4)
        {
            $('#username').addClass('form-myinput-warning');
            $('.error-username').removeClass('hidden');
            $('#error-username').html('Tên đăng nhập phải lớn hơn 3 ký tự !');
            return false;
        }
            $('#username').removeClass('form-myinput-warning');
            $('.error-username').addClass('hidden');  
            $('#error-username').html('');       
        $.ajax({
            url:  base_url+'frontend/register/check_username',
            type: "POST",
            data: $('#frm-register').serialize(),
            success:function(msg) {
                var data = JSON.parse(msg); 
                if(data.type!==1){
                    formRegister.find("."+data.element).removeClass('hidden');
                    formRegister.find("#"+data.element).html(data.message);
                }else{
                    formRegister.find("."+data.element).addClass('hidden');
                    formRegister.find("#"+data.element).html('');
                }
            }
        });

    });
    
    $(document).on('click', '.btn-cart-ajax', function (e) {
        e.preventDefault();
        var url    = $(this).attr('href');
        var itemId = $('#item_id_ajax').val();
        var qty    = $('#qty_ajax').val();
        var color  = $('.color-choosen').val();
        var size   = $('.size-choosen').val();

        if(itemId && qty && color && size) {
            var base_url = $('#baseUrl').val();
            $.ajax({
                url:  base_url+'/add-to-cart',
                type: "POST",
                data: $('#product_addtocart_form_ajax').serialize(),
                beforeSend :function(){
                    $('.loader-addItem-cart').show();
                },
                success: function (msg) {
                    var data = JSON.parse(msg);
                    var qty  = data.qty;
                    $('.header-qty-number').html(qty +' SP');
                    $('.loader-addItem-cart').hide();
                    $.fancybox({
                        width: 400,
                        height: 400,
                        overlayShow : true,
                        overlayOpacity : 0.7,
                        autoSize: true,
                        href: url,
                        type: 'ajax'
                    });
                }
                
            });
        }
        return false;
    });
    
    $(document).on('click', '.btn-em-buy-now', function (e) {
        e.preventDefault();
        var params = $('#product_addtocart_form').serialize();
        if (!params){
            var params = $('#product_addtocart_form_ajax').serialize();
        }
        var url = $(this).attr('href');
        window.location = url + '?p=checkout' + params;
        return false;
    });

	$(document).on('change','._ajaxState',function(){
	    var id = $(this).val();
	    $.ajax({
	        url:base_url + "/register/choose_district",
	        data:{ id:id },
	        success:function(result) {
	            var data = $.parseJSON(result);
	            $('._ajaxDistrict').html(data);
	            $('._ajaxDistrict').removeClass('hidden');
	            $('._afterDistrict').addClass('hidden');
	        }
	    });
	});

    $('#_bt-login_top').click(function (event) {
    	event.preventDefault();
        $.ajax({
            url: base_url + 'signin',
            type: 'POST',
            data: $('#frm-login-top').serialize(),
            beforeSend :function(){
                $(this).hide();
                $('.loader-login').show();
            },
            success: function(msg) {
                var result = JSON.parse(msg);
                if (result.type === 1) {
                    return location.reload();
                }else{
                    $('.loader-login').hide();
                    $(this).show();
                    $('#frm-login-top').find('.err-ajax').html(result.message).show();
                    $('#frm-login-top div.alert-hidden').removeClass('hidden');
                    return false;
                }
            }
        });
	});

    $('#_bt-lostpass_top').click(function (e) {
        var x = $(this);
        e.preventDefault();
        $('#frm-lostpass-top div.alert-success-hidden').addClass('hidden');
        $('#frm-lostpass-top div.alert-error-hidden').addClass('hidden');
        $.ajax({
            url: base_url + 'lostpass',
            type: 'POST',
            data: $('#frm-lostpass-top').serialize(),
            beforeSend :function(){
                $(x).hide();
                $('.loader-login').show();
            },
            success: function(msg) {
                var result = JSON.parse(msg);
                if (result.type === 1) {
                    $('#frm-lostpass-top').find('.success-ajax').html(result.message).show();
                    $('#frm-lostpass-top div.alert-success-hidden').removeClass('hidden');
                }else{
                    $(x).show();
                    $('#frm-lostpass-top').find('.err-ajax').html(result.message).show();
                    $('#frm-lostpass-top div.alert-error-hidden').removeClass('hidden');
                }
                $('.loader-login').hide();
            }
        });
        return false;
    });

	$('#frm-login').find('._inputPass').keyup(function (e) {
	    if (e.keyCode == 13) {
	        $('#_bt-login').click();
	    }
	});

	$('#frm-login-top').find('._inputPass').keyup(function (e) {
	    if (e.keyCode == 13) {
	        $('#_bt-login_top').click();
	    }
	});

    $('body').on('click', '.btn-cart-home', function(){
        var url = $(this).attr('href');
        $.fancybox({
            width: 400,
            height: 400,
            overlayShow : true,
            overlayOpacity : 0.7,
            autoSize: true,
            href: url,
            type: 'ajax'
        });
    });

    $('body').on('click', 'ul#setting-user > li > a.fancybox', function (e) {
        var url = $(this).attr('href');
        var x   = $(this).attr('fancybox');

        if (x) {
            $.fancybox({
                width: 400,
                height: 400,
                overlayShow : true,
                overlayOpacity : 0.7,
                autoSize: true,
                href: url,
                type: 'ajax'
            });
            return false;
        }
    });

    $('body').on('click', 'button#submit-setting-user', function (e){
        $('#frm-setting-user').validator();
        var x = $(this);
        e.preventDefault();
        $('#frm-setting-user div.alert-success-hidden').addClass('hidden');
        $('#frm-setting-user div.alert-error-hidden').addClass('hidden');
        $('#frm-setting-user div.alert-success-changepass-hidden').addClass('hidden');
        $('#frm-setting-user div.alert-error-changepass-hidden').addClass('hidden');
        $.ajax({
            url: base_url + 'u/setting',
            type: 'POST',
            data: $('#frm-setting-user').serialize(),
            beforeSend :function(){
                $(x).hide();
                $('.loader-setting-user').show();
            },
            success: function(msg) {
                var result = JSON.parse(msg);
                if (result.type === 1) {
                    $('#frm-setting-user').find('div.alert-success-hidden .success-ajax').html(result.message).show();
                    $('#frm-setting-user div.alert-success-hidden').removeClass('hidden');
                }else{
                    $('#frm-setting-user').find('div.alert-error-hidden .err-ajax').html(result.message).show();
                    $('#frm-setting-user div.alert-error-hidden').removeClass('hidden');
                }

                if (result.type_changepass === 1) {
                    $('#frm-setting-user').find('div.alert-success-changepass-hidden .success-ajax').html(result.message_changepass).show();
                    $('#frm-setting-user div.alert-success-changepass-hidden').removeClass('hidden');

                    $('#frm-setting-user').find('input[type="password"]').val('');
                }
                else if (result.type_changepass === 0) {
                    $('#frm-setting-user').find('div.alert-error-changepass-hidden .err-ajax').html(result.message_changepass).show();
                    $('#frm-setting-user div.alert-error-changepass-hidden').removeClass('hidden');
                }
                $(x).show();
                $('.loader-setting-user').hide();
            }
        });
        return false;
    });

    $('body').on('keydown', '#frm-setting-user input#password', function (e){
        if ($(this).val()) {
            console.log($(this).val());
            $('#frm-setting-user').find('input[type="password"]').attr('required', '');
        }
    });

    $('#billing_city_id').on('change', function (e) {
        e.preventDefault();
        var cityId   = $(this).val();
        var base_url = $('#baseUrl').val();
        if (cityId !== '') {
            $.ajax({
                url:  base_url+'/get-district.html?cityId='+cityId,
                type: "GET",
                beforeSend :function(){
                },
                success: function (msg) {
                    var data = JSON.parse(msg);
                    $('#billing_district_id').html(data.list_district)
                },
                error: function () {
                    $('#billing_district_id').html('<option value="" selected="selected">Quận / Huyện</option>');
                }
            });
        }
        else {
            $('#billing_district_id').html('<option value="" selected="selected">Quận / Huyện</option>');
        }
        $('#billing_ward_id').html('<option value="" selected="selected">Xã / Phường</option>');
        $('#billing_street').trigger('keyup');
        return false;
    });

    $('#billing_district_id').on('change', function (e) {
        e.preventDefault();
        var districtId   = $(this).val();
        var base_url     = $('#baseUrl').val();
        if (!$('#billing_city_id').val()) {
            alert('Chọn thành phố trước.');
        }
        else {
            if (districtId !== '') {
                $.ajax({
                    url:  base_url+'/get-ward.html?districtId='+districtId,
                    type: "GET",
                    beforeSend :function(){
                    },
                    success: function (msg) {
                        var data = JSON.parse(msg);
                        $('#billing_ward_id').html(data.list_ward)
                    },
                    error: function () {
                        $('#billing_ward_id').html('<option value="" selected="selected">Xã / Phường</option>');
                    }
                });
            }
            else {
                $('#billing_ward_id').html('<option value="" selected="selected">Xã / Phường</option>');
            }
        }
        $('#billing_street').trigger('keyup');
        return false;
    });

    $('#billing_ward_id').on('change', function (e) {
        $('#billing_street').trigger('keyup');
    });
    
    $('#billing_district_id').on('click', function (e) {
        e.preventDefault();
        var districtId   = $(this).val();
        var base_url     = $('#baseUrl').val();
        if (!$('#billing_city_id').val()) {
            alert('Chọn thành phố trước.');
        }
        return false;
    });

    $('#billing_ward_id').on('click', function (e) {
        e.preventDefault();
        var districtId   = $(this).val();
        var base_url     = $('#baseUrl').val();
        if (!$('#billing_district_id').val()) {
            alert('Chọn quận huyện trước.');
        }
        return false;
    });

    $('.sp-methods > ul > li > input').on('click', function (e) {
        $('.sp-methods > dt > input').prop("checked", false);
        $('.sp-methods > dt').hide();
        var billing = $(this).attr('data-billing');
        $('#'+billing).find('input').prop("checked", true);
        $('#'+billing).show();
    });

    $('#billing_street').on('keyup', function (e) {
        var html = $(this).val();

        if ($('#billing_ward_id').val()) {
            html += ', '+$('#billing_ward_id option:selected').text();
        }
        if ($('#billing_district_id').val()) {
            html += ', '+$('#billing_district_id option:selected').text();
        }
        if ($('#billing_city_id').val()) {
            html += ', '+$('#billing_city_id option:selected').text();
        }
        
        $('.fulldist > span').html(html);
        $('.fulldist > input').val(html);
    });

    /*Loading with scroll function*/
    // Biến dùng kiểm tra nếu đang gửi ajax thì ko thực hiện gửi thêm
    var is_busy = false;
         
    // Biến lưu trữ trang hiện tại
    var page = 0;
     
    // Biến lưu trữ rạng thái phân trang 
    var stopped = false;

    $('body').on('click', '.item-filter > input', function (e){
        var checked = $(this).is(':checked');
        if (checked) {
            $(this).parent().addClass('item-filter-active');
        }
        else {
            $(this).parent().removeClass('item-filter-active');
        }

        $('#frm-search select#sortlist-search').trigger('change');
    });

    $('body').on('click', '.item-choosen > input', function (e){
        $(this).parent().parent().find('label').removeClass('item-choosen-active');
        $(this).parent().addClass('item-choosen-active');
        $(this).prop('checked', true);
    });

    $('#frm-search input[type="search"]').keydown(function (e){
        var code = e.keyCode || e.which;
        if (code == 13) {
            delay(function(){
                $('#frm-search select#sortlist-search').trigger('change');
            }, 200 );
            e.preventDefault();
            return false;
        }
    });

    $('#button-search').click(function (){
        delay(function(){
            $('#frm-search select#sortlist-search').trigger('change');
        }, 200 );
    });

    $('body').on('change', '#frm-search select#sortlist-search', function (e) {
        var base_url = $('#baseUrl').val();
        var data     = $('#frm-search').serialize();
        $.ajax({
            url: base_url + '/search.html',
            type: 'GET',
            data: data+'&ajax=true',
            beforeSend :function(){
                $('.loader-search').show();
            },
            success: function(msg) {
                var result = JSON.parse(msg);
                $('.loader-search').hide();
                if (typeof window.history.pushState === "function"){
                    window.history.pushState("", "", base_url + 'search.html'+'?'+data);
                }

                if (result.table_filter_content) {
                    $('#table-filter-content').html(result.table_filter_content);
                }

                if (result.list_item) {
                    $('#list-item-content').html(result.list_item);
                }

                $('.search-scroll-url').val(base_url + 'search.html'+'?'+data);
                stopped = false; page = 0;
            },
            error: function() {
                $('.loader-search').hide();
            }
        });
    });

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    /*URL*/
    var url = $('.search-scroll-url').val();

    // Khi kéo scroll thì xử lý
    $(window).scroll(function() 
    {
        // Element append nội dung
        $element = $('#list-item-content');
         
        // ELement hiển thị chữ loadding
        $loadding = $('.search-scroll-loading');
         
        // Nếu màn hình đang ở dưới cuối thẻ thì thực hiện ajax
        if($(window).scrollTop() + $(window).height() >= $('#em-wrapper-main-search').height()) 
        {
            // Nếu đang gửi ajax thì ngưng
            if (is_busy == true){
                return false;
            }
             
            // Nếu hết dữ liệu thì ngưng
            if (stopped == true){
                return false;
            }
             
            // Thiết lập đang gửi ajax
            is_busy = true;
             
            // Tăng số trang lên 1
            page++;
             
            // Hiển thị loadding
            $loadding.removeClass('display-none');
             
            // Gửi Ajax
            $.ajax(
            {
                type        : 'get',
                dataType    : 'text',
                url         : url,
                data        : {page : page, ajax: true},
                success     : function (msg)
                {
                    var result = JSON.parse(msg);
                    if (result.stopped) {
                        stopped = true;
                    }
                    else {
                        if (result.list_item) {
                            $element.append(result.list_item);
                        }
                    }
                }
            })
            .always(function()
            {
                // Sau khi thực hiện xong ajax thì ẩn display-none và cho trạng thái gửi ajax = false
                $loadding.addClass('display-none');
                is_busy = false;
            });
            return false;
        }
    });

    $('div.product-shop-top')

    .mouseenter(function (e){ /* > a.product-image > img.em-alt-hover*/
        var list_img  = $(this).attr('data-list-img').split(';');/* list_img.reverse();*/
        var img_hover = $(this).find('img.em-alt-hover');
        var i         = 0;
        var timer     = setInterval(function(){
            console.log(list_img[i]);
            if(list_img[i]) {
                img_hover.attr('src', list_img[i]);
            }
            i++;
            if (i === list_img.length - 1) {
                i = 0;
            }
        }, 1000);
        $(this).data('timer', timer);
    })

    .mouseleave(function (e) {
        clearInterval($(this).data('timer'));
    })
    ;

    $('.emcatalog-mobile-5').each(function (){
        var len = $(this).length;
        if (len) {
            var gridItemMaxHeight = 0;
            var $listItems = $(this).find('div.item');
            var lenLi = $listItems.length;
            if(lenLi){
                for(var j=0;j<lenLi;j++){
                    $listItems.eq(j).css('height', '');
                    gridItemMaxHeight = Math.max(gridItemMaxHeight, $listItems.eq(j).height());
                }
            }

            if(gridItemMaxHeight) {
                $listItems.css('height', gridItemMaxHeight + 'px');
                $listItems.find('div.product-item').css('height', '100%');
            }
        }
    });
});

