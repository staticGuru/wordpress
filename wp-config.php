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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'newsite' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'aK7disfZ+#23fYh1A%h[8|Tu[X>*db8Xup-V}<i`64t|SW?n{V&h(5*aTIIOt*B0' );
define( 'SECURE_AUTH_KEY',  'PrkHn7<r[T>.X/^x[9+N]XjspU6^#9JNv[5d:^UN_p@b2lmrF?@>C|?MCXzk}*K>' );
define( 'LOGGED_IN_KEY',    'iQkTgw#z!]?jzW^Q]x)bcV</8j,e=sHTaB9=KpBh;MzZfmtg[t9fO5aDd){zXI-8' );
define( 'NONCE_KEY',        '%X/vA-ss+s 4eg{/q0Y3gG.)[`o#!_4GSB!aNos>)qW40-.P0j|4~+wTs=$oz?in' );
define( 'AUTH_SALT',        'q2aouGNJcC#tA6D2Fi%A12#e=yxsX6*@k7_oQ-M|2r#*B[fAMR>{^C[SC<uV|V|s' );
define( 'SECURE_AUTH_SALT', '~f$/la__=>V)?^K_*}g5qr4z[{cc7JCW,{sdmVf6~x<=gN(,&`mH:SE94w6N8o#z' );
define( 'LOGGED_IN_SALT',   'xc{Bv!0~TzKO|]wFP07!r/}N6h@J8zB)FZW-ULMG?%25uXoVg7+axcqoU_lY|.rQ' );
define( 'NONCE_SALT',       'PN3^wV9cTaeqCzWKE{5B-v(_7Qo+ /1OXx r!T858Z5L?hOdl}5%a/4{}RX(gdGA' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
