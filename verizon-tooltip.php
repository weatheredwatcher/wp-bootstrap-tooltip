<?php
/*
Plugin Name: Verizon Tooltip
Plugin URI: http://paceco.com
Description: An easy method of creating tooltip code in posts
Version: 2.0
Author: David Duggins
Author URI: http://weatheredwatcher.com
License: GPL2
*/

/*  Copyright 2012 David Duggins  (email : weatheredwatcher@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



// add the shortcode handler for tooltips
function addTooltips($atts, $content = null) {
   
    //declaring the variables to prevent errors/notices.

    $id="";
    $url="";
    $image="";
    $button="";
    $category="";
    $title="";
    $text="";

        if(isset($atts['id'])){
         $id = $atts['id'];
         $tooltip = get_post($id);
         
          $url = $tooltip->guid;
          if(has_post_thumbnail($id)){
            $image =  wp_get_attachment_url(get_post_thumbnail_id($id));
          }
          
          if(isset($atts['label'])) {
            $button = $atts['label'];
            } else $button = "Learn More"; //default label
            
            
          $category = strip_tags( get_the_term_list( $id, 'section', '', ', ', '' ) );
          
          $title = $tooltip->post_title;
          $text = $tooltip->post_excerpt;
        }

          if(isset($atts['url'])) {
            $url = $atts['url'];
            } 
          
          if(isset($atts['image'])) {
            $image = $atts['image'];
            } 
                
          if(!strlen($image)){
            $device = MachDevice::GetDevice($id);
            $image = $device->get_image('thumb');
             }
            
              
          

          if(isset($atts['category'])) {
            $category = $atts['category'];
            } 

          if(isset($atts['title'])) {
            $title = $atts['title'];
            } 
          
          if(isset($atts['text'])) {
            $text = $atts['text'];
            } 

            
            
            
          $html = <<<POP


           <a href="$url" rel="popover" data-content="<img src='$image' /><div class='popover-txt'><p class='popover-cat'>$category</p><a href=$url><h4>$title</h4></a>$text</div><a class='red-btn' href='$url' target='_blank'>$button</a>" >$content</a>


POP;
        
        
        return $html;
}


add_shortcode('tooltip', 'addTooltips');

function add_tooltips_button() {

     add_filter("mce_external_plugins", "add_tooltip_tinymce_plugin");
     add_filter('mce_buttons', 'register_tooltip_button');
}

function register_tooltip_button($buttons) {
   array_push($buttons, "|", "vz_tooltip");
   return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_tooltip_tinymce_plugin($plugin_array) {
  $plugin_array['vz_tooltip'] = plugins_url('', __FILE__).'/editor_plugin.js';
   return $plugin_array;
}

//function my_refresh_mce($ver) {
//  $ver += 3;
//  return $ver;
//}





// init process for button control
add_filter( 'tiny_mce_version', 'my_refresh_mce');
add_action('init', 'add_tooltips_button');
//