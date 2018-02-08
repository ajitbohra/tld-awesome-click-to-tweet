<?php
/**
 * Block Initializer
 *
 * Enqueue CSS/JS for block.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function tld_gutenberg_editor_assets() {
	// Scripts
	wp_enqueue_script( 'tld-block-js', plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), array( 'wp-i18n', 'wp-blocks', 'wp-components' ) );
	// Styles
	wp_enqueue_style( 'tld-block-editor-css', plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), array( 'wp-edit-blocks' ) );
}

// Hook assets to editor
add_action( 'enqueue_block_editor_assets', 'tld_gutenberg_editor_assets' );

// Hook server side rendering into render callback
register_block_type( 'thelonedev/clicktotweet', [
    'render_callback' => 'tld_block_callback',
	'attributes' => array(
		'tweetmask' => array(
			'type' => 'string',
		),
		'tweet' => array(
			'type' => 'string',
		),
		'button' => array(
			'type' => 'string',
			'default' => 'Tweet Now',
		),
		'theme' => array(
			'type' => 'string',
			'default' => 'bbutton',
		),
		'font' => array(
			'type' => 'string',
			'default' => 'poiret-one',
		),
		'animation' => array(
			'type' => 'string',
			'default' => 'none',
		),
		'infinite' => array(
			'type' => 'boolean',
			'default' => false,
		),
		'duration' => array(
			'type' => 'number',
			'default' => 1,
		),
		'delay' => array(
			'type' => 'number',
			'default' => 1,
		),
	),
] );

// Callback function for block
function tld_block_callback( $attributes) {
	extract( $attributes ); 

	$infinite = ( $infinite === true ? 'infinite=" infinite"' : 'infinite=""' );
	$tweet = ( $tweet === '' ? $tweetmask : $tweet );

	$shortcode_string = '[actt %s mask="%s" tweet="%s" btn-text="%s" duration="%s" delay="%s" font="%s" anim="%s" template="%s"]';

	return sprintf( $shortcode_string, $infinite, $tweetmask, $tweet, $button, $duration, $delay, $font, $animation, $theme );
}