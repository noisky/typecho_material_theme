<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!--重写评论列表-->
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>

    <li id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?>">
        <div class="comment-author">
            <?php
            //评论如果是qq邮箱则显示qq头像
            $email = $comments->mail;
            if(preg_match('/^[1-9]\d{4,12}@qq\.com$/', $email)){
                //邮箱地址使用aes128加密传输
                $avatarKey = file_get_contents("key/avatar.key");
                $data = openssl_encrypt($email, 'aes-128-ecb', $avatarKey, OPENSSL_RAW_DATA);
                $urlCode = urlencode(base64_encode($data));
                echo '<img class="avatar" src="//api.ffis.me/imgApi/avatar/qq?avatar='.$urlCode.'" alt=' . $comments->author .' width="40" height="40">';
            }else{
                $comments->gravatar('40', '');
            }
            ?>
            <cite class="fn"><?php $comments->author(); ?></cite>
        </div>
        <div class="comment-meta">
            <a href="<?php $comments->permalink(); ?>"><?php $comments->date('Y-m-d H:i'); ?></a>
        </div>
        <div class="comment-content">
            <?php $comments->content(); ?>
        </div>
        <div class="comment-reply">
            <?php $comments->reply('<button type="button" class="btn btn-danger btn-xs fa fa-reply reply-button"></button>'); ?>
        </div>
        <?php if ($comments->children) { ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>
<div class="row">
    <div id="comments">
        <?php $this->comments()->to($comments); ?>

<?php if($this->allow('comment')): ?>
<div class="alert alert-info">
    <span id="commentCount"><?php $this->commentsNum(_t('还不快抢沙发'), _t('只有地板了'), _t('已有 %d 条评论')); ?></span>
</div>

<?php $comments->listComments(); ?>

<?php $comments->pageNav('&laquo;', '&raquo;', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
<div id="<?php $this->respondId(); ?>" class="respond">
<div class="respond panel panel-default">
	<div class="panel-body">
	<div class="cancel-comment-reply"><?php $comments->cancelReply('<button type="button" class="btn btn-primary btn-xs btn-fab fa fa-close pull-right"><div class="ripple-wrapper"></div></button>'); ?>
		</div>
		<h3 id="response">添加新评论</h3>
		<!-- 输入表单开始 -->
		    <form method="post" action="<?php $this->commentUrl() ?>" id="comment_form" class="form-horizontal">
		        <!-- 如果当前用户已经登录 -->
		        <?php if($this->user->hasLogin()): ?>
		            <!-- 显示当前登录用户的用户名以及登出连接 -->
		            <p>已作为管理员<a href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?></a>登录
		            <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">点击注销 &raquo;</a></p>

		        <!-- 若当前用户未登录 -->
		        <?php else: ?>

		    	<div class="form-group">
		    		<label for="author" class="col-sm-1 control-label required">昵称</label>
		    		<div class="col-sm-11">
		    			<div class="form-control-wrapper">
		    				<input type="text" id="comment-reply-author" name="author" class="form-control text empty" size="35" value="" placeholder="必填*"/>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
				<div class="form-group">
		    		<label for="mail" class="col-sm-1 control-label required">邮箱</label>
		    		<div class="col-sm-11">
		    			<div class="form-control-wrapper">
		    				<input type="email" id="comment-reply-mail" name="mail" class="form-control text empty" size="35" value="" placeholder="必填*"/>
							<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="url" class="col-sm-1 control-label required">网站</label>
		    		<div class="col-sm-11">
		    			<div class="form-control-wrapper">
		    				<input type="url" id="comment-reply-url" name="url" class="form-control text empty" size="35" value="" placeholder="http://"/>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
                <script>
                        <?php if(!$this->user->hasLogin()){ ?>
                        function getCookie(name){
                            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
                            if(arr = document.cookie.match(reg))
                                return unescape(decodeURI(arr[2]));
                            else
                                return null;
                        }
                        function adduser(){
                            document.getElementById('comment-reply-author').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_author');
                            document.getElementById('comment-reply-mail').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_mail');
                            document.getElementById('comment-reply-url').value = getCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_url');
                        }
                        adduser();
                        <?php } ?>
                </script>
		        <?php endif; ?>
		        <div class="form-group">
		    		<label for="textarea" class="col-sm-1 control-label required">内容</label>
		    		<div class="col-sm-11">
		    			<div class="form-control-wrapper">
		    				<textarea rows="9" cols="50" name="text" id="textarea" class="form-control textarea  empty" required="" placeholder="允许使用的 HTML 标签 <a> <img> <blockquote> <pre>"></textarea>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
				<?php Smilies_Plugin::output(); ?>
		    		<div class="col-sm-offset-1 col-sm-5">
		    			<button type="submit" id="submit" class="btn btn-success btn-raised submit">提交评论</button>　
		    		</div>
		    	</div>
		    </form>
	</div>
</div>
</div>
<?php else: ?>

	<div class="alert alert-warning">
	    <span id="commentCount">评论已关闭</span>
	</div>

<?php endif; ?>
</div>
</div>
