<?php

namespace WBL\Theme;

?>
<article class="entry <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'entry/single/header' ) ?>

	<?php Template::display( 'entry/single/content' ) ?>

</article>