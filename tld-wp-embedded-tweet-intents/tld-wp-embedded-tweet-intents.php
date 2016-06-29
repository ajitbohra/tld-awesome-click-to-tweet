<?php
/*
Plugin Name: TLD WordPress Embedded Tweet Intents
Plugin URI: http://soaringleads.com
Description: A plugin for inserting tweet intents directly into posts after any paragraph.
Version: 1.2.0-beta
Author: Uriahs Victor
Author URI: http://soaringleads.com
License: GPLv2
*/


defined( 'ABSPATH' ) or die( 'But why!?' );

add_action( 'loop_start', 'add_tweet_intent' );
add_action( 'wp_enqueue_scripts', 'tld_wpeti_load_intents_assets' );
add_action( 'admin_enqueue_scripts', 'tld_wpeti_load_admin_assets' );

// Save post meta

add_action( 'save_post', 'tld_wpeti_save_data' );

/**
* Register style sheet.
*/
function tld_wpeti_load_intents_assets() {
	wp_register_style( 'tld-tweet-intents', plugin_dir_url( __FILE__ ) . '/assets/css/style.css?v1.0.39' );
	wp_register_style( 'tld-tweet-icomoon', plugin_dir_url( __FILE__ ) . '/assets/css/icomoon.css' );
	wp_register_style( 'tld-tweet-intents-animate', plugin_dir_url( __FILE__ ) . '/assets/css/animate.min.css?v3.5.2' );
	wp_enqueue_style( 'tld-tweet-intents' );
	wp_enqueue_style( 'tld-tweet-icomoon' );
	wp_enqueue_style( 'tld-tweet-intents-animate' );
	wp_enqueue_style( 'tld-lobster-font', 'https://fonts.googleapis.com/css?family=Lobster+Two' );
	wp_enqueue_style( 'tld-raleway-font', 'https://fonts.googleapis.com/css?family=Raleway' );
	wp_enqueue_style( 'tld-indie-font', 'https://fonts.googleapis.com/css?family=Indie+Flower' );
	wp_enqueue_style( 'tld-titillium-font', 'https://fonts.googleapis.com/css?family=Titillium+Web' );
}

//only enqueue fonts if selected by post

function tld_wpeti_load_admin_assets(){
	wp_register_style( 'tld_wpeti_styles',  plugin_dir_url( __FILE__ ) . '/assets/css/admin.css?v1.0.14' );
	wp_enqueue_style( 'tld_wpeti_styles' );
}

function tld_wpeti_metabox(){

	add_meta_box(

	'tld_wpeti_metabox',
	'Add a tweet intent',
	'tld_wpeti_metabox_fields',
	'',
	'normal',
	'low'

);

}

add_action( 'add_meta_boxes_post', 'tld_wpeti_metabox' );

function tld_wpeti_intent_animations(){
	global $animations;
	$animations = array(
		"None"				=> "",
		"Pulse"				=> "pulse",
		"Bounce"			=> "bounce",
		"Rubber Band"	=> "rubberBand",
		"Jello"				=> "jello",
	);

}

function tld_wpeti_intent_templates(){
	global $templates;
	$templates = array(
		"Default"				=> "tld-default",
		"Twitter"				=> "tld-default-twitter",
		"Minimalist"		=> "tld-minimalist",
		"Dashed border" => "tld-border-dashed"
	);

}

function tld_wpeti_intent_fonts(){
	global $fonts;
	$fonts = array(
		"Inherit" 			=> "inherit",
		"Raleway"				=> "raleway",
		"Lobster Two"		=> "lobster-two",
		"Indie Flower"	=> "indie-flower",
		"Titillium Web"	=> "titillium-web"
	);

}

