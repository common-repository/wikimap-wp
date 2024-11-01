<?php 
if (empty($wp)) {
  require_once('wp-config.php');
  wp('feed=atom');
}
header('Content-type: application/atom+xml;charset=' . get_settings('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_settings('blog_charset').'"?'.'>'; 
?>
<feed xmlns="http://www.w3.org/2005/Atom"
      xmlns:thr="http://purl.org/syndication/thread/1.0"
      xml:base="<?php is_single() ? permalink_single_rss() : bloginfo_rss("url") ?>">
<?php
$i = 0;
if (have_posts()) :
  while (have_posts()) : the_post();
	if ($i < 1) {
		$i++;
?>
	<id><?php (is_single()) ? permalink_single_rss() : bloginfo_rss("url") ?></id>
	<title type="html"><![CDATA[<?php if (is_single() || is_page()) { echo "Comments on: "; the_title_rss(); } else { bloginfo_rss("name"); echo " Comments"; } ?>]]></title>
  <updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT')); ?></updated>
	<link rel="self" href="<?php echo(comments_rss())  ?>" />
  <link href="<?php (is_single()) ? permalink_single_rss() : bloginfo_rss("url") ?>" />   
  <author>
    <name><?php the_author() ?></name>
  </author>
	<generator uri="http://wordpress.org/" version="<?php bloginfo_rss('version'); ?>">WordPress</generator>

<?php 
		if (is_single() || is_page()) {
			$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_author_email, 
			comment_author_url, comment_date, comment_content, comment_post_ID, 
			$wpdb->posts.ID, $wpdb->posts.post_password FROM $wpdb->comments 
			LEFT JOIN $wpdb->posts ON comment_post_id = id WHERE comment_post_ID = '$id' 
			AND $wpdb->comments.comment_approved = '1' AND ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_status = 'page') 
			AND post_date < '".date("Y-m-d H:i:59")."' 
			ORDER BY comment_date " );
		} else { // if no post id passed in, we'll just ue the last 10 comments.
			$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_author_email, 
			comment_author_url, comment_date, comment_content, comment_post_ID, 
			$wpdb->posts.ID, $wpdb->posts.post_password FROM $wpdb->comments 
			LEFT JOIN $wpdb->posts ON comment_post_id = id WHERE $wpdb->posts.post_status = 'publish' 
			AND $wpdb->comments.comment_approved = '1' AND post_date < '".date("Y-m-d H:i:s")."'  
			ORDER BY comment_date DESC LIMIT " . get_settings('posts_per_rss') );
		}
	// this line is WordPress' motor, do not delete it.
		if ($comments) {
			foreach ($comments as $comment) {
?>
	<entry>
    <id><?php comment_link() ?></id>
    <updated><?php echo comment_time('Y-m-d\TH:i:s\Z'); ?></updated>
		<title type="html"><![CDATA[Comment by: <?php echo comment_author_rss() ?>]]></title>
	  <author>
<?php
$author = $comment->comment_author;
if ($author == "") {
  $author = "Anonymous";
}
  echo("<name><![CDATA[".$author."]]></name>");

if ($comment->comment_author_url != "") {
	echo("<uri>$comment->comment_author_url</uri>");
}
?>
		</author>
		<link href="<?php comment_link() ?>" />
		<thr:in-reply-to ref="<?php bloginfo_rss('home') ?>/?p=<?php echo $comment->comment_post_ID;?>" href="<?php bloginfo_rss('home') ?>/?p=<?php echo $comment->comment_post_ID;?>" type="application/xhtml+xml" source="<?php bloginfo_rss('home') ?>/wp-atom.php"/> 
		<link rel="related" type="text/html" href="<?php bloginfo_rss('home') ?>/?p=<?php echo $comment->comment_post_ID;?>" />
			<?php 
			if (!empty($comment->post_password) && $_COOKIE['wp-postpass'] != $comment->post_password) {
			?>
		<summary>Protected Comments: Please enter your password to view comments.</summary>
		<content type="html"><![CDATA[<?php echo get_the_password_form() ?>]]></content>
			<?php
			} else {
			?>
		<summary type="html"><![CDATA[<?php comment_text_rss() ?>]]></summary>
		<content type="html"><![CDATA[<?php comment_text() ?>]]></content>
			<?php 
			} // close check for password 
			?>
	</entry>
<?php 
			}
		}
	}
endwhile; endif;
?>
</feed>
