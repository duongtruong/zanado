<div class="em-wrapper-header">
    <div id="em-mheader" class="visible-xs container">
    <div id="em-mheader-top" class="row">
        <div id="em-mheader-logo" class="col-xs-4">
            <div class="em-logo">
                <a href="<?php echo base_url('/index.html')?>" title="ESHOP" class="logo"><strong>ESHOP</strong><img src="<?php echo base_url('public/assets/images/logo-noen.png')?>" alt="ESHOP" /></a>
            </div>
        </div><!-- /#em-mheader-logo -->
        <div class="col-xs-20">
            <div class="em-top-search">
                <div class="em-header-search-mobile">
                    <form method="get" action="<?php echo base_url('search.html')?>">
                        <div class="form-search no_cate_search">
                            <div class="text-search">
                                <input id="search-mobile" type="text" name="q" value="" class="input-text" maxlength="128" />
                                <button type="submit" title="Search" class="button"><span><span>Search</span></span>
                                </button>
                                <div id="search_autocomplete_mobile" class="search-autocomplete"></div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.em-header-search-mobile -->
            </div><!-- /.em-top-search -->
            <div class="em-top-cart">
                <div class="em-wrapper-topcart-mobile em-no-quickshop">
                    <div class="em-container-topcart">
                        <div class="em-summary-topcart">
                            <a id="em-amount-cart-link" title="Shopping Cart" class="em-amount-topcart" href="<?php echo base_url('checkout/cart.html')?>"> <span class="em-topcart-text">My Cart:</span> <span class="em-topcart-qty"><?php echo $this->cart->total_items()?></span> </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.em-top-cart -->
            <div id="em-mheader-wrapper-menu"> <span class="visible-xs fa fa-bars" id="em-mheader-menu-icon"></span>
                <div id="em-mheader-menu-content" style="display: none;">
                    <div class="em-wrapper-top">
                        <div class="em-top-links row">
                            <div class="">
                                <ul class="top-header-link links">
                                    <li class="first col-xs-8"> <a title="Log In" data-toggle="modal" data-target="#myModallogin" class="login-link fa fa-user" href="#"><span>Đăng nhập</span></a>
                                    </li>
                                    <li class="col-xs-8"> <a title="Sign up" data-toggle="modal" data-target="#myModallogin" class='signup-link fa fa-sign-out' href="#"><span>Đăng ký</span></a>
                                    </li>
                                    <li class="last col-xs-8"> <a href="<?php echo base_url('checkout/cart.html')?>" class="checkout-link fa fa-shopping-cart"><span>Giỏ hàng</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.em-top-links -->
                    </div><!-- /.em-wrapper-top -->
                    <div class="row mobile-main-menu toggle-menu">
                        <div class="col-sm-24">
                            <div class="em-top-menu">
                                <div class="em-menu-mobile">
                                    <div class="megamenu-wrapper wrapper-7_5505">
                                        <div class="em_nav" id="toogle_menu_7_5505">
                                            <ul class="hnav em_menu_mobile">
                                                <li class="menu-item-link menu-item-depth-0 fa fa-home">
                                                    <a class="em-menu-link" href="<?php echo base_url('index.html')?>"> <span> Trang chủ </span> </a>
                                                </li><!-- /.menu-item-link -->
                                                <li class="menu-item-link menu-item-depth-0 dd-menu-link fa fa-bars menu-item-parent">
                                                    <a class="em-menu-link" href="#"> <span> Danh mục </span> </a>
                                                    <ul class="menu-container">
                                                        <li class="menu-item-text menu-item-depth-1">
                                                        	<ul class="em-catalog-navigation vertical">
                                                        	<?php
								                            function buildMenuMobile($items, $currentId = 0, $parent = 0, $level = 0)
								                            {
								                                $hasChildren = false;
								                                $childrenHtml = '';
								                                $outputHtml = '<ul class="level'.$level.'">%s</ul>';
								                                if ($parent == 0) {
								                                    $outputHtml = '%s';
								                                }

								                                foreach($items as $item)
								                                {
								                                    $s = ($item['id'] == $currentId) ? 'selected' : '';
								                                    if ($item['parent_id'] == $parent) {                                        
								                                        $hasChildren  = true;
								                                        $temp         = buildMenuMobile($items, $currentId, $item['id'], $item['level']+1);
								                                        $c_left       = $item['level'] == 1 ? 'level0 nav-2' : 'level1 nav-2-1 first';
								                                        $dropdown     = $temp ? 'class="parent '.$c_left.'"' : '';
								                                        $lv3_li_class = $item['level'] == 3 ? 'class="cat-menu-sub-show"' : '';
								                                        $spanclass    = '<span>';
								                                        $endspanclass = '</span>';

								                                        $childrenHtml .= '<li id="cat-menu-'.$item['id'].'" '.$dropdown.' '.$lv3_li_class.'><a class="'.$s.'" tabindex="-1" href="'.base_url('p/cat/'.$item['slug'].'-'.$item['id']).'.html">'.$spanclass.$item['title'].$endspanclass.'</a>';

								                                        $childrenHtml .= $temp;

								                                        $childrenHtml .= '</li>';
								                                    }
								                                }

								                                // Without children, we do not need the <ul> tag.
								                                if (!$hasChildren) {
								                                    $outputHtml = '';
								                                }

								                                // Returns the HTML
								                                return sprintf($outputHtml, $childrenHtml);
								                            }

								                            $categories = $this->temp['category'];
								                            $html = buildMenuMobile($categories, 0, 0, 0);
								                            echo $html;
								                            ?>
								                            </ul>
                                                        </li>
                                                    </ul>
                                                </li><!-- /.menu-item-link -->
                                                <li class="menu-item-link menu-item-depth-0 fa fa-file">
                                                    <a class="em-menu-link" href="<?php echo base_url('brande-.html')?>"> <span> Thương hiệu </span> </a>
                                                </li><!-- /.menu-item-link -->
                                            </ul>
                                        </div>
                                    </div><!-- /.megamenu-wrapper -->
                                </div>
                            </div><!-- /.em-top-menu -->
                        </div>
                    </div><!-- /.mobile-main-menu -->
                    <div class="row mobile-block">
                        <div class="col-sm-24">
                            <ul class="em-mobile-help">
                                <li><a href="<?php echo base_url('about.html')?>"><span class="fa fa-user">&nbsp;</span>Giới thiệu</a>
                                </li>
                                <li><a href="<?php echo base_url('faq.html')?>"><span class="fa fa-question-circle">&nbsp;</span>Hỏi đáp</a>
                                </li>
                                <li><a href="<?php echo base_url('policy.html')?>"><span class="fa fa-star">&nbsp;</span>Bảo mật</a>
                                </li>
                                <li><a href="<?php echo base_url('contact.html')?>"><span class="fa fa-comment-o">&nbsp;</span>Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.mobile-block -->
                </div>
            </div><!-- /.em-mheader-wrapper-menu -->
        </div>
    </div><!-- /#em-mheader-top -->
    </div><!-- /#em-mheader -->
</div><!-- /.em-wrapper-header -->