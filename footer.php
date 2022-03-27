<!--吃水不忘挖井人，请勿删除版权，谢谢！-->
<!--删除版权可能会影响网站SEO，视为放弃一切技术支持！出问题自理！-->
<!--让更多人使用主题，作者才有动力继续更新下去-->
<!--你删除版权，你的良心难道不会痛吗？-->
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
	<div class="gd_block"></div>
		<div class="gd_box gd_copy_middle">
			    <b style="text-align: center">友情链接</b>
			    <?php Links_Plugin::output(); ?>
		</div>
			<!--吃水不忘挖井人，请勿删除版权，谢谢！-->
			<!--删除版权可能会影响网站SEO，视为放弃一切技术支持！出问题自理！-->
			<!--让更多人使用主题，作者才有动力继续更新下去-->
			<!--你删除版权，你的良心难道不会痛吗？-->
			<br><br><div class="gd_box gd_copy_middle">
			    <p>本站已运行<span id="momk"></span></p>
		    	Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
			    <?php _e('Theme by <a href="https://www.314669.xyz">HighPress</a>'); ?><br>
			    <img src="https://www.lovestu.com/wp-content/themes/CorePress-Pro/static/img/icp.svg" style="width: 24px;height: 24px;"><a href="http://beian.miit.gov.cn/" target="_blank"><?php $this->options->icp() ?></a>&nbsp;&nbsp;
			    <img src="https://www.lovestu.com/wp-content/themes/CorePress-Pro/static/img/police.svg" style="width: 24px;height: 24px;"><a href="http://beian.gov.cn/" target="_blank"><?php $this->options->police() ?></a>
		    	<br><?php $this->options->footerCode() ?>
			    <script language="javascript">
			    	function show_date_time(){
			    	window.setTimeout("show_date_time()", 1000);
			    	BirthDay=new Date("<?php $this->options->runtime() ?>");//建站日期（月/日/年）
			    	today=new Date();
			    	timeold=(today.getTime()-BirthDay.getTime());
				    sectimeold=timeold/1000
			    	secondsold=Math.floor(sectimeold);
			    	msPerDay=24*60*60*1000
			    	e_daysold=timeold/msPerDay
			    	daysold=Math.floor(e_daysold);
			    	e_hrsold=(daysold-e_daysold)*-24;
			    	hrsold=Math.floor(e_hrsold);
			    	e_minsold=(hrsold-e_hrsold)*-60;
			    	minsold=Math.floor((hrsold-e_hrsold)*-60);
			    	seconds=Math.floor((minsold-e_minsold)*-60);
			    	momk.innerHTML=daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒" ;
			    	}
			    	show_date_time();
			    </script>
			</div>
		</div>
	</div>
</div><!-- end #body -->
<script>
            function suit(){
                if($(".gd_main").width() >= 760){
                    $(".gd_main").css('left', ($(window).width() / 2 - 400));
                }
                else{
                    $(".gd_main").css('left', 'calc(10% - 20px)');
                }
                $("#d").css('height', $(".gd_copy").height() + 40);
            }
            suit();
            $(window).resize(function(){
                suit();
            });
        </script>
<?php $this->footer(); ?>
</body>
</html>
