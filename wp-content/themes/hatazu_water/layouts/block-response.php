<?php $two_line_header_image = get_field('two_line_header_image','customizer'); 
	$two_line_header_link = get_field('two_line_header_link','customizer');
?>
<div class="two-line">
	<div class="container">
		<div class="row">
			<div class="col-12 line text-center">
				<a href="<?php echo $two_line_header_link; ?>"><img src="<?php echo $two_line_header_image['url']; ?>"></a>
				<h3><?php echo get_field('two_line_header_text','customizer'); ?></h3>
				<a href="<?php echo $two_line_header_link; ?>">Tìm hiểu</a>
			</div>
		</div>
	</div>
</div>