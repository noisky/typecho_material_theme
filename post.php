<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="container" id="main">
    <div class="c-a" id="page-tree">
        <a class="index-box-title" onclick="$('.index-box').slideToggle()" href="javascript:;">目录</a>
            <div class="index-box">
            </div>
            <div id="t"></div>
    </div>
    <div class="row">

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="post-title"><a href="<?php $this->permalink() ?>" target="_blank"><?php $this->title() ?></a></h3>
                    <div class="post-meta">
                        <span>作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
                        <span>时间：<?php $this->date('Y-m-d'); ?></span>
                        <span>分类：<?php $this->category(','); ?></span>
                        <span>评论：<a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
                    </div>
                    <div class="post-content"><?php $this->content('- 阅读剩余部分 -'); ?></div>
					<br>
					<p class="arctags text-right"><span aria-hidden="true" class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;&nbsp;<?php $this->tags(' , ', true, '无标签'); ?></p>
                </div>
				<div class="post-copyright">
				本文由 <b><a href="https://ffis.me/author/1/">Noisky</a></b> 创作，采用 <b><a target="_blank" href="https://creativecommons.org/licenses/by/4.0/" rel="external nofollow">知识共享署名 4.0</a></b> 国际许可协议进行许可。
				可自由转载、引用，但需署名作者且注明文章出处。</div>
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
<script>
    //动态控制文章目录树的显示位置
    function displayWindowSize(){
        //获取文章离屏幕左边的距离
        let offsetLeft = document.getElementsByClassName("row")[0].offsetLeft;
        //获取窗口的宽度和高度，不包括滚动条
        var width = document.body.clientWidth;
        //当屏幕宽带小于1600时隐藏文章目录树
        if (width < 1600) {
            document.getElementById("page-tree").style.display = "none";
        } else {
            document.getElementById("page-tree").style.display = "block";
            document.getElementById("page-tree").style.left = (offsetLeft - 207) + "px";
        }
    }
    //将事件侦听器函数附加到窗口的resize事件
    window.addEventListener("resize", displayWindowSize);
    //第一次调用该函数
    displayWindowSize();
</script>
<?php $this->need('footer.php'); ?>
