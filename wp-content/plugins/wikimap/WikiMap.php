<?php
/*
Plugin Name: WikiMap WP
Plugin URI: http://www.sourceforge.org/projects/wikimap
Description: Add a web 2.0 map to your website.
Author: Robert Buzink
Version: 1.0
Author URI: http://robertbuzink.nl
*/ 

/*
WikiMap
Licensed under the GPL License
Copyright (c)  2006 Robert Buzink

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the
Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software,
and to permit persons to whom the Software is furnished to
do so, subject to the following conditions:

The above copyright notice and this permission notice shall
be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

include_once('wm-config.php');
include_once( 'wikimap.class.php' );
include_once( 'wikimap.options.php' );
include_once( 'wikimap.install.php' );
include_once( 'wikimap.addoverlay.php' );
// include_once( 'openlayers.class.php' );

add_action('admin_menu', 'mt_add_pages');
add_action('template_redirect', 'redirect_feeds');
add_action('activate_wikimap/WikiMap.php','wm_install');
add_action('publish_post', 'wm_addoverlay');
?>