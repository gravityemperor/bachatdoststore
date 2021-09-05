<?php

/**
 * Wpparallax hooks
 */

/**
 * Header
 *
 * @see  wp_parallax_top_header() - 10
 * @see wp_parallax_top_nav (filter for top header navigation)
 * @see  wp_parallax_button_header() - 20
 */
add_action( 'wp_parallax_header', 'wp_parallax_top_header', 10 );
add_action( 'wp_parallax_header', 'wp_parallax_button_header', 20 );

/* Breadcrumb hook */
add_action( 'wp_parallax_breadcrumb', 'wp_parallax_header_banner_x');

/*slider hook */

add_action('wpop_main_slider','wp_parallax_slider');


/* Single post hook */
add_action('wpparallax_after_single_post','wp_parallax_tags',10);
add_action('wpparallax_after_single_post','the_post_navigation',20);
add_action('wpparallax_after_single_post','wp_parallax_comments',30);
function wp_parallax_tags(){
    ?>
    <div class="tags">
        <?php the_tags( ); ?>
    </div>
    <?php
}
function wp_parallax_comments(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

}

/**
 * Footer
 * @see  wp_parallax_footer_widgets() - 0
 * @see  wp_parallax_credit() - 10
 */
add_action( 'wp_parallax_footer', 'wp_parallax_footer_widgets', 0 );
add_action( 'wp_parallax_footer', 'wp_parallax_credit', 10 );


/* For Preloader */
add_action('wp_parallax_before_body_output','wp_parallax_preloader',5);
if(!function_exists('wp_parallax_preloader')){
    function wp_parallax_preloader(){
        $preloader = get_theme_mod('wp_parallax_show_preloader','hide');
        if( $preloader == 'show'): ?>
            <div id="loading8" class="opstore-loader">
                <div id="loading-center">
                    <div id="loading-center-absolute">
                        <div class="object" id="object_one"></div>
                        <div class="object" id="object_two"></div>
                        <div class="object" id="object_three"></div>
                        <div class="object" id="object_four"></div>
                    </div>
                </div>
            </div>
          <?php 
        endif; 
    }
}