<?php

namespace WBL\Theme;

?>
<div class="page__content">
	
	<?php Template::display( 'components/page-meta' ); ?>

	<?php the_content(); ?>
	
	<hr>

	<?php Template::display( 'components/page-related-entries' ); ?>

</div>
