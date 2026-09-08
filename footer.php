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
				<li>Powered by <a href="http://typecho.org/" rel="nofollow">Typecho)))</a></li>
                <?php $policeBeian = trim((string) $this->options->policebeian); ?>
                <?php $miibeian = trim((string) $this->options->miibeian); ?>
                <?php if ($miibeian !== '') : ?>
                    <li><a href="http://beian.miit.gov.cn" rel="nofollow"><?php echo htmlspecialchars($miibeian, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></a></li>
                <?php endif; ?>
                <?php if ($policeBeian !== '') : ?>
                    <?php
                    $policeRecordCode = preg_replace('/\\D+/', '', $policeBeian);
                    $policeBeianUrl = 'http://www.beian.gov.cn/portal/registerSystemInfo';
                    if ($policeRecordCode !== '') {
                        $policeBeianUrl .= '?recordcode=' . rawurlencode($policeRecordCode);
                    }
                    ?>
                    <li><a target="_blank" href="<?php echo htmlspecialchars($policeBeianUrl, ENT_QUOTES, 'UTF-8'); ?>" rel="nofollow"><img src="<?php echo htmlspecialchars(materialAssetUrl('img/policebeian.png'), ENT_QUOTES, 'UTF-8'); ?>" alt="beian"/> <?php echo htmlspecialchars($policeBeian, ENT_QUOTES, 'UTF-8'); ?></a></li>
                <?php endif; ?>
				<?php if ( !empty($this->options->misc) && in_array('ShowLoadTime', $this->options->misc) ) : ?>
				<li>加载耗时：<?php echo timer_stop(); ?></li>
				<?php endif; ?>
			</ul>

		</div>
	</div>
</footer>
<?php $this->footer(); ?>
<!--加载静态资源-->
<script src="<?php echo htmlspecialchars(materialAssetUrl('js/jquery-2.2.4.min.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<script src="<?php echo htmlspecialchars(materialAssetUrl('js/bootstrap.min.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<script src="<?php echo htmlspecialchars(materialAssetUrl('js/merge.min.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<script src="<?php echo htmlspecialchars(materialAssetUrl('js/MyCustom.min.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
<!-- 统计代码：保持原样输出 -->
<?php $this->options->statiStics(); ?>
</body>
</html>
