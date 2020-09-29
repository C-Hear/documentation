<?php
/**
 * Plugin Name:     CHIF Uploader for Gutenberg
 * Description:     C-Hear Wordpress Plugin for embedding CHIFs on your Wordpress site.
 * Version:         0.1.0
 * Author:          C-Hear Labs
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     chif-uploader
 *
 * @package         create-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function create_block_chif_uploader_block_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/chif-uploader" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-chif-uploader-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);
	wp_set_script_translations( 'create-block-chif-uploader-block-editor', 'chif-uploader' );

	// $editor_css = 'build/index.css';
	wp_register_style(
		'create-block-chif-uploader-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-chif-uploader-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'create-block/chif-uploader', array(
		'editor_script' => 'create-block-chif-uploader-block-editor',
		'editor_style'  => 'create-block-chif-uploader-block-editor',
		'style'         => 'create-block-chif-uploader-block',
	) );
}
add_action( 'init', 'create_block_chif_uploader_block_init' );

 function wp_47904_mime_type( $mime_types ) {
        $mime_types['chif'] = 'application/octet-stream';
        return $mime_types;
    }
    add_filter( 'upload_mimes', 'wp_47904_mime_type', 1, 1 );

function backend_enqueue() {
    wp_enqueue_script(
        'chifplayer',
      	'https://storage.cloud.google.com/chif-player/chifPlayer-4.0.3.js');
    wp_enqueue_script('chif', plugins_url( 'public/chif.js', __FILE__ ), array('chifplayer'), null, true);
}
add_action( 'admin_enqueue_scripts', 'backend_enqueue' );

function front_end_enqueue() {   
    wp_enqueue_script( 'my_enqueue_script', 'https://storage.cloud.google.com/chif-player/chifPlayer-4.0.3.js' );
    wp_enqueue_script('chif', plugins_url( 'public/chif.js', __FILE__ ), array('my_enqueue_script'));
}
add_action('wp_enqueue_scripts', 'front_end_enqueue');
