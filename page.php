<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="container" id="main">
    <div class="row">

        <div class="col-md-9" role="main">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="post-title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h3>
                    <div class="post-content"><?php $this->content('- 阅读剩余部分 -'); ?></div>
                </div>
                <div class="post-copyright">
                    本文由 <b><a href="https://ffis.me/author/1/">Noisky</a></b> 创作，采用 <b><a target="_blank" href="https://creativecommons.org/licenses/by/4.0/" rel="external nofollow">知识共享署名 4.0</a></b> 国际许可协议进行许可。
                    可自由转载、引用，但需署名作者且注明文章出处。</div>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
      <?php $this->need('sidebar.php'); ?>
	</div>
</div>
    <?php $this->need('footer.php'); ?>


