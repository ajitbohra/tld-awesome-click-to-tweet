<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
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
	wp_enqueue_style( 'tld-tweet-intents', plugins_url( 'assets/css/style.css', dirname( __FILE__ ) ) );
	wp_enqueue_style( 'tld-tweet-icomoon', plugins_url( 'assets/css/icomoon.css', dirname( __FILE__ ) ) );
	wp_enqueue_style( 'tld-tweet-intents-animate', plugins_url( 'assets/css/animate.min.css', dirname( __FILE__ ) ) );
	wp_enqueue_style( 'tld-lobster-font', '//fonts.googleapis.com/css?family=Lobster+Two' );
	wp_enqueue_style( 'tld-raleway-font', '//fonts.googleapis.com/css?family=Raleway' );
	wp_enqueue_style( 'tld-indie-font', '//fonts.googleapis.com/css?family=Indie+Flower' );
	wp_enqueue_style( 'tld-titillium-font', '//fonts.googleapis.com/css?family=Titillium+Web' );
	wp_enqueue_style( 'tld-alegreya-font', '//fonts.googleapis.com/css?family=Poiret+One' );
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
		'animaion' => array(
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
	$tweetmask = $attributes[ 'tweetmask' ];
	$tweet	   = $attributes[ 'tweet' ];
	$button	   = $attributes[ 'button' ];
	$theme     = $attributes[ 'theme' ];
	$font      = $attributes[ 'font' ];
	$animation = $attributes[ 'animaion' ];
	$infinite  = $attributes[ 'infinite' ];
	$duration  = $attributes[ 'duration' ];
	$delay     = $attributes[ 'delay' ];

	if( $tweet === '' ) {
		$tweet = $tweetmask;
	}

	if( $infinite === true ) {
		$infinite = 'infinite=" infinite"';
	} else {
		$infinite = 'infinite=""';
	}

	return '[actt '. $infinite .' mask="'. $tweetmask .'" tweet="'. $tweet .'" btn-text="'. $button .'" duration="'. $duration .'" delay="'. $delay .'" font="'. $font .'" anim="'. $animation .'" template="'. $theme .'"]';
}