function tld_wpeti_metabox_fields(){

	$tld_wpeti_intent_mask = sanitize_text_field( get_post_meta( get_the_ID(), 'tld_wpeti_intent_mask', true ) );
	$tld_wpeti_intent_text = sanitize_text_field( get_post_meta( get_the_ID(), 'tld_wpeti_intent_text', true ) );
	$tld_wpeti_intent_paragraph = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_paragraph', true ) );
	$tld_wpeti_animation_duration = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_animation_duration', true ) );
	$tld_wpeti_animation_delay = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_animation_delay', true ) );

	?>

	<div id="tld-wpeti-meta-wrap">

		<div class="tld-wpeti-meta-float-left">
			<div>
				<p>
					<em><label for="tld-wpeti-intent-mask">Tweet Mask</label></em>
				</p>
			</div>
			<div>
				<textarea name="tld-wpeti-intent-mask" rows="2" id="tld-wpeti-intent-mask" class="tld-wpeti-tweet-inputs" placeholder="The text shown to visitors on the post."><?php 	if ( !empty( $tld_wpeti_intent_mask ) ){ echo $tld_wpeti_intent_mask; } ?></textarea>
			</div>
		</div>

		<div class="tld-wpeti-meta-float-left">
			<div>
				<p>
					<em><label for="tld-wpeti-intent-text">Tweet Intent</label></em>
				</p>
			</div>
			<div>
				<textarea name="tld-wpeti-intent-text" rows="2" id="tld-wpeti-intent-text" class="tld-wpeti-tweet-inputs" maxlength="140" placeholder="The actual intent which gets sent to twitter"><?php if ( !empty( $tld_wpeti_intent_text ) ){ echo $tld_wpeti_intent_text; } ?></textarea>
			</div>
		</div>

		<div class="tld-wpeti-clearfix"></div>

		<div class="tld-wpeti-meta-float-left">
			<div>
				<p>
					<em><label for="tld-wpeti-intent-paragraph">Paragraph</label></em>
				</p>
				<span><em>Enter the paragraph number after which the intent will show.</em></span>
			</div>
			<div>
				<input type="number" name="tld-wpeti-intent-paragraph" id="tld-wpeti-intent-paragraph" class="tld-wpeti-number-input" value="<?php echo $tld_wpeti_intent_paragraph  ?>">
			</div>
		</div>

		<div class="tld-wpeti-meta-float-left">
			<div>
				<?php tld_wpeti_intent_animations(); global $animations; ?>
				<p>
					<em><label for="tld-wpeti-intent-animation"></label>Choose animation</em>
				</p>
				<span><em>Choose animation for this tweet.</em></span>
			</div>
			<div>
				<select name="tld-wpeti-intent-animation">
					<?php

					$selected_animation = get_post_meta( get_the_ID(), 'tld_wpeti_intent_animation', true );
					foreach ( $animations as $animation_nn => $animation ){

						if ( $selected_animation == $animation ){
							echo '<option value="' . $animation . '" selected>'. $animation_nn . '</option>';
						}else{
							echo '<option value="' . $animation . '">'. $animation_nn . '</option>';
						}

					}

					?>
				</select>

			</div>
		</div>

		<div class="tld-wpeti-clearfix"></div>

		<div class="tld-wpeti-meta-float-left">
			<div>
				<p>
					<em><label>Animation settings</label></em>
				</p>
				<span><em>Adjust animation settings(duration, delay respectively)</em></span>
			</div>
			<div>
				<input type="number" name="tld-wpeti-animation-duration" id="tld-wpeti-animation-duration" class="tld-wpeti-number-input" value="<?php echo $tld_wpeti_animation_duration ?>">
				<input type="number" name="tld-wpeti-animation-delay" id="tld-wpeti-animation-delay" class="tld-wpeti-number-input" value="<?php echo $tld_wpeti_animation_delay ?>">
			</div>
		</div>

		<div class="tld-wpeti-meta-float-left">
			<div>
				<?php tld_wpeti_intent_templates(); global $templates; ?>
				<p>
					<em><label for="tld-wpeti-intent-template"></label>Choose template</em>
				</p>
				<span><em>Choose template for this tweet intent.</em></span>
			</div>
			<div>
				<select name="tld-wpeti-intent-template">
					<?php

					$selected_template = get_post_meta( get_the_ID(), 'tld_wpeti_intent_template', true );
					foreach ( $templates as $template_nn => $template ){

						if ( $selected_template == $template ){
							echo '<option value="' . $template . '" selected>'. $template_nn . '</option>';
						}else{
							echo '<option value="' . $template. '">'. $template_nn . '</option>';
						}

					}

					?>
				</select>
			</div>
		</div>

		<div class="tld-wpeti-clearfix"></div>

		<div class="tld-wpeti-meta-font-style">
			<div>
				<?php tld_wpeti_intent_fonts(); global $fonts; ?>
				<p>
					<em><label for="tld-wpeti-intent-font"></label>Choose font</em>
				</p>
				<span><em>Choose font for this tweet intent.</em></span>
			</div>
			<div>
				<select name="tld-wpeti-intent-font">
					<?php

					$selected_font = get_post_meta( get_the_ID(), 'tld_wpeti_intent_font', true );
					foreach ( $fonts as $font_nn => $font ){

						if ( $selected_font == $font ){
							echo '<option value="' . $font . '" selected>'. $font_nn . '</option>';
						}else{
							echo '<option value="' . $font. '">'. $font_nn . '</option>';
						}

					}

					?>
				</select>
			</div>
		</div>

		<div class="tld-wpeti-clearfix"></div>

	</div>

	<?php
}

