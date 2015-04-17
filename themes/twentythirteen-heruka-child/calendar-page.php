<?php
/*
Template Name: Calendar
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<div class="entry-thumbnail">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
							</div>
						<?php endif; ?>
					</header><!-- .entry-header -->

					<!--<div class="full-calendar" style="clear: both;"></div>-->
					<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=meditateinlondon.org.uk_lumj3dg61gi77a3q174bt7imv0%40group.calendar.google.com&amp;color=%232952A3&amp;src=meditateinlondon.org.uk_aeu138cq8vqfdl21he3s9i1elg%40group.calendar.google.com&amp;color=%23B1440E&amp;src=info%40meditateinlondon.org.uk&amp;color=%2329527A&amp;src=meditateinlondon.org.uk_03m40crkgmfqhv4b42laafiqbg%40group.calendar.google.com&amp;color=%23875509&amp;src=meditateinlondon.org.uk_t6mrs3mmjuf1u0ch0micbfibf8%40group.calendar.google.com&amp;color=%23333333&amp;src=en.uk%23holiday%40group.v.calendar.google.com&amp;color=%2329527A&amp;src=meditateinlondon.org.uk_ongjlf456a1v5mmd476sc155r0%40group.calendar.google.com&amp;color=%232F6309&amp;src=meditateinlondon.org.uk_1krmorbgrd01tgbrbtk025evok%40group.calendar.google.com&amp;color=%235F6B02&amp;ctz=Europe%2FLondon" style=" border-width:0 " width="800px" height="600" frameborder="0" scrolling="no"></iframe>
					
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->

	

<?php get_footer(); ?>