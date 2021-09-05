<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wpparallax
 */

get_header(); 
$show_bread = get_theme_mod('wp_parallax_show_archive_banner','show');
if($show_bread == 'show'){	
	do_action('wp_parallax_breadcrumb');
}
?>
<div class="wpop-container clearfix">
	<div class="inner-container clearfix">
		<section id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'wpparallax' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
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

				the_posts_navigation();
				echo '</div>';

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->
	<?php
	get_sidebar('right'); ?>

	</div>
</div>
<?php

get_footer();
