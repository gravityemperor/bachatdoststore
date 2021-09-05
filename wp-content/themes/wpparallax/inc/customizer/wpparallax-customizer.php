<?php
get_template_part('inc/repeater-controller/wp','customizer');

function wp_parallax_custom_customize_register( $wp_customize ) {

	/* Option list of all post */
	$wpparallax_options_posts = array();
	$wpparallax_options_posts_obj = get_posts('posts_per_page=-1');
	$wpparallax_options_posts[''] = esc_html__( 'Choose Post', 'wpparallax' );
	foreach ( $wpparallax_options_posts_obj as $wpparallax_posts ) {
		$wpparallax_options_posts[$wpparallax_posts->ID] = $wpparallax_posts->post_title;
	}

	/* Option list of all categories */
	$wpparallax_args = array(
		'type'                     => 'post',
		'orderby'                  => 'name',
		'taxonomy'                 => 'category'
	);
	$wpparallax_option_categories = array();
	$wpparallax_category_lists = get_categories( $wpparallax_args );
	$wpparallax_option_categories[''] = esc_html__( 'Choose Category', 'wpparallax' );
	foreach( $wpparallax_category_lists as $wpparallax_category ){
		$wpparallax_option_categories[$wpparallax_category->term_id] = $wpparallax_category->name;
	}

	$get_sidebars = wpparallax_get_sidebars();

    /**
     * Add General Settings panel
     */

    $wp_customize->add_panel( 'general_settings', array(
    	'priority'         =>      1,
    	'capability'       =>      'edit_theme_options',
    	'theme_supports'   =>      '',
    	'title'            =>      esc_html__( 'General Settings', 'wpparallax' ),
    	'description'      =>      esc_html__( 'This allows to edit general theme settings', 'wpparallax' ),
    ));

    $wp_customize->get_section('title_tagline')->panel = 'general_settings';
    $wp_customize->remove_section('header_image');
    $wp_customize->get_section('background_image')->panel = 'general_settings';
    $wp_customize->get_section('static_front_page')->panel = 'general_settings';
    $wp_customize->get_section('colors')->panel = 'general_settings'; 

    /* Color Option */
    $wp_customize->add_setting( 'wp_parallax_color_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_color_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Theme Color', 'wpparallax' ),
        'section'   => 'colors',
        'priority' => 1
    ) ) );

    $wp_customize->add_setting(
    	'wp_parallax_theme_color', array(
    		'default' => '#017bbd',
    		'sanitize_callback' => 'sanitize_hex_color',
    	)
    );

    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
    		'wp_parallax_theme_color', 
    		array(
    			'label' => esc_html__('Theme Color','wpparallax'), 
    			'section' => 'colors',
    			'priority' => 2
    		)
    	)
    );

    /* anchor color */
    $wp_customize->add_setting( 'wp_parallax_acolor_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_acolor_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Anchor Color', 'wpparallax' ),
        'section'   => 'colors',
        'priority' => 3
    ) ) );

    $wp_customize->add_setting(
        'wp_parallax_anchor_color', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_anchor_color', 
            array(
                'label' => esc_html__('Anchor Color','wpparallax'), 
                'section' => 'colors',
                'priority' => 4
            )
        )
    );
    $wp_customize->add_setting(
        'wp_parallax_anchor_hcolor', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_anchor_hcolor', 
            array(
                'label' => esc_html__('Anchor Hover Color','wpparallax'), 
                'section' => 'colors',
                'priority' => 5
            )
        )
    );

    /* other color */
    $wp_customize->add_setting( 'wp_parallax_othercolor_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_othercolor_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Other Colors', 'wpparallax' ),
        'section'   => 'colors',
        'priority' => 6
    ) ) );
    /* Container Settings */
    $wp_customize->add_section( 'wp_parallax_container_section', array(
        'title'           =>      esc_html__('Container Settings', 'wpparallax'),
        'priority'        =>      35,
        'panel'           => 'general_settings'
    ));

    $wp_customize->add_setting( 'wp_parallax_cont_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_cont_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Container Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_container_section',
    ) ) );


    $wp_customize->add_setting(
        'wp_parallax_container_width', array(
            'default'       =>      1190,
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize -> add_control(
        'wp_parallax_container_width',
        array(
            'label' => esc_html__('Container Width', 'wpparallax'),
            'section' => 'wp_parallax_container_section',
            'type' => 'number',
        )
    ); 

    $wp_customize->add_setting( 'wp_parallax_content_style', array(
        'capability' => 'edit_theme_options',
        'default' => 'plain',
        'sanitize_callback' => 'wp_parallax_sanitize_select',
    ) );

    $wp_customize->add_control(
        'wp_parallax_content_style',
        array(
            'type'      => 'select',
            'choices'   => array(
                'plain' => esc_html__('Plain','wpparallax'),
                'boxed' => esc_html__('Boxed','wpparallax'),
            ),
            'label'     => esc_html__( 'Content Style', 'wpparallax' ),
            'section'   => 'wp_parallax_container_section',
        )
    );

    /* Extra Option */

    $wp_customize->add_section( 'wp_parallax_additional_section', array(
    	'title'           =>      esc_html__('Extra Settings', 'wpparallax'),
    	'priority'        =>      45,
    	'panel'           => 'general_settings'
    ));
    $wp_customize->add_setting( 'wp_parallax_extra_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_extra_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Extra Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_additional_section',
        'priority'  => 1
    ) ) ); 
    $wp_customize->add_setting( 'wp_parallax_show_preloader', array(
        'default' => 'hide',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_preloader',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Preloader', 'wpparallax' ),
        'section'   => 'wp_parallax_additional_section',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'wpparallax' ),
            'hide'  => esc_html__( 'Disable', 'wpparallax' )
        ),
        'priority'  => 2
    ) ) );     

    $wp_customize->add_setting( 'wp_parallax_wow_animation_option', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_wow_animation_option',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'WoW Animation', 'wpparallax' ),
    	'section'   => 'wp_parallax_additional_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Enable', 'wpparallax' ),
    		'hide'  => esc_html__( 'Disable', 'wpparallax' )
    	),
    	'priority'  => 3
    ) ) );  

    $wp_customize->add_setting( 'wp_parallax_smooth_scroll_option', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_smooth_scroll_option',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Smooth Scroll', 'wpparallax' ),
    	'section'   => 'wp_parallax_additional_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Enable', 'wpparallax' ),
    		'hide'  => esc_html__( 'Disable', 'wpparallax' )
    	),
    	'priority'  => 4
    ) ) );   

    $wp_customize->add_setting( 'wp_parallax_scroll_top', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_scroll_top',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Scroll to Top', 'wpparallax' ),
        'section'   => 'wp_parallax_additional_section',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'wpparallax' ),
            'hide'  => esc_html__( 'Disable', 'wpparallax' )
        ),
        'priority'  => 5
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_sticky_sidebar', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_sticky_sidebar',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Sticky Sidebar', 'wpparallax' ),
        'section'   => 'wp_parallax_additional_section',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'wpparallax' ),
            'hide'  => esc_html__( 'Disable', 'wpparallax' )
        ),
        'priority'  => 6
    ) ) ); 

    /* Typography Option */
    $wp_customize->add_section( 'wp_parallax_typography_section', array(
        'title'           =>      esc_html__('Typography Settings', 'wpparallax'),
        'priority'        =>      35,
        'panel'           => 'general_settings'
    ));

    $wp_customize->add_setting( 'wp_parallax_typo_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_typo_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Body Typography', 'wpparallax' ),
        'section'   => 'wp_parallax_typography_section',
        'priority' => 1
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_body_font_family',
        array(
            'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
            'sanitize_callback' => 'wp_parallax_google_font_sanitization',
            'transport' => 'refresh',
        )
    );
     $wp_customize->add_control( 
        new Wp_Customize_Google_Font_Control( 
            $wp_customize, 'wp_parallax_body_font_family',
            array(
                'label' => esc_html__( 'Body Font Family' , 'wpparallax'),
                'section' => 'wp_parallax_typography_section',
                'input_attrs' => array(
                    'font_count' => 'all',
                    'orderby' => 'alpha',
                ),
                'priority' => 2
            )
        ) 
    ); 

    $wp_customize->add_setting(
    'wp_parallax_body_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_body_text_color', 
            array(
                'label' => esc_html__('Font Color','wpparallax'), 
                'section' => 'wp_parallax_typography_section',
                'priority' => 3
            )
        )
    );   

    $wp_customize->add_setting(
        'wp_parallax_body_font_size', array(
            'sanitize_callback' => 'absint'
        ));
    $wp_customize -> add_control(
        'wp_parallax_body_font_size',
        array(
            'label' => esc_html__('Font Size(px)', 'wpparallax'),
            'section' => 'wp_parallax_typography_section',
            'type' => 'number',
            'priority' => 4
        )
    );

    $wp_customize->add_setting(
        'wp_parallax_body_line_height', array(
            'sanitize_callback' => 'absint'
        ));
    $wp_customize -> add_control(
        'wp_parallax_body_line_height',
        array(
            'label' => esc_html__('Line Height(px)', 'wpparallax'),
            'section' => 'wp_parallax_typography_section',
            'type' => 'number',
            'priority' => 5
        )
    ); 

    /*===========================================================================================================
     * Header Pannel
    */

    $wp_customize->add_panel(
    	'wp_parallax_header_settings_panel', 
    	array(
    		'priority'       => 2,
    		'capability'     => 'edit_theme_options',
    		'theme_supports' => '',
    		'title'          => esc_html__( 'Header Settings', 'wpparallax' ),
    	) 
    );

    /* Header Layouts */

    $wp_customize->add_section( 'wp_parallax_header_layouts_section', array(
    	'title'           =>     esc_html__('Header Layouts', 'wpparallax'),
    	'priority'        =>      1,
    	'panel'           => 'wp_parallax_header_settings_panel'
    ));

    $wp_customize->add_setting( 'wp_parallax_hlayout_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_hlayout_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Header Layout', 'wpparallax' ),
        'section'   => 'wp_parallax_header_layouts_section',
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_header_layouts', array(
    	'capability' => 'edit_theme_options',
    	'default' => 'layout3',
    	'sanitize_callback' => 'wp_parallax_sanitize_select',
    ) );

    $wp_customize->add_control(
    	'wp_parallax_header_layouts',
    	array(
    		'type'      => 'select',
    		'choices'   => array(
    			'layout1' => esc_html__('Layout One','wpparallax'),
    			'layout2' => esc_html__('Layout Two','wpparallax'),
    			'layout3' => esc_html__('Layout Three','wpparallax'),
    			'custom' => esc_html__('Custom','wpparallax'),
    		),
    		'label'     => esc_html__( 'Choose Header Layouts', 'wpparallax' ),
    		'section'   => 'wp_parallax_header_layouts_section',
    	)
    ); 
    //Custom header
	$wp_customize->add_setting('wp_parallax_custom_header',array(
	    	'capability' => 'edit_theme_options',
	    	'sanitize_callback' => 'absint',
	    	'transport' => 'refresh',
	    )
	);
    $wp_customize->add_control( 'wp_parallax_custom_header',
    	array(
    		'label'  => esc_html__( 'Custom Header', 'wpparallax' ),
    		'section' => 'wp_parallax_header_layouts_section',
    		'type' => 'select',
    		'choices' => wpparallax_get_elementor_templates(),
    		'active_callback' => 'wpparallax_header_layouts_cb' 
    	)
    );

    $wp_customize->add_setting( 'wp_parallax_header_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Help_Control( $wp_customize, 'wp_parallax_header_help',  array( 
      'label'     => esc_html__( 'Header built from elementor will be applied.', 'wpparallax' ),
      'section'   => 'wp_parallax_header_layouts_section',
      'active_callback' => 'wpparallax_header_layouts_cb',
    ) ) );

