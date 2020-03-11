<?php
/*
Plugin Name: Tag Media As Logo
Plugin URI: https://github.com/ludovicroland/tagMediaAsLogo-wordpress
Description: Adds a meta box to the media detail page where you can tag the current media as a main logo.
Version: 0.1
Author: Ludovic ROLAND
Author URI: http://www.rolandl.fr/
Text Domain: tag-media-as-logo
Domain Path: /languages
License: MIT License
*/

define("TERMS_OF_USE_META_KEY", "_tag_page_as_terms_of_use");

add_action('add_meta_boxes','add_tag_page_as_terms_of_use_metaboxes');
function add_tag_page_as_terms_of_use_metaboxes()
{
  load_plugin_textdomain('tag-page-as-terms-of-use', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
  add_meta_box('tag_page_as_terms_of_use', __('Terms of use', 'tag-page-as-terms-of-use'), 'tag_page_as_terms_of_use', 'attachment', 'side', 'default');
}

function tag_page_as_terms_of_use($post){
  $val = get_post_meta($post->ID,'_tag_page_as_terms_of_use',true);
  
  echo '<label for="tag-page-as-terms-of-use"><input id="tag-page-as-terms-of-use" name="tag-page-as-terms-of-use" type="checkbox" value="use"';
  
  if($val == 'use')
  {
    echo 'checked';
  }

  echo '/>' . __('Use this page as a Terms of use page', 'tag-page-as-terms-of-use') . '</label>';
}

add_action('save_post','save_tag_page_as_terms_of_use_metaboxes');
function save_tag_page_as_terms_of_use_metaboxes($post_ID){
  if(isset($_POST['tag-page-as-terms-of-use'])){
    update_post_meta($post_ID, TERMS_OF_USE_META_KEY, $_POST['tag-page-as-terms-of-use']);
  }
  else {
    delete_post_meta($post_ID, TERMS_OF_USE_META_KEY);
  }
}