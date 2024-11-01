<?php

$def_layers = get_option('wm_baselayers'); // default layers shown on the map (in that order, first one visible) 'google', 'googles', 'googleh', 'yahoo', 'multimap', 'virtualearth', 'metacarta' 

$google_api_key = get_option('wm_google_api_key'); // get api-key at http://www.google.com/apis/maps/
$yahoo_api_key = get_option('wm_yahoo_api_key');
$multimap_api_key = get_option('wm_multimap_api_key'); // get api-key (= clientname) at http://www.multimap.com/share/api_demos/ 
// $virtualearth_api_key = ""; // is not needed? http://msdn.microsoft.com/mappoint/

$lat = get_option('wm_lat');
$lon = get_option('wm_lon');
$zoom = get_option('wm_zoom');

$layerorder = "";

?>