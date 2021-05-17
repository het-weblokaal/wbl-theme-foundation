<?php

namespace WBL\Theme;

/// Only show site version on development
if ( ! Theme::is_debug_mode() ) {
	return;
}

?>

<div class="site-debug-info">
	<div class="site-debug-info__grid">

	</div>
	<div class="site-debug-info__version">
		<?= Theme::get_version() ?>
	</div>
	<div class="site-debug-info__responsiveness">

	</div>
</div>
