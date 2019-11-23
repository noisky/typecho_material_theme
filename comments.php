<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->comments()->to($comments); ?>
<div class="row">
    <div id="comments">


<?php if($this->allow('comment')): ?>
<div class="alert alert-info">
    <span id="commentCount"><?php $this->commentsNum(_t('还不快抢沙发'), _t('只有地板了'), _t('已有 %d 条评论')); ?></span>
</div>
<?php $comments->listComments(array(
            'replyWord'=>'<button type="button" class="btn btn-danger btn-xs mdi-content-reply reply-button"></button>',
           )); ?>
<?php $comments->pageNav('&laquo;', '&raquo;', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
<div id="<?php $this->respondId(); ?>" class="respond">
<div class="respond panel panel-default">
	<div class="panel-body">
	<div class="cancel-comment-reply"><?php $comments->cancelReply('<button type="button" class="btn btn-primary btn-xs btn-fab mdi-content-clear pull-right"><div class="ripple-wrapper"></div></button>'); ?>
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
		    		<label for="author" class="col-sm-2 control-label required">昵称</label>
		    		<div class="col-sm-9">
		    			<div class="form-control-wrapper">
		    				<input type="text" id="comment-reply-author" name="author" class="form-control text empty" size="35" value="" placeholder="必填*"/>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
				<div class="form-group">
		    		<label for="mail" class="col-sm-2 control-label required">邮箱</label>
		    		<div class="col-sm-9">
		    			<div class="form-control-wrapper">
		    				<input type="email" id="comment-reply-mail" name="mail" class="form-control text empty" size="35" value="" placeholder="必填*"/>
							<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="url" class="col-sm-2 control-label required">网站</label>
		    		<div class="col-sm-9">
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
		    		<label for="textarea" class="col-sm-2 control-label required">内容</label>
		    		<div class="col-sm-9">
		    			<div class="form-control-wrapper">
		    				<textarea rows="9" cols="50" name="text" id="textarea" class="form-control textarea  empty" required="" placeholder="允许使用的 HTML 标签 <a> <img> <blockquote> <pre>"></textarea>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
				<?php Smilies_Plugin::output(); ?>
		    		<div class="col-sm-offset-2 col-sm-5">
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
