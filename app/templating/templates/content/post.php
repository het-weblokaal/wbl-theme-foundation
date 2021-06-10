<?php

namespace WBL\Theme;

// Setup postdata (only on singular templates)
the_post(); 

?>
<div class="site-content">

	<article class="entry entry--single <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

		<header class="entry__header">

			<?php Template::display( 'components/breadcrumbs' ) ?>

			<h1 class="entry__title"><?= get_the_title() ?></h1>

		</header>

		<div class="entry__content">

			<?php the_content(); ?>

		</div>

		<footer class="entry__footer">

			<?php Template::display( 'components/entry-meta' ) ?>
			<?php Template::display( 'components/related-entries' ) ?>

		</footer>

	</article>

</div>