<?php

function tld_actt_add_tinymce_button(){
  global $typenow;

  //check permissions

  if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ){
    return;
  }

  //verify post tidy_parse_file

  if ( ! in_array( $typenow, array( 'post', 'page' ) ) )
    return;


  //check if WYSIWYG is enabled

  if ( get_user_option( 'rich_editing' ) == 'true' ){

    add_filter( 'mce_external_plugins', 'tld_actt_add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'tld_actt_register_tinymce_button' );

  }

}
add_action( 'admin_head', 'tld_actt_add_tinymce_button' );




function tld_actt_add_tinymce_plugin( $plugin_array ){

//button script path //change this to plugin dir
$plugin_array['tld_actt_button'] = plugins_url( '../assets/js/button.js?'. time(), __FILE__ );
return $plugin_array;

}

function tld_actt_register_tinymce_button( $buttons ){

array_push( $buttons, 'tld_actt_button');
return $buttons;

}
