<?php get_header(); ?>
<div id="primary">
	<div id="content" role="main">
		<article class="hentry">
			<?php
        	//TODO: Forceful get post.
       			global $post;
        		$postid = url_to_postid( $_SERVER['REQUEST_URI'] );
        		$post = get_post( $postid);
      			$EM_Event = em_get_event($post->ID, 'post_id');
			?>
			<header class="entry-header">
				<h1 class="entry-title"><?php echo $EM_Event->output('#_EVENTNAME'); ?></h1>
				<h2><?php echo get_secondary_title(); ?></h2>

				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
					</div>
				<?php endif; ?>
			</header>

			<div class="entry-content">
				<!--<div class="thumbnail wp-caption alignleft">
				    <?php the_post_thumbnail(); ?>
				    
				    <p class="wp-caption-text">
				      <?php
				        $thumb_id = get_post_thumbnail_id(get_the_ID());
				        $args = array(
				          'p' => $thumb_id,
				          'post_type' => 'attachment'
				          );
				        $thumb_image = get_posts($args);
				        if ($thumb_image && isset($thumb_image[0])) {
				          echo '<span>'.$thumb_image[0]->post_excerpt.'</span>';
				        }
				      ?>
				    </p>
				  </div>-->

			<?php echo $EM_Event->output_single(); ?>
			</div>
		</article>
	</div><!-- #content -->
</div><!-- #primary -->
<?php
	get_sidebar();
	get_footer();
?>