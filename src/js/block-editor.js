/**
 * Block Control
 *
 */

wp.domReady( function() {

	const { __ } = wp.i18n;

	/* ==================== CLEANUP ==================== */

	/**
	 * Remove panels
	 *
	 * These should be re-enabled if blog module is active
	 */
	const { removeEditorPanel } = wp.data.dispatch( 'core/edit-post' );

	// // Excerpt panel
	// removeEditorPanel( 'post-excerpt' );

	// Discussion panel
	removeEditorPanel( 'discussion-panel' );

	/**
	 * Disable inline images
	 */
	 wp.richText.unregisterFormatType( 'core/image' );

	/**
	 * Remove Style variants
	 */

	// Quote
	wp.blocks.unregisterBlockStyle( 'core/quote', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );

	// Table
	wp.blocks.unregisterBlockStyle( 'core/table', 'regular' );
	wp.blocks.unregisterBlockStyle( 'core/table', 'stripes' );

	// Separator
	wp.blocks.unregisterBlockStyle( 'core/separator', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );
	wp.blocks.unregisterBlockStyle( 'core/separator', 'dots' );

	// Buttons
	wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );

	// Image
	wp.blocks.unregisterBlockStyle( 'core/image', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );


	/* ==================== ADDITIONS ==================== */

} );
