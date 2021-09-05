<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpparallax
 */
$sticky_sidebar = get_theme_mod('wp_parallax_sticky_sidebar','show');
if($sticky_sidebar == 'show'){
	wp_enqueue_script('theia-sticky');
}
$sidebar = '';
$sidebar_layout = '';

if(is_archive() || is_tag() || is_home() || is_author() || is_search()){
	
	$sidebar_layout = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
	$sidebar = get_theme_mod('archive_page_sidebar','sidebar-right');
}
if(is_page()){

	$page_sidebar = get_post_meta(get_the_ID(),'ultra_sidebar',true);
	$psidebar_layout = get_post_meta(get_the_ID(),'ultra_sidebar_layout',true);

	if($psidebar_layout == 'default' || $psidebar_layout == ''){
		$sidebar_layout = get_theme_mod('wp_parallax_single_page_sidebars_layout','nosidebar');
    }else{
    	$sidebar_layout = $psidebar_layout;
    }
	if($page_sidebar == '0' || $page_sidebar == ''){
		$sidebar = get_theme_mod('wp_parallax_single_page_sidebar','sidebar-right');
    }else{
    	$sidebar = $page_sidebar;
    }
} 
if(is_single()){
	$post_sidebar = get_post_meta(get_the_ID(),'ultra_sidebar',true);
	$psidebar_layout = get_post_meta(get_the_ID(),'ultra_sidebar_layout',true);

	if($psidebar_layout == 'default' || $psidebar_layout == ''){
		$sidebar_layout = get_theme_mod('wp_parallax_single_post_sidebars_layout','rightsidebar');
    }else{
    	$sidebar_layout = $psidebar_layout;
    }
	if($post_sidebar == '0' || $post_sidebar == ''){
		$sidebar = get_theme_mod('wp_parallax_single_post_sidebar','sidebar-right');
    }else{
    	$sidebar = $post_sidebar;
    }
}
if(class_exists('woocommerce')){
	
	if(is_shop() || is_product() || is_product_category() ){
		$sidebar_layout = get_theme_mod('wpparallax_shop_sidebar_layout','nosidebar');
		$sidebar = get_theme_mod('wpparallax_shop_sidebar','sidebar-shop');
	}
}

if($sidebar == ''){
	return;
}

if( ! is_active_sidebar($sidebar)){
	return;
}

if($sidebar_layout == 'rightsidebar'){
	$ID = 'secondaryright';
}elseif($sidebar_layout == 'leftsidebar'){
	$ID = 'secondaryleft';
}else{
	$ID = '';
}
if($sidebar_layout!='nosidebar'){
	echo '<aside id="'.esc_attr($ID).'" class="widget-area" role="complementary">';
	dynamic_sidebar( $sidebar );
	echo '</aside>';
} 
