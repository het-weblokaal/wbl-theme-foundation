<?php

namespace WBL\Theme;

?>
<section class="page <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'page/header' ); ?>

	<?php Template::display( 'page/content' ); ?>

</section>
