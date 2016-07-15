<?php
/*
Plugin Name: TLD WordPress Embedded Tweet Intents
Description: A plugin for inserting tweet intents directly into posts after any paragraph.
Version: 2.0.1-beta
Author: Uriahs Victor
License: GPLv2
*/


defined( 'ABSPATH' ) or die( 'But why!?' );

add_action( 'wp_enqueue_scripts', 'tld_wpeti_load_intents_assets' );

/**
* Register style sheet.
*/
function tld_wpeti_load_intents_assets() {
	wp_register_style( 'tld-tweet-intents', plugin_dir_url( __FILE__ ) . 'assets/css/style.css?'.time() );
	wp_register_style( 'tld-tweet-icomoon', plugin_dir_url( __FILE__ ) . 'assets/css/icomoon.css' );
	wp_register_style( 'tld-tweet-intents-animate', plugin_dir_url( __FILE__ ) . 'assets/css/animate.min.css?v3.5.2' );
	wp_enqueue_style( 'tld-tweet-intents' );
	wp_enqueue_style( 'tld-tweet-icomoon' );
	wp_enqueue_style( 'tld-tweet-intents-animate' );
	wp_enqueue_style( 'tld-lobster-font', 'https://fonts.googleapis.com/css?family=Lobster+Two' );
	wp_enqueue_style( 'tld-raleway-font', 'https://fonts.googleapis.com/css?family=Raleway' );
	wp_enqueue_style( 'tld-indie-font', 'https://fonts.googleapis.com/css?family=Indie+Flower' );
	wp_enqueue_style( 'tld-titillium-font', 'https://fonts.googleapis.com/css?family=Titillium+Web' );
	wp_enqueue_style( 'tld-alegreya-font', 'https://fonts.googleapis.com/css?family=Poiret+One' );
}

function tld_wpeti_shortcode( $atts, $content = null ){

	$atts = shortcode_atts( array(

		'mask' 			=> '',
		'tweet'			=> '',
		'btn-text'	=> 'Tweet Now',
		'anim'			=> 'pulse',
		'duration'	=> ' 5',
		'delay'			=> ' 5',
		'infinite'	=> ' infinite',
		'template'	=> '',
		'font'			=> ' lobster-two',



	), $atts, 'wpeti' );

	$the_mask 		= $atts['mask'];
	$the_tweet 		= rawurlencode($atts['tweet']);
	$the_btn_text = $atts['btn-text'];
	$the_anim 		= $atts['anim'];
	$the_duration = $atts['duration'];
	$the_delay 		= $atts['delay'];
	$the_infinite = $atts['infinite'];
	$the_template = $atts['template'];
	$the_font			= ' '. $atts['font'];

	$the_animation_duration =	$the_duration . "s";
	$the_animation_delay =	$the_delay . "s";

	$tld_wpeti_vendor_webkit_duration = "-webkit-animation-duration:" . $the_animation_duration . ";";
	$tld_wpeti_vendor_moz_duration = "-moz-animation-duration:" . $the_animation_duration . ";";
	$tld_wpeti_vendor_o_duration = "-o-animation-duration:" . $the_animation_duration . ";";
	$tld_wpeti_vendor_default_duration = "animation-duration:" . $the_animation_duration . ";";
	$tld_wpeti_vendor_webkit_delay = "-webkit-animation-delay:" . $the_animation_delay . ";";
	$tld_wpeti_vendor_moz_delay = "-moz-animation-delay:" . $the_animation_delay . ";";
	$tld_wpeti_vendor_o_delay = "-o-animation-delay:" . $the_animation_delay . ";";
	$tld_wpeti_vendor_default_delay = "animation-delay:" . $the_animation_delay . ";";

	$the_animation_settings = $tld_wpeti_vendor_webkit_duration . $tld_wpeti_vendor_moz_duration . $tld_wpeti_vendor_o_duration . $tld_wpeti_vendor_default_duration . $tld_wpeti_vendor_webkit_delay . $tld_wpeti_vendor_moz_delay . $tld_wpeti_vendor_o_delay . $tld_wpeti_vendor_default_delay;

	switch ( $the_template ) {

		case 'dashed':
		$the_template = ' tld-wpeti-border-dashed';
		break;

		case 't1':
		$the_template = ' tld-wpeti-t1';
		break;

		default:
		$the_template = ' tld-wpeti-minimalist';
		break;
		
	}


	$the_classes	= 'animated ';
	$the_classes	.= $the_anim;
	$the_classes	.= $the_infinite;
	$the_classes	.= $the_template;
	$the_classes	.= $the_font;

	switch ( $the_template ) {
		case ' tld-wpeti-t1':
		$tweet = '
		<div id="tld-wpeti-tweet-container" class="'.esc_attr( $the_classes ).'" style="'.esc_attr( $the_animation_settings).'">
		<p>'.wp_strip_all_tags( $the_mask . $content ).'</p>
		<div class="tld-wpeti-tweet-text tld-wpeti-white-btn-text tld-wpeti-btn-full">
		<a href="https://twitter.com/intent/tweet?text='.$the_tweet.'" target="_blank">'.wp_strip_all_tags( $the_btn_text ).'<span class="icon-twitter"></span></a>
		</div>
		</div>';
		break;

		default:
		$tweet = '
		<div id="tld-wpeti-tweet-container" class="'.esc_attr( $the_classes ).'" style="'.esc_attr( $the_animation_settings ).'">
		<p>'.wp_strip_all_tags( $the_mask . $content ).'</p>
		<div class="tld-wpeti-tweet-text">
		<a class="tld-wpeti-btn-default" href="https://twitter.com/intent/tweet?text='.$the_tweet.'" target="_blank">'.wp_strip_all_tags( $the_btn_text ).'<span class="icon-twitter"></span></a>
		</div>
		</div>';
		break;
	}

	return $tweet;

}

add_shortcode( 'wpeti', 'tld_wpeti_shortcode' );

?>
