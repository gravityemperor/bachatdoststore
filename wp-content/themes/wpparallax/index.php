<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpparallax
 */

get_header(); 
do_action('wp_parallax_breadcrumb');
?>
<div class="wpop-container clearfix">
	<div class="inner-container clearfix">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						$show_title = get_theme_mod('wp_parallax_show_archive_title','show');
						if($show_title == 'show'){
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						}
					?>
				</header><!-- .page-header -->

				<?php $layout = get_theme_mod('wp_parallax_archive_layout','grid');?>
				<div class="archive-wrap clearfix <?php echo esc_attr($layout);?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					echo '<div class="wplx-archive-'.esc_attr($layout).'">';
					get_template_part( 'template-parts/content', get_post_format() );
					echo '</div>';

				endwhile;

				echo '</div>';

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	<?php get_sidebar(); ?>
	</div>
</div> 
<?php
get_footer();
