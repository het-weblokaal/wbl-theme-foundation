<?php

namespace WBL\Theme;

?>
<main class="site-main <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?> id="main">

	<?php Template::display( 'content' ) ?>

</main>
