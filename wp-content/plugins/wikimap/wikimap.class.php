<?php

//
// PHP TAGS FOR USE IN TEMPLATE
//

function wm_config($show) { // show configuration variables independently

global $google_api_key;
global $yahoo_api_key;
global $multimap_api_key;

if ($show == "google_api_key") {echo $google_api_key;}
if ($show == "yahoo_api_key") {echo $yahoo_api_key;}
if ($show == "multimap_api_key") {echo $multimap_api_key;}

}

//show the code that should be in the head of the page
function wm_head () {

 global $google_api_key;
 global $yahoo_api_key;
 global $multimap_api_key;
 global $def_layers;
 
 $gmap = 0;

  foreach($def_layers as $layer) {
 
   if (($layer == "google" || $layer == "googles" || $layer == "googleh") && $gmap != 1 ) {
   echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=';
   wm_config('google_api_key');
   echo '" type="text/javascript"></script>';
   $gmap = 1;
   }
   
   if ($layer == "yahoo" ) {
   echo '<script src="http://api.maps.yahoo.com/ajaxymap?v=3.0&appid=';
   wm_config('yahoo_api_key');
   echo '" type="text/javascript"></script>';
   }

   if ($layer == "multimap" ) {
   echo '<script src="http://clients.multimap.com/API/maps/1.1/';
   wm_config('multimap_api_key');
   echo '" type="text/javascript"></script>';
   }

   if ($layer == "virtualearth" ) {
   echo '<script src="http://dev.virtualearth.net/mapcontrol/v3/mapcontrol.js';
   echo '" type="text/javascript"></script>';
   }
 }   


echo '<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script  id="clientEventHandlersJS"  language="javascript">
<!--
function ShowWebSite(target, title)
{
      title = title;
      document.all.myFrame.src=target;
      document.all.title.innerHTML=title;
      document.all.myFrame.style.visibility="visible";
	document.all.popup.style.visibility="visible";
}

function Button1_onclick() {
var v = document.all("txtWebSite").value;
ShowWebSite(v);
}

function HideWebSite()
{
      document.all.myFrame.style.visibility="hidden";
	document.all.popup.style.visibility="hidden";
	document.all.myFrame.src="wp-content/plugins/wikimap/please_wait.html";
      document.all.title.innerHTML= "";
}

//-->
</script>';
}

// show map
function wm_map () {

start_map();

echo "var map = new OpenLayers.Map('map', {controls: [new OpenLayers.Control.PanZoom()]});
    map.addControl(new OpenLayers.Control.MouseToolbar());
    var ls = new OpenLayers.Control.LayerSwitcher();
    map.addControl(ls);\n";
    
default_layers ($def_layers);
wm_get_layers();

add_layer_markers ("markers", "Markers", "New Markers", "", "" );
// add_layer_markers ("georss", "GeoRSS", "GeoRSS layer", "wp-content/plugins/wikimap/markers.georss.w3c.php", "" ); 

end_map ();

 }

// show menu
function wm_menu_top() {
echo '
<div id="loginlink">
     <ul>';
wp_register();
wp_meta(); 
echo '     </ul>
</div>';
}

//
// FUNCTIONS
//

// hacked wp content functions
function wm_the_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = wm_get_the_content($more_link_text, $stripteaser, $more_file);
remove_filter('the_content','wptexturize');
remove_filter('the_content','wpautop');
      $content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
}


function wm_get_the_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	global $id, $post, $more, $single, $withcomments, $page, $pages, $multipage, $numpages;
	global $preview;
	global $pagenow;
	$output = '';

	if ( !empty($post->post_password) ) { // if there's a password
		if ( stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) != $post->post_password ) {	// and it doesn't match the cookie
			$output = get_the_password_form();
			return $output;
		}
	}

	if ( $more_file != '' )
		$file = $more_file;
	else
		$file = $pagenow; //$_SERVER['PHP_SELF'];

	if ( $page > count($pages) ) // if the requested page doesn't exist
		$page = count($pages); // give them the highest numbered page that DOES exist

	$content = $pages[$page-1];
	$content = explode('<!--more-->', $content, 2);
	if ( (preg_match('/<!--noteaser-->/', $post->post_content) && ((!$multipage) || ($page==1))) )
		$stripteaser = 1;
	$teaser = $content[0];
	if ( ($more) && ($stripteaser) )
		$teaser = '';
	$output .= $teaser;
	if ( count($content) > 1 ) {
		if ( $more )
			$output .= '<a id="more-'.$id.'"></a>'.$content[1];
		else
			$output .= ' <a href="#" onClick="ShowWebSite(\''. get_permalink() . '#more-' . $id . '\', \'\');return false">'. $more_link_text . '</a>';
	}
	if ( $preview ) // preview fix for javascript bug with foreign languages
		$output =	preg_replace('/\%u([0-9A-F]{4,4})/e',	"'&#'.base_convert('\\1',16,10).';'", $output);

	return $output;
}