function tld_wpeti_save_data( $post_id ){
	//below throws an error
	if ( define( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;

	if ( !current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	$intent_mask = sanitize_text_field( isset( $_POST['tld-wpeti-intent-mask'] ) ? $_POST['tld-wpeti-intent-mask'] : '' );
	$intent_text = sanitize_text_field( isset( $_POST['tld-wpeti-intent-text'] ) ? $_POST['tld-wpeti-intent-text'] : '' );
	$intent_paragraph = sanitize_text_field( isset( $_POST['tld-wpeti-intent-paragraph'] ) ? $_POST['tld-wpeti-intent-paragraph'] : '' );
	$intent_animation = sanitize_text_field( isset( $_POST['tld-wpeti-intent-animation'] ) ? $_POST['tld-wpeti-intent-animation'] : '' );
	$intent_animation_duration = sanitize_text_field( isset( $_POST['tld-wpeti-animation-duration'] ) ? $_POST['tld-wpeti-animation-duration'] : '' );
	$intent_animation_delay = sanitize_text_field( isset( $_POST['tld-wpeti-animation-delay'] ) ? $_POST['tld-wpeti-animation-delay'] : '' );
	$intent_template = sanitize_text_field( isset( $_POST['tld-wpeti-intent-template'] ) ? $_POST['tld-wpeti-intent-template'] : '' );
	$intent_font = sanitize_text_field( isset( $_POST['tld-wpeti-intent-font'] ) ? $_POST['tld-wpeti-intent-font'] : '' );

	update_post_meta( $post_id, 'tld_wpeti_intent_mask', $intent_mask );
	update_post_meta( $post_id, 'tld_wpeti_intent_text', $intent_text );
	update_post_meta( $post_id, 'tld_wpeti_intent_paragraph', $intent_paragraph );
	update_post_meta( $post_id, 'tld_wpeti_intent_animation', $intent_animation );
	update_post_meta( $post_id, 'tld_wpeti_animation_duration', $intent_animation_duration );
	update_post_meta( $post_id, 'tld_wpeti_animation_delay', $intent_animation_delay );
	update_post_meta( $post_id, 'tld_wpeti_intent_template', $intent_template );
	update_post_meta( $post_id, 'tld_wpeti_intent_font', $intent_font );

	//ADD NOUNCE FIELD FOR SECURITY

}

function tld_wpeti_append_animation_settings(){
	//add conditionals for if empty
	if ( is_singular( 'post' ) ){

		$tld_wpeti_fr_animation_duration = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_animation_duration', true ) );
		$tld_wpeti_fr_animation_delay = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_animation_delay', true ) );

		if ( !empty( $tld_wpeti_fr_animation_duration && $tld_wpeti_fr_animation_delay ) ){

			$tld_wpeti_fr_animation_duration =	$tld_wpeti_fr_animation_duration . "s";
			$tld_wpeti_fr_animation_delay =	$tld_wpeti_fr_animation_delay . "s";

			$tld_wpeti_vendor_webkit_duration = "-webkit-animation-duration:" . $tld_wpeti_fr_animation_duration . ";";
			$tld_wpeti_vendor_moz_duration = "-moz-animation-duration:" . $tld_wpeti_fr_animation_duration . ";";
			$tld_wpeti_vendor_o_duration = "-o-animation-duration:" . $tld_wpeti_fr_animation_duration . ";";
			$tld_wpeti_vendor_default_duration = "animation-duration:" . $tld_wpeti_fr_animation_duration . ";";
			$tld_wpeti_vendor_webkit_delay = "-webkit-animation-delay:" . $tld_wpeti_fr_animation_delay . ";";
			$tld_wpeti_vendor_moz_delay = "-moz-animation-delay:" . $tld_wpeti_fr_animation_delay . ";";
			$tld_wpeti_vendor_o_delay = "-o-animation-delay:" . $tld_wpeti_fr_animation_delay . ";";
			$tld_wpeti_vendor_default_delay = "animation-delay:" . $tld_wpeti_fr_animation_delay . ";";
			global $tld_wpeti_fr_animation_settings;
			$tld_wpeti_fr_animation_settings = $tld_wpeti_vendor_webkit_duration . $tld_wpeti_vendor_moz_duration . $tld_wpeti_vendor_o_duration . $tld_wpeti_vendor_default_duration . $tld_wpeti_vendor_webkit_delay . $tld_wpeti_vendor_moz_delay . $tld_wpeti_vendor_o_delay . $tld_wpeti_vendor_default_delay;

		}

	}

}

add_action('wp', 'tld_wpeti_append_animation_settings'); //maybe use different hook, mayone one for single posts

function tld_wpeti_set_fr_animation(){

	global $tld_wpeti_fr_animation_settings;
	if ( !empty ( $tld_wpeti_fr_animation_settings ) ){
		$tld_wpeti_fr_animation_set = '<style>#tld-tweet-container{'.$tld_wpeti_fr_animation_settings.'}</style>';
		echo $tld_wpeti_fr_animation_set;
	}

}

add_action('wp_head','tld_wpeti_set_fr_animation');

function add_tweet_intent(){

	static $has_run = 'no';

	if ( $has_run == 'no' ){

		if ( is_singular( 'post' ) ){
			add_filter( 'the_content', 'tld_insert_post_tweet' );
		}

		function tld_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
			$closing_p = '</p>';
			$paragraphs = explode( $closing_p, do_shortcode( $content ) );
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
			//SANITIZE
			$tld_wpeti_fr_intent_mask = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_mask', true ) );
			$tld_wpeti_fr_intent_text = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_text', true ) );
			$tld_wpeti_fr_intent_text = rawurlencode( $tld_wpeti_fr_intent_text );
			$after_paragraph = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_paragraph', true ) );
			$tld_wpeti_fr_template = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_template', true ) );
			$tld_wpeti_fr_template = $tld_wpeti_fr_template; //maybe delete this
			$tld_wpeti_fr_animation = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_animation', true ) );
			$tld_wpeti_fr_font = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_font', true ) );
			$tld_wpeti_fr_animation = " " . $tld_wpeti_fr_animation;
			$tld_wpeti_fr_font = " " . $tld_wpeti_fr_font;
			$tld_wpeti_fr_classes = $tld_wpeti_fr_template;
			$tld_wpeti_fr_classes .= $tld_wpeti_fr_animation;
			$tld_wpeti_fr_classes .= $tld_wpeti_fr_font;
			$tld_wpeti_fr_classes .= " animated";
			$tld_wpeti_fr_classes .= " infinite ";

			$tweet_container = '

			<div id="tld-tweet-container" class="'.$tld_wpeti_fr_classes.'">

			<p>'.$tld_wpeti_fr_intent_mask.'</p>
			<a id="tld-tweet-text" href="https://twitter.com/intent/tweet?text='.$tld_wpeti_fr_intent_text.'" target="_blank">Click to tweet</a><span class="icon-twitter"></span>
			</div>';

			if ( is_singular( 'post' ) && ! is_admin() ) {
				echo tld_insert_after_paragraph( $tweet_container, $after_paragraph, $content );
			}
		}
		$has_run = 'yes';
	}
}


?>
