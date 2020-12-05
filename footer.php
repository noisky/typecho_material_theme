<?php
/**
* Material Typecho Theme 
* 尾部文件
* footer.php
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 使用php缓冲区
 * 图片延缓加载相关处理
 * 替换src为data-original
 */
//ob_start();
$echo = ob_get_contents(); //获取缓冲区内容
ob_clean(); //清空缓冲区内容，不输出到页面
$preg = '/<img(.*?)src=\"(.*?)\"(.*?)>/i'; //正则匹配所有<img>图片标签
$replaced = "<img\$1data-original=\"\$2\"\$3>";
print preg_replace($preg, $replaced, $echo); //重新写入的缓冲区
ob_end_flush(); //将缓冲区输入到页面，并关闭缓存区
?>

<footer>
	<div class="footer-bottom">
		<div class="container">
			<div class="pull-left copyright">Copyright &copy; 2013-<?php _e(date('Y')) ?>&nbsp;<?php $this->options->title(); ?></div>
			<ul class="footer-nav pull-right">
				<li>Powered by <a href="http://typecho.org/" rel="nofollow">Typecho))) & <a href="https://www.upyun.com/?utm_source=lianmeng&utm_medium=referral" target="_blank" rel="nofollow"><img src="https://static.ffis.me/img/upyun.png" width="56" height="28" style="margin: -25px 2px"  alt="upai"/></a></a></li>
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
<script src="https://static.ffis.me/javascript/jquery-2.2.4.min.js"></script>
<script src="https://static.ffis.me/javascript/bootstrap.min.js" async defer></script>
<script src="https://static.ffis.me/javascript/merge.min.js?v=2020120501"></script>
<!--<script src="--><?php //$this->options->themeUrl('js/merge.min.js'); ?><!--"></script>-->
<script src="https://static.ffis.me/javascript/MyCustom.min.js?v=2020120501"></script>
<!--<script src="--><?php //$this->options->themeUrl('js/MyCustom.js'); ?><!--"></script>-->
</body>
<!-- 统计代码 -->
<?php $this->options->statiStics()?>
</html>
