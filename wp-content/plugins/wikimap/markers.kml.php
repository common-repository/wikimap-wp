<?php

if (empty($wp)) {
	require_once('../../../wp-config.php');
	wp('feed=rss2');
}

header('Content-Type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<kml xmlns=\"http://earth.google.com/kml/2.1\">\n";
echo "<Document>\n";

$items_count = 0;
  if ($posts) {
      foreach ($posts as $post) {
          start_wp();
          if ((get_post_meta($post->ID, 'Lat') &&  get_post_meta($post->ID, 'Lon') && str_replace(" ", "_", get_post_meta($post->ID, 'Overlay', 'true')) == $_GET['Overlay']) || (get_post_meta($post->ID, 'Lat') &&  get_post_meta($post->ID, 'Lon') && !$_GET['Overlay']) ) {
             
echo "<Placemark>\n\t<name>";
the_title();
echo "</name>\n\t<description>";
the_content();
echo "</description>\n\t<Point>\n\t\t<coordinates>";
echo get_post_meta($post->ID, 'Lat', 'true');
echo ",";
echo get_post_meta($post->ID, 'Lon', 'true');
echo ",0 </coordinates>\n\t</Point>\n</Placemark>\n";
               }
      $items_count++;
      if (($items_count == 9999 ) && empty($m)) { break; }
}
}

echo "</Document>\n";
echo "</kml>";

?>