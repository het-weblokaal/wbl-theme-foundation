<?php

namespace WBL\Theme;

?>
<header class="site-header <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<?php Template::display( 'components/site-branding' ) ?>

	<?php Template::display( 'components/site-nav' ) ?>

	<?php Template::display( 'components/site-nav-toggle' ) ?>

</header>

