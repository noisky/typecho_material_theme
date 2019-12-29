<?php
/**
* Material Typecho Theme 
* 尾部文件
* footer.php
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<footer>
	<div class="footer-bottom">
		<div class="container">
			<div class="pull-left copyright">Copyright &copy; 2013-<?php _e(date('Y')) ?>&nbsp;<?php $this->options->title(); ?></div>
			<ul class="footer-nav pull-right">
				<li>Powered by <a href="http://typecho.org/" rel="nofollow">Typecho))) & <a href="//www.upyun.com" target="_blank" rel="nofollow"><img src="//www.upyun.com/static/90X45.png" width="56" height="28" style="margin: -25px 2px" /></a></a></li>
				<li>Optimized by <a href="https://noisky.cn/" rel="nofollow">饭饭</a> & <a href="https://hanc.cc/" rel="nofollow">HanSon</a> </li>
				<?php if($this->options->miibeian) : ?>
				<li><a href="http://beian.miit.gov.cn" rel="nofollow"><?php echo $this->options->miibeian; ?></a></li>
				<?php endif; ?>
				<?php if ( !empty($this->options->misc) && in_array('ShowLoadTime', $this->options->misc) ) : ?>
				<li>加载耗时：<?php echo timer_stop(); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</footer>
<?php $this->footer(); ?>
<script src="//static.ffis.me/javascript/jquery-2.2.4.min.js"></script>
<script src="//static.ffis.me/javascript/highlight.pack.js"></script>
<script src="//static.ffis.me/javascript/text-autospace.min.js"></script>
<script src="//static.ffis.me/javascript/bootstrap.min.js" async defer></script>
<script src="//static.ffis.me/javascript/material.min.js"></script>
<script src="//static.ffis.me/javascript/MyCustom.js?v=2019123002"></script>
</body>
<!-- 统计代码 -->
<?php $this->options->statiStics()?>
</html>
