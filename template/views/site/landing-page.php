<?php

namespace WBL\Theme;

?>
<div class="site <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'components/page-skip-to-content' ) ?>

	<?php Template::display( 'site/header', Template::hierarchy() ) ?>

	<?php Template::display( 'site/main', Template::hierarchy() ) ?>

	<?php Template::display( 'site/footer', Template::hierarchy() ) ?>

</div>