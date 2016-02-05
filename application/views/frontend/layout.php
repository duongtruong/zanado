<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php if(isset($title)) echo $title . ' » Thời trang Online Mua sắm quần áo nam nữ Đẹp Rẻ » eShop'; else echo 'Thời trang Online Mua sắm quần áo nam nữ Đẹp Rẻ » eShop';?></title>

		<!-- Bootstrap CSS -->
		<!-- ================= Google Fonts ================== -->
	    <link href='http://fonts.googleapis.com/css?family=Lato:200,300,400,500,600,700,800&amp;subset=latin,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese,latin-ext' rel='stylesheet' type='text/css' />
	    <link href='http://fonts.googleapis.com/css?family=Lora:200,300,400,500,600,700,800&amp;subset=latin,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese,latin-ext' rel='stylesheet' type='text/css' />
	    <link href='http://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800&amp;subset=latin,cyrillic-ext,cyrillic,greek-ext,greek,vietnamese,latin-ext' rel='stylesheet' type='text/css' />
	    
	    <!-- Cloud Zoom CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/em_cloudzoom.css');?>" media="all" />

	    <!-- Menu CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/menu.css');?>" media="all" />
	    <!-- Mega Menu CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/megamenu.css');?>" media="all" />

	    <!-- Widget CSS -->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/widgets.css')?>" media="all" /> -->
	    
	    <!-- Default CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/styles.css')?>" media="all" />
	    <!-- Font Awesome CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/font-awesome.css')?>" media="all" />
	    <!-- Owl Carousel CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/owl.carousel.css')?>" media="all" />
	    <!-- Responsive CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/responsive.css')?>" media="all" />

	    <!-- Ajax Cart CSS -->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/em_ajaxcart.css')?>" media="all" /> -->
	    <!-- Blog Style CSS -->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/blog-styles.css')?>" media="all" /> -->
	    <!-- Multi Deal Pro CSS -->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/em_multidealpro.css')?>" media="all" />

	    <!-- Product Labels CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/em_productlabels.css')?>" media="all" />

	    <!-- Quick Shop CSS -->
	    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/em_quickshop.css')?>" media="all" /> -->

	    <!-- Fancybox CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/jquery.fancybox.css')?>" media="all" />

	    <!-- Responsive Tab CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/responsive-tabs.css')?>" media="all" />
	    <!-- Print CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/print.css')?>" media="print" />
	    <!-- Fashion CSS -->
	    <link rel='stylesheet' type='text/css' media='all' href='<?php echo base_url("/public/assets/css/style_fashion.css")?>' />
	    <!-- Fashion CSS -->
	    <link rel='stylesheet' type='text/css' media='all' href='<?php echo base_url("/public/assets/css/color1.css")?>' />
		<link href="<?php echo base_url('/public/assets/css/style.css')?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('/public/assets/css/s.css')?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/public/assets/css/bootstrap.css')?>" media="all">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="wrapper">
            <noscript>
                <div class="global-site-notice noscript">
                    <div class="notice-inner">
                        <p> <strong>JavaScript seems to be disabled in your browser.</strong>
                            <br /> You must have JavaScript enabled in your browser to utilize the functionality of this website.</p>
                    </div>
                </div>
            </noscript>
        </div>
		<div class="page-header">
			<?php $this->load->view('frontend/scripts/header')?>
		</div>

		<div class="page-header-mobile">
			<?php $this->load->view('frontend/scripts/header-mobile')?>
		</div>

		<div class="page-sliders">
			<?php if(isset($sliders) && $sliders ) $this->load->view('frontend/scripts/slider')?>
		</div>

		<div class="page-container">
			<?php $this->load->view($template, $content);?>
		</div>

		<div class="page-footer">
			<?php $this->load->view('frontend/scripts/footer')?>
		</div>

		<div class="hidden">
			<input type="hidden" name="" id="baseUrl" class="form-control" value="<?php echo base_url();?>">
		</div>

		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<script type="text/javascript">
			$(function () {
				$('.nav-block').hover(function(){
					$('.nav-block').addClass("showsub");}, 
					function(){$('.nav-block').removeClass("showsub"); 
					$(".nav-containersub").removeClass("showhide");});

				$("ul.level2 > li").hover(function(){
			        $('ul.level2').css("border-bottom", "0px solid #dc0309");
			        }, function(){
			        $('ul.level2').css("border-bottom", "2px solid #dc0309");
			    });
			});

			function qtyDown(id) {
                var qty_el = document.getElementById('cart[' + id + '][qty]');
                var qty = qty_el.value;
                if (!isNaN(qty) && qty > 1) {
                    qty_el.value--;
                }
                return false;
            }

            function qtyUp(id) {
                var qty_el = document.getElementById('cart[' + id + '][qty]');
                var qty = qty_el.value;
                var max_qty = qty_el.getAttribute('max-value');
                if (!isNaN(qty) && qty < max_qty) {
                    qty_el.value++;
                }

                if (qty >= max_qty) {
                	alert('Số lượng quá giới hạn.');
                }
                return false;
            }
		</script>
	</body>
</html>

<!-- Function -->
<?php
	function vn_str_filter($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        $text = mb_strtolower($text);
        $text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
        $text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
        $text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
        $text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
        $text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
        $text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
        $text = preg_replace("/(đ)/", 'd', $text);
        $text = preg_replace("/(@|&|<|>)/", '', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
?>