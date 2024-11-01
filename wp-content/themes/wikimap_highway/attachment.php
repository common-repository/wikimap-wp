<?php get_header(); ?>

<div id="cuerpo">
	<div id="content" class="widecolumn">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="navigation">
			<div class="alignleft">&nbsp;</div>
			<div class="alignright">&nbsp;</div>
		</div>

		<?php $attachment_link = get_the_attachment_link($post->ID, true, array(450, 800));  ?>
		<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment';  ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="entrytext">
				<p class="<?php echo $classname; ?>"><?php echo $attachment_link; ?><br /><?php echo basename($post->guid); ?></p>

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
	
				<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
	
				<p class="postmetadata alt">
					<small>
						Esta entrada fue publicada el <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						y est&aacute; clasificada en la categoria <?php the_category(', ') ?>.
						Puede hacer un seguimiento de los comentarios de esta entrada gracias al feed <?php comments_rss_link('RSS 2.0'); ?>.
				
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							Puede <a href="#respond">dejar un comentario</a>, o hacer un <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> desde su sitio web.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.			
						
						<?php } edit_post_link('Edite esta entrada.','',''); ?>
						
					</small>
				</p>
	
			</div>
		</div>
		
	<?php comments_template(); ?>
	
	<?php endwhile; else: ?>
	
		<p>Lo sentimos, no hemos encontrado entradas relacionadas.</p>
	
<?php endif; ?>
	
	</div>


<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
