<?php
function wm_addoverlay() {

global $wpdb; // $post_ID $post->ID $_POST['id'] $_POST['ID'] doesn't work.
$table_name = $wpdb->prefix . "wm_overlays";
$new_overlay = $_POST['rc_overlay'];

$wpdb->show_errors();
$overlays = $wpdb->get_results("SELECT overlay_name, marker_picture FROM ".$table_name );
$exist = 0;
  foreach ($overlays as $overlay) {
    if ($overlay->overlay_name == $new_overlay) { $exist = 1;}
  }

  if ($exist != 1) { $wpdb->query("
	INSERT INTO ".$table_name." (overlay_name)
	VALUES ('".$new_overlay."')");
  }

}

?>