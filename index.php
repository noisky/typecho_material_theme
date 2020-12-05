<?php

/**
 * 这是 Noisky 修改的基于 Material 的 Typecho 模板
 *
 * @package Material Theme
 * @author Noisky
 * @version 2.1.2
 * @link http://ffis.me
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<section class="billboard">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="intro animate fadeIn">
					<h1><?php $this->options->slogan() ?></h1>
					    <div class="lead">
					    <span class='hitokoto'>
						<?php if ($this->options->leanSlogan) : echo $this->options->leanSlogan() ?>
						<?php else: ?>
						<?php if ( !empty($this->options->misc) && in_array('Showyiyan', $this->options->misc) ) : ?>
						<?php else: ?>
						<div id="hitokoto">『Loading…』</div>
						<?php endif; ?>
						<?php endif; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container" <?php if(!$this->is('index')): ?> id="main" <?php endif; ?> >
	<div class="row">
		<div class="col-md-9" role="main">
		    <?php while($this->next()): ?>
		    <div class="panel">
			    <div class="panel-body">
			        <h3 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
			        <div class="post-meta">
                        <span>#&nbsp;作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
                        <span>/&nbsp;&nbsp;分类：<?php $this->category(','); ?></span>
                        <span>/&nbsp;&nbsp;评论：<a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
                        <span>/&nbsp;&nbsp;时间：<?php $this->date('Y-m-d H:i'); ?></span>
			        </div>
			        <div class="post-content">
                        <?php $this->content('- 阅读剩余部分 -'); ?>
                    </div>
			    </div>
		    </div>
		    <?php endwhile; ?>
			<?php $this->pageNav('&laquo;', '&raquo;', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
		</div>
		
	    <?php $this->need("sidebar.php"); ?>
   </div>
</div>
<script src="//v1.hitokoto.cn/?encode=js&select=%23hitokoto" defer></script>
<?php $this->need('footer.php'); ?>

