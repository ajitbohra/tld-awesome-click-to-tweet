<?php
/*
Plugin Name: TLD WordPress Embedded Tweet Intents
Plugin URI: http://soaringleads.com
Description: A plugin for inserting tweet intents directly into posts.
Author: Uriahs Victor
Author URI: http://soaringleads.com
License: GPL2
*/


/* Start Adding Functions Below this Line */
include_once('fields.php');
add_action('loop_start', 'add_tweet_intent');
add_action( 'wp_enqueue_scripts', 'tld_tweet_intents_styles' );


/*
function remove_calendar_widget() {

	unregister_widget('WP_Widget_Recent_Posts');


}

add_action( 'widgets_init', 'remove_calendar_widget' );
*/

/**
* Register style sheet.
*/
function tld_tweet_intents_styles() {
	wp_enqueue_style( 'tld-tweet-intents' );
}

function add_tweet_intent(){

	static $has_run = 'no';

	if ( $has_run == 'no' ){


	$active = get_field('add_inline_tweet');

	if ( $active == "yes" ){

		add_filter( 'the_content', 'tld_insert_post_tweet' );
		// Parent Function that makes the magic happen

		function tld_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
			$closing_p = '</p>';
			$paragraphs = explode( $closing_p, $content );
			foreach ($paragraphs as $index => $paragraph) {

				if ( trim( $paragraph ) ) {
					$paragraphs[$index] .= $closing_p;
				}
				if ( $paragraph_id == $index + 1 ) {
					$paragraphs[$index] .= $insertion;
				}
			}     return implode( '', $paragraphs );
		}

		function tld_insert_post_tweet( $content ) {
			$tweet_msg = get_field('tweet_msg');
			$tweet_msg = rawurlencode($tweet_msg);
			$tweet_txt = get_field('tweet_text');
			$tweet_icon = get_field('tweet_icon');
			$after_paragraph= get_field('paragraph');
			if(empty($tweet_icon)){
				echo '<style>#tld-tweet-icon-container{display: none;}</style>';
			}

			$tweet_container = '
			<div id="tld-tweet-container">

			<div id="tld-tweet-icon-container"><img id="tld-tweet-icon-img" src="'.$tweet_icon.'" alt="" /></div>

			</a>
			</div>';

			if ( (is_single() && ! is_admin()) ) {
				echo tld_insert_after_paragraph( $tweet_container, $after_paragraph, $content );
			}
		}
	$has_run = 'yes';
	}
}
}

/* Stop Adding Functions Below this Line */
?>
