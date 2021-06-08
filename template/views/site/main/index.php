<?php

namespace WBL\Theme;

?>
<main class="site-main <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?> id="main">

	<?php the_post(); // Setup postdata (only on singular templates) ?>

	<?php Template::display( 'page' ) ?>

</main>
