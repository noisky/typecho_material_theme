<?php
/**
 * Material Typecho Theme
 * 文章详情页模板文件
 * post.php
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<div class="container" id="main">
    <div class="c-a" id="page-tree">
        <a class="index-box-title" id="index-box-title" onclick="$('.index-box').slideToggle()" href="javascript:;">目录</a>
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
                        <span>#&nbsp;作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
                        <span>/&nbsp;&nbsp;分类：<?php $this->category(','); ?></span>
                        <span>/&nbsp;&nbsp;评论：<a href="<?php $this->permalink() ?>"><?php $this->commentsNum('%d 评论'); ?></a> </span>
                        <span>/&nbsp;&nbsp;时间：<?php $this->date('Y-m-d H:i'); ?></span>
                    </div>
                    <div class="post-content">
                        <?php $this->content(); ?>
                    </div>
					<br>
                    <div class="arctags arctags-left">
                        <span aria-hidden="true" class="glyphicon glyphicon-tags arctags-left"></span>&nbsp;&nbsp;&nbsp;<?php $this->tags(' , ', true, '无标签'); ?>
                    </div>
                    <div class="arctags arctags-rignt">
                        <span class="post-update" ># 最后更新：<?php echo date('Y-m-d H:i', $this->modified); ?>
                    </div>
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
        //获取滚动高度
        let scrollTop = document.documentElement.scrollTop;
        //获取文章离屏幕左边的距离
        let offsetLeft = document.getElementsByClassName("row")[0].offsetLeft;
        //获取文章容器宽度
        let rowWidth = document.getElementsByClassName("col-md-9")[0].getBoundingClientRect().width;
        if (scrollTop < 1900) {
            //获取窗口的宽度和高度，不包括滚动条
            var width = document.body.clientWidth;
            //当屏幕宽带小于1600时隐藏文章目录树
            if (width < 1630) {
                document.getElementById("page-tree").style.display = "none";
            } else {
                document.getElementById("page-tree").style.display = "block";
                document.getElementById("page-tree").style.left = (offsetLeft - 207) + "px";
                document.getElementById("page-tree").style.width = '200px';
            }
        } else {
            // console.log(offsetLeft);
            // document.getElementById("page-tree").style.left = (offsetLeft + 923) + "px";
            //根据文章宽度移动到侧边栏
            document.getElementById("page-tree").style.left = (offsetLeft + rowWidth + 12) + "px";
            //目录宽度增加
            document.getElementById("page-tree").style.width = '265px';
        }
    }
    //事件侦听器添加监听窗口的resize事件和scroll滚动事件
    ['resize','scroll'].forEach(function(item){
        window.addEventListener(item, displayWindowSize);
    })
    //第一次调用该函数
    displayWindowSize();
</script>
<?php $this->need('footer.php'); ?>
