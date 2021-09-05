<?php
/**
 * Own Store: Dynamic CSS stylesheet
 * 
 */


function own_store_dynamic_css_stylesheet() {
    
    $layout= (OWN_STORE_CONTAINER_CLASS=='os-container') ? '1350px' : '1170px';
    $primary_color= sanitize_hex_color(get_theme_mod( 'own_shop_site_primary_color','#333333' ));
    $secondary_color= sanitize_hex_color(get_theme_mod( 'own_shop_site_secondary_color','#000000' ));

    $css = '
    	
        h1:not(h1.site-title):not(.blog h1):not(.single h1):not(.archive h1):not(.wp-block-cover__inner-container h1), 
        h2:not(.blog h2):not(.single h2):not(.archive h2):not(.wp-block-cover__inner-container h2), 
        h3:not(.blog h3):not(.single h3):not(.archive h3):not(.wp-block-cover__inner-container h3), 
        h4:not(.blog h4):not(.single h4):not(.archive h4):not(.wp-block-cover__inner-container h4), 
        h5:not(.blog h5):not(.single h5):not(.archive h5):not(.wp-block-cover__inner-container h5), 
        h6:not(.blog h6):not(.single h6):not(.archive h6):not(.wp-block-cover__inner-container h6),
        p,
        .wp-block-cover.alignwide,
        .wp-block-columns.alignwide,
        .wc-block-grid__products,
        .wp-block-cover-image .wp-block-cover__inner-container, 
        .wp-block-cover .wp-block-cover__inner-container {
            max-width: '.$layout.';
            margin: 0 auto;
        }

        .wp-block-cover.alignwide,
        .wp-block-columns.alignwide,
        .wc-block-grid__products,
        .wp-block-cover-image .wp-block-cover__inner-container, 
        .wp-block-cover .wp-block-cover__inner-container {
             padding: 0 15px;
        }

        h1, h2, h3, h4, h5, h6,
        .single h1.entry-title a {
            color: #000;
        }

        .top-menu .navigation >li.current-menu-item  a {
            color: '.$primary_color.';
        }

        header button[type="submit"] {
            font-size: 0 !important;
        }

        footer#footer, footer#footer .footer-widgets-wrapper {
            clear: both;
        }

        .wp-block-button__link,
        .wc-block-grid__product-onsale,
        .wp-block-search .wp-block-search__button {
            background: '.$primary_color.' !important;
            color: #fff !important; 
            border: none;
        }

        @media only screen and (max-width: 1200px) {
            .os-container,
            h1, h2, h3, h4, h5, h6,
            .wc-block-grid__products,
            .wp-block-cover-image .wp-block-cover__inner-container, 
            .wp-block-cover .wp-block-cover__inner-container {
                width: 99%;
                padding-left: 15px;
                padding-right: 15px;
            }

            .blog h2.entry-title,
            .archive h2.entry-title,
            .single h1.entry-title {
                width: 100%;
                padding: 0 !important;
            }
        }
       

	';

    //CSS when layout width changes
    if('container'===esc_html(get_theme_mod('own_shop_layout_content_width_ratio','os-container'))) :
        $css .='
           @media only screen and (min-width: 1400px) and (max-width: 1921px) {
                header button[type=submit] i {
                    left: 465px;
                }
            }
        ';
    endif;
	
	return apply_filters( 'own_store_dynamic_css_stylesheet', own_store_minimize_css($css));
}