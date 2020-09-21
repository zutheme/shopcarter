<?php get_template_part('layouts/layout-footer'); ?>
<div class="htz-popup-processing" style="display: none; position: fixed; z-index: 99999;left: 0;top: 0%;width: 100%; height: 100%; overflow: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4); ">
	<div class="processing" style="position:relative;background-color: rgba(255,255,255,0.1);width: 250px;height: 250px;margin-top:15%; margin-left: auto;margin-right: auto;text-align: center;">
		<p><img class="loading" style=" position: absolute;top: 11%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;" src="<?php bloginfo('template_directory');?>/images/loading.gif"></p>
		<p class="result"></p>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
