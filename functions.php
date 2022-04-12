<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form)
{
    $faviconUrl = new Typecho_Widget_Helper_Form_Element_Text(
        '',
        NULL, NULL,
        '网站Favicon地址',
        '在这里填入一个图片 URL 地址, 以设置网站标题栏图标'
    );
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'logoUrl',
        NULL, NULL,
        '网站LOGO地址',
        '在这里填入一个图片 URL 地址, 以设置网站标题栏图标'
    );
    $jqueryUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'jqueryUrl',
        NULL, NULL,
        'JQuery CDN 地址',
        '在这里填入 JQuery CDN URL 地址, 以加载网页必要的JQuery库'
    );
    $runtime = new Typecho_Widget_Helper_Form_Element_Text(
        'runtime',
        NULL, NULL,
        '网站运行时间',
        '格式：月-日-年 时:分:秒，例：03-25-2022 12:00:00'
    );
    $yyimg = new Typecho_Widget_Helper_Form_Element_Text(
        'yyimg',
        NULL, NULL,
        '首页一言图片模块',
        '一言模块，仅支持图片api，如：https://v1.jinrishici.com/rensheng/all.svg?font-size=30&spacing=1'
    );
    $slide = new Typecho_Widget_Helper_Form_Element_Text(
        'slide',
        NULL, NULL,
        '首页幻灯片',
        '请填写首页幻灯片图片地址'
    );
    $icp = new Typecho_Widget_Helper_Form_Element_Text(
        'icp',
        NULL, NULL,
        'ICP备案号',
        '请填写ICP备案号'
    );
    $police = new Typecho_Widget_Helper_Form_Element_Text(
        'police',
        NULL, NULL,
        '公安联网备案号',
        '填写您的公安联网备案号'
    );
    $cssCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cssCode',
        NULL, NULL,
        '自定义网站CSS',
        '自定义网站CSS，在此添加CSS可不破坏网页代码'
    );
    $HeaderCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'HeaderCode',
        null, null,
        '自定义页头代码',
        '自定义页头代码，支持HTML'
    );
    $footerCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'footerCode',
        NULL, NULL,
        '自定义页脚代码',
        '自定义备案下方的页脚代码，支持HTML'
    );
    $hello = new Typecho_Widget_Helper_Form_Element_Text(
        'hello',
        NULL, NULL,
        '网站顶部欢迎语',
        '填写网站顶部欢迎语，支持HTML'
    );
    $motto = new Typecho_Widget_Helper_Form_Element_Text(
        'motto',
        NULL, NULL,
        '网站顶部格言',
        '填写网站顶部格言，支持HTML'
    );
    $indexSet = new Typecho_Widget_Helper_Form_Element_Checkbox('indexSet', 
        array('hideyyimg' => _t('隐藏一言模块'),
            'hideslide' => _t('隐藏幻灯片')),
        array(''),
        _t('首页设置'), null);
    
    $footerSet = new Typecho_Widget_Helper_Form_Element_Checkbox('footerSet', 
        array('hiderun' => _t('隐藏页面底部运行时间'),
            'hidefriend' => _t('隐藏页面底部友链模块'),
            'hideicp' => _t('隐藏ICP备案号及联网备案号')),
        array(''),
        _t('底部设置'), null);
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
    $form->addInput($indexSet->multiMode());
	$form->addInput($footerSet->multiMode());
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