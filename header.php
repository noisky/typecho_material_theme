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
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php foreach (materialDnsPrefetchOrigins($this) as $origin): ?>
    <link rel="dns-prefetch" href="<?php echo htmlspecialchars($origin, ENT_QUOTES, 'UTF-8'); ?>" />
<?php endforeach; ?>
<?php $siteIcon = materialSafeUrl($this->options->siteIcon, array('http', 'https'), true, false); ?>
<?php if ($siteIcon !== ''): ?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo htmlspecialchars($siteIcon, ENT_QUOTES, 'UTF-8'); ?>"/>
    <link rel="Shortcut Icon" href="<?php echo htmlspecialchars($siteIcon, ENT_QUOTES, 'UTF-8'); ?>"/>
    <link rel="Bootmark" href="<?php echo htmlspecialchars($siteIcon, ENT_QUOTES, 'UTF-8'); ?>"/>
<?php endif; ?>
    <!--加载静态资源-->
   <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/bootstrap.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
   <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/material.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
   <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/customs.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
   <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/customs-blue.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
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
                <!--END-->
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </div><!-- /.navbar -->
</header>
