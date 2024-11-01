<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11"> 
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<style type="text/css" media="screen">
	/* To accomodate differing install paths of WordPress, images are referred only here,
	and not in the wp-layout.css file. If you prefer to use only CSS for colors and what
	not, then go right ahead and delete the following lines, and the image files. */
	body { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/body.jpg"); }	
	<?php /* Checks to see whether it needs a sidebar or not */ if ((! $withcomments) && (! is_single())) { ?>
		#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/bg.jpg") repeat-y top center; border: none; }
	<?php } else { // No sidebar ?>
		#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/bg.jpg") repeat-y top center; border: none; } 
	<?php } ?>
	#header { background: #7C8D94 url("<?php bloginfo('stylesheet_directory'); ?>/images/header.jpg") no-repeat top center; border: none;}
	#footer { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/footer.jpg") no-repeat bottom center; border: none;}
	#cuerpo { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/content.jpg") no-repeat top center; border: none;}

	/* Because the template is slightly different, size-wise, with images, this needs to be set here
	If you don't want to use the template's images, you can also delete the following two lines. */
	#header 	{ margin: 0 !important; margin: 0 0 0 1px; padding: 1px; height: 398px; width: 758px; }
	#headerimg 	{ margin: 7px 9px 0; height: 20px; width: 740px; } 
	
      </style>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/myFunctions.js" type="text/javascript" ></script>
<script type="text/javascript">
	imgLoading = '<?php bloginfo("stylesheet_directory"); ?>/images/loading.gif';
	urlComments = '<?php bloginfo("stylesheet_directory");  ?>/php/comments_ajax.php';
	urlSearch = '<?php bloginfo("stylesheet_directory");  ?>/php/search_ajax.php';
	urlImages = '<?php bloginfo("stylesheet_directory"); ?>/images/';
</script>



<?php wm_head(); ?>
<?php wp_head(); ?>
</head>
<body>

<div id = "popup" style="width:80%; height:92%; Z-INDEX: 999; LEFT: 50px; border: #00008B 3px solid; POSITION: absolute; TOP: 28px; visibility:hidden;">
<iframe  id="myFrame"  frameborder="0"  vspace="0"  hspace="0"  marginwidth="0"  marginheight="0"
                  width="100%" height="100%" style="margin-top: 0px; Z-INDEX: 999; visibility:hidden;">
</iframe>
<div id = "title"></div>
<div id = "iClose" > 
   <a href="#" onClick="HideWebSite();return false">[Close Window]</a>&nbsp;<br />
</div>
</div>

<div id="page">

<div id="header">

	<div id="headerimg">
<div id="map"></div>

		<h1><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>
</div>
<hr />
