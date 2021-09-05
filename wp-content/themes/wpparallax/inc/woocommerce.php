<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package wpparallax
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function wp_parallax_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wp_parallax_woocommerce_setup' );



/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function wp_parallax_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'wp_parallax_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function wp_parallax_woocommerce_products_per_page() {
	$perpage = get_theme_mod('wpparallax_product_perpage',9);
	return $perpage;
}
add_filter( 'loop_shop_per_page', 'wp_parallax_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function wp_parallax_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'wp_parallax_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function wp_parallax_woocommerce_loop_columns() {
	$col = get_theme_mod('wpparallax_woo_column',4);
	return $col;
}
add_filter( 'loop_shop_columns', 'wp_parallax_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function wp_parallax_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wp_parallax_woocommerce_related_products_args' );

if ( ! function_exists( 'wp_parallax_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function wp_parallax_woocommerce_product_columns_wrapper() {
		$columns = wp_parallax_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'wp_parallax_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'wp_parallax_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function wp_parallax_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'wp_parallax_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'wp_parallax_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function wp_parallax_woocommerce_wrapper_before() {
		?>
		<?php 
		$show_bread = get_theme_mod('wp_parallax_show_shop_banner','show');
		$show_bread_single = get_theme_mod('wp_parallax_show_shop_single_banner','hide');
		if($show_bread == 'show' && !is_product()){	
			do_action('wp_parallax_breadcrumb');
		}
		if($show_bread_single == 'show' && is_product()){	
			do_action('wp_parallax_breadcrumb');
		}
		?>
		<div class="wpop-container clearfix">
		<div class="inner-container clearfix">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'wp_parallax_woocommerce_wrapper_before' );

if ( ! function_exists( 'wpparallax_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function wpparallax_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar('shop');?>
		</div>
		</div><!--.wpop-container-->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'wpparallax_woocommerce_wrapper_after' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/* Manage Folder Structure */
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);

function wp_parallax_woo_thumb_wrap_open(){
	echo '<figure>';
	do_action('wpparallax_product_icons');
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_before_shop_loop_item','wp_parallax_woo_thumb_wrap_open',10);

function wp_parallax_woo_thumb_wrap_close(){
	woocommerce_template_loop_product_link_close();
	echo '</figure>';
}
add_action('woocommerce_before_shop_loop_item_title','wp_parallax_woo_thumb_wrap_close',15);

function wp_parallax_woo_content_wrap_open(){
	echo '<div class="woo-content">';
}
add_action('woocommerce_shop_loop_item_title','wp_parallax_woo_content_wrap_open',5);

function wp_parallax_woo_content_wrap_close(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','wp_parallax_woo_content_wrap_close',25);

function wp_parallax_woo_desc_wrap_open(){
	echo '<div class="woo-desc-wrap">';
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_shop_loop_item_title','wp_parallax_woo_desc_wrap_open',6);

function wp_parallax_woo_desc_wrap_close(){
	woocommerce_template_loop_product_link_close();
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','wp_parallax_woo_desc_wrap_close',5);


function wp_parallax_single_breadcrumb(){
	$show_bread_single = get_theme_mod('wp_parallax_show_shop_single_banner','hide');
	if($show_bread_single == 'hide'){
        $seperator = get_theme_mod('wp_parallax_breadcrumb_delimiter','>>');
        $args = array( 'delimiter' => '<span class="delimiter">'.esc_attr($seperator).'</span>' );
        woocommerce_breadcrumb( $args );
	}
}
add_action('woocommerce_single_product_summary','wp_parallax_single_breadcrumb',3);

/**
 * Header Type to Shopping Cart function 
**/
if ( wp_parallax_is_woocommerce_activated() ) {
    
    /**
     *  Cart function area for header one
    */
    if ( ! function_exists( 'wp_parallax_shopping_cart' ) ) {
       function wp_parallax_shopping_cart(){ ?>
            <a class="cart-contentsone" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'wpparallax' ); ?>">
               <div class="count">
				<svg xmlns="http://www.w3.org/2000/svg" height="512pt" viewBox="0 -31 512.00026 512"><path d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"></path><path d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path><path d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path></svg>
                   <span class="cart-count"><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?></span>
               </div>                                      
           </a>
       <?php
       }
    }

    if ( ! function_exists( 'wp_parallax_cart_header_link_fragment' ) ) {

        function wp_parallax_cart_header_link_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            wp_parallax_shopping_cart();
            $fragments['a.cart-contentsone'] = ob_get_clean();
            return $fragments;
        }
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'wp_parallax_cart_header_link_fragment' );

}



if ( ! function_exists( 'wpparallax_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function wpparallax_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php wpparallax_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);

function wpparallax_product_wrap(){
    woocommerce_template_loop_product_thumbnail();
    woocommerce_template_loop_product_link_close();
}

add_action('woocommerce_before_shop_loop_item_title','wpparallax_product_wrap',10);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
function wpparallax_woocommerce_template_loop_price(){ ?>
    <div class="product-price-wrap clearfix">
        <?php woocommerce_template_loop_price(); ?>        
    </div>
<?php
}
add_action( 'woocommerce_after_shop_loop_item_title' ,'wpparallax_woocommerce_template_loop_price', 12 );

/*Woocommerce Breadcrumb */

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter( 'woocommerce_breadcrumb_defaults', 'wpparallax_change_breadcrumb_delimiter' );
function wpparallax_change_breadcrumb_delimiter( $defaults ) {
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}

add_filter( 'woocommerce_show_page_title', 'wpparallax_woo_hide_page_title' );
function wpparallax_woo_hide_page_title() {
	
	return false;
	
}

/* Sale tag text */
function wp_parallax_sale_tag_text(){
	$sale_text = get_theme_mod('wpparallax_saletag_text','Sale');
    return '<span class="onsale">' . esc_html($sale_text) . '</span>';
}
add_filter('woocommerce_sale_flash', 'wp_parallax_sale_tag_text', 10, 3);

remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10 );    
add_action( 'woocommerce_before_single_product_summary','wp_parallax_sale_tag_text',10 );

/* Related Product show/Hide */
$show_related = get_theme_mod('wp_parallax_show_related_products','show');
if($show_related == 'hide'){
	remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
}