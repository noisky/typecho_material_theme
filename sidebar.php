<?php
/**
* Material Typecho Theme 
* 侧栏文件
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
    <!-- 微主页 -->
	<div class="panel panel-primary">
	<a class="panel-heading" onclick="$('.amadeus_about').slideToggle()" href="javascript:;">
	        <h3 class="panel-title">微主页</h3>
	    </a>
		<aside class="amadeus_about clearfix">
			<div class="photo-background">
			    <div class="photo-background" style="background:url(https://static.ffis.me/img/about.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
			<div class="photo-wrapper text-center">
			<a href="https://ffis.me/about.html" title="关于饭饭"><img src="https://static.ffis.me/img/author.png" alt="关于饭饭"></a>
<!--			<a href="https://ffis.me/about.html" title="关于饭饭"><img src="https://static.noisky.cn/homepage/img/noiskyWithMask.png" alt="关于饭饭"></a>-->
			<!-- 微博橙V
			<a href="http://weibo.com/u/5230249128" class="Weibo_icon_position"><em title="前往饭饭的微博" class="Weibo_icon Weibo_icon_logo"></em></a>-->
			<!-- 国旗 -->
			<a href="#" class="Weibo_icon_position"><em title="庆祝新中国成立70周年" class="Weibo_icon Weibo_icon_logo"></em></a>
			</div>
			<div class="pf_username">
				<div class="username">饭饭</div>
			</div>
			<div class="pf_intro"><a href="https://noisky.cn" target="_blank" title="饭饭的主页">@Noisky</a></div>
			<div class="user-footer">
			  <div class="row">
                <div class="col-xs-3 border-right center-block">
                    <div class="description-block">
                        <a href="https://noisky.cn" target="_blank" title="饭饭的主页" class="description-header">
						<i class="fa fa-home fa-fw fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-xs-3 border-right center-block">
                    <div class="description-block">
                        <a href="https://weibo.com/u/5230249128" target="_blank" title="微博 @五分缘" class="description-header">
						<i class="fa fa-weibo fa-fw fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-xs-3 border-right center-block">
                    <div class="description-block">
                        <a href="https://telegram.me/Noisky" target="_blank" title="Telegram @Noisky" class="description-header">
						<i class="fa fa-telegram fa-fw fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-xs-3 center-block">
                    <div class="description-block">
                        <a href="https://github.com/noisky" target="_blank" title="Github @Noisky" class="description-header">
						<i class="fa fa-github fa-fw fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
              </div>
			</div>
			</div></div>
	</aside>  
    </div>

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
