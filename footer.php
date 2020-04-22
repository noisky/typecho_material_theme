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
				<li>Powered by <a href="http://typecho.org/" rel="nofollow">Typecho))) & <a href="//www.upyun.com" target="_blank" rel="nofollow"><img src="//www.upyun.com/static/90X45.png" width="56" height="28" style="margin: -25px 2px"  alt="upai"/></a></a></li>
<!--				<li>Optimized by <a href="https://noisky.cn/" rel="nofollow">饭饭</a></li>-->
                <li><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=41019702002679"><img src="https://static.ffis.me/beian/policebeian.png" alt="beian"/> 豫公网安备 41019702002679号</a></li>
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
<script src="//static.ffis.me/javascript/bootstrap.min.js" async defer></script>
<script src="//static.ffis.me/javascript/merge.min.js?v=2020041001"></script>
<!--<script src="--><?php //$this->options->themeUrl('js/merge.min.js'); ?><!--"></script>-->
<script src="//static.ffis.me/javascript/MyCustom.min.js?v=20200411"></script>
<!--<script src="--><?php //$this->options->themeUrl('js/MyCustom.js?v=20200409'); ?><!--"></script>-->
</body>
<!-- 统计代码 -->
<?php $this->options->statiStics()?>
</html>
