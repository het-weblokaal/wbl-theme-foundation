<?php
/**
 * Navigation between single posts
 */

$previous_link = get_previous_post_link( '%link' );
$next_link     = get_next_post_link( '%link' );

$class_modifier = '';

if ( ! $previous_link && ! $next_link ) {
	return;
}

if ( ! $previous_link ) {
	$class_modifier = 'post-navigation--first-post';
}
elseif ( ! $next_link ) {
	$class_modifier = 'post-navigation--last-post';
}

?>
<nav class="post-navigation <?= $class_modifier ?>" role="navigation">
	<h2 class="screen-reader-text"><?= __( 'Berichten navigatie' ) ?></h2>

	<div class="post-navigation__links">

		<?php if ( $previous_link ) : ?>

			<div class="post-navigation__previous">
				<div class="post-navigation__link-label"><?= __( 'Vorig bericht', 'wbl-theme' ) ?></div>
				<?= $previous_link ?>
			</div>

		<?php endif ;?>

		<?php if ( $next_link ) : ?>

			<div class="post-navigation__next">
				<div class="post-navigation__link-label"><?= __( 'Volgend bericht', 'wbl-theme' ) ?></div>
				<?= $next_link ?>
			</div>

		<?php endif ;?>

	</div>
</nav>
