<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11"> 
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wm_head(); ?>
<?php wp_head(); ?>
</head>
<body>
<div style="width:100%; height:100%; " id="map"></div>
<div id = "popup" style="width:80%; height:92%; Z-INDEX: 999; LEFT: 50px; border: #00008B 3px solid; POSITION: absolute; TOP: 28px; visibility:hidden;">
<iframe  id="myFrame"  frameborder="0"  vspace="0"  hspace="0"  marginwidth="0"  marginheight="0"
                  width="100%" height="100%" style="margin-top: 0px; Z-INDEX: 999; visibility:hidden;">
</iframe>
<div id = "title"></div>
<div id = "iClose" > 
   <a href="#" onClick="HideWebSite();return false">[Close Window]</a>&nbsp;<br />
</div>
</div>