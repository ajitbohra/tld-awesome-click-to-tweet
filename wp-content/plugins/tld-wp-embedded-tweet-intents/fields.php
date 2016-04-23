<?php
include_once('advanced-custom-fields/acf.php');
define( 'ACF_LITE', true );
if(function_exists("register_field_group"))
{
  register_field_group(array (
  'id' => 'acf_tweet-intent',
  'title' => 'Tweet Intent',
  'fields' => array (
  array (
  'key' => 'field_56f2b414d4187',
  'label' => 'Add Inline Tweet',
  'name' => 'add_inline_tweet',
  'type' => 'radio',
  'instructions' => 'Choose whether you want to add a tweet message on this post. Do not add a tweet message if this post makes use of a shortcode.',
  'choices' => array (
  'yes' => 'Yes',
  'no' => 'No',
),
'other_choice' => 0,
'save_other_choice' => 0,
'default_value' => 'no',
'layout' => 'horizontal',
),
array (
'key' => 'field_56c51413198bd',
'label' => 'Tweet text',
'name' => 'tweet_text',
'type' => 'text',
'instructions' => 'This is the text you want to show visitors, it is the text for the tweet shown on the post.',
'required' => 1,
'conditional_logic' => array (
'status' => 1,
'rules' => array (
array (
'field' => 'field_56f2b414d4187',
'operator' => '==',
'value' => 'yes',
),
),
'allorany' => 'all',
),
'default_value' => '',
'placeholder' => '',
'prepend' => '',
'append' => '',
'formatting' => 'none',
'maxlength' => '',
),
array (
'key' => 'field_56c4bc73120f7',
'label' => 'Tweet Msg',
'name' => 'tweet_msg',
'type' => 'text',
'instructions' => 'Enter tweet message, you can also include hashtags or a link. It is the actual message which goes to twitter.',
'required' => 1,
'conditional_logic' => array (
'status' => 1,
'rules' => array (
array (
'field' => 'field_56f2b414d4187',
'operator' => '==',
'value' => 'yes',
),
),
'allorany' => 'all',
),
'default_value' => '',
'placeholder' => '',
'prepend' => '',
'append' => '',
'formatting' => 'none',
'maxlength' => 140,
),
array (
'key' => 'field_56c4bc9a07c09',
'label' => 'Paragraph',
'name' => 'paragraph',
'type' => 'number',
'instructions' => 'Please enter after which paragraph you would like tweet to be displayed.',
'required' => 1,
'conditional_logic' => array (
'status' => 1,
'rules' => array (
array (
'field' => 'field_56f2b414d4187',
'operator' => '==',
'value' => 'yes',
),
),
'allorany' => 'all',
),
'default_value' => '',
'placeholder' => '',
'prepend' => '',
'append' => '',
'min' => '',
'max' => '',
'step' => '',
),
array (
'key' => 'field_56f58c7319f49',
'label' => 'Tweet Icon',
'name' => 'tweet_icon',
'type' => 'image',
'instructions' => 'Select an image for the tweet icon',
'conditional_logic' => array (
'status' => 1,
'rules' => array (
array (
'field' => 'field_56f2b414d4187',
'operator' => '==',
'value' => 'yes',
),
),
'allorany' => 'all',
),
'save_format' => 'url',
'preview_size' => 'thumbnail',
'library' => 'all',
),
),
'location' => array (
array (
array (
'param' => 'post_type',
'operator' => '==',
'value' => 'post',
'order_no' => 0,
'group_no' => 0,
),
),
),
'options' => array (
'position' => 'normal',
'layout' => 'default',
'hide_on_screen' => array (
),
),
'menu_order' => 0,
));
}


?>
