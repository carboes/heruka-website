<?php get_header(); ?>
<div id="primary">
  <div id="content" role="main">
    <article class="hentry">
      <?php
        //TODO: Forceful get post.
        global $post;
        $postid = url_to_postid( $_SERVER['REQUEST_URI'] );
        $post = get_post( $postid);
      ?>
      <header class="entry-header">
        <?php $venuename = get_post_meta(get_the_ID(), 'wpcf-venue-name', true); ?>
        <h1 class="entry-title">
          <?php if (empty($venuename)) { ?>
            <span>Meditation classes in</span>
          <?php } else { ?>
            <span>Meditation classes at <strong><?php echo $venuename; ?></strong> in</span>
          <?php } ?>
          <strong><?php the_title(); ?></strong>
          <?php echo get_secondary_title() ? '& <strong>'.get_secondary_title().'</strong>' : ''; ?>
        </h1>
      </header>

      <div class="entry-content">
         <?php echo do_shortcode("[GP_branch_root]  ".get_the_content($postid)."[/GP_branch_root]"); ?>
      </div>
    </article>
  </div><!-- #content -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>