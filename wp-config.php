<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bachatdoststore_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'hGp![-EMC0r z66,wJ|Sk]D.!  #K[-#L[PYow0)Rob#cNt#(AHF&A/K3Y>!z<j|' );
define( 'SECURE_AUTH_KEY',  ':LZDeXz Swhtu._?c4Fq?RS`_1ofM$76TI#1v`o?~3_`#|{:fO:,8/&KF3S:b){R' );
define( 'LOGGED_IN_KEY',    'U>Lmv)PjgRRhXX~&&uv(]yTun6hN}^YZu%@Ei5u/zbh#HSkY$9X={9a?Qp^S?CFT' );
define( 'NONCE_KEY',        'LT4yR~duQ5J0hGk >Jrqa!Sjxkfa`+BAUo> o5NsP*}`dF6t3@Q 1e-%8e<SHV5G' );
define( 'AUTH_SALT',        'CF:Ohp{A[GYW]JhL)D)ZpH; sSL3vD5,0gJ#u!s10Vd>hVS=(G#vg0$nMzqB.m:P' );
define( 'SECURE_AUTH_SALT', '3z8d%HAd{.0/@EgDW6>{]RW#gJxV{lQ ba=SDG9q1so{g,6n/`^~5}/9d0+2bp9D' );
define( 'LOGGED_IN_SALT',   'Kyecx%ZdH$;@UTX<+{+&e0R#j.LN0WH;[J9CVym-3^%|2;0fwjDj*BMe*e*`a&4Z' );
define( 'NONCE_SALT',       '@_|[>~v!+uau+:s,8,Br|d S# 5v@VuO3C[k+<NE8xYHGc 06r!V6pZ%~gKB!%!x' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
