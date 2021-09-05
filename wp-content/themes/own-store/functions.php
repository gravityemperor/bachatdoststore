<?php 


/**
 *  Defining Constants
 */

// Core Constants
define('OWN_STORE_REQUIRED_PHP_VERSION', '5.6' );
define('OWN_STORE_THEME_AUTH','https://www.spiraclethemes.com/');
define('OWN_STORE_THEME_URL','https://www.spiraclethemes.com/own-store-free-wordpress-theme/');
define('OWN_STORE_THEME_PRO_URL','https://www.spiraclethemes.com/own-store-pro-addons/');
define('OWN_STORE_THEME_DOC_URL','https://www.spiraclethemes.com/own-store-documentation/');
define('OWN_STORE_THEME_VIDEOS_URL','https://www.spiraclethemes.com/own-store-video-tutorials/');
define('OWN_STORE_THEME_SUPPORT_URL','https://wordpress.org/support/theme/own-store/');
define('OWN_STORE_THEME_RATINGS_URL','https://wordpress.org/support/theme/own-store/reviews/');
define('OWN_STORE_THEME_CHANGELOGS_URL','https://themes.trac.wordpress.org/log/own-store/');
define('OWN_STORE_THEME_CONTACT_URL','https://www.spiraclethemes.com/contact/');
define('OWN_STORE_CONTAINER_CLASS', esc_html(get_theme_mod('own_shop_layout_content_width_ratio','os-container')));


/**
* Check for minimum PHP version requirement 
*
*/
function own_store_check_theme_setup( $oldtheme_name, $oldtheme ){
  	// Compare versions.
  	if ( version_compare(phpversion(), OWN_STORE_REQUIRED_PHP_VERSION, '<') ) :
	  	// Theme not activated info message.
	  	add_action( 'admin_notices', 'own_store_php_admin_notice' );
	  	function own_store_php_admin_notice() {
	    	?>
	      		<div class="update-nag">
	          		<?php 
	          			esc_html_e( 'You need to update your PHP version to a minimum of 5.6 to run Own Store WordPress Theme.', 'own-store' ); 
	          		?> 
	          		<br />
	          		<?php esc_html_e( 'Actual version is:', 'own-store' ) ?> 
	          		<strong><?php echo phpversion(); ?></strong>, 
	          		<?php esc_html_e( 'required is', 'own-store' ) ?> 
	          		<strong><?php echo OWN_STORE_REQUIRED_PHP_VERSION; ?></strong>
	      		</div>
	    	<?php
	  	}
		// Switch back to previous theme.
		switch_theme( $oldtheme->stylesheet );
		return false;
	endif;
}
add_action( 'after_switch_theme', 'own_store_check_theme_setup', 10, 2  );



/**
 * Own Store theme functions
 */	
function own_store_theme_setup(){

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	//remove theme support for new widgets block editor
	remove_theme_support( 'widgets-block-editor' );
    
    remove_action( 'admin_menu', 'own_shop_add_menu' );
    remove_action( 'enqueue_block_editor_assets', 'own_shop_block_editor_width_styles' );
    unregister_nav_menu( 'topbar' );
	
	add_action('wp_enqueue_scripts', 'own_store_load_scripts');

	/**
	* Adding translation file
	*/
	$path = get_stylesheet_directory().'/languages';
    load_child_theme_textdomain( 'own-store', $path );

    if ( is_customize_preview() ) :
    	require_once( get_stylesheet_directory(). '/inc/starter-content.php' );
		add_theme_support( 'starter-content', own_store_get_starter_content() );
	endif;
}
add_action( 'after_setup_theme', 'own_store_theme_setup', 99 );



/**
 * Setting default theme mods value for child theme
 */
function own_store_set_default_theme_mods() {
	set_theme_mod('own_shop_site_primary_color', '#333333');
    set_theme_mod('own_shop_site_secondary_color', '#000000');
}
add_action('after_switch_theme', 'own_store_set_default_theme_mods');


/**
 * Load Scripts
 */
function own_store_load_scripts() {

	//dequeue parent blocks-frontend
	wp_dequeue_style( 'blocks-frontend' );

	//dequeue parent fonts
	wp_dequeue_style( 'poppins-google-font' );
	wp_dequeue_style( 'Josefins-google-font' );
	
	wp_register_style( 'own-store-style' , trailingslashit(get_stylesheet_directory_uri()).'style.min.css', false, wp_get_theme()->get('Version'), 'all');
	wp_style_add_data( 'own-store-style', 'rtl', 'replace' );
	wp_style_add_data( 'own-store-style', 'suffix', '.min' );
	wp_enqueue_style( 'own-store-style' );

	if ( own_store_is_active_woocommerce() ) :
		wp_register_style( 'own-store-woocommerce-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/woo-style.min.css', array(), wp_get_theme()->get('Version'));
    	wp_style_add_data( 'own-store-woocommerce-style', 'rtl', 'replace' );
    	wp_style_add_data( 'own-store-woocommerce-style', 'suffix', '.min' );
		wp_enqueue_style( 'own-store-woocommerce-style' );
	endif;
	
	wp_register_style( 'own-store-blocks-frontend', trailingslashit(get_stylesheet_directory_uri()).'css/blocks-frontend.min.css', false, wp_get_theme()->get('Version'), 'all');
	wp_style_add_data( 'own-store-blocks-frontend', 'rtl', 'replace' );
	wp_style_add_data( 'own-store-blocks-frontend', 'suffix', '.min' );
	wp_enqueue_style( 'own-store-blocks-frontend' );

	wp_enqueue_style( 'red-hat-display-google-font', 'https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap', array(), '1.0');

}

