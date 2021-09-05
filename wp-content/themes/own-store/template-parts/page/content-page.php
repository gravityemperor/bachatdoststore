<?php
/**
 * Template part for displaying cart page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package own-store
 */

?>

<div id="page-wrapper">
	<div class="content-page">
		<div class="page-content-area">
			<div class="entry-content">
				<?php
					the_content();
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'own-store' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'own-store' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</div>