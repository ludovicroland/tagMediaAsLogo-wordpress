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

define("MEDIA_LOGO_META_KEY", "_tag_media_as_logo");

add_action('add_meta_boxes','add_tag_media_as_logo_metaboxes');
function add_tag_media_as_logo_metaboxes()
{
  load_plugin_textdomain('tag-media-as-logo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
  add_meta_box('tag_media_as_logo', __('Logo', 'tag-media-as-logo'), 'tag_media_as_logo', 'attachment', 'side', 'default');
}

function tag_media_as_logo($post)
{
  $val = get_option(MEDIA_LOGO_META_KEY);
  
  echo '<label for="tag-media-as-logo"><input id="tag-media-as-logo" name="tag-media-as-logo" type="checkbox" value="use"';
  
  if($val == $post->ID)
  {
    echo 'checked';
  }

  echo '/>' . __('Use this media as logo', 'tag-media-as-logo') . '</label>';
}

add_action('edit_attachment','save_tag_media_as_logo_metaboxes');
function save_tag_media_as_logo_metaboxes($post_ID)
{    
  if(isset($_POST['tag-media-as-logo']))
  {
    if(get_option(MEDIA_LOGO_META_KEY) === FALSE)
    {
      add_option(MEDIA_LOGO_META_KEY, $post_ID);
    }
    else
    {
      update_option(MEDIA_LOGO_META_KEY, $post_ID);
    }
  }
  else 
  {
    delete_option(MEDIA_LOGO_META_KEY);
  }
}