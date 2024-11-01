<?php
//
// Options page
//

function wm_options_page() {

global $wpdb;
$table_name = $wpdb->prefix . "wm_overlays";

if ($_POST[sql]) {
$wpdb->show_errors();
$overlays = wm_get_option_overlays();

	foreach ($overlays as $overlay) {
 		$current = $_POST[str_replace(" ", "_", $overlay)];
 
 
    	$result = $wpdb->query("
	   	UPDATE ".$table_name."
 	   	SET marker_picture = '".$current."'
	   	WHERE overlay_name = '".$overlay."'
	   	");
	}
 
 
 if ($_POST['wm_lat']) { update_option('wm_lat', $_POST['wm_lat']);}
 if ($_POST['wm_lon']) { update_option('wm_lon', $_POST['wm_lon']);}
 if ($_POST['wm_zoom']) { update_option('wm_zoom', $_POST['wm_zoom']);}
 
 if ($_POST['wm_google_api_key']) { update_option('wm_google_api_key', $_POST['wm_google_api_key']);}
 if ($_POST['wm_yahoo_api_key']) { update_option('wm_yahoo_api_key', $_POST['wm_yahoo_api_key']);}
 if ($_POST['wm_multimap_api_key']) { update_option('wm_multimap_api_key', $_POST['wm_multimap_api_key']);}
 
 
 
 $new_def_layers = array();
 
 if ($_POST['wm_google'] == true) {array_push ($new_def_layers, 'google');}
 if ($_POST['wm_googles'] == true) {array_push ($new_def_layers, 'googles');}
 if ($_POST['wm_googleh'] == true) {array_push ($new_def_layers, 'googleh');}
 if ($_POST['wm_yahoo'] == true) {array_push ($new_def_layers, 'yahoo');}
 if ($_POST['wm_multimap'] == true) {array_push ($new_def_layers, 'multimap');}
 if ($_POST['wm_virtualearth'] == true) {array_push ($new_def_layers, 'virtualearth');}
 if ($_POST['wm_metacarta'] == true) {array_push ($new_def_layers, 'metacarta');}
  
 update_option('wm_baselayers', $new_def_layers);
 
 
 }

// start the form
echo '<div class="wrap">';

echo "<h2>WikiMap options</h2>";


  echo '<form method="post" action="'.basename($PHP_SELF).'">';

// initial map display
echo '<fieldset class="options">
<legend>Initial map display</legend>
<p>Define initial center and zoom of the map <a href="http://openlayers.org/dev/examples/lonlatfrompx.html" target="_blank" >[1]</a>.</p>';
echo '<table width="100%" cellspacing="2" cellpadding="5" class="editform">'; 

echo '<tr valign="top"><th scope="row">Latitude: </th>';
echo '<td><input type="text" name="wm_lat" value="'.get_option('wm_lat').'" /></td></tr>';
echo '<tr valign="top"><th scope="row">Longitude: </th>'; 
echo '<td><input type="text" name="wm_lon" value="'.get_option('wm_lon').'" /></td></tr>';
echo '<tr valign="top"><th scope="row">Zoom: </th>';
echo '<td><input type="text" name="wm_zoom" value="'.get_option('wm_zoom').'" /></td></tr>'; 

echo "</table></fieldset>";


// baselayers on/off
$def_layers = get_option('wm_baselayers');

echo '<fieldset class="options">
<legend>Baselayers</legend>
<p>Choose which baselayers you want to be available.</p>';
echo '<table width="100%" cellspacing="2" cellpadding="5" class="editform">'; 

echo '<label for="rich_editing">
<input name="wm_yahoo" id="wm_yahoo" value="true" ';
if (in_array('yahoo', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Yahoo base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_google" id="wm_google" value="true" ';
if (in_array('google', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Google base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_googles" id="wm_googles" value="true" ';
if (in_array('googles', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Google satelite base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_googleh" id="wm_googleh" value="true" ';
if (in_array('googleh', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Google hybrid base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_multimap" id="wm_multimap" value="true" ';
if (in_array('multimap', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Multimap base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_virtualearth" id="wm_virtualearth" value="true" ';
if (in_array('virtualearth', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Virtualearth base layer</label><br>';
echo '<label for="rich_editing">
<input name="wm_metacarta" id="wm_metacarta" value="true" ';
if (in_array('metacarta', $def_layers)) {echo 'checked="checked" ';}
echo 'type="checkbox">
Metacarta base layer</label><br>';
 
echo "</table></fieldset>";

// set api keys

echo '<fieldset class="options">
<legend>API keys</legend>
<p>Define API keys of map services.</p>';
echo '<table width="100%" cellspacing="2" cellpadding="5" class="editform">'; 

echo '<tr valign="top"><th scope="row">Google API key: </th>';
echo '<td><input type="text" name="wm_google_api_key" value="'.get_option('wm_google_api_key').'" /></td><td><a href="http://www.google.com/apis/maps/" target="blank">Get one</a></td></tr>';
echo '<tr valign="top"><th scope="row">Yahoo API key: </th>'; 
echo '<td><input type="text" name="wm_yahoo_api_key" value="'.get_option('wm_yahoo_api_key').'" /></td><td><a href="http://api.search.yahoo.com/webservices/register_application" target="blank">Get one</a></td></tr>';
echo '<tr valign="top"><th scope="row">Multimap API key </th>';
echo '<td><input type="text" name="wm_multimap_api_key" value="'.get_option('wm_multimap_api_key').'" /></td><td><a href="http://www.multimap.com/share/api_demos/" target="blank">Info</a></td></tr>'; 
// echo '<tr valign="top"><th scope="row">Virtualearth API key </th>';
// echo '<td><input type="text" name="wm_zoom" value="'.get_option('wm_virtualearth_api_key').'" /></td></tr>'; 


echo "</table></fieldset>";

// set overlay pictures

echo '<fieldset class="options">
<legend>Overlay pictures</legend>
<p>Define url for marker pictures per overlay (i.e. "Other: /wordpress/wp-content/upload/donut.png" or "My Houses: http://www.celiba-club.com/images/catimage/La-vie-des-membres.png").</p>';
echo '<table width="100%" cellspacing="2" cellpadding="5" class="editform">'; 

 
 $single_overlays = array();
 $overlays = wm_get_option_overlays();
 $overlay_pics = $wpdb->get_results("SELECT overlay_name, marker_picture FROM ".$table_name );

  foreach ($overlays as $overlay) {
  $overlay_pic = $wpdb->get_var("SELECT marker_picture FROM ".$table_name." WHERE overlay_name = '".$overlay."'");
    echo '<tr valign="top">
<th scope="row">'.$overlay.': </th><td><input type="text" name="'.str_replace(" ", "_", $overlay).'" value="'.$overlay_pic.'" /></td><td><img src="'.$overlay_pic.'" /></td>
</tr>';
}

echo "</table></fieldset>";


//end the form
echo "<p class=\"submit\"><input type=\"hidden\" name=\"sql\" value=\"true\" /><input type=\"submit\" name=\"Submit\" value=\"Update Options &raquo;\" /></p></form>";

echo '</div>';
}

//
// Add option page
//

function mt_add_pages() { // mt_add_pages() is the sink function for the 'admin_menu' hook
    // Add a new menu under Options:
    add_options_page('WikiMap', 'WikiMap', 8, _FILE_, 'wm_options_page');
                         }

?>
