<?php
/*
Plugin Name: TLD WordPress Embedded Tweet Intents
Plugin URI: http://soaringleads.com
Description: A plugin for inserting tweet intents directly into posts after any paragraph.
Version: 1.0.0-beta
Author: Uriahs Victor
Author URI: http://soaringleads.com
License: GPL2
*/


defined( 'ABSPATH' ) or die( 'But why!?' );
//include_once('fields.php');

add_action( 'loop_start', 'add_tweet_intent' );
add_action( 'wp_enqueue_scripts', 'tld_wpeti_load_intents_assets' );
add_action( 'admin_enqueue_scripts', 'tld_wpeti_load_admin_assets' );

// Save post meta

add_action( 'save_post', 'tld_wpeti_save_data' );

/**
* Register style sheet.
*/
function tld_wpeti_load_intents_assets() {
	wp_register_style( 'tld-tweet-intents', plugin_dir_url( __FILE__ ) . '/assets/css/style.css?v1.0.9' );
	wp_register_style( 'tld-tweet-intents-animate', plugin_dir_url( __FILE__ ) . '/assets/css/animate.min.css?v3.5.2' );
	wp_enqueue_style( 'tld-tweet-intents' );
	wp_enqueue_style( 'tld-tweet-intents-animate' );
	wp_enqueue_style( 'tld-lobster-font', 'https://fonts.googleapis.com/css?family=Lobster+Two' );
}

function tld_wpeti_load_admin_assets(){
	wp_register_style( 'tld_wpeti_styles',  plugin_dir_url( __FILE__ ) . '/assets/css/admin.css?v1.0.5' );
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
		"Pulse"				=> "pulse",
		"Bounce"			=> "bounce",
		"Swing"				=> "swing",
		"Tada"				=> "tada",
		"Wobble"			=> "wobble",
		"Rotate In"		=> "rotateIn",
		"Light Speed In" => "lightSpeedIn"

	);

}

function tld_wpeti_metabox_fields(){

	$tld_wpeti_intent_mask = sanitize_text_field( get_post_meta( get_the_ID(), 'tld_wpeti_intent_mask', true ) );

	$tld_wpeti_intent_text = sanitize_text_field( get_post_meta( get_the_ID(), 'tld_wpeti_intent_text', true ) );

	$tld_wpeti_intent_paragraph = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_paragraph', true ) );

	?>

	<div>

		<p>
			<em><label for="tld-wpeti-intent-mask">Tweet Mask</label></em>
		</p>

	</div>

	<div>

		<textarea name="tld-wpeti-intent-mask" rows="2" id="tld-wpeti-intent-mask" class="tweet-inputs" maxlength="140" placeholder="The text shown to visitors on the post."><?php 	if ( !empty( $tld_wpeti_intent_mask ) ){ echo $tld_wpeti_intent_mask; } ?></textarea>

	</div>

	<div>

		<p>
			<em><label for="tld-wpeti-intent-text">Tweet Intent</label></em>
		</p>

	</div>

	<div>

		<textarea name="tld-wpeti-intent-text" rows="2" id="tld-wpeti-intent-text" class="tweet-inputs" maxlength="140" placeholder="The actual intent which gets sent to twitter"><?php if ( !empty( $tld_wpeti_intent_text ) ){ echo $tld_wpeti_intent_text; } ?></textarea>

	</div>

	<div>

		<p>
			<em><label for="tld-wpeti-intent-paragraph">Paragraph</label></em>
		</p>
		<span><em>Enter the paragraph number after which the intent will show.</em></span>
	</div>

	<div>

		<input type="number" name="tld-wpeti-intent-paragraph" id="tld-wpeti-intent-paragraph" value="<?php echo $tld_wpeti_intent_paragraph  ?>">

	</div>

	<div>
		<?php tld_wpeti_intent_animations();
		global $animations;
		//	echo var_dump($animations);
		?>
		<p>
			<em><label for="tld-wpeti-intent-animation"></label>Choose animation</em>
		</p>

		<select name="tld-wpeti-intent-animation">
			<?php

			$selected = get_post_meta( get_the_ID(), 'tld_wpeti_intent_animation', true );
			foreach ( $animations as $animation_nn => $animation ){

				if ( $selected == $animation ){
					echo '<option value="' . $animation . '" selected>'. $animation_nn . '</option>';
				}else{
					echo '<option value="' . $animation . '">'. $animation_nn . '</option>';
				}

			}

			?>
		</select>

	</div>

	<?php
}

function tld_wpeti_save_data( $post_id ){

	if ( define( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;

	if ( !current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	//try commenting below
	$intent_mask = sanitize_text_field( $_POST['tld-wpeti-intent-mask'] );
	$intent_text = sanitize_text_field( $_POST['tld-wpeti-intent-text'] );
	$intent_paragraph = sanitize_text_field( $_POST['tld-wpeti-intent-paragraph'] );
	$intent_animation = sanitize_text_field( $_POST['tld-wpeti-intent-animation'] );

	update_post_meta( $post_id, 'tld_wpeti_intent_mask', $intent_mask );
	update_post_meta( $post_id, 'tld_wpeti_intent_text', $intent_text );
	update_post_meta( $post_id, 'tld_wpeti_intent_paragraph', $intent_paragraph );
	update_post_meta( $post_id, 'tld_wpeti_intent_animation', $intent_animation );

	//ADD NOUNCE FIELD FOR SECURITY

}

function add_tweet_intent(){

	static $has_run = 'no';

	if ( $has_run == 'no' ){


		//	$active = get_field('add_inline_tweet');

		//	if ( $active == "yes" ){

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
			//SANITIZE
			$tld_wpeti_fr_intent_mask = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_mask', true ) );
			$tld_wpeti_fr_intent_text = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_text', true ) );
			$tld_wpeti_fr_intent_text = rawurlencode( $tld_wpeti_fr_intent_text );
			$after_paragraph = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_paragraph', true ) );
			$tld_wpeti_fr_animation = esc_attr( get_post_meta( get_the_ID(), 'tld_wpeti_intent_animation', true ) );
			$tld_wpeti_fr_animation .= " animated";
			$tld_wpeti_fr_animation .= " infinite";

		$tweet_container = '
		<div id="tld-tweet-container" class="'.$tld_wpeti_fr_animation.'">
		<a id="tld-tweet-text" href="https://twitter.com/intent/tweet?text='.$tld_wpeti_fr_intent_text.'" target="_blank">Tweet: '.$tld_wpeti_fr_intent_mask.'

		<div id="tld-tweet-icon-container"><img id="tld-tweet-icon-img" src="" alt="" /></div>

		</a>
		</div>';

		if ( (is_single() && ! is_admin()) ) {
			echo tld_insert_after_paragraph( $tweet_container, $after_paragraph, $content );
		}
	}
	$has_run = 'yes';
}
}
//}

?>