//
// MAP BUILDING
//

function add_layer ($name, $type, $title, $url, $extra) {
global $layerorder;
echo "var ".$name." = new OpenLayers.Layer.".$type."(\"".$title."\"";
if ($url) { echo ", \"".$url."\""; }
if ($extra) { echo ", ".$extra; }
echo ");\n";
if ($layerorder != "map.addLayers([" ) { $layerorder .= ","; }
$layerorder .= $name;
}

function add_layer_markers ($name, $type, $title, $url, $extra) {
global $layerorderm;
echo "var ".$name." = new OpenLayers.Layer.".$type."(\"".$title."\"";
if ($url) { echo ", \"".$url."\""; }
if ($extra) { echo ", ".$extra; }
echo ");\n";
if ($layerorderm != "map.addLayers([" ) { $layerorderm .= ","; }
$layerorderm .= $name;
}

function default_layers ($layers) {
global $layerorder;
global $def_layers;
$x = 0;
$y = (count($def_layers)) -  1;

$layer="";

foreach($def_layers as $layer) {
 
 if ($layer == "google") {
   add_layer ($layer, "Google", "Google Map", "", "");
   
 }   
 
 if ($layer == "googles") {
  add_layer ($layer, "Google", "Google Satellite", "",  "{ type: G_SATELLITE_MAP }");
  }
 
 if ($layer == "googleh") {
  add_layer ($layer, "Google", "Google Hybrid", "", "{ type: G_HYBRID_MAP }"); }

 if ($layer == "yahoo") {
  add_layer ($layer, "Yahoo", "Yahoo Map", "", ""); }
 if ($layer == "multimap") {
  add_layer ($layer, "MultiMap", "MultiMap", "", ""); }
 if ($layer == "virtualearth") {
  add_layer ($layer, "VirtualEarth", "VirtualEarth", "", ""); }

 if ($layer == "metacarta") {
  add_layer ($layer, "WMS", "Metacarta", "http://labs.metacarta.com/wms/vmap0", "{layers: 'basic'}" ); }

$x++;
                                }
return $layerorder;
                                     }

function start_map() {
global $layerorder;
global $layerorderm;
$layerorder = "map.addLayers([";
$layerorderm = "map.addLayers([";
echo "<script defer=\"defer\" type=\"text/javascript\">\n";
}

function end_map() {

global $layerorder, $lat, $lon, $zoom, $layerorderm;
$layerorder .= "]);\n";
$layerorderm .= "]);\n";
echo $layerorder;
echo $layerorderm;
echo "map.events.register(\"click\", map, function(e) {
      markers.addMarker(new OpenLayers.Marker(this.getLonLatFromPixel(e.xy)));
	var lonlat= map.getLonLatFromPixel(e.xy);
	var website = \"wp-admin/post.php?Lat=\" + lonlat.lat + \"&Lon=\" + lonlat.lon + \"&Overlay=Other\";
	ShowWebSite(website, 'Add a location to');
    });

    document.all.myFrame.src='wp-content/plugins/wikimap/please_wait.html';";
	center_map ($lat, $lon, $zoom);
echo "</script>\n";
}

function center_map ($lon, $lat, $zoom) {
echo "map.setCenter(new OpenLayers.LonLat(".$lon.", ".$lat."), ".$zoom.");\n";
}

// get overlay names from options table and return array
function wm_get_option_overlays() {
global $wpdb;
$option_overlays = array();

$overlays = $wpdb->get_col("SELECT meta_value
	FROM $wpdb->postmeta
	WHERE meta_key = 'overlay'
	ORDER BY meta_value");

foreach ($overlays as $overlay) {
  if (!in_array($overlay, $option_overlays)){ 
  
array_push($option_overlays, $overlay);
} 
}
return ($option_overlays);
}




//////
function wm_get_layers() {

$overlays = wm_get_option_overlays();

foreach ($overlays as $overlay) {
   
  add_layer_markers (str_replace(" ", "_", $overlay), "Text", $overlay, "", "{ location:\"wp-content/plugins/wikimap/markers.txt.php?Overlay=".str_replace(" ", "_", $overlay)."\"}" );
}
}

// replaces original wp feed with atom 1.0 georss feed
function redirect_feeds()
{
  global $post, $posts, $wpdb, $id, $comment;

  if (is_feed()) {
    if (is_single()) {
      require(ABSPATH . '/wp-content/plugins/wikimap/wp-atom10-comments.php');
    }
    else {
      require(ABSPATH . '/wp-content/plugins/wikimap/wp-atom10.php');
    }
    exit;
  }
}

?>