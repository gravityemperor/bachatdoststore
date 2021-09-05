<?php
function store_hub_customize_register( $wp_customize ) {
    /* Header Layouts*/
    $wp_customize->get_control('wp_parallax_header_layouts')->choices=array( 
		'layout1' => esc_html__('Layout One','store-hub'),
		'layout2' => esc_html__('Layout Two','store-hub'),
		'layout3' => esc_html__('Layout Three','store-hub'),
		'store-header' => esc_html__('Store Header','store-hub'),
		'custom' => esc_html__('Custom','store-hub'),
    );
    $wp_customize->get_setting('wp_parallax_header_layouts')->default='store-header';
    for($i=1; $i<=2; $i++){
	    $wp_customize->add_setting( 'store_hub_hinfo_seperator'.$i, array(
	        'sanitize_callback' => 'sanitize_text_field',
	    ) );

	    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'store_hub_hinfo_seperator'.$i,  array(
	        'type'      => 'text',                    
	        'label'     => sprintf(esc_html__( 'Header Info %d', 'store-hub' ),$i),
	        'section'   => 'wp_parallax_header_layouts_section',
	        'active_callback' => 'store_hub_header_layouts_cb'
	    ) ) );

	    $wp_customize->add_setting(
	    	'store_hub_header_info_title'.$i, 
	    	array(
	    		'transport' => 'refresh',
	    		'sanitize_callback' => 'sanitize_text_field'                   
	    	)
	    );    
	    $wp_customize->add_control(
	    	'store_hub_header_info_title'.$i,
	    	array(
	    		'type'      => 'text',
	    		'label'     => esc_html__( 'Title', 'store-hub' ),
	    		'section'   => 'wp_parallax_header_layouts_section',
	    		'active_callback' => 'store_hub_header_layouts_cb'  
	    	)
	    ); 
	    $wp_customize->add_setting(
	    	'store_hub_header_info_value'.$i, 
	    	array(
	    		'transport' => 'refresh',
	    		'sanitize_callback' => 'sanitize_text_field'                   
	    	)
	    );    
	    $wp_customize->add_control(
	    	'store_hub_header_info_value'.$i,
	    	array(
	    		'type'      => 'text',
	    		'label'     => esc_html__( 'Value', 'store-hub' ),
	    		'section'   => 'wp_parallax_header_layouts_section',
	    		'active_callback' => 'store_hub_header_layouts_cb'  
	    	)
	    );
	}


    $wp_customize->add_setting( 'wp_parallax_minicart_layout', array(
    	'capability' => 'edit_theme_options',
    	'default' => 'offcanvas',
    	'sanitize_callback' => 'wp_parallax_sanitize_radio',
    ) );

    $wp_customize->add_control(
    	'wp_parallax_minicart_layout',
    	array(
    		'type'      => 'radio',
    		'choices'   => array(
    			'offcanvas' => esc_html__('Offcanvas','store-hub'),
    			'dropwown' => esc_html__('Dropdown','store-hub'),
    		),
    		'label'     => esc_html__( 'Minicart Layouts', 'store-hub' ),
    		'section'   => 'wpparallax_woo_section',
    	)
    ); 


}
add_action( 'customize_register', 'store_hub_customize_register',999 );

/* Active Callback Functions */
function store_hub_header_layouts_cb(){
    $header_layout = get_theme_mod('wp_parallax_header_layouts');
    if($header_layout == 'store-header'){
        return true;
    }
    return false;
}