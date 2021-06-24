/**
 * WordPress dependencies
 */
const { has } = lodash;

/**
 * Get the source url of an image
 *
 * @return string
 */
export function getImage( media, size ) {

	return {
		id: getImageId(media),
		src: getImageSrc(media,size),
		size: size
	};
}

/**
 * Get the source url of an image
 *
 * @return string
 */
export function getImageId( media ) {
	return media.id ?? undefined;
}

/**
 * Get the source url of an image
 *
 * @return string
 */
export function getImageSrc( media, size ) {
	let src = '';

	size = size || 'thumbnail';

	if ( media ) {

		// The media object can be different I guess...
		// - Media with media_details and source_url
		// - Media with direct properties and url
		if ( has( media, [ 'media_details' ] ) ) {
			if ( has( media, [ 'media_details', 'sizes', size ] ) ) {
				src = media.media_details.sizes[ size ].source_url;
			} else {
				src = media.source_url;
			}
		}
		else {
			if ( has( media, [ 'sizes', size ] ) ) {
				src = media.sizes[ size ].url;
			} else {
				src = media.url;
			}
		}
	}

	return src;
}

/**
 * Copied from core/media-text/edit.js
 *
 * @link https://github.com/WordPress/gutenberg/blob/master/packages/block-library/src/media-text/edit.js
 */
function attributesFromMedia( {
	attributes: { linkDestination, href },
	setAttributes,
} ) {
	return ( media ) => {
		let mediaType;
		let src;
		// for media selections originated from a file upload.
		if ( media.media_type ) {
			if ( media.media_type === 'image' ) {
				mediaType = 'image';
			} else {
				// only images and videos are accepted so if the media_type is not an image we can assume it is a video.
				// video contain the media type of 'file' in the object returned from the rest api.
				mediaType = 'video';
			}
		} else {
			// for media selections originated from existing files in the media library.
			mediaType = media.type;
		}

		if ( mediaType === 'image' ) {
			// Try the "large" size URL, falling back to the "full" size URL below.
			src =
				media.sizes?.large?.url ||
				// eslint-disable-next-line camelcase
				media.media_details?.sizes?.large?.source_url;
		}

		let newHref = href;
		if ( linkDestination === LINK_DESTINATION_MEDIA ) {
			// Update the media link.
			newHref = media.url;
		}

		// Check if the image is linked to the attachment page.
		if ( linkDestination === LINK_DESTINATION_ATTACHMENT ) {
			// Update the media link.
			newHref = media.link;
		}

		setAttributes( {
			mediaAlt: media.alt,
			mediaId: media.id,
			mediaType,
			mediaUrl: src || media.url,
			mediaLink: media.link || undefined,
			href: newHref,
			focalPoint: undefined,
		} );
	};
}

