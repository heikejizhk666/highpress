<?php
/**
 * 一款简洁、美观、高性能博客主题<br><a href="https://www.314669.xyz/hightech/docs">主题文档</a>&nbsp;&nbsp;&nbsp;<a href="https://www.314669.xyz/highpress">主题下载</a>&nbsp;&nbsp;&nbsp;<a href="https://jq.qq.com/?_wv=1027&k=TvHysSEV">QQ交流群</a>
 * @package HighPress
 * @author HighTech
 * @version 1.0
 * @link https://www.314669.xyz/
 */


/*温馨提示：请勿乱改代码，乱改出问题自理！*/

/*链接头部*/
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include('header.php');
        ?>
    </head>
    <body>
        <div class="gd_head">
            <a href="<?php $this->options->siteUrl(); ?>">
                <img src="<?php echo $this->options->logoUrl(); ?>">
            </a>
        </div>
        <div class="gd_main">
            <div class="gd_block">
                <div class="gd_box gd_post_header gd_copy_middle">
                    <div>
                        <!--一言及欢迎语-->
                        <h2 style="text-align: center"><img src="<?php $this->options->yiyan() ?>"></h2>
                        <h2 style="text-align: center">欢迎来到<?php $this->options->title(); ?>!</h2>
                    </div>
                </div>
            </div>
            <div class="gd_block">
                <!--引入Typecho页面-->
                <div class="gd_menu">
                    <a href="<?php $this->options->siteUrl(); ?>">首页</a><?php $this->widget('Widget_Contents_Page_List')->parse('<a href="{permalink}">{title}</a>'); ?>
                </div>
            </div>
            <!--文章列表-->
            <div class="gd_block">
                <div class="gd_box">
                    <h3>文章列表</h3>
                    <?php while($this->next()): ?>
                    <div class="gd_block">
                        <a href="<?php $this->permalink() ?>">
                            <div class="gd_box gd_pd gd_c">
                                <h2><?php $this->title() ?></h2>
                                <p>作者: <?php $this->author(); ?> 发布日期: <?php $this->date('Y F j'); ?></p>
                                <p><?php $this->commentsNum('评论 %d'); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <!--链接footer-->
            <div id="d" class="gd_block" style="height: 145px"></div>
            <div class="gd_copy">
                <?php include('footer.php') ?>
            </div>
        </div>
        <script src="<?php $this->options->themeUrl(); ?>js/main.js"></script>
    </body>
</html>