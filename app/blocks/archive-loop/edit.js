/**
 * WordPress dependencies
 */
const {	useBlockProps } = wp.blockEditor;
const { __ } = wp.i18n;
// const { withSelect } = wp.data;

/**
 * Internal dependencies
 */
// import { name } from './';

/**
 * Edit function
 */
function edit( { attributes, setAttributes, isSelected } ) {

	// Setup new variables
	const blockClassName = "wbl-archive-loop";

	// Setup blockProps
	const blockProps = useBlockProps( {
		className: blockClassName
	} );

	return (
		<div {...blockProps }>
            <h2 className={ `${blockClassName}__title` }>{ __('Archive Loop', 'wbl-theme' ) }</h2>
            <p className={ `${blockClassName}__text` }>{ __('This block is a placeholder for the archive loop', 'wbl-theme' ) }</p>
		</div>
	);
}

export default edit;
