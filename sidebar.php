<?php
/**
* Material Typecho Theme 
* 侧栏模板文件
* sidebar.php
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<div class="col-md-3">
	<form method="post" action="" class="panel-body">
		<div class="input-group">
			<div class="form-control-wrapper">
				<input type="text" name="s" class="form-control floating-label" placeholder="搜索" size="32" required />
			</div>
			<span class="input-group-btn">
		    	<button class="btn btn-primary btn-fab btn-raised fa fa-search" value="" id="search-btn" type="submit"></button>
			</span>
		</div>
	</form>
    <?php
    $microHomeEnabled = !empty($this->options->microHome)
        && in_array('enable', (array) $this->options->microHome, true);
    $microAvatar = materialSafeUrl($this->options->microAvatar, array('http', 'https'), true, false);
    $microAvatar = $microAvatar !== '' ? $microAvatar : materialAssetUrl('img/author.png');
    $microName = trim((string) $this->options->microName);
    $microIntro = trim((string) $this->options->microIntro);
    $microProfileUrl = materialSafeUrl($this->options->microProfileUrl, array('http', 'https'), true, true);
    $microHomeUrl = materialSafeUrl($this->options->microHomeUrl, array('http', 'https'), true, true);
    $microWeiboUrl = materialSafeUrl($this->options->microWeiboUrl, array('http', 'https'), true, true);
    $microEmailUrl = materialSafeUrl($this->options->microEmailUrl, array('http', 'https', 'mailto', 'tel'), true, true);
    $microGithubUrl = materialSafeUrl($this->options->microGithubUrl, array('http', 'https'), true, true);
    ?>
    <?php if ($microHomeEnabled): ?>
    <!-- 微主页 -->
	<div class="panel panel-primary">
	<a class="panel-heading" onclick="$('.amadeus_about').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">微主页</h3>
	    </a>
		<aside class="amadeus_about clearfix">
			<div class="photo-background" style="background:url(<?php echo htmlspecialchars(materialAssetUrl('img/about.jpg'), ENT_QUOTES, 'UTF-8'); ?>) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; padding:14px 0 12px; overflow:hidden;">
			<div class="photo-wrapper text-center" style="position:relative;">
            <?php if ($microProfileUrl !== ''): ?><a href="<?php echo htmlspecialchars($microProfileUrl, ENT_QUOTES, 'UTF-8'); ?>" title="关于饭饭">
            <?php endif; ?>
                <img src="<?php echo htmlspecialchars($microAvatar, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" decoding="async" width="110" height="110" alt="<?php echo htmlspecialchars($microName, ENT_QUOTES, 'UTF-8'); ?>" style="display:block;margin:0 auto;" />
            <?php if ($microProfileUrl !== ''): ?></a><?php endif; ?>
            <!-- 纪念图标与头像共用链接 -->
            <?php if ($microProfileUrl !== ''): ?><a href="<?php echo htmlspecialchars($microProfileUrl, ENT_QUOTES, 'UTF-8'); ?>" class="Weibo_icon_position" style="position:absolute; left:calc(50% + 34px); top:78px; right:auto;" target="_blank" rel="nofollow"><em title="纪念图标" class="Weibo_icon Weibo_icon_logo"></em></a><?php endif; ?>
			</div>
            <?php if ($microName !== ''): ?><div class="pf_username"><div class="username"><?php echo htmlspecialchars($microName, ENT_QUOTES, 'UTF-8'); ?></div></div><?php endif; ?>
            <?php if ($microIntro !== ''): ?><div class="pf_intro"><?php if ($microHomeUrl !== ''): ?><a href="<?php echo htmlspecialchars($microHomeUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="nofollow" title="微主页个人主页"><?php endif; ?><?php echo htmlspecialchars($microIntro, ENT_QUOTES, 'UTF-8'); ?><?php if ($microHomeUrl !== ''): ?></a><?php endif; ?></div><?php endif; ?>
			<?php
            $microIcons = array();
            if ($microHomeUrl !== '') $microIcons[] = array($microHomeUrl, 'fa fa-home fa-fw fa-lg', '个人主页');
            if ($microWeiboUrl !== '') $microIcons[] = array($microWeiboUrl, 'fa fa-weibo fa-fw fa-lg', '微博');
            if ($microEmailUrl !== '') $microIcons[] = array($microEmailUrl, 'social fa fa-envelope', '邮箱');
            if ($microGithubUrl !== '') $microIcons[] = array($microGithubUrl, 'fa fa-github fa-fw fa-lg', 'GitHub');
            ?>
            <?php if (!empty($microIcons)): ?>
            <div class="user-footer">
              <div class="row micro-social-row" style="display:flex;text-align:center;">
                <?php foreach ($microIcons as $index => $microIcon): ?>
                <div class="micro-social-item<?php echo $index < count($microIcons) - 1 ? ' border-right' : ''; ?>" style="flex:1 1 0;float:none;">
                    <div class="description-block">
                        <a href="<?php echo htmlspecialchars($microIcon[0], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="nofollow" title="<?php echo htmlspecialchars($microIcon[2], ENT_QUOTES, 'UTF-8'); ?>" class="description-header">
                            <i class="<?php echo htmlspecialchars($microIcon[1], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
			</div>
	</aside>  
    </div>
    <?php endif; ?>

	<div class="panel panel-primary">
	    <a class="panel-heading" onclick="$('.recent_posts_box').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">最新文章</h3>
	    </a>
	    <div class="recent_posts_box">
	       <?php $this->widget('Widget_Contents_Post_Recent')
	        ->parse('<a href="{permalink}" class="item">{title}</a>'); ?>
	    </div>
	</div>

	<?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
	<div class="panel panel-primary">
	    <a class="panel-heading" onclick="$('.comments_box').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">最新回复</h3>
	    </a>
	    <div class="comments_box">
			<?php while($comments->next()): ?>
			    <a href="<?php $comments->permalink(); ?>" class="item"><?php $comments->author(false); ?>: <?php $comments->excerpt(30, '...'); ?></a>
			<?php endwhile; ?>
	    </div>
	</div>

	<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=50')->to($tags); ?>
	<div class="panel panel-primary" onmouseleave="$('.tags_box').clearQueue();$('.tags_box').slideUp()" onmouseenter="$('.tags_box').clearQueue();$('.tags_box').slideDown()">
	    <a class="panel-heading" onclick="$('.tags_box').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">标签</h3>
	    </a>
		<div class="tags_box" style="display: none;">
			<?php if($tags->have()): ?>
				<?php while ($tags->next()): ?>
				    <a href="<?php $tags->permalink(); ?>" rel="tag" class="item size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 个话题"><?php $tags->name(); ?><span class="badge pull-right"> <?php $tags->count(); ?></span></a>
				<?php endwhile; ?>
			<?php else: ?>
				<a class="item"><?php _e('没有任何标签'); ?></a>
			<?php endif; ?>
		</div>
	</div>

	<div class="panel panel-primary">
	    <a class="panel-heading" onclick="$('.article_cate_box').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">归档</h3>
	    </a>
	    <div class="article_cate_box">
	       <?php $this->widget('Widget_Contents_Post_Date', 'type=year&format=Y年')
	        ->parse('<a href="{permalink}" class="item">{date}</a>'); ?>
	    </div>
	</div>

	<div class="panel panel-primary">
	    <a class="panel-heading" onclick="$('.other_box').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">其他</h3>
	    </a>

	    <div class="other_box">
		 <?php if ( !empty($this->options->misc) && in_array('ShowLogin', $this->options->misc) ) : ?>
		  <?php if($this->user->hasLogin()): ?>
		   <a href="<?php $this->options->adminUrl(); ?>" class="item"><?php $this->user->screenName(); ?><?php _e('进入后台'); ?></a>
		   <a href="<?php $this->options->logoutUrl(); ?>" class="item"><?php _e('点击注销'); ?></a>
		 <?php else: ?>
		   <a href="<?php $this->options->adminUrl('login.php'); ?>" class="item"><?php _e('登录'); ?></a>
		 <?php endif; ?>
		 <?php endif; ?>
	       <a href="<?php $this->options->feedUrl(); ?>" class="item"><?php _e('文章 RSS'); ?></a>
	       <a href="<?php $this->options->commentsFeedUrl(); ?>" class="item"><?php _e('评论 RSS'); ?></a>
           <a href="https://ffis.me/sponsor/" class="item" target="_blank"><?php _e('赞助 Sponsor'); ?></a>
	    </div>
	</div>

</div>
