<?php

namespace WBL\Theme;

// Setup postdata (only on singular templates)
the_post(); 

?>
<article class="page <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'page/header' ); ?>

	<?php Template::display( 'page/content' ); ?>

	<?php Template::display( 'page/footer' ); ?>

</article>
