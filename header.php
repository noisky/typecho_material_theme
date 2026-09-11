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
    <meta name="color-scheme" content="light dark"/>
    <script>
    (function () {
        try {
            var theme = localStorage.getItem('material-theme');
            if (theme === 'light' || theme === 'dark') {
                document.documentElement.setAttribute('data-theme', theme);
            }
        } catch (error) {
            // localStorage 不可用时继续跟随系统主题。
        }
    }());
    </script>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/bootstrap.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/material.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/customs.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(materialAssetUrl('css/customs-blue.min.css'), ENT_QUOTES, 'UTF-8'); ?>"/>
    <?php $this->header(); ?>
</head>
<body>
<header>
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="container material-navbar-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" id="logo"
                   href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
            </div>
            <div class="material-theme-control" id="material-theme-control">
                <button
                    type="button"
                    class="material-theme-toggle"
                    id="material-theme-toggle"
                    aria-label="主题模式：跟随系统"
                    title="主题模式：跟随系统，点击切换">
                    <svg class="material-theme-icon material-theme-icon-system" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                        <path fill="currentColor" d="m12 21c4.971 0 9-4.029 9-9s-4.029-9-9-9-9 4.029-9 9 4.029 9 9 9zm4.95-13.95c1.313 1.313 2.05 3.093 2.05 4.95s-.738 3.637-2.05 4.95c-1.313 1.313-3.093 2.05-4.95 2.05v-14c1.857 0 3.637 0.737 4.95 2.05z"/>
                    </svg>
                    <svg class="material-theme-icon material-theme-icon-light" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                        <path fill="currentColor" d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"/>
                    </svg>
                    <svg class="material-theme-icon material-theme-icon-dark" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                        <path fill="currentColor" d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"/>
                    </svg>
                    <span class="sr-only material-theme-label">自动</span>
                </button>
            </div>
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
