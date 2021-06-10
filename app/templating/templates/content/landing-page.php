<?php

namespace WBL\Theme;

// Setup postdata (only on singular templates)
the_post(); 

?>
<div class="site-content">

	<article class="entry entry--single <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

		<div class="entry__content">

			<?php the_content(); ?>

		</div>

	</article>
	
</div>