<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpparallax
 */

get_header(); 
$show_bread = get_theme_mod('wp_parallax_show_post_banner','show');
if($show_bread == 'show'){	
	do_action('wp_parallax_breadcrumb');
}
?>
<div class="wpop-container clearfix">
	<div class="inner-container clearfix">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			
			<?php
			while ( have_posts() ) : the_post();
				do_action('wpparallax_before_single_post');

				get_template_part( 'template-parts/content', 'single' );

				
				do_action('wpparallax_after_single_post');


			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php get_sidebar();?>
	</div>
</div>
<?php

get_footer();
