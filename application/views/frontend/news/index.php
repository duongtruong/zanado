<?php
	$link = '#'; $list = ''; $s = '';

	foreach ($types as $key => $value) {
		if ($type == $key && $type) {
			$link  = base_url('tin-tuc/cat/'.vn_str_filter($value).'-'.$key.'.html');
			$title = $value;
            $s     = 'selected';
		}

        $list .= '<li class="tabclick '.$s.'"><a href="'.base_url('tin-tuc/cat/'.vn_str_filter($value).'-'.$key.'.html').'">'.$value.'</a></li>';
	}
?>
<div class="wrapper-breadcrums">
    <div class="container">
        <div class="row">
            <div class="col-sm-24">
                <div class="breadcrumbs">
                    <ul>
                        <li class="home"> <a href="<?php echo base_url()?>" title="Trang chủ"><span>Trang chủ</span></a> <span class="separator">/ </span></li>
                        <?php
                        if (isset($type) && $type) {
                        ?>
                            <li class="news"> <a href="<?php echo base_url('tin-tuc.html')?>" title="Tin tức"><span>Tin tức</span></a> <span class="separator">/ </span></li>
                            <li class="post"> <strong><?php echo $title?></strong></li>
                        <?php
                        }
                        else {
                            echo '<li class="post"> <strong>'.$title.'</strong></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col2-left-layout">
                <div class="row">
                    <div class="col-sm-18 em-col-main">
                        <ul class="tablist">
                            <li class="tabclick <?php if($type == 0) echo 'selected'?>"><a href="<?php echo base_url('tin-tuc.html')?>">Tin Tức</a></li>
                            <?php echo $list?>
                        </ul>
                        
                        <div class="post-list row">
                            <div class="content-post-child">
                                <?php
                                    if ($list_item) {
                                        foreach ($list_item as $key => $value) {
                                            echo '
                                            <h3 class="col-sm-24"><a href="'.base_url('tin-tuc/'.$value['slug'].'-'.$value['id'].'.html').'">'.$value['title'].'</a></h3>
                                            <div class="post-img col-sm-6">
                                                <a href="'.base_url('tin-tuc/'.$value['slug'].'-'.$value['id'].'.html').'" title="'.$value['title'].'"><img src="'.$value['icon'].'" alt="'.$value['title'].'"></a>
                                            </div>
                                            <div class="post-content col-sm-18">
                                                <div class="postContent">'.$value['sort_description'].'</div>
                                            </div>
                                            ';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="paginations col-sm-24">
                                <div class="pages">
                                <?php
                                    echo $this->pagination->create_links(); // tạo link phân trang
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 em-col-left em-sidebar col-sm-offset-1">
                    	<div class="em-line-01 block block-layered-nav">
                            <div class="em-block-title block-title"> <strong><span>Xem nhiều</span></strong></div>
                            <div class="block-content">
                                <ul>
                                    <?php
                                        if (isset($news) && $news) {
                                            foreach ($news as $key => $value) {
                                                echo '
                                                <li class="clear">
                                                    <div class="rightthumb">
                                                        <a target="_blank" href="'.base_url('/tin-tuc/'.$value['slug'].'-'.$value['id'].'.html').'" title="'.$value['title'].'">
                                                            <img src="'.$value['icon'].'" alt="'.$value['title'].'">
                                                        </a>
                                                    </div>
                                                    <div style="height: 2px"></div>
                                                    <a target="_blank" href="'.base_url('/tin-tuc/'.$value['slug'].'-'.$value['id'].'.html').'">'.$value['title'].'</a>
                                                </li>
                                                ';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
       	</div>
    </div>
</div>