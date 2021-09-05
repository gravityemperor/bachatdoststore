<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpparallax
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php 
do_action( 'wp_parallax_before_body_output' );
?>
<body <?php body_class(); ?>>
<?php 
if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
}
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'store-hub' ); ?></a>
<div id="page" class="site">
	<?php do_action( 'wp_parallax_before_header' ); ?>
	<?php 
	$header_layout = get_theme_mod('wp_parallax_header_layouts','store-header');
	$wp_parallax_slider_show = get_theme_mod('wp_parallax_slider_show','show');
	$wp_parallax_slider_cat = get_theme_mod('wp_parallax_slider_cat',0);
	if($header_layout != 'layout3') {
		$class_sl = 'slider-hidden';
		if( ($wp_parallax_slider_show == 'show') && ($wp_parallax_slider_cat != 0) ){
			$class_sl = '';
		}	
	}else{
		$class_sl = '';
	}
	
    $meta = get_post_meta(get_the_ID(),'ultra_page_header',true);
    $header_layout = get_post_meta(get_the_ID(),'ultra_page_header',true);
    $template_id = get_post_meta(get_the_ID(),'ultra_page_custom_header',true);
    
    if($header_layout == 'default' || $header_layout == ''){
        $header_layout = get_theme_mod( 'wp_parallax_header_layouts','store-header' );
        $template_id = get_theme_mod('wp_parallax_custom_header');
    }

	if ( !is_front_page() || !is_page_template('tpl_home.php') ){ 
		$home_inner='wpop-inner';
	} else{ 
		$home_inner='';
	}

    if($header_layout!='hide'){

	    $header_classes   = apply_filters( 'wp_parallax_header_classes', array(
	    'site-header',
	    $home_inner,
	    $class_sl,
	    $header_layout
	    ) );

	    echo '<header id="masthead" class="'.esc_attr( implode( ' ', array_map( 'sanitize_html_class', $header_classes ) ) ).'">';

        if($header_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
        }elseif($header_layout == 'store-header'){
        	do_action('store_hub_mob_nav');
        	do_action( 'store_hub_header' );
        }else{

			/**
			 *
			 * @see  wp_parallax_top_header() - 10
			 * @see  wp_parallax_button_header() - 20
			**/			
			do_action( 'wp_parallax_header' ); 
        }
        echo '</header>';
	}
	?>
		
	<?php do_action( 'wp_parallax_after_header' ); ?>

	<div id="content" class="site-content">

