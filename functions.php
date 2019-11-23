<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    $slogan = new Typecho_Widget_Helper_Form_Element_Text('slogan', NULL, NULL, _t('首页图片标语文字'), _t('在这里填入一段文字，作为首页图片中的主要文字，留空则不显示'));
    $form->addInput($slogan);
    $leanSlogan = new Typecho_Widget_Helper_Form_Element_Text('leanSlogan', NULL, NULL, _t('首页图片副标语'), _t('在这里填入一段文字，作为首页图片中的附加文字，留空则显示一言'));
    $form->addInput($leanSlogan);
    $siteIcon = new Typecho_Widget_Helper_Form_Element_Text('siteIcon', NULL, NULL, _t('标题栏和书签栏Icon'), _t('在这里填入一个图片URL地址, 作为标题栏和书签栏Icon, 默认不显示'));
    $form->addInput($siteIcon);

    $miibeian = new Typecho_Widget_Helper_Form_Element_Text('miibeian', NULL, NULL, _t('备案号'), _t('在这里填入天朝备案号，不显示则留空'));
    $form->addInput($miibeian);
    $weibolink = new Typecho_Widget_Helper_Form_Element_Text('weibolink', NULL, NULL, _t('微博链接'), _t('输入微博链接地址'));
    $form->addInput($weibolink);
	$statiStics = new Typecho_Widget_Helper_Form_Element_Textarea('statiStics', NULL, NULL, _t('站点统计'), _t('在这里填入站点统计代码'));
    $form->addInput($statiStics);
    $misc = new Typecho_Widget_Helper_Form_Element_Checkbox('misc', array(
        'ShowLogin' => _t('侧栏显示登录入口'),
        'ShowLoadTime' => _t('页脚显示加载耗时'),
		'Showyiyan' => _t('关闭一言')
        ),
    array('ShowLogin'), _t('杂项'));
    $form->addInput($misc->multiMode());
}

function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
 
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime() );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision );
    $r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display )
    echo $r;
    return $r;
}
