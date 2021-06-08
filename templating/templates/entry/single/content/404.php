<?php

namespace WBL\Theme;

?>
<div class="entry__content">

	<p>Pagina niet gevonden</p>

	<?php 
		Template::display( 'loop/blog', null, [ 'query_args' => [
			'post_type' => 'page'
		]]); 
	?>
	<hr>
	<?php
		Template::display( 'loop/list', null, [ 'query_args' => [
			'post_type' => 'post'
		]]); 
	?>
	<hr>
	<?php
		Template::display( 'loop/list', null, [ 'query_args' => [
			'post_type' => 'test'
		]]); 
	?>

</div>
