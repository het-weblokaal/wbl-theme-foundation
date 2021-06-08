<?php

namespace WBL\Theme;

?>
<div class="entry__content">

	<?php the_archive_description(); ?>

	<?php Template::display( 'loop/blog' ); ?>

</div>
