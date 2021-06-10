<?php

namespace WBL\Theme;

?>

<div class="site-branding <?= html_classes($args['extra_classes']) ?>" <?= html_attributes($args['attr']) ?>>
	<a class="site-branding__link" href="<?= home_url() ?>" rel="home"><?= render_site_logo() ?></a>
</div>

