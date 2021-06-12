<?php

namespace WBL\Theme;

?>
<article class="page <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

	<header class="page__header">

		<?php Template::display( 'components/breadcrumbs' ) ?>

		<h1 class="page__title"><?= get_404_title() ?></h1>

	</header>

	<div class="page__content">

		<p>Pagina niet gevonden</p>

	</div>

</article>