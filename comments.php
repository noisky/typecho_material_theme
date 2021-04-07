<?php
/**
 * Material Typecho Theme
 * 评论模板文件，重写了评论列表实现
 * comments.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!--重写评论列表-->
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    $Identity = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
            $Identity = '<label class="label commit-author">博主</label>';
        } else {
            $commentClass .= ' comment-by-user';
        }
    } else {
        $Identity = '';
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
            <cite class="fn"><?php $comments->author(); ?><?php echo $Identity; ?></cite>
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
        <?php if(!$this->allow('comment')): ?>
            <div class="alert alert-warning">
                <span id="commentCount">评论已关闭</span>
            </div>
        <?php endif; ?>
        <?php $this->comments()->to($comments); ?>

<div class="alert alert-info">
    <span id="commentCount"><?php $this->commentsNum(_t('还不快抢沙发'), _t('只有地板了'), _t('已有 %d 条评论')); ?></span>
</div>

<?php $comments->listComments(); ?>

<?php $comments->pageNav('&laquo;', '&raquo;', 3, '...', array('wrapTag' => 'ol', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
<!-- 评论回复框 -->
<?php if($this->allow('comment')): ?>
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
		    				<input type="text" id="comment-reply-author" name="author" class="form-control text empty" required="required" size="35" value="" placeholder="必填*"/>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
				<div class="form-group">
		    		<label for="mail" class="col-sm-1 control-label required">邮箱</label>
		    		<div class="col-sm-11">
		    			<div class="form-control-wrapper">
		    				<input type="email" id="comment-reply-mail" name="mail" class="form-control text empty" required="required" size="35" value="" placeholder="必填*"/>
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
		    				<textarea rows="9" cols="50" name="text" id="textarea" class="form-control textarea  empty" required="required" placeholder="允许使用的 HTML 标签 <a> <img> <blockquote> <pre>"></textarea>
		    				<span class="material-input"></span>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
				<?php Smilies_Plugin::output(); ?>
		    		<div class="col-sm-offset-1 col-sm-5">
                        <div id="captcha">
                            <div id="text">
                                行为验证™ 安全组件加载中...
                            </div>
                            <div id="wait" class="show" style="display: none;">
                                <div class="loading">
                                    <div class="loading-dot"></div>
                                    <div class="loading-dot"></div>
                                    <div class="loading-dot"></div>
                                    <div class="loading-dot"></div>
                                </div>
                            </div>
                        </div>
		    			<button id="sub_btn" type="submit" class="btn btn-success btn-raised submit">提交评论</button>　
		    		</div>
		    	</div>
		    </form>
	</div>
</div>
</div>
    <script>
        /* 极验验证码 */
        window.onload = function () {
            var handler = function (captchaObj) {
                captchaObj.appendTo('#captcha');
                captchaObj.onReady(function () {
                    $("#wait").hide();
                });
                // $('#sub_btn').click(function () {
                $('#comment_form').submit(function () {
                    var result = captchaObj.getValidate();
                    if (!result) {
                        alert('请完成验证码验证嗷~');
                        return false;
                    }
                    var submit = false;
                    $.ajax({
                        url: 'https://api.ffis.me/geetest/validate',
                        // url: 'http://localhost:9090/geetest/validate',
                        async: false, //二次验证改为同步请求，方便处理请求结果
                        type: 'POST',
                        xhrFields: {
                            withCredentials: true
                        },
                        dataType: 'json',
                        data: {
                            challenge: result.geetest_challenge,
                            validate: result.geetest_validate,
                            seccode: result.geetest_seccode
                        },
                        success: function (data) {
                            if (data.data.result === 'success') {
                                // alert('验证成功');
                                submit = true;
                            } else if (data.data.result === 'fail') {
                                alert('验证失败，请重新验证');
                                captchaObj.reset();
                                submit = false;
                            }
                        }
                    });
                    //控制表单提交
                    if (submit) {
                        return submit;
                    } else {
                        return submit;
                    }
                })
                window.gt = captchaObj;
            };
            var errHanlder = function () {
                $('#comment_form').submit(function () {
                    alert('验证码加载失败！无法提交评论');
                    return false;
                })
            };
            $.ajax({
                url: "https://api.ffis.me/geetest/register?t=" + (new Date()).getTime(), // 加随机数防止缓存
                // url: "http://localhost:9090/geetest/register?t=" + (new Date()).getTime(), // 加随机数防止缓存
                // async: false,
                timeout: 2000,
                type: "get",
                xhrFields: {
                    withCredentials: true
                },
                dataType: "json",
                success: function (data) {
                    $('#text').hide();
                    $('#wait').show();
                    // 调用 initGeetest 进行初始化
                    // 参数1：配置参数
                    // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它调用相应的接口
                    initGeetest({
                        // 以下 4 个配置参数为必须，不能缺少
                        gt: data.data.gt,
                        challenge: data.data.challenge,
                        offline: !data.data.success, // 表示用户后台检测极验服务器是否宕机
                        new_captcha: data.data.new_captcha, // 用于宕机时表示是新验证码的宕机
                        product: "float", // 产品形式，包括：float，popup
                        width: "200px",
                        // https: false
                    }, handler);
                },
                error: function (data) {
                    $('#text').html("行为验证™ 安全组件 <span class='loadErr'>加载失败！</span>")
                    errHanlder()
                }
            });
        };
    </script>
<?php endif; ?>
</div>
</div>
