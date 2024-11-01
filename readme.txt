WikiMap-WP 1.0 beta

GENERAL INFORMATION

website: http://wikimap.sourcefirge.net
Author: Robert Buzink (http://robertbuzink.nl post@robertbuzink.nl)

WikiMap is a dynamic ('web 2.0') map that allows you to easily add locations to it. These locations show up on the map as markers. When you click a marker a little infowindow pops up. This infowindow can contain text, images, video, you name it.

WikiMap is based on Openlayers (http://www.openlayers.org) and WordPress (http://www.wordpress.org).


INSTALLATION

1. Install wordpress, if you haven't allready.

2. Copy the files contained in the WikiMap zip-file into your wordpress directory while retaining the folder structure.

3. Go to your WordPress administration panel and activate the wikimap and rc-custom-field-gui plugins under 'Plugins'.

4. Go to your WordPress administration panel and activate the WikiMap fullscreen theme under 'Presentation/Themes'.

5. Open the wm-config.php file in the wp-content/Plugins/wikimap folder and adjust to your liking:

* The base layers that you want on your map (google, yahoo, etc.)
* The api-keys for these layers
* The latitude/longitude values for the initial center of the map display
* The zoom level for the map.

USAGE

After installation, point your browser to your wordpress blog. You should now see a fullscreen map.

Click somewhere on the map to add a location. A window pops up where (after logging in) you can fill in the title and the content of the location you want to add. You can also decide in which overlay the location should show up. Press 'Publish', 'Close window' and refesh the page. You should see your location on the map as a little red marker. Click on it to get the infowindow, click on it again to get rid of the infowindow.

Click on the little blue cross at the right side of the screen to hide/show layers and overlays.

OPTIONS

In the WordPress administration panel, under 'Options/WikiMap', you can configure some aspects of WikiMap.