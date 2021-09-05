<?php
/**
 * Opstore Constants definition file
 *
 * @package  WPparallax
 */
// get theme data
$theme = wp_get_theme();

// theme core directory path & uri
$dir = get_template_directory();
$uri = get_template_directory_uri();

/**
 * Theme constants
 */
define( 'WPPLX_THEME', $theme->get( 'Name' ) );
define( 'WPPLX_VERSION', $theme->get( 'Version' ) );

/**
 * Template directory & uri
 */
define( 'WPPLX_DIR', wp_normalize_path( $dir ) );
define( 'WPPLX_URI', trailingslashit( $uri ) );

/**
 * Theme assets URI & DIR
 */
define( 'WPPLX_ASSETS', WPPLX_DIR . '/assets/' );
define( 'WPPLX_ASSETS_URI', WPPLX_URI . 'assets/' );
define( 'WPPLX_CSS', WPPLX_ASSETS_URI . 'css/' );
define( 'WPPLX_JS', WPPLX_ASSETS_URI . 'js/' );
define( 'WPPLX_EXT', WPPLX_ASSETS_URI . 'ext/' );
define( 'WPPLX_IMAGES', WPPLX_ASSETS_URI . 'images/' );


/* PHP Closing tag is omitted */