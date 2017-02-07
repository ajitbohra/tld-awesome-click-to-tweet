<?php
// require_once("../../../../wp-load.php");
require( $_SERVER['DOCUMENT_ROOT'].'/wp-load.php' ); //look more into this

global $wpdb;

$my_table = $wpdb->prefix . 'my_table';

//check if the current page is the plugin settings page for greater security

if ( current_user_can( 'administrator' ) ){

  if ( isset( $_POST['tld-tweet-template-name'] )  ){
    $name = $_POST['tld-tweet-template-name'];
  };

  if ( isset( $_POST['tld-tweet-box-width'] )  ){
    $width = $_POST['tld-tweet-box-width'] . 'px;';
  };

  if ( isset( $_POST['tld-tweet-box-height'] )  ){
    $height = $_POST['tld-tweet-box-height'] . 'px;';
  };

  if ( isset( $_POST['tld-tweet-bg-color'] )  ){
    $bg_color = $_POST['tld-tweet-bg-color'];
  };



  $wpdb -> insert(
    $my_table,
    array(

      'name'      => $name,
      'width'     => $width,
      'height'    => $height,
      'bg_color'  => $bg_color

    )

  );

  if ( isset( $_POST['_wp_http_referer']  )  ){
    $go_back = $_POST['_wp_http_referer'];
  };

  // wp_mail ( 'uriahs.victor@gmail.com', 'Hello', $a . $b . $c . $d );

}else{

  die('Ure not an admin!')  ;
  // wp_mail ( 'uriahs.victor@gmail.com', 'Hello', 'Hmm it worked so you can check for permissions' );

}
// $e = $_SERVER['DOCUMENT_ROOT'];

// add check to see if the referrer is set to continue executing MAYBE USE CHECK ADMIN REFERRER

// echo '<script>
// console.log("'.$a.'");
// console.log("'.$b.'");
// console.log("'.$c.'");
// console.log("'.$d.'");
//
// </script>';
// sleep(5);
wp_redirect( $go_back );
// wp_redirect( 'https://example.com/some/page' );

// is_ssl();
?>

<!-- <script>
console.log("<?php echo $a ?>");
console.log("<?php echo $b ?>");
console.log("<?php echo $c ?>");
console.log("<?php echo $d ?>");
console.log("<?php echo $e ?>");
// console.log("<?php echo $referrer ?>");

</script> -->
