<?php

//add ABSPATH and if current user can

// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_options_page('Awesome Click to Tweet', 'ACTT', 'administrator', 'actt', 'my_cool_plugin_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'tld-actt-settings-group', 'tld-tweet-box-width' );
	register_setting( 'tld-actt-settings-group', 'tld-tweet-bg-color' );
	register_setting( 'tld-actt-settings-group', 'tld-tweet-box-height' );
}

function my_cool_plugin_settings_page() {

	?>
	<div class="wrap">
		<h1>Awesome Click to Tweet</h1>

		<form method="post" action="<?php echo plugin_dir_url( __FILE__ )  ?>tld-actt-options.php">
			<?php settings_fields( 'tld-actt-settings-group' ); ?>
			<?php do_settings_sections( 'tld-actt-settings-group' ); ?>

			<div id="tld-actt-settings-wrap">

				<div id="tld-actt-template-fields">
					<ul>
						<span><?php _e( 'Template Name', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-template-name" placeholder="Template 1"/></li>
						<hr>
						<span><?php _e( 'Tweet', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-text" id="tld-tweet-text" placeholder="Lorem Ipsum"/></li>
						<span><?php _e( 'Height', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-height" id="tld-tweet-box-height" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Tweet box width', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-width" id="tld-tweet-box-width" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Background color', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-bg-color" id="tld-tweet-bg-color" value="" placeholder="e.g #000"/></li>
					</ul>
				</div>

				<div id="tld-actt-template-fields">
					<ul>
						<span><?php _e( 'Template Name', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-template-name" placeholder="Template 1"/></li>
						<hr>
						<span><?php _e( 'Tweet', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-text" id="tld-tweet-text" placeholder="Lorem Ipsum"/></li>
						<span><?php _e( 'Height', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-height" id="tld-tweet-box-height" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Tweet box width', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-width" id="tld-tweet-box-width" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Background color', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-bg-color" id="tld-tweet-bg-color" value="" placeholder="e.g #000"/></li>
					</ul>
				</div>

				<div id="tld-actt-template-fields">
					<ul>
						<span><?php _e( 'Template Name', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-template-name" placeholder="Template 1"/></li>
						<hr>
						<span><?php _e( 'Tweet', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-text" id="tld-tweet-text" placeholder="Lorem Ipsum"/></li>
						<span><?php _e( 'Height', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-height" id="tld-tweet-box-height" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Tweet box width', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-box-width" id="tld-tweet-box-width" value="" placeholder="e.g 380px or 50%"/></li>
						<span><?php _e( 'Background color', 'tld-actt' ) ?></span><li><input type="text" name="tld-tweet-bg-color" id="tld-tweet-bg-color" value="" placeholder="e.g #000"/></li>
					</ul>
				</div>

				<div>
					<input type="button" id="somebutton" value="button" onclick="addText()">
				</div>

			</div>

			<div style="float: right;">

				<div id="temp"><p>HUJKM</p></div>
			</div>


			<script>
			// function addText()
			// {
			//     document.getElementById('temp').innerHTML = document.getElementById('tld-tweet-text').value;
			//
			//     document.getElementById('temp').style.height +=  document.getElementById('tld-tweet-box-heightt').value;
			//
			//     document.getElementById('temp').style.width +=  document.getElementById('tld-tweet-box-width').value;
			//     // document.getElementById('temp').style.height =  "100px";
			// 		//
			//     // document.getElementById('temp').style.width =  "305px";
			// 		//
			// 		// document.getElementById('temp').style.backgroundColor =  "#000"
			// 		document.getElementById('temp').style.backgroundColor +=   document.getElementById('tld-tweet-bg-color').value;
			// }
			// jQuery(document).ready(function($) {
			var $ = jQuery.noConflict();
			var width =  $('#tld-tweet-box-width').val();
			var height =  $('#tld-tweet-box-height').val();
			var color =  $('#tld-tweet-bg-color').val();

			// var width =  "432px";
			// var height =  "120px";
			// var color =  "#000";
			function addText() {
				$("#temp p").text($("#tld-tweet-text").val())
				$("#temp").height($('#tld-tweet-box-height').val())
				// $("#temp").css({"background-color" :  color, "width": width });
				$("#temp").css({"background-color" :  $('#tld-tweet-bg-color').val(), "width": $('#tld-tweet-box-width').val()});
			}
			// });
			</script>


		</form>
		<?php submit_button(); ?>
	</div>
	<?php } ?>
