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

		<!-- REMOVE GET OPTIONS FROM THESE INPUTS USE IT WHEN EDITING A SHORTCODE -->
    <table class="form-table">

        <tr valign="top">
        <th scope="row"><?php _e( 'Template Name', 'tld-actt' ) ?></th>
        <td><input type="text" name="tld-tweet-template-name" /></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php _e( 'Tweet box width', 'tld-actt' ) ?></th>
        <td><input type="text" name="tld-tweet-box-width" value="<?php echo esc_attr( get_option('tld-tweet-box-width') ); ?>" />px</td>
        </tr>

				<tr valign="top">
				<th scope="row"><?php _e( 'Height', 'tld-actt' ) ?></th>
				<td><input type="text" name="tld-tweet-box-height" value="<?php echo esc_attr( get_option('tld-tweet-box-height') ); ?>" />px</td>
				</tr>

        <tr valign="top">
        <th scope="row"><?php _e( 'Background color', 'tld-actt' ) ?></th>
        <td><input type="text" name="tld-tweet-bg-color" value="<?php echo esc_attr( get_option('tld-tweet-bg-color') ); ?>" /><small>include # sign</small></td>
        </tr>

    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
