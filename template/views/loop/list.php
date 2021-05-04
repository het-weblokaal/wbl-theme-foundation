<?php 

namespace WBL\Theme;

// Setup custom query, or fallback to default query if no query arguments are passed
$query = ( $args['query_args'] ) ? new \WP_Query( $args['query_args'] ) : $GLOBALS['wp_query'];

?>

<?php if ( $query->have_posts() ) : ?>

	<div class="loop layout-list <?= html_classes( $args['extra_classes'] ) ?>" <?= html_attributes($args['attr']) ?>>

		<?php while ( $query->have_posts() ) : $query->the_post(); ?>

			<?php Template::display( 'entry/list', Template::entry_hierarchy() ); ?>

		<?php endwhile; ?>

	</div>

	<?php Template::display( 'components/loop-navigation' ); ?>

<?php else : ?>

	<?php Template::display( 'loop/no-results' ); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

