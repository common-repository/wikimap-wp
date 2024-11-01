<?php

if (empty($wp)) {
	require_once('../../../wp-config.php');
	wp('feed=rss2');
}

echo "point\ttitle\tdescription\ticonSize\n";

$items_count = 0;
  if ($posts) {
      foreach ($posts as $post) {
          start_wp();
          if ((get_post_meta($post->ID, 'Lat') &&  get_post_meta($post->ID, 'Lon') && str_replace(" ", "_", get_post_meta($post->ID, 'Overlay', 'true')) == $_GET['Overlay']) || (get_post_meta($post->ID, 'Lat') &&  get_post_meta($post->ID, 'Lon') && !$_GET['Overlay']) ) {
             echo get_post_meta($post->ID, 'Lat', 'true').",".get_post_meta($post->ID, 'Lon', 'true');
             echo "\t<div id=\"wmtitle\">";
             echo the_title();
             echo "</div>\t<div id=\"wmcontent\">";
             echo wm_the_content('more &raquo;');
             echo "</div>\t21,25\n";
}
      $items_count++;
      if (($items_count == 9999 ) && empty($m)) { break; }
}
}

?>