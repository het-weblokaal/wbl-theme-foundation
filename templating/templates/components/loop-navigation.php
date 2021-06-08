<?php
/**
 * Pagination
 */

namespace WBL\Theme;

// Don't print empty markup if...
// - it's not the main query
// - there's only one page.
if ( ! is_main_query() || $GLOBALS['wp_query']->max_num_pages <= 1 ) {
	return;
}

// Get Post Type object
$post_type_object = get_post_type_object( get_post_type_on_archive() );

// Set labels
$label = $post_type_object->labels->name ?? null;
$plural = $post_type_object->labels->name ?? null;

$pagination = get_the_posts_pagination([
    'mid_size'           => 1,
    'prev_text'          => _x( 'Previous', 'previous set of posts' ),
    'next_text'          => _x( 'Next', 'next set of posts' ),
    'screen_reader_text' => sprintf( __( '%s navigation' ), $label ),
    'aria_label'         => $label,
]);

?>

<div class="loop-navigation">
	<div class="loop-navigation__inner">

		<h3><?= sprintf( __('Blader door onze %s', 'wbl-theme'), strtolower($plural) ) ?></h3>

		<?= $pagination ?>

	</div>
</div>
