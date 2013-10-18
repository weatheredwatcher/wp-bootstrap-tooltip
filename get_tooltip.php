<?php
//pull in the wordpress enviroment
//set_include_path("http://".$_SERVER['SERVER_NAME']);
include("/var/www/html/vz_eguide_3/wp-load.php");

//echo $_SERVER['SERVER_NAME'];
$post_id = $_GET['postID'];
$tooltip = get_post($post_id);
$title = $tooltip->post_title;
$image = get_the_post_thumbnail($post_id, 'thumbnail');
$text = $tooltip->post_excerpt;


 $id = $atts['id'];
          $tooltip = get_post($id);
         
          $url = $tooltip->guid;
          $image = get_the_post_thumbnail($id, 'thumbnail');
          $button = $atts['label'];
          $category = get_the_category($id);
          $title = $tooltip->title;
        