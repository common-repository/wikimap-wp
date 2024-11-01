<?php
if (empty($wp)) {
   require_once('wp-config.php');
   wp('feed=atom');
}
header('Content-type: application/atom+xml; charset=' . get_settings('blog_charset'), true);
$more = 1;
?>
<?php echo '<?xml version="1.0" encoding="'.get_settings('blog_charset').'"?'.'>'; ?>
<feed
  xmlns="http://www.w3.org/2005/Atom"
  xmlns:thr="http://purl.org/syndication/thread/1.0"
  xmlns:georss="http://www.georss.org/georss" 
  xmlns:gml="http://www.opengis.net/gml"
  xml:lang="<?php echo get_option('rss_language'); ?>"
  xml:base="<?php bloginfo_rss('home') ?>">
  <id><?php bloginfo_rss('atom_url') ?></id>
  <updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT')); ?></updated>
  <title type="text"><?php bloginfo_rss('name') ?></title>
  <subtitle type="text"><?php bloginfo_rss("description") ?></subtitle>
  <link rel="self" type="application/atom+xml" href="<?php bloginfo_rss('rss2_url'); ?>" />
  <link href="<?php bloginfo_rss('home') ?>" />
  <rights type="text">Copyright <?php echo mysql2date('Y', get_lastpostdate('blog')); ?></rights>
  <generator uri="http://wordpress.org/" version="<?php bloginfo_rss('version'); ?>">WordPress</generator>
  <?php $items_count = 0; if ($posts) { foreach ($posts as $post) { start_wp(); ?>
  <entry>
    <id><?php the_guid(); ?></id>
    <title type="html"><![CDATA[<?php the_title_rss() ?>]]></title>
    <updated><?php echo get_post_time('Y-m-d\TH:i:s\Z', true); ?></updated>
    <published><?php echo get_post_time('Y-m-d\TH:i:s\Z', true); ?></published>
    <author>
      <name><?php the_author()?></name>
      <email><?php the_author_email()?></email>
<?php
$author_url = get_the_author_url();
if ($author_url != "" && $author_url != "http://") {
  echo("<uri>$author_url</uri>");
}
?>
    </author>
    <link rel="replies" type="application/atom+xml" href="<?php echo(comments_rss()); ?>" thr:count="<?php comments_number('0', '1', '%', 'number'); ?>"  />
    <link href="<?php permalink_single_rss() ?>" />
<?php foreach(get_the_category() as $category) { ?>
    <category scheme="<?php bloginfo_rss('home') ?>" term="<?php echo $category->cat_name?>" />
<?php } ?>        
    <summary type="html"><![CDATA[<?php the_excerpt_rss(); ?>]]></summary>
<?php if (!get_settings('rss_use_excerpt')) : ?>
  <?php if ( strlen( $post->post_content ) ) : ?>
    <content type="html" xml:base="<?php permalink_single_rss() ?>"><![CDATA[<?php the_content('', 0, '') ?>]]></content>
  <?php else : ?>
    <content type="html" xml:base="<?php permalink_single_rss() ?>"><![CDATA[<?php the_excerpt_rss(); ?>]]></content>
  <?php endif; ?>
<?php else : ?>
    <content type="html" xml:base="<?php permalink_single_rss() ?>"><![CDATA[<?php the_excerpt_rss() ?>]]></content>
<?php endif; ?>
            <georss:where>
   			<gml:Point>
      			<gml:pos><?php echo get_post_meta($post->ID, 'Lat', 'true'); echo " "; echo get_post_meta($post->ID, 'Lon', 'true'); ?></gml:pos>
   			</gml:Point>
		</georss:where>
  
</entry>
  <?php $items_count++; if (($items_count == get_settings('posts_per_rss')) && empty($m)) { break; } } } ?>
</feed>
