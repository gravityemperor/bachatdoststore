<?php
/**
 * wpparallax Theme Customizer
 *
 * @package wpparallax
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_parallax_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wp_parallax_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wp_parallax_customize_partial_blogdescription',
		) );
	}


/*------------------------------------------------------------------------------------*/
	/**
	 * Upgrade to Pro
	*/
	if(!defined('WPOP_PRO')):
	// Register custom section types.
	$wp_customize->register_section_type( 'Wpparallax_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
	    new Wpparallax_Customize_Section_Pro(
	        $wp_customize,
	        'wpparallax-pro',
	        array(
	            'title'    => esc_html__( 'Upgrade To Premium', 'wpparallax' ),
	            'pro_text' => esc_html__( 'Buy Now','wpparallax' ),
	            'pro_text1' => esc_html__( 'Compare','wpparallax' ),
	            'pro_url'  => 'https://wpoperation.com/themes/wpparallax-pro/',
	            'priority' => 0,
	        )
	    )
	);
	$wp_customize->add_setting(
		'wpparallax_pro_upbuton',
		array(
			'section' => 'ultra-eleven',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'wpparallax_pro_upbuton',
		array(
			'section' => 'wpparallax-pro'
		)
	);
	endif;

}
add_action( 'customize_register', 'wp_parallax_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_parallax_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_parallax_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_parallax_customize_preview_js() {
	wp_enqueue_script( 'wpparallax-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wp_parallax_customize_preview_js' );