/**
 * Display dynamic CSS.
 */
function own_store_dynamic_css_wrap() {
    require_once( get_stylesheet_directory(). '/css/dynamic.css.php' );
    ?>
       	<style type="text/css" id="own-store-dynamic-style">
        	<?php echo own_store_dynamic_css_stylesheet(); ?>
       	</style>
    <?php 
}
add_action( 'wp_head', 'own_store_dynamic_css_wrap',20 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function own_store_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Sidebar', 'own-store' ),
		'id'            => 'topsidebar',
		'description'   => esc_html__( 'Add widgets here.', 'own-store' ),
		'before_widget' => '<ul id="%1$s" class="widget %2$s">',
		'after_widget'  => '</ul>',
	) );
}
add_action( 'widgets_init', 'own_store_widgets_init', 20 );


/**
 * Admin scripts
 */
if ( ! function_exists( 'own_store_admin_scripts' ) ) :
function own_store_admin_scripts($hook) {
    if('appearance_page_own-store-theme-info' != $hook)
    	return;  
    wp_enqueue_style( 'own-store-info', trailingslashit(get_stylesheet_directory_uri()).'css/own-store-theme-info.css', false );
}
endif;
add_action( 'admin_enqueue_scripts', 'own_store_admin_scripts' );


/**
 * Adding class to body
 */
if ( ! function_exists( 'own_store_add_classes_to_body' ) ) :
function own_store_add_classes_to_body($classes = '') {
    return array_merge( $classes, array( 'own-store','layout-'.OWN_STORE_CONTAINER_CLASS ) );
}
endif;
add_filter('body_class', 'own_store_add_classes_to_body');


/**
 * Function for Minimizing dynamic CSS
 */
function own_store_minimize_css($css){
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css);
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}


/**
 * Load our Block Editor styles to style the Editor like the front-end
 */
if ( ! function_exists( 'own_store_block_editor_width_styles' ) ) :
function own_store_block_editor_width_styles() {
	$own_store_layout_width = 1200;
	$styles = '';

	wp_register_style( 'own-store-blocks-style', trailingslashit(get_stylesheet_directory_uri()).'css/blocks-style.min.css',  array(), '1.0.0', 'all');
	wp_style_add_data( 'own-store-blocks-style', 'rtl', 'replace' );
	wp_style_add_data( 'own-store-blocks-style', 'suffix', '.min' );
	wp_enqueue_style( 'own-store-blocks-style' );

	// Increase width of Title
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-post-title .editor-post-title__block {max-width: ' . esc_attr( $own_store_layout_width - 10 ) . 'px;}';

	// Increase width of all Blocks & Block Appender
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block {max-width: ' . esc_attr( $own_store_layout_width - 10 ) . 'px;}';
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-default-block-appender {max-width: ' . esc_attr( $own_store_layout_width - 10 ) . 'px;}';

	// Increase width of Wide blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="wide"] {max-width: ' . esc_attr( $own_store_layout_width - 10 + 400 ) . 'px;}';

	// Remove max-width on Full blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="full"] {max-width: none;}';

	// Adding dynamic color
	$styles .= '.wp-block-button__link, .wc-block-grid__product-onsale, .wp-block-search .wp-block-search__button {background-color: ' .sanitize_hex_color(get_theme_mod( 'own_shop_site_primary_color','#cc9866' )) .';}';

	// Output our styles into the <head> whenever our block styles are enqueued
	wp_add_inline_style( 'own-store-blocks-style', $styles );
}
endif;
add_action( 'enqueue_block_editor_assets', 'own_store_block_editor_width_styles' );



/**
* Includes
*/

//include info
require_once( get_stylesheet_directory(). '/inc/theme-info.php' );


//include customizer
require_once( get_stylesheet_directory(). '/inc/customizer/customizer.php' );


//include template functions
require_once( get_stylesheet_directory(). '/inc/template-functions.php' );


//include template hooks
require_once( get_stylesheet_directory(). '/inc/template-hooks.php' );


/**
 * Upgrade to Pro
 */
require_once( get_stylesheet_directory(). '/own-store-pro/class-customize.php' );
