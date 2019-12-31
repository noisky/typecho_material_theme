<?php
/**
 * Material Typecho Theme
 * 关闭评论模板
 * comments.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->comments()->to($comments); ?>
<div class="row">
    <div id="comments">
        <div class="alert alert-warning">
            <span id="commentCount">评论已关闭</span>
        </div>
</div>
</div>
