<?php
/**
 * Material Typecho Theme
 * 头文件
 * header.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!DOCTYPE HTML>
<html lang="zh-CN" class="space">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="content-type" content="text/html; charset=<?php $this->options->charset(); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if($this->is('index')): ?>
    <link rel="dns-prefetch" href="https://api.ffis.me" />
    <link rel="dns-prefetch" href="https://static.ffis.me" />
    <link rel="dns-prefetch" href="https://static.noisky.cn" />
    <link rel="dns-prefetch" href="https://v1.hitokoto.cn" />
    <link rel="dns-prefetch" href="https://hm.baidu.com" />
    <link rel="dns-prefetch" href="https://www.google-analytics.com" />
    <link rel="dns-prefetch" href="https://www.googletagmanager.com" />
<?php endif;?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php $this->options->siteIcon() ?>"/>
    <link rel="Shortcut Icon" href="<?php $this->options->siteIcon() ?>"/>
    <link rel="Bootmark" href="<?php $this->options->siteIcon() ?>"/>
    <link rel="stylesheet" href="https://static.ffis.me/stylesheet/bootstrap.min.css?v20200413"/>
    <link rel="stylesheet" href="https://static.ffis.me/stylesheet/material.min.css?v=2019123001"/>
<!--    <link rel="stylesheet" href="--><?php //$this->options->themeUrl('css/material.min.css'); ?><!--">-->
    <link rel="stylesheet" href="https://static.ffis.me/stylesheet/customs.min.css?v=20210442001"/>
<!--   <link rel="stylesheet" href="--><?php //$this->options->themeUrl('css/customs.css'); ?><!--">-->
    <link rel="stylesheet" href="https://static.ffis.me/stylesheet/customs-blue.min.css?v=2020120601"/>
<!--    <link rel="stylesheet" href="--><?php //$this->options->themeUrl('css/customs-white.css'); ?><!--">-->
    <!--[if lt IE 9]>
    <script src="https://static.ffis.me/javascript/html5shiv.js"></script>
    <script src="https://static.ffis.me/javascript/respond.js"></script>
    <![endif]-->
    <?php $this->header(); ?>
</head>
<body>
<header>
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" id="logo"
                   href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li<?php if ($this->is('index')): ?> class="active"<?php endif; ?>>
                        <a href="<?php $this->options->siteUrl(); ?>"><span
                                class="fa fa-home">&nbsp;</span><?php $this->options->title() ?></a></li>
                    <!--顶部导航显示分类-->
                    <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                    <?php while ($category->next()): ?>
                        <?php if (count($category->children)): ?>
                            <li class="dropdown">
                                <a href="<?php $category->permalink(); ?>" data-target="#" class="dropdown-toggle"
                                   data-toggle="dropdown">
                                    <?php echo $category->name ?>
                                    <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo $category->permalink(); ?>"><?php echo $category->name ?></a>
                                    </li>
                                    <?php foreach ($category->children as $k => $v): ?>
                                        <li><a href="<?php echo $v['permalink'] ?>"><?php echo $v['name'] ?></a></li>
                                    <?php endforeach; ?></ul>
                            </li>
                        <?php else: ?>
                            <?php if ($category->levels == 0): ?>
                                <li<?php if ($this->is('category', $category->slug)): ?> class="active" <?php endif; ?>>
                                    <a href="<?php $category->permalink(); ?>"
                                       title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <!--END-->
                    <!--顶部导航显示独立页-->
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while ($pages->next()): ?>
                        <li<?php if ($this->is('page', $pages->slug)): ?> class="active"<?php endif; ?>><a
                                href="<?php $pages->permalink(); ?>"
                                title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?></ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->options->weibolink): ?>
                        <li><a href="<?php $this->options->weibolink() ?>" rel="nofollow" target="_blank"><img
                                    class="top_weibo" src="https://static.ffis.me/img/weibo.png">&nbsp;Weibo</a></li>
                    <?php endif; ?>
                </ul>
                <!--END-->
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </div><!-- /.navbar -->
</header>
