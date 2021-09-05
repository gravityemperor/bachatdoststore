<?php
// child style enqueue
add_action( 'wp_enqueue_scripts', 'th_store_styles' );
function th_store_styles() {
	$themeVersion = wp_get_theme()->get('Version');
    // Enqueue our style.css with our own version
    wp_enqueue_style('th-store-styles', get_template_directory_uri() . '/style.css',array(), $themeVersion);
}
function th_store_customizer_script_registers(){
	$themeVersion = wp_get_theme()->get('Version');
wp_enqueue_script( 'thhhh_store_custom_customizer_script', get_stylesheet_directory_uri() . '/customizer/js/customizer.js', array("jquery"), $themeVersion, true ); 
}
add_action('customize_controls_enqueue_scripts', 'th_store_customizer_script_registers',99 );
//customizer
function th_store_customizer( $wp_customize ){
define('BIG_STORE_PRO_MAIN_HEADER_LAYOUT_TWO', get_stylesheet_directory_uri() . "/images/header-layout-2.png");
define('BIG_STORE_PRO_FOOTER_WIDGET_LAYOUT_5', get_stylesheet_directory_uri() . "/images/widget-footer-5.png");
$wp_customize->add_setting(
            'big_store_main_header_layout', array(
                'default'           => 'mhdrdefault',
                'sanitize_callback' => 'big_store_sanitize_radio',
            )
        );
$wp_customize->add_control(
            new Big_Store_WP_Customize_Control_Radio_Image(
                $wp_customize, 'big_store_main_header_layout', array(
                    'label'    => esc_html__( 'Header Layout', 'th-store' ),
                    'section'  => 'big-store-main-header',
                    'choices'  => array(
                        'mhdrthree' => array(
                            'url' => BIG_STORE_MAIN_HEADER_LAYOUT_ONE,
                        ),
                        'mhdrdefault'   => array(
                            'url' => BIG_STORE_PRO_MAIN_HEADER_LAYOUT_TWO,
                        ),
                        'mhdrone'   => array(
                            'url' => BIG_STORE_MAIN_HEADER_LAYOUT_THREE,
                        ),
                        'mhdrtwo' => array(
                            'url' => BIG_STORE_MAIN_HEADER_LAYOUT_FOUR,
                        ),
                        
                                     
                    ),
                    'priority'   => 1,
                )
            )
        );
 
 /******************/
//Widegt footer
/******************/
if(class_exists('Big_Store_WP_Customize_Control_Radio_Image')){
               $wp_customize->add_setting(
               'big_store_bottom_footer_widget_layout', array(
               'default'           => 'ft-wgt-five',
               'sanitize_callback' => 'sanitize_text_field',
            )
        );
$wp_customize->add_control(
            new Big_Store_WP_Customize_Control_Radio_Image(
                $wp_customize, 'big_store_bottom_footer_widget_layout', array(
                    'label'    => esc_html__( 'Layout','th-store'),
                    'section'  => 'big-store-widget-footer',
                    'choices'  => array(
                       'ft-wgt-none'   => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_NONE,
                        ),
                        'ft-wgt-one'   => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_1,
                        ),
                        'ft-wgt-two' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_2,
                        ),
                        'ft-wgt-three' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_3,
                        ),
                        'ft-wgt-four' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_4,
                        ),
                        'ft-wgt-five' => array(
                            'url' => BIG_STORE_PRO_FOOTER_WIDGET_LAYOUT_5,
                        ),
                        'ft-wgt-six' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_6,
                        ),
                        'ft-wgt-seven' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_7,
                        ),
                        'ft-wgt-eight' => array(
                            'url' => BIG_STORE_FOOTER_WIDGET_LAYOUT_8,
                        ),
                    ),
                )
            )
        );
    }
}
add_action( 'customize_register', 'th_store_customizer', 99 );

require_once( get_stylesheet_directory(). '/inc/header-function.php' );
require_once( get_stylesheet_directory(). '/inc/footer-function.php' );