import { registerBlockType } from '@wordpress/blocks';

import { __ } from '@wordpress/i18n';

import './style.scss';

import Edit from './edit';
import save from './save';

registerBlockType( 'create-block/chif-uploader', {
	title: __( 'CHIF Uploader', 'chif-uploader' ),
	description: __(
		'C-Hear Gutenberg block to allow you to add CHIFs to your Wordpress site.',
		'chif-uploader'
	),
	category: 'embed',
	icon: 'admin-media',
	supports: {
		// Removes support for an HTML mode.
		html: true,
	},
	attributes: {
	    imgUrl: {
	        type: 'string',
	        default: 'http://placehold.it/500'
	    },
	    set: {
	    	type: 'bool',
	    	default: false
	    }
	},
	edit: Edit,
	save,
} );
