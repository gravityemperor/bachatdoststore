<?php

/**
 * Enqueue scripts and styles.
 */
if(!function_exists('wp_parallax_scripts')){
	function wp_parallax_scripts() {
		wp_register_style('font-awesome',WPPLX_EXT.'fontawesome/font-awesome.min.css');
		wp_enqueue_style('font-awesome');

		wp_register_style('light-slider',WPPLX_EXT.'lightslider/lightslider.css');

		$preloader = get_theme_mod('wp_parallax_show_preloader','hide');
		if($preloader == 'show'){
			wp_register_style('preloader',WPPLX_CSS.'preloader.css');
			wp_enqueue_style('preloader');
		}

		wp_enqueue_style('google-fonts', wp_parallax_google_fonts_url(),array(),null);

		wp_register_style( 'wpparallax-style', get_stylesheet_uri() );
		wp_enqueue_style( 'wpparallax-style' );

	    if(class_exists('woocommerce')){
	    	wp_register_style( 'wpparallax-woo-style', WPPLX_CSS .'woo.css' );
	    	wp_enqueue_style( 'wpparallax-woo-style' );
	    }


	    wp_register_style( 'wpparallax-responsive-style', WPPLX_CSS .'responsive.css' );
	    wp_enqueue_style( 'wpparallax-responsive-style' );

	    //keyboard navigations
	    wp_register_style( 'wpparallax-keyboard', WPPLX_CSS .'keyboard.css');
	    wp_enqueue_style( 'wpparallax-keyboard' );

		/* Scripts */

		wp_register_script( 'wpparallax-navigation', WPPLX_JS . 'navigation.js', array(), WPPLX_VERSION, true );
		wp_enqueue_script( 'wpparallax-navigation' );

	    $wow = get_theme_mod('wp_parallax_wow_animation_option','show');
	    $smoothscroll = get_theme_mod('wp_parallax_smooth_scroll_option','show');
	    if($wow == 'show'){
	    	wp_register_style( 'animate', WPPLX_CSS .'animate.css');
	    	wp_enqueue_style( 'animate' );
		    wp_register_script( 'wow', WPPLX_JS .'wow.js', array( 'jquery' ), WPPLX_VERSION, true );
		    wp_enqueue_script( 'wow' );
	    }

	    if($smoothscroll == 'show'){
		    wp_register_script( 'smooth-scroll', WPPLX_EXT .'smoothscroll/SmoothScroll.min.js', array( 'jquery' ), WPPLX_VERSION, true );
		    wp_enqueue_script( 'smooth-scroll' );
	    }

	    wp_register_script( 'light-slider', WPPLX_EXT . 'lightslider/lightslider.js', array('jquery'), WPPLX_VERSION, true );

	    $menu_type = get_theme_mod('wp_parallax_menu_type','show');
	    if($menu_type == 'hide'){
			wp_register_script( 'wpparallax-jquery-nav', WPPLX_JS . 'jquery.nav.js', array('jquery'), WPPLX_VERSION, true );
			wp_enqueue_script( 'wpparallax-jquery-nav');
		}

		wp_register_script( 'isotope', WPPLX_EXT . 'isotope/isotope.pkgd.js',array('jquery'), WPPLX_VERSION, true);
		wp_register_script( 'packery', WPPLX_EXT . 'isotope/packery-mode.pkgd.js',array('jquery'), WPPLX_VERSION, true);

		wp_register_script( 'fitvids', WPPLX_JS .'jquery.fitvids.js', array( 'jquery' ), WPPLX_VERSION, true);
		wp_register_script( 'theia-sticky', WPPLX_JS .'theia-sticky-sidebar.js', array( 'jquery' ), WPPLX_VERSION, true);

		wp_enqueue_script( 'wpparallax-jquery-sticky', WPPLX_JS . 'jquery.sticky.js',array('jquery'), WPPLX_VERSION, true);

		wp_register_script( 'wpparallax-skip-link-focus-fix', WPPLX_JS . 'skip-link-focus-fix.js', array(), WPPLX_VERSION, true );
		wp_enqueue_script( 'wpparallax-skip-link-focus-fix' );

		wp_register_script( 'wpparallax-common-script', WPPLX_JS . 'wpparallax-common.js', array('jquery','imagesloaded'), WPPLX_VERSION, true );

	
		/**
	     * wp localize
	    */
	    $sticky = get_theme_mod('wp_parallax_sticky_menu','show');
	    $sticky_sidebar = get_theme_mod('wp_parallax_sticky_sidebar','show');
	    wp_localize_script( 'wpparallax-common-script', 'wpparallax_option', array(
	        'mode'=> esc_html($wow),
	        'is_sticky' => $sticky,
	        'sidebar_sticky' => $sticky_sidebar,
	        'smooth_scroll' => $smoothscroll
	        ) );

	    wp_enqueue_script('wpparallax-common-script');

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'wp_parallax_scripts', 999 );


//admin scripts
if(!function_exists('wp_parallax_admin_scripts')){
	function wp_parallax_admin_scripts() {
	    if ( function_exists( 'wp_enqueue_media' ) ) {
	        wp_enqueue_media();
	    }

	    wp_register_script( 'of-media-uploader', WPPLX_ASSETS_URI . 'js/media-uploader.js', array('jquery'), 1.70);
	    wp_enqueue_script( 'of-media-uploader' );
	    wp_localize_script( 'of-media-uploader', 'wpparallax_l10n', array(
	        'upload' => esc_html__( 'Upload', 'wpparallax' ),
	        'remove' => esc_html__( 'Remove', 'wpparallax' )
	        ));	
		wp_enqueue_style( 'wp-color-picker' );        
	    wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wpparallax-admin-styles', WPPLX_ASSETS_URI . 'admin/css/admin.css');
		wp_enqueue_script( 'wpparallax-admin-scripts', WPPLX_ASSETS_URI . 'admin/js/admin.js', array('jquery','jquery-ui-datepicker','customize-controls'), '2230', true );
			

	}
}
add_action( 'admin_enqueue_scripts', 'wp_parallax_admin_scripts' );