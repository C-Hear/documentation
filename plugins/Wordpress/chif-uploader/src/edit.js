/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import './editor.scss';

const ALLOWED_MEDIA_TYPES = [ 'application/octet-stream' ];

export default function Edit( { props, attributes,setAttributes } ) {	
	const chifPlayer = window.chifPlayer;

	const selectImage = function(value	) {
		setAttributes({
		    imgUrl: value.url,
		    set: true
		});
		chifPlayer.streamFiles();
	}
	return (
		<div>
			<MediaUpload 
                onSelect={selectImage}
                allowedTypes={ ALLOWED_MEDIA_TYPES }
                render={ ({open}) => {
                    return (
                    	<div>
                    		{!attributes.set &&
                    			<button onClick={open}>Select CHIF</button>
                        	}
                        		<chear src={attributes.imgUrl} onClick={open}></chear>
                    	</div>
                    );
                }}
            />
		</div>
	);
}
