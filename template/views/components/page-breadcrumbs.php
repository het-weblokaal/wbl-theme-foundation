<?php
	namespace WBL\Theme;

	# Slim SEO breadcrumbs doesn't support svg as separator unfortunately.
	$separator = '>';
?>

<?= do_shortcode( '[slim_seo_breadcrumbs separator="'.$separator.'"]' ); ?>
