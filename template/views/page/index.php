<?php

namespace WBL\Theme;

?>
<article class="page <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'page/header', Template::hierarchy() ) ?>

	<?php Template::display( 'page/content', Template::hierarchy() ) ?>

</article>