<?php

namespace WBL\Theme;

?>
<div class="site-content">

	<article class="entry entry--single <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

		<header class="entry__header">

			<?php Template::display( 'components/breadcrumbs' ) ?>

			<h1 class="entry__title"><?= get_404_title() ?></h1>

		</header>

		<div class="entry__content">

			<p>Pagina niet gevonden</p>

		</div>

	</article>
	
</div>