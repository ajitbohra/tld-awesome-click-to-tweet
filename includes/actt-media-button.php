<?php

add_action( 'media_buttons', 'actt_media_button' );

function actt_media_button(){

// add check to see if is posts or page not cpt
  $button_title = __('ACTT Shortcode');

  $img = '<span class="wp-media-buttons-icon" id="fca-eoi-media-button"></span>';
  echo '<a href="#TB_inline?width=550&height=600&inlineId=actt-content" id="insert-actt-shortcode" class="button thickbox" title="'. $button_title .'">' . $img . $button_title . '</a>';


  add_thickbox();
?>

<div id= "actt-content" style="display:none">
  <p>Select your shortcode your previously created shortcode below.</p>
  <div>
  <select id="actt-shortcode-id">
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  </select>
  </div>
  <p class="submit">
  <input type="button" id="actt-shortcode-insert" class="button-primary" value="<?php _e("Insert") ?>" >
  <a id="actt-shortcode-cancel" class="button-secondary" onclick="tb_remove();" > <?php _e("Cancel") ?>
  </a>
  </p>
  </div>

<script>
jQuery( function ( $ ) {

$( '#actt-shortcode-insert' ).on( 'click', function(){

var id = $( '#actt-shortcode-id' ).val();

window.send_to_editor('[actt id="' + id + '"]');

});


});
</script>


<?php
}
