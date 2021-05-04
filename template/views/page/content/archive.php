<?php

namespace WBL\Theme;

?>
<div class="page__content">

	<?php the_archive_description(); ?>

	<?php Template::display( 'loop/blog' ); ?>

</div>
