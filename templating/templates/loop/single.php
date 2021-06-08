<?php 

namespace WBL\Theme;

?>

<?php the_post(); // Setup postdata (only on singular templates) ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php Template::display( 'entry/single', Template::entry_hierarchy() ); ?>

	<?php endwhile ?>

<?php endif ?>