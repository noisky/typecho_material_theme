<?php
/**
 * Material Typecho Theme
 * 独立页面模板文件
 * page.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="container" id="main">
    <div class="row">

        <div class="col-md-9" role="main">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="post-title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h3>
                    <div class="post-content">
                        <?php $this->content(); ?>
                    </div>
                </div>
                <?php $this->need('copyright.php'); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
      <?php $this->need('sidebar.php'); ?>
	</div>
</div>
    <?php $this->need('footer.php'); ?>


