<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if ( !function_exists( 'store_hub_enqueue_scripts' ) ):
    function store_hub_enqueue_scripts() {
        wp_enqueue_style( 'store-hub-parent', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_script( 'store-hub-custom', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/custom.js',array('jquery'),'1.0.0',true );
    }
endif;
add_action( 'wp_enqueue_scripts', 'store_hub_enqueue_scripts', 10 );

/* Include Files */
require get_stylesheet_directory().'/inc/store-header.php';
require get_stylesheet_directory().'/inc/customizer.php';
if(class_exists('woocommerce')){
	require get_stylesheet_directory().'/inc/woo.php';
}

function store_hub_search(){
	?>
	<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <div>
	        <span class="screen-reader-text"><?php esc_html_e('Search for:','store-hub')?></span>
	        <input type="search" autocomplete="off" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'store-hub' ); ?>" value="" name="s">
	    </div>
	    <input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'store-hub' ); ?>">
	    <?php 
	    if( function_exists('WC') ):
	        ?>
	        <input type="hidden" name="post_type" value="product">
	        <?php
	    endif;
	    ?>
	</form>
	<?php
}

add_action('init','store_hub_remove_actions');
function store_hub_remove_actions(){
	$header_layout = get_theme_mod('wp_parallax_header_layouts','store-header');
	if($header_layout=='store-header'){
		remove_action('wp_parallax_mob_nav','wp_parallax_mob_nav');	
	}
}

//Dynamic Styles
function store_hub_dynamic_css($custom_css){
	$theme_color = sanitize_hex_color(get_theme_mod('wp_parallax_theme_color'));
	if($theme_color){
		$custom_css .= ".woocommerce ul.products li .woo-content a.add_to_cart_button:after,
body.woocommerce ul.products li .woo-content a.added_to_cart:after{ background-color:$theme_color !important;}
ul.products li.product .icons a.added_to_cart:hover{color: $theme_color !important;}";
	}

	return $custom_css;
}
add_filter( 'wpparallax_dynamic_css', 'store_hub_dynamic_css' );