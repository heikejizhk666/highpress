<?php
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $faviconUrl = new Typecho_Widget_Helper_Form_Element_Text('faviconUrl', NULL, NULL, _t('Favicon 地址'), _t('在这里填入一个图片 URL 地址, 以设置网站标题栏图标'));
    $jqueryUrl = new Typecho_Widget_Helper_Form_Element_Text('jqueryUrl', NULL, NULL, _t('JQuery CDN 地址'), _t('在这里填入 JQuery CDN URL 地址, 以加载网页必要的JQuery库'));
    $cssCode = new Typecho_Widget_Helper_Form_Element_Textarea('cssCode', null, null, _t('自定义 CSS'), _t('通过自定义 CSS 您可以很方便的设置页面样式，自定义 CSS 不会影响网站源代码。'));
    $runtime = new Typecho_Widget_Helper_Form_Element_Text('runtime', NULL, NULL, _t('网站运行时间'), _t('格式：月-日-年 时:分:秒，例：03-25-2022 12:00:00'));
    $yyimg = new Typecho_Widget_Helper_Form_Element_Text('yyimg', null, null, _t('首页一言图片模块'), _t('一言模块，请填写图片api地址，例：https://v1.jinrishici.com/rensheng/all.svg?font-size=30&spacing=1'));
    $slide = new Typecho_Widget_Helper_Form_Element_Text('slide', null, null, _t('首页幻灯片'), _t('首页幻灯片，请填写图片地址'));
    $icp = new Typecho_Widget_Helper_Form_Element_Text('icp', null, null, _t('ICP备案号'), _t('填写您的ICP备案号'));
    $police = new Typecho_Widget_Helper_Form_Element_Text('police', null, null, _t('公安联网备案号'), _t('填写您的公安联网备案号'));
    $HeaderCode = new Typecho_Widget_Helper_Form_Element_Textarea('HeaderCode', null, null, _t('自定义页头代码'), _t('自定义页头代码，支持HTML'));
    $footerCode = new Typecho_Widget_Helper_Form_Element_Textarea('footerCode', null, null, _t('自定义页脚代码'), _t('自定义备案下方的代码，支持HTML'));
    $hello = new Typecho_Widget_Helper_Form_Element_Text('hello', null, null, _t('网站顶部欢迎语'), _t('填写网站顶部欢迎语'));
    $motto = new Typecho_Widget_Helper_Form_Element_Text('motto', null, null, _t('网站顶部格言'), _t('填写网站顶部格言'));
    
    $form->addInput($logoUrl);
    $form->addInput($faviconUrl);
    $form->addInput($jqueryUrl);
    $form->addInput($hello);
    $form->addInput($motto);
    $form->addInput($runtime);
    $form->addInput($yyimg);
    $form->addInput($slide);
    $form->addInput($icp);
    $form->addInput($police);
    $form->addInput($cssCode);
    $form->addInput($HeaderCode);
    $form->addInput($footerCode);
}

function themeFields($layout) {
    $postcopy = new Typecho_Widget_Helper_Form_Element_Textarea('postcopy', NULL, NULL, _t('文章版权信息'), _t('在这里填入文章版权信息，将在文章末尾展示。支持HTML'));
    $postimg = new Typecho_Widget_Helper_Form_Element_Textarea('postimg', NULL, NULL, _t('文章封面图片'), _t('在这里填入文章封面图片地址'));
    $layout->addItem($postcopy);
    $layout->addItem($postimg);
}

// 统计阅读数
function get_post_view($archive){
	$cid    = $archive->cid;
	$db     = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
		if(empty($views)){
			$views = array();
		}else{
			$views = explode(',', $views);
		}
        if(!in_array($cid,$views)){
	        $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
			$views = implode(',', $views);
			Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
		}
	}
	echo $row['views'];
}

// 获取附件首张图片
function thumb1($obj) {
	$attach = $obj->attachments(1)->attachment;
	if(isset($attach->isImage) && $attach->isImage == 1){
		$thumb = $attach->url;
	}else{
		$thumb = '/usr/themes/Echo/Public/home/img/00.png';
	}
	return $thumb;
}

// 获取文章首张图片
function thumb2($obj) {
	preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $obj->content, $thumbUrl);
	$img_src = $thumbUrl[1][0];
	if($img_src){
		$thumb = $img_src;
	}else{
		$thumb = '/usr/themes/Echo/Public/home/img/00.png';
	}
	return $thumb;
}

// 获取自定义随机图片
function thumb3($obj) {
	$options = Typecho_Widget::widget('Widget_Options');
	$thumbs = explode("|",$options->thumbs);
	if($options->thumbs && count($thumbs)>0){
		$thumb = $thumbs[rand(0,count($thumbs)-1)];
	}else{
		$thumb = '/usr/themes/Echo/Public/home/img/00.png';
	}
	return $thumb;
}

// 留言加@
function getPermalinkFromCoid($coid) {
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
	if (empty($row)) return '';
	return '<a href="#comment-'.$coid.'">@'.$row['author'].'</a>';
}

// 解析头像
function getAvatar($mail)
{
        $gravatar = 'https://avatar.sourcegcdn.com/';
	$mail = strtolower(trim($mail));
	$qq = str_replace('@qq.com', '', $mail);
	if (strstr($mail, "qq.com") && is_numeric($qq) && strlen($qq) < 11 && strlen($qq) > 4) {
		$url = '//thirdqq.qlogo.cn/g?b=qq&nk=' . $qq . '&s=100';
	} else {
		$url = $gravatar . md5($mail) . '?s=40&r=G&d=';
	}
	return $url;
}
?>