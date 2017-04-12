</div>

<footer>
	<div class="contained">
		<div class="cf">
			<h2><?= $site->footertitle()->html() ?></h2>
		</div>
		<div class="cf">
			<div class="col-1-3">
				<?= $site->footertext1()->kt() ?>
			</div>
			<div class="col-1-3">
				<?= $site->footertext2()->kt() ?>
			</div>
			<div class="col-1-3">
				<div class="col-1-2">
					<?= $site->footeraddress()->kt() ?>
				</div>
				<div class="col-1-2">
					<?= $site->footercontact()->kt() ?>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php if(!$site->googleanalytics()->empty()): ?>
  <!-- Google Analytics-->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', '<?php echo $site->googleanalytics() ?>', 'auto');
    ga('send', 'pageview');
  </script>
<?php endif ?>
	<script>
		var $sitetitle = '<?= $site->title()->escape() ?>';
	</script>
	<?php
	echo js(array('assets/js/build/plugins.js', 'assets/js/build/app.min.js'));
	?>

</body>
</html>