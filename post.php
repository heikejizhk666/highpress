<?php
/**
 * 一款简洁、美观、高性能博客主题<br><a href="https://www.314669.xyz/highpress.html">主题下载</a>&nbsp;&nbsp;&nbsp;<a href="https://www.314669.xyz/highpress-docs.html">主题文档</a>&nbsp;&nbsp;&nbsp;<a href="https://jq.qq.com/?_wv=1027&k=TvHysSEV">QQ交流群</a>
 * @package HighPress
 * @author HighTech
 * @version 1.0.3
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
                <div class="gd_box gd_post_header">
                    <div>
                        <h1><?php $this->title() ?></h1>
                        <p>作者: <?php $this->author(); ?> 日期: <?php $this->date('c'); ?></p>
                        <p> 分类: <?php $this->category(','); ?> 标签: <?php $this->tags(', ', true, 'none'); ?></p>
                    </div>
                </div>
            </div>
            <div class="gd_block">
                <div class="gd_menu">
                    <a href="<?php $this->options->siteUrl(); ?>">首页</a><?php $this->widget('Widget_Contents_Page_List')->parse('<a href="{permalink}">{title}</a>'); ?>
                </div>
            </div>
            <div class="gd_block">
                <div class="gd_box gd_p">
                    <?php $this->content(); ?>
                </div>
            </div>
            <div class="gd_block">
                <div class="gd_box">
                    <?php $this->need('comments.php'); ?>
                </div>
            </div>
            <div id="d" class="gd_block" style="height: 145px"></div>
            <div class="gd_copy">
                <?php include('footer.php') ?>
            </div>
        </div>
        <script src="<?php $this->options->themeUrl(); ?>js/main.js"></script>
    </body>
</html>