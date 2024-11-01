<?php

function wm_install () {

	global $wpdb;

	$table_name = $wpdb->prefix . "wm_overlays";
	
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

		$sql = "CREATE TABLE ".$table_name." (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		overlay_name VARCHAR(20) NOT NULL,
		marker_picture VARCHAR(100) NOT NULL,
		UNIQUE KEY id (id)
		);";

		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
		dbDelta($sql);

	}

add_option('wm_lat', '13.923403897723347');
add_option('wm_lon', '19.16015625');
add_option('wm_zoom', '2');

add_option('wm_google_api_key');
add_option('wm_yahoo_api_key');
add_option('wm_multimap_api_key', 'metacarta_04');

$def_layers = array('google', 'googles', 'googleh', 'yahoo', 'multimap', 'virtualearth', 'metacarta' );
add_option('wm_baselayers', $def_layers, 'WikiMap baselayers');
add_option('wm_overlays', $overlays, 'WikiMap overlays');


// add_option('wm_google', 'hide', 'WikiMap baselayer' );
// add_option('wm_googles', 'hide', 'WikiMap baselayer' );
// add_option('wm_googleh', 'hide', 'WikiMap baselayer' );
// add_option('wm_yahoo', 'hide', 'WikiMap baselayer' );
// add_option('wm_multimap', 'hide', 'WikiMap baselayer' );
// add_option('wm_virtualearth', 'hide', 'WikiMap baselayer' );
// add_option('wm_metacarta', 'show', 'WikiMap baselayer' );

}

?>