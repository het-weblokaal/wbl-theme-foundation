<?php
/**
 * Related entries
 */

namespace WBL\Theme;

?>

<div class="entry-related-entries">
		
	<?php
	Template::display( 'loop/grid', null, [
		'query_args' => [
			'posts_per_page' => 4,
			'post_type' => 'post',
			'post__not_in' => [ get_the_ID() ],
		]
	] );
	?>

</div>