/*    $wp_customize->add_setting('wp_parallax_transparent_header', array(
        'default'    => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('wp_parallax_transparent_header',
        array(
            'label'     => esc_html__('Transparent Header?', 'wpparallax'),
            'section'   => 'wp_parallax_header_layouts_section',
            'type'      => 'checkbox',
        )
 
    );*/

    /* Top header */

    $wp_customize->add_section( 'wp_parallax_top_header_section', array(
    	'title'           =>     esc_html__('Top Header settings', 'wpparallax'),
    	'priority'        =>      2,
    	'panel'           => 'wp_parallax_header_settings_panel'
    ));

    $wp_customize->add_setting( 'wp_parallax_theader_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_theader_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Top Header Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_top_header_section',
        'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_top_header_show', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    	'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_top_header_show',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Hide / Show Top header', 'wpparallax' ),
    	'section'   => 'wp_parallax_top_header_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Show', 'wpparallax' ),
    		'hide'  => esc_html__( 'Hide', 'wpparallax' )
    	),
    	'priority'  => 1
    ) ) ); 

    $wp_customize->selective_refresh->add_partial( 'wp_parallax_top_header_show', array(
    	'selector'        => '.top-header',
    	'container_inclusive' => true,
    	'render_callback' => 'wp_parallax_top_header',
    ) );  
    /* Header info */

    $wp_customize->add_setting( 'wp_parallax_info_seperator', array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_info_seperator',  array(
    	'type'      => 'text',                    
    	'label'     => esc_html__( 'Header Info', 'wpparallax' ),
    	'section'   => 'wp_parallax_top_header_section',
    	'priority'  => 2
    ) ) );   

    $wp_customize->add_setting(
    	'wp_parallax_header_contact', 
    	array(
    		'transport' => 'postMessage',
    		'sanitize_callback' => 'wp_parallax_sanitize_text'                   
    	)
    );    
    $wp_customize->add_control(
    	'wp_parallax_header_contact',
    	array(
    		'type'      => 'text',
    		'label'     => esc_html__( 'Contact no.', 'wpparallax' ),
    		'section'   => 'wp_parallax_top_header_section',
    		'priority'  => 3
    	)
    );  

    $wp_customize->selective_refresh->add_partial( 'wp_parallax_header_contact', array(
    	'selector'        => '.header-info',
    	'container_inclusive' => true,
    	'render_callback' => 'wp_parallax_header_info',
    ) );    

    $wp_customize->add_setting(
    	'wp_parallax_header_email', 
    	array(
    		'transport' => 'postMessage',
    		'sanitize_callback' => 'wp_parallax_sanitize_text'                   
    	)
    );    
    $wp_customize->add_control(
    	'wp_parallax_header_email',
    	array(
    		'type'      => 'text',
    		'label'     => esc_html__( 'Email Address', 'wpparallax' ),
    		'section'   => 'wp_parallax_top_header_section',
    		'priority'  => 4
    	)
    ); 

    $wp_customize->selective_refresh->add_partial( 'wp_parallax_header_email', array(
    	'selector'        => '.header-info',
    	'container_inclusive' => true,
    	'render_callback' => 'wp_parallax_header_info',
    ) );  



    /* social Icons */

    $wp_customize->add_setting( 'wp_parallax_social_seperator', array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_social_seperator',  array(
    	'type'      => 'text',                    
    	'label'     => esc_html__( 'Social Icons Settings', 'wpparallax' ),
    	'section'   => 'wp_parallax_top_header_section',
    	'priority'  => 5
    ) ) ); 

    $socials = array('Facebook','Twitter','Instagram','Pinterest');
    foreach($socials as $social){

    	$wp_customize->add_setting('wp_parallax_'.$social,
    		array(
    			'default' => '',
    			'sanitize_callback' => 'esc_url_raw',
    			'transport'=>'postMessage'
    		)
    	);

    	$wp_customize->add_control( 'wp_parallax_'.$social,
    		array(
    			'label'  => sprintf(esc_html__(' %s', 'wpparallax' ),$social),
    			'description'=>sprintf(esc_html__( 'Enter URL for %s', 'wpparallax' ),$social),
    			'section' => 'wp_parallax_top_header_section',
    			'type' => 'url',
    			'priority'=> 6
    		)
    	); 

    	$wp_customize->selective_refresh->add_partial( 'wp_parallax_'.$social, array(
    		'selector'        => '.header-icons',
    		'container_inclusive' => true,
    		'render_callback' => 'wpparallax_social_icons',
    	) ); 

    }//end foreach;

    /* Bottom header */

    $wp_customize->add_section( 'wp_parallax_bottom_header_section', array(
    	'title'           =>      esc_html__('Bottom Header Settings', 'wpparallax'),
    	'priority'        =>      '2',
    	'panel'           => 'wp_parallax_header_settings_panel'
    ));

    $wp_customize->add_setting( 'wp_parallax_bheader_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_bheader_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Bottom Header', 'wpparallax' ),
        'section'   => 'wp_parallax_bottom_header_section',
        'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_menu_type', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    	'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_menu_type',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Choose Menu Layout', 'wpparallax' ),
    	'section'   => 'wp_parallax_bottom_header_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Primary', 'wpparallax' ),
    		'hide'  => esc_html__( 'Parallax', 'wpparallax' )
    	),
    	'priority'  => 1
    ) ) ); 

    $wp_customize->selective_refresh->add_partial( 'wp_parallax_menu_type', array(
    	'selector'        => '.main-navigation',
    	'container_inclusive' => true,
    	'render_callback' => 'wp_parallax_nav',
    ) ); 

    $wp_customize->add_setting( 'wp_parallax_sticky_menu', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_sticky_menu',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Sticky Menu', 'wpparallax' ),
    	'section'   => 'wp_parallax_bottom_header_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Enable', 'wpparallax' ),
    		'hide'  => esc_html__( 'Disable', 'wpparallax' )
    	),
    	'priority'  => 2
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_search_enable', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    	'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_search_enable',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Search Icon', 'wpparallax' ),
    	'section'   => 'wp_parallax_bottom_header_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Show', 'wpparallax' ),
    		'hide'  => esc_html__( 'Hide', 'wpparallax' )
    	),
    	'priority'  => 3
    ) ) ); 

    if(class_exists('woocommerce')){    
    	$wp_customize->add_setting( 'wp_parallax_cart_enable', array(
    		'default' => 'show',
    		'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    		'transport' => 'postMessage'
    	) );

    	$wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_cart_enable',  array(
    		'type'      => 'switch',                    
    		'label'     => esc_html__( 'Cart Icon', 'wpparallax' ),
    		'section'   => 'wp_parallax_bottom_header_section',
    		'choices'   => array(
    			'show'  => esc_html__( 'Show', 'wpparallax' ),
    			'hide'  => esc_html__( 'Hide', 'wpparallax' )
    		),
    		'priority'  => 4
    	) ) );  
    }

    $wp_customize->add_setting(
        'wp_parallax_header_button_text', 
        array(
            'default'   => esc_html__('Contact Us','wpparallax'),
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'                   
        )
    );    
    $wp_customize->add_control(
        'wp_parallax_header_button_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Button Text', 'wpparallax' ),
            'section'   => 'wp_parallax_bottom_header_section',
        )
    ); 

    $wp_customize->add_setting(
        'wp_parallax_header_button_link', 
        array(
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'                   
        )
    );    
    $wp_customize->add_control(
        'wp_parallax_header_button_link',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Button Link', 'wpparallax' ),
            'section'   => 'wp_parallax_bottom_header_section',
        )
    ); 

    $wp_customize->add_setting(
        'wp_parallax_header_button_target', 
        array(
            'transport' => 'refresh',
            'default' => '1',
            'sanitize_callback' => 'absint'                   
        )
    );    
    $wp_customize->add_control(
        'wp_parallax_header_button_target',
        array(
            'type'      => 'checkbox',
            'label'     => esc_html__( 'Target Blank?', 'wpparallax' ),
            'section'   => 'wp_parallax_bottom_header_section',
        )
    );
    
    /* Header Design Settings */
    $wp_customize->add_section( 'wp_parallax_header_design_section', array(
        'title'           =>     esc_html__('Design settings', 'wpparallax'),
        'priority'        =>      2,
        'panel'           => 'wp_parallax_header_settings_panel'
    ));
    //top header
    $wp_customize->add_setting( 'wp_parallax_theaderd_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_theaderd_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Top Header Design', 'wpparallax' ),
        'section'   => 'wp_parallax_header_design_section',
        'priority'  => 1
    ) ) ); 

  $wp_customize->add_setting(
    'wp_parallax_top_header_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_top_header_bg_color', 
        array(
            'label' => esc_html__('Background Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  );
  $wp_customize->add_setting(
    'wp_parallax_top_header_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_top_header_text_color', 
        array(
            'label' => esc_html__('Text Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  ); 
  $wp_customize->add_setting(
    'wp_parallax_top_header_hover_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_top_header_hover_color', 
        array(
            'label' => esc_html__('Hover Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  ); 

  //Bottom header
    $wp_customize->add_setting( 'wp_parallax_bheaderd_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_bheaderd_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Bottom Header Design', 'wpparallax' ),
        'section'   => 'wp_parallax_header_design_section',
    ) ) ); 

  $wp_customize->add_setting(
    'wp_parallax_bottom_header_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_bottom_header_bg_color', 
        array(
            'label' => esc_html__('Background Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  );
  $wp_customize->add_setting(
    'wp_parallax_bottom_header_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_bottom_header_text_color', 
        array(
            'label' => esc_html__('Text Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  ); 
  $wp_customize->add_setting(
    'wp_parallax_bottom_header_hover_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

    $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_bottom_header_hover_color', 
        array(
            'label' => esc_html__('Hover Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
    ); 
   //Mobile Navigation
    $wp_customize->add_setting( 'wp_parallax_mnav_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_mnav_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Mobile Menu Design', 'wpparallax' ),
        'section'   => 'wp_parallax_header_design_section',
    ) ) );
  $wp_customize->add_setting(
    'wp_parallax_mobile_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_mobile_bg_color', 
        array(
            'label' => esc_html__('Background Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  );
  $wp_customize->add_setting(
    'wp_parallax_mobile_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_mobile_text_color', 
        array(
            'label' => esc_html__('Text Color','wpparallax'), 
            'section' => 'wp_parallax_header_design_section',
        )
    )
  ); 
  //Bottom header
    $wp_customize->add_setting( 'wp_parallax_bheaderb_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_bheaderb_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Button Design', 'wpparallax' ),
        'section'   => 'wp_parallax_header_design_section',
    ) ) ); 

    $wp_customize->add_setting(
        'wp_parallax_button_text_color', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_text_color', 
            array(
                'label' => esc_html__('Text Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    ); 
    $wp_customize->add_setting(
        'wp_parallax_button_bg_color', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_bg_color', 
            array(
                'label' => esc_html__('Background Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    );
    $wp_customize->add_setting(
        'wp_parallax_button_border_color', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_border_color', 
            array(
                'label' => esc_html__('Border Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    );
    $wp_customize->add_setting(
        'wp_parallax_button_text_hcolor', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_text_hcolor', 
            array(
                'label' => esc_html__('Text Hover Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    ); 
    $wp_customize->add_setting(
        'wp_parallax_button_bg_hcolor', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_bg_hcolor', 
            array(
                'label' => esc_html__('Background Hover Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    );
    $wp_customize->add_setting(
        'wp_parallax_button_border_hcolor', array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_button_border_hcolor', 
            array(
                'label' => esc_html__('Border Hover Color','wpparallax'), 
                'section' => 'wp_parallax_header_design_section',
            )
        )
    );

  /**
  *Breadcrumb settings................................................................................................
  */
  $wp_customize->add_section(
  	'wp_parallax_breadcrumb',
  	array(
  		'title' => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
  		'priority' => 2,
  	)
  );

    $wp_customize->add_setting( 'wp_parallax_bread_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_bread_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Breadcrumb Banner Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_breadcrumb',
        'priority'  => 1
    ) ) ); 

  $wp_customize->add_setting( 'wp_parallax_breadcrumb_section_option', array(
  	'default' => 'show',
  	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
  ) );

  $wp_customize->add_control( new Wp_customize_Switch_Control( $wp_customize, 'wp_parallax_breadcrumb_section_option',  array(
  	'type'      => 'switch',                    
  	'label'     => esc_html__( 'Enable / Disable Banner', 'wpparallax' ),
  	'section'   => 'wp_parallax_breadcrumb',
  	'priority'  => 1,
  	'choices'   => array(
  		'show'  => esc_html__( 'Enable', 'wpparallax' ),
  		'hide'  => esc_html__( 'Disable', 'wpparallax' )
  	)
  ) ) ); 

  $wp_customize->add_setting(
    'wp_parallax_breadcrumb_image',
    array(
        'default' => '',
        'sanitize_callback'=>'esc_url_raw'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Upload_Control(
        $wp_customize,
        'wp_parallax_breadcrumb_image',
        array(
            'label'      => esc_html__( 'Banner Image', 'wpparallax' ),
            'description'=> esc_html__('suggested dimensions for Breadcrumb:1920x325','wpparallax'),
            'section'    => 'wp_parallax_breadcrumb',
            'settings'   => 'wp_parallax_breadcrumb_image',
        )
    )
  );

  $wp_customize->add_setting(
  	'wp_parallax_breadcrumb_bg_color', array(
  		'sanitize_callback' => 'sanitize_hex_color',
  	)
  );

  $wp_customize->add_control(
  	new WP_Customize_Color_Control(
  		$wp_customize,
  		'wp_parallax_breadcrumb_bg_color', 
  		array(
  			'label' => esc_html__('Background Color','wpparallax'), 
  			'section' => 'wp_parallax_breadcrumb',
  		)
  	)
  );  

  $wp_customize->add_setting(
    'wp_parallax_breadcrumb_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'wp_parallax_breadcrumb_text_color', 
        array(
            'label' => esc_html__('Text Color','wpparallax'), 
            'section' => 'wp_parallax_breadcrumb',
        )
    )
  );

  $wp_customize->add_setting( 'wp_parallax_breadcrumb_overlay', array(
    'default' => 'show',
    'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
  ) );

   $wp_customize->add_control( new Wp_customize_Switch_Control( $wp_customize, 'wp_parallax_breadcrumb_overlay',  array(
    'type'      => 'switch',                    
    'label'     => esc_html__( 'Enable / Disable Overlay', 'wpparallax' ),
    'section'   => 'wp_parallax_breadcrumb',
    'choices'   => array(
        'show'  => esc_html__( 'Enable', 'wpparallax' ),
        'hide'  => esc_html__( 'Disable', 'wpparallax' )
    )
    ) ) ); 


    $wp_customize->add_setting( 'wp_parallax_bread_title_position', array(
        'capability' => 'edit_theme_options',
        'default' => 'left',
        'sanitize_callback' => 'wp_parallax_sanitize_select',
    ) );

    $wp_customize->add_control(
        'wp_parallax_bread_title_position',
        array(
            'type'      => 'select',
            'choices'   => array(
                'left' => esc_html__('Left','wpparallax'),
                'right' => esc_html__('Right','wpparallax'),
                'center' => esc_html__('Center','wpparallax'),
                'wide' => esc_html__('Wide','wpparallax'),
            ),
            'label'     => esc_html__( 'Title Position', 'wpparallax' ),
            'section'   => 'wp_parallax_breadcrumb',
        )
    ); 
  $wp_customize->add_setting( 'wp_parallax_banner_height', array(
  	'default'   => 300,
  	'sanitize_callback' => 'wp_parallax_sanitize_number'                   
    )
  );    
  $wp_customize->add_control( 'wp_parallax_banner_height', array(
  	'type'      => 'number',
  	'label'     => esc_html__( 'Banner Height', 'wpparallax' ),
  	'section'   => 'wp_parallax_breadcrumb',
   )
   );

  $wp_customize->add_setting( 'wp_parallax_breadcrumb_enable', array(
    'default' => 'show',
    'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
  ) );

   $wp_customize->add_control( new Wp_customize_Switch_Control( $wp_customize, 'wp_parallax_breadcrumb_enable',  array(
    'type'      => 'switch',                    
    'label'     => esc_html__( 'Enable / Disable Breadcrumb', 'wpparallax' ),
    'section'   => 'wp_parallax_breadcrumb',
    'choices'   => array(
        'show'  => esc_html__( 'Enable', 'wpparallax' ),
        'hide'  => esc_html__( 'Disable', 'wpparallax' )
    )
    ) ) ); 

    $wp_customize->add_setting(
        'wp_parallax_breadcrumb_delimiter', 
        array(
            'default'   => '>>',
            'sanitize_callback' => 'sanitize_text_field'                   
        )
    );    
    $wp_customize->add_control(
        'wp_parallax_breadcrumb_delimiter',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Delimiter', 'wpparallax' ),
            'section'   => 'wp_parallax_breadcrumb',
        )
    );   
    /*===========================================================================================================
     * Homepage Pannel
    */

    $wp_customize->add_panel(
    	'wp_parallax_homepage_settings_panel', 
    	array(
    		'priority'       => 3,
    		'capability'     => 'edit_theme_options',
    		'theme_supports' => '',
    		'title'          => esc_html__( 'Homepage Settings', 'wpparallax' ),
    	) 
    );

    /* Slider Section */   

    $wp_customize->add_section( 'wp_parallax_slider_section', array(
    	'title'           =>      esc_html__('Slider settings', 'wpparallax'),
    	'priority'        =>      '1',
    	'panel'           => 'wp_parallax_homepage_settings_panel'
    ));

    $wp_customize->add_setting( 'wp_parallax_slider_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_slider_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Slider Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_slider_section',
        'priority'  => 1
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_slider_show', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_slider_show',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Hide/Show Slider', 'wpparallax' ),
    	'section'   => 'wp_parallax_slider_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Show', 'wpparallax' ),
    		'hide'  => esc_html__( 'Hide', 'wpparallax' )
    	),
    	'priority'  => 1
    ) ) );  

    $wp_customize->add_setting('wp_parallax_slider_cat',array(
    	'default' => 0,
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'wp_parallax_sanitize_number',
    )
);

    $wp_customize->add_control( 'wp_parallax_slider_cat',
    	array(
    		'label'  => esc_html__( 'Choose Category for slider ', 'wpparallax' ),
    		'description'=> esc_html__('Choose the category of posts for homepage slider','wpparallax'),
    		'section' => 'wp_parallax_slider_section',
    		'type' => 'select',
    		'choices' => $wpparallax_option_categories
    	)
    ); 
    
    /* Page Settings */
    $wp_customize -> add_section(
    	'wp_parallax_page_options',
    	array(
    		'title' => esc_html__('Page Settings','wpparallax'),
    		'priority' => 30,
	));

    $wp_customize->add_setting( 'wp_parallax_page_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_page_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Page Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_page_options',
    ) ) );

    $wp_customize->add_setting( 'wp_parallax_show_page_banner', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_page_banner',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
        'section'   => 'wp_parallax_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_page_title', array(
        'default' => 'hide',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_page_title',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Page Title', 'wpparallax' ),
        'section'   => 'wp_parallax_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_page_fimage', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_page_fimage',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Feature Image', 'wpparallax' ),
        'section'   => 'wp_parallax_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_page_sidebar_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_page_sidebar_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Sidebar Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_page_options',
    ) ) );

    $wp_customize->add_setting(
    	'wp_parallax_single_page_sidebars_layout', array(
		'default'       =>      'nosidebar',
		'sanitize_callback' => 'wp_parallax_sanitize_radio'
	));

    $wp_customize->add_control( new WP_Customize_Radioimage_Control(
    	$wp_customize,
    	'wp_parallax_single_page_sidebars_layout',
    	array(
    		'section'       =>      'wp_parallax_page_options',
    		'label'         =>      esc_html__('Choose Sidebar Layout', 'wpparallax'),
    		'type'          =>      'radioimage',
    		'choices'       =>      array( 
    			'leftsidebar' => WPPLX_IMAGES.'left-sidebar.png',  
    			'rightsidebar' => WPPLX_IMAGES.'right-sidebar.png', 
    			'nosidebar' => WPPLX_IMAGES.'no-sidebar.png',
    		)
        )
    ));
    $wp_customize->add_setting('wp_parallax_single_page_sidebar',array(
    	'default' => 'sidebar-right',
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_text_field',
    )
    );
    
    $wp_customize->add_control( 'wp_parallax_single_page_sidebar',
    	array(
    		'label'  => esc_html__( 'Choose Widget Area ', 'wpparallax' ),
    		'section' => 'wp_parallax_page_options',
    		'type' => 'select',
    		'choices' => $get_sidebars,
    	)
    );

    /* Post Settings */
    $wp_customize -> add_section(
        'wp_parallax_post_options',
        array(
            'title' => esc_html__('Post Settings','wpparallax'),
            'priority' => 30,
    ));

    $wp_customize->add_setting( 'wp_parallax_post_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_post_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Post Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_post_options',
    ) ) );

    $wp_customize->add_setting( 'wp_parallax_show_post_banner', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_post_banner',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
        'section'   => 'wp_parallax_post_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_post_title', array(
        'default' => 'hide',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_post_title',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Post Title', 'wpparallax' ),
        'section'   => 'wp_parallax_post_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_post_fimage', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_post_fimage',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Feature Image', 'wpparallax' ),
        'section'   => 'wp_parallax_post_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_post_sidebar_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_post_sidebar_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Sidebar Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_post_options',
    ) ) );

    $wp_customize->add_setting(
        'wp_parallax_single_post_sidebars_layout', array(
        'default'       =>      'rightsidebar',
        'sanitize_callback' => 'wp_parallax_sanitize_radio'
    ));

    $wp_customize->add_control( new WP_Customize_Radioimage_Control(
        $wp_customize,
        'wp_parallax_single_post_sidebars_layout',
        array(
            'section'       =>      'wp_parallax_post_options',
            'label'         =>      esc_html__('Choose Sidebar Layout', 'wpparallax'),
            'type'          =>      'radioimage',
            'choices'       =>      array( 
                'leftsidebar' => WPPLX_IMAGES.'left-sidebar.png',  
                'rightsidebar' => WPPLX_IMAGES.'right-sidebar.png', 
                'nosidebar' => WPPLX_IMAGES.'no-sidebar.png',
            )
        )
    ));
    $wp_customize->add_setting('wp_parallax_single_post_sidebar',array(
        'default' => 'sidebar-right',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
    );
    
    $wp_customize->add_control( 'wp_parallax_single_post_sidebar',
        array(
            'label'  => esc_html__( 'Choose Widget Area ', 'wpparallax' ),
            'section' => 'wp_parallax_post_options',
            'type' => 'select',
            'choices' => $get_sidebars,
        )
    );

    /* Archive page Settings */
    $wp_customize -> add_section(
    	'wp_parallax_archive_page_options',
    	array(
    		'title' => esc_html__('Archive Settings','wpparallax'),
    		'priority' => 30,
    	));

    $wp_customize->add_setting( 'wp_parallax_archive_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_archive_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Archive Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_archive_page_options',
        'priority'  => 1
    ) ) );

    $wp_customize->add_setting(
        'wp_parallax_archive_layout', array(
            'default'       =>      'grid',
            'sanitize_callback' => 'wp_parallax_sanitize_radio'
        ));

    $wp_customize->add_control( new WP_Customize_Radioimage_Control(
        $wp_customize,
        'wp_parallax_archive_layout',
        array(
            'section'       =>      'wp_parallax_archive_page_options',
            'label'         =>      esc_html__('Choose Archive Layout', 'wpparallax'),
            'type'          =>      'radioimage',
            'choices'       =>      array( 
                'list' => WPPLX_IMAGES.'list.png',  
                'grid' => WPPLX_IMAGES.'grid.png', 
            ))));


    $wp_customize->add_setting( 'wp_parallax_show_archive_banner', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_archive_banner',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
        'section'   => 'wp_parallax_archive_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_archive_title', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_archive_title',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Show / Hide Title', 'wpparallax' ),
        'section'   => 'wp_parallax_archive_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_show_archive_text', array(
        'default' => 'show',
        'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    ) );
    
    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_archive_text',  array(
        'type'      => 'switch',                    
        'label'     => esc_html__( 'Show / Hide Category by:', 'wpparallax' ),
        'section'   => 'wp_parallax_archive_page_options',
        'choices'   => array(
            'show'  => esc_html__( 'Show', 'wpparallax' ),
            'hide'  => esc_html__( 'Hide', 'wpparallax' )
        ),
    ) ) ); 

    $wp_customize->add_setting(
        'wp_parallax_archive_page_excerpts', array(
            'default'       =>      400,
            'sanitize_callback' => 'absint'
        ));
    $wp_customize -> add_control(
        'wp_parallax_archive_page_excerpts',
        array(
            'label' => esc_html__('Archive Post Excerpt Length', 'wpparallax'),
            'section' => 'wp_parallax_archive_page_options',
            'type' => 'number',
        )); 
    $wp_customize->add_setting( 'wp_parallax_archive_read_more', array(
        'default'           => esc_html__('Read More Text', 'wpparallax'),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize -> add_control(
        'wp_parallax_archive_read_more',
        array(
            'label' => esc_html__('Read More Text', 'wpparallax'),
            'section' => 'wp_parallax_archive_page_options',
            'type' => 'text',
        )
    ); 
    $wp_customize->add_setting( 'wp_parallax_archive_sidebar_seperator', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_archive_sidebar_seperator',  array(
        'type'      => 'text',                    
        'label'     => esc_html__( 'Sidebar Settings', 'wpparallax' ),
        'section'   => 'wp_parallax_archive_page_options',
    ) ) );
    $wp_customize->add_setting(
    	'archive_page_sidebars_layout', array(
    		'default'       =>      'rightsidebar',
    		'sanitize_callback' => 'wp_parallax_sanitize_radio'
    	));

    $wp_customize->add_control( new WP_Customize_Radioimage_Control(
    	$wp_customize,
    	'archive_page_sidebars_layout',
    	array(
    		'section'       =>      'wp_parallax_archive_page_options',
    		'label'         =>      esc_html__('Choose Sidebar Layout', 'wpparallax'),
    		'type'          =>      'radioimage',
    		'choices'       =>      array( 
    			'leftsidebar' => WPPLX_IMAGES.'left-sidebar.png',  
    			'rightsidebar' => WPPLX_IMAGES.'right-sidebar.png', 
    			'nosidebar' => WPPLX_IMAGES.'no-sidebar.png',
    		))));


    $wp_customize->add_setting('archive_page_sidebar',array(
    	'default' => 'sidebar-right',
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_text_field',
    )
    );
    
    $wp_customize->add_control( 'archive_page_sidebar',
    	array(
    		'label'  => esc_html__( 'Choose Widget Area ', 'wpparallax' ),
    		'section' => 'wp_parallax_archive_page_options',
    		'type' => 'select',
    		'choices' => $get_sidebars,
    	)
    );

    /* Woocommerce Options */
    if( class_exists('woocommerce') ){

    	$wp_customize->add_section( 'wpparallax_woo_section', array(
    		'title'           =>     esc_html__('Shop Settings', 'wpparallax'),
            'priority' => 31
    	));

    	$wp_customize->add_setting( 'wpparallax_woo_seperator', array(
    		'sanitize_callback' => 'sanitize_text_field',
    	) );

    	$wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wpparallax_woo_seperator',  array(
    		'type'      => 'text',                    
    		'label'     => esc_html__( 'Shop Settings', 'wpparallax' ),
    		'section'   => 'wpparallax_woo_section',
    	) ) ); 

        $wp_customize->add_setting( 'wp_parallax_show_shop_banner', array(
            'default' => 'show',
            'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
        ) );
        
        $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_shop_banner',  array(
            'type'      => 'switch',                    
            'label'     => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'wpparallax' ),
                'hide'  => esc_html__( 'Hide', 'wpparallax' )
            ),
        ) ) ); 

    	$wp_customize->add_setting( 'wpparallax_shop_sidebar_layout', array(
    		'default'           => 'nosidebar',
    		'sanitize_callback' => 'wp_parallax_sanitize_radio'
    	)
        );

    	$wp_customize->add_control( new Wp_Customize_Radioimage_Control(
    		$wp_customize,
    		'wpparallax_shop_sidebar_layout',
    		array(
    			'section'       =>      'wpparallax_woo_section',
    			'label'         =>      esc_html__('Choose Shop Page Sidebar', 'wpparallax'),
    			'type'          =>      'radioimage',
    			'choices'       =>      array( 
    				'leftsidebar' => WPPLX_IMAGES.'left-sidebar.png',  
    				'rightsidebar' => WPPLX_IMAGES.'right-sidebar.png', 
    				'nosidebar' => WPPLX_IMAGES.'no-sidebar.png',
    			)
    		)
    	)
        );

    	$wp_customize->add_setting('wpparallax_shop_sidebar',array(
    		'default' => 'sidebar-shop',
    		'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field',
    	)
        );
    	
    	$wp_customize->add_control( 'wpparallax_shop_sidebar',
    		array(
    			'label'  => esc_html__( 'Choose Widget Area ', 'wpparallax' ),
    			'section' => 'wpparallax_woo_section',
    			'type' => 'select',
    			'choices' => $get_sidebars,
    		)
    	);

    	$wp_customize->add_setting( 'wpparallax_saletag_text', array(
    		'default'   => 'Sale',
    		'sanitize_callback' => 'sanitize_text_field'                   
    	)
        );    
    	$wp_customize->add_control( 'wpparallax_saletag_text', array(
    		'type'      => 'text',
    		'label'     => esc_html__( 'Sale Tag Text', 'wpparallax' ),
    		'section'   => 'wpparallax_woo_section',
    	)
        );
    	$wp_customize->add_setting( 'wpparallax_woo_column', array(
    		'default'   => 4,
    		'sanitize_callback' => 'absint'                   
    	)
        );    
    	$wp_customize->add_control( 'wpparallax_woo_column', array(
    		'type'      => 'number',
    		'label'     => esc_html__( 'Product Column', 'wpparallax' ),
    		'section'   => 'wpparallax_woo_section',
    	)
        ); 

    	$wp_customize->add_setting( 'wpparallax_product_perpage', array(
    		'default'           => 9,
    		'sanitize_callback' => 'absint'                   
    	)
        );    
    	$wp_customize->add_control( 'wpparallax_product_perpage', array(
    		'type'      => 'number',
    		'label'     => esc_html__( 'Product Per page', 'wpparallax' ),
    		'section'   => 'wpparallax_woo_section',
    	)
        ); 

        /* Shop Single */
        $wp_customize->add_setting( 'wpparallax_woo_single_seperator', array(
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wpparallax_woo_single_seperator',  array(
            'type'      => 'text',                    
            'label'     => esc_html__( 'Single Product', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
        ) ) ); 

        $wp_customize->add_setting( 'wp_parallax_show_shop_single_banner', array(
            'default' => 'hide',
            'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
        ) );
        
        $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_shop_single_banner',  array(
            'type'      => 'switch',                    
            'label'     => esc_html__( 'Breadcrumb Banner', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'wpparallax' ),
                'hide'  => esc_html__( 'Hide', 'wpparallax' )
            ),
        ) ) ); 

        $wp_customize->add_setting( 'wp_parallax_show_related_products', array(
            'default' => 'show',
            'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
        ) );
        
        $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_related_products',  array(
            'type'      => 'switch',                    
            'label'     => esc_html__( 'Related Products', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'wpparallax' ),
                'hide'  => esc_html__( 'Hide', 'wpparallax' )
            ),
        ) ) );

        $wp_customize->add_setting( 'wpparallax_woomini_seperator', array(
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wpparallax_woomini_seperator',  array(
            'type'      => 'text',                    
            'label'     => esc_html__( 'Mini Cart', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
        ) ) ); 

        $wp_customize->add_setting( 'wp_parallax_show_mini_cart', array(
            'default' => 'show',
            'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
        ) );
        
        $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_show_mini_cart',  array(
            'type'      => 'switch',                    
            'label'     => esc_html__( 'Mini Cart', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'wpparallax' ),
                'hide'  => esc_html__( 'Hide', 'wpparallax' )
            ),
        ) ) );
        $wp_customize->add_setting( 'wpparallax_minicart_label', array(
            'default'   => __(' Shopping Cart Items','wpparallax'),
            'sanitize_callback' => 'sanitize_text_field'                   
        )
        );    
        $wp_customize->add_control( 'wpparallax_minicart_label', array(
            'type'      => 'text',
            'label'     => esc_html__( 'Heading Text', 'wpparallax' ),
            'section'   => 'wpparallax_woo_section',
        )
        );
    } 
    /*===========================================================================================================
     * Footer Pannel
    */

    $wp_customize->add_section( 'wp_parallax_footer_section', array(
    	'title'           =>     esc_html__('Footer Settings', 'wpparallax'),
        'priority' => 32
    ));

    $wp_customize->add_setting( 'wp_parallax_flayout_seperator', array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_flayout_seperator',  array(
    	'type'      => 'text',                    
    	'label'     => esc_html__( 'Footer Layout', 'wpparallax' ),
    	'section'   => 'wp_parallax_footer_section',
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_footer_layouts', array(
    	'capability' => 'edit_theme_options',
    	'default' => 'default',
    	'sanitize_callback' => 'wp_parallax_sanitize_radio',
    ) );

    $wp_customize->add_control(
    	'wp_parallax_footer_layouts',
    	array(
    		'type'      => 'radio',
    		'choices'   => array(
    			'default' => esc_html__('Default','wpparallax'),
    			'custom' => esc_html__('Custom','wpparallax'),
    		),
    		'label'     => esc_html__( 'Choose Footer Layouts', 'wpparallax' ),
    		'section'   => 'wp_parallax_footer_section',
    	)
    ); 
    //Custom footer
	$wp_customize->add_setting('wp_parallax_custom_footer',array(
	    	'capability' => 'edit_theme_options',
	    	'sanitize_callback' => 'absint',
	    	'transport' => 'refresh',
	    )
	);
    $wp_customize->add_control( 'wp_parallax_custom_footer',
    	array(
    		'label'  => esc_html__( 'Custom Footer', 'wpparallax' ),
    		'section' => 'wp_parallax_footer_section',
    		'type' => 'select',
    		'choices' => wpparallax_get_elementor_templates(),
    		'active_callback' => 'wpparallax_footer_layouts_cb' 
    	)
    );

    $wp_customize->add_setting( 'wp_parallax_footer_help', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Help_Control( $wp_customize, 'wp_parallax_footer_help',  array( 
      'label'     => esc_html__( 'Footer built from elementor will be applied.', 'wpparallax' ),
      'section'   => 'wp_parallax_footer_section',
      'active_callback' => 'wpparallax_footer_layouts_cb',
    ) ) );


    $wp_customize->add_setting( 'wp_parallax_tfooter_seperator', array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_tfooter_seperator',  array(
    	'type'      => 'text',                    
    	'label'     => esc_html__( 'Top Footer', 'wpparallax' ),
    	'section'   => 'wp_parallax_footer_section',
    ) ) ); 

    $wp_customize->add_setting( 'wp_parallax_top_footer_show', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    	'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_top_footer_show',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Hide / Show Top Footer', 'wpparallax' ),
    	'section'   => 'wp_parallax_footer_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Show', 'wpparallax' ),
    		'hide'  => esc_html__( 'Hide', 'wpparallax' )
    	),
    ) ) );

    $wp_customize->add_setting(
    'wp_parallax_tfooter_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_tfooter_bg_color', 
            array(
                'label' => esc_html__('Background Color','wpparallax'), 
                'section' => 'wp_parallax_footer_section',
            )
        )
    );

    $wp_customize->add_setting(
    'wp_parallax_tfooter_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_tfooter_text_color', 
            array(
                'label' => esc_html__('Text Color','wpparallax'), 
                'section' => 'wp_parallax_footer_section',
            )
        )
    );


    $wp_customize->add_setting( 'wp_parallax_bfooter_seperator', array(
    	'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Wp_Customize_Seperator_Control( $wp_customize, 'wp_parallax_bfooter_seperator',  array(
    	'type'      => 'text',                    
    	'label'     => esc_html__( 'Bottom Footer', 'wpparallax' ),
    	'section'   => 'wp_parallax_footer_section',
    ) ) ); 

    $wp_customize->add_setting(
    	'wp_parallax_footer_text', 
    	array(
    		'default'   => '',
    		'transport' => 'postMessage',
    		'sanitize_callback' => 'wp_kses_post'                   
    	)
    );    
    $wp_customize->add_control(
    	'wp_parallax_footer_text',
    	array(
    		'type'      => 'textarea',
    		'label'     => esc_html__( 'Copyright Text', 'wpparallax' ),
    		'description' => '<em>'.esc_html__( 'Shortcodes like [site_title],[year] can be used in this area.', 'wpparallax' ).'</e>',
    		'section'   => 'wp_parallax_footer_section',
    	)
    ); 
    $wp_customize->selective_refresh->add_partial( 'wp_parallax_footer_text', array(
    	'selector'        => '.footer-left',
    	'render_callback' => 'wp_parallax_footer_info',
    ) ); 

    $wp_customize->add_setting( 'wp_parallax_footer_icon_show', array(
    	'default' => 'show',
    	'sanitize_callback' => 'wp_parallax_sanitize_switch_option',
    	'transport' => 'postMessage'
    ) );

    $wp_customize->add_control( new Wp_Customize_Switch_Control( $wp_customize, 'wp_parallax_footer_icon_show',  array(
    	'type'      => 'switch',                    
    	'label'     => esc_html__( 'Hide / Show social icon', 'wpparallax' ),
    	'section'   => 'wp_parallax_footer_section',
    	'choices'   => array(
    		'show'  => esc_html__( 'Show', 'wpparallax' ),
    		'hide'  => esc_html__( 'Hide', 'wpparallax' )
    	),
    ) ) );  

    $wp_customize->add_setting(
    'wp_parallax_bfooter_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_bfooter_bg_color', 
            array(
                'label' => esc_html__('Background Color','wpparallax'), 
                'section' => 'wp_parallax_footer_section',
            )
        )
    );

    $wp_customize->add_setting(
    'wp_parallax_bfooter_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'wp_parallax_bfooter_text_color', 
            array(
                'label' => esc_html__('Text Color','wpparallax'), 
                'section' => 'wp_parallax_footer_section',
            )
        )
    );   
}
add_action( 'customize_register', 'wp_parallax_custom_customize_register' );