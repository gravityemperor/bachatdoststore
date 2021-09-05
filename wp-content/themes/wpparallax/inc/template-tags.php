<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wpparallax
 */

if ( ! function_exists( 'wp_parallax_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function wp_parallax_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'wpparallax' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wpparallax' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'wp_parallax_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_parallax_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'wpparallax' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wpparallax' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wpparallax' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wpparallax' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wpparallax' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wpparallax' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


/* Remove archive title tag */
$remove_cat = get_theme_mod('wp_parallax_show_archive_text','show');
if($remove_cat == 'hide'){
	add_filter( 'get_the_archive_title', function ($title) {    
	    if ( is_category() ) {    
	            $title = single_cat_title( '', false );    
	        } elseif ( is_tag() ) {    
	            $title = single_tag_title( '', false );    
	        } elseif ( is_author() ) {    
	            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
	        } elseif ( is_tax() ) { //for custom post types
	            $title = sprintf( __( '%1$s','wpparallax' ), single_term_title( '', false ) );
	        } elseif (is_post_type_archive()) {
	            $title = post_type_archive_title( '', false );
	        }
	    return $title;    
	});
}

/* Dynamic Google Fonts URL */
 if ( ! function_exists( 'wp_parallax_google_fonts_url' ) ){
 	function wp_parallax_google_fonts_url() {
 		$fonts_url = '';
 		$body_font = json_decode(get_theme_mod('wp_parallax_body_font_family','{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'));

   		$bfont = $body_font->font;
 		$bregularweight = $body_font->regularweight;
 		$bitalicweight = isset($body_font->italicweight) ? $body_font->italicweight : '';
 		$bboldweight = isset($body_font->boldweight) ? $body_font->boldweight : '';
 		$bcategory = isset($body_font->category) ? $body_font->category : '';
 		$content_font = $bfont .":". $bregularweight.','.$bitalicweight.','.$bboldweight;

 		if ( 'off' !== $content_font ) {
 			$font_families = array();
   			if ( 'off' !== $content_font ) {
 				$font_families[] = $content_font;
 			}
   			$query_args = array(
 				'family' =>  urlencode(implode( '|', array_unique(apply_filters('wpparallax_font_families',$font_families)) )),
 			);
   			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
 		}
   		return apply_filters('wp_parallax_google_font_args',esc_url_raw( $fonts_url ));
 	}
} 