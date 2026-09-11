<?php
/**
 * Material Typecho Theme
 * 文章详情页模板文件
 * post.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="container" id="main">
    <div class="row article-layout">

        <div class="col-md-9 article-main">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="post-title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h3>
                    <div class="post-meta">
                        <span>#&nbsp;作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
                        <span>/&nbsp;&nbsp;分类：<?php $this->category(','); ?></span>
                        <span>/&nbsp;&nbsp;评论：<a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
                        <span>/&nbsp;&nbsp;时间：<?php $this->date('Y-m-d H:i'); ?></span>
                    </div>
                    <div class="post-content">
                        <?php echo materialAddLazyLoading($this->content, $this, null); ?>
                    </div>
					<br>
                    <div class="arctags arctags-left">
                        <span aria-hidden="true" class="glyphicon glyphicon-tags arctags-left"></span>&nbsp;&nbsp;&nbsp;<?php $this->tags(' , ', true, '无标签'); ?>
                    </div>
                    <div class="arctags arctags-rignt">
                        <span class="post-update" ># 最后更新：<?php echo date('Y-m-d H:i', $this->modified); ?>
                    </div>
                </div>
				<?php $this->need('copyright.php'); ?>
            </div>


	        <div class="panel panel-default prenext">
              <div class="panel-body">
                <?php $this->thePrev('<span class="label label-danger">上一篇</span> &nbsp;&nbsp;%s','<span class="label label-default">上一篇</span> &nbsp;&nbsp;没有了');?>
              </div>
              <div class="panel-body">
                <?php $this->theNext('<span class="label label-danger">下一篇</span> &nbsp;&nbsp;%s','<span class="label label-default">下一篇</span> &nbsp;&nbsp;没有了');?>
              </div>                  
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
      <?php $this->need('sidebar.php'); ?>
    </div>
</div>
<?php $this->need('footer.php'); ?>
