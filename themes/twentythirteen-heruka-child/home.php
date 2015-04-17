<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<?php echo do_shortcode('[layerslider id="2"]'); ?>
	<?php if ( is_active_sidebar( 'home-top' ) ) : ?>
		<div class="widget-area home-top">
			<ul><?php dynamic_sidebar( 'home-top' ); ?></ul>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'home-middle' ) ) : ?>
		<div class="widget-area home-middle">
			<ul><?php dynamic_sidebar( 'home-middle' ); ?></ul>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'home-bottom' ) ) : ?>
		<div class="widget-area home-bottom">
			<ul><?php dynamic_sidebar( 'home-bottom' ); ?></ul>
		</div>
	<?php endif; ?>
<?php get_footer(); ?>