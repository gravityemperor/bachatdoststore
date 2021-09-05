<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wpparallax
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wow slideInUp'); ?>>
	<div class="entry-content content-blog">

		<?php 
			$show_title = get_theme_mod('wp_parallax_show_post_title','hide');
			$show_image = get_theme_mod('wp_parallax_show_post_fimage','show');
			if( $show_image == 'show' ){
			?>
			<div class="main-blog-left">
				<?php wp_parallax_post_formats();?>
			</div>
		<?php } ?>
		
		<div class="main-blog-right">		
			<?php if($show_title == 'show'){?>
			<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php }?>
			<ul class="metadata">
				<li class="author"><i class="fa fa-user"></i> <?php the_author(); ?></li>
				<li><i class="fa fa-folder-open"></i> <?php the_category( ', ' ) ?></li>
				<li class="date"><i class="fa fa-calendar"></i> <span><?php echo the_time( 'd F Y' ); ?></span></li>
				<li class="comment"><i class="fa fa-comment"></i> <span><?php comments_popup_link('No Comments', 'Comment : 1', 'Comments : %'); ?></span></li>
			</ul>

			<div class="description">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wpparallax' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpparallax' ),
						'after'  => '</div>',
					) );
				?>
			</div>

		</div>
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->