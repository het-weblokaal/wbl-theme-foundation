<?php

namespace WBL\Theme;

?>
<div class="site-content">

	<section class="archive <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

		<header class="archive__header">

			<?php Template::display( 'components/breadcrumbs' ) ?>

			<h1 class="archive__title"><?= get_archive_title() ?></h1>

		</header>

		<div class="archive__content">

			<?php the_archive_description('<p>', '</p>'); ?>

			<?php Template::display( 'loop/blog' ); ?>

		</div>

	</section>

</div>