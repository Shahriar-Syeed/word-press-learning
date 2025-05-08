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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '@e5OsdyPv83XH4{F&YSYdaw2a(j`+Qol(}2I;JzOEmDG5Ve8C|06}}j^Xq=*s=?3' );
define( 'SECURE_AUTH_KEY',   'f:<9zzfQ;C&0<YoiC:{q2lFMv2]c35PAB2|8p)yX4U#l |$USKEry?!wEu.{/[GV' );
define( 'LOGGED_IN_KEY',     'T.Ub$} A&TU2>Pvr}JDRIFw_*~#{dVDYT6pN(WxF>+,^Y2*Ei]|&p;[,6a~{ry_L' );
define( 'NONCE_KEY',         ',Vbh(X& VeqKu^)kjOdL]^d3x.IcQ<u!h8D5Lc_j; 6 CWC@jz~{yS5t[CmwE3RH' );
define( 'AUTH_SALT',         '18FIcg+|^YNvgG> )<zNWc!gJS1i4A^X^%W.c?vrMkI~Sm8}g~J5v6Y1,$=%fgS~' );
define( 'SECURE_AUTH_SALT',  '.rNRxq3q4a|0@XW`3DC&G-Gjy+|oz/`87HmB/(DEt6&6[&s+Pa+Vw?c7]y,<v0XM' );
define( 'LOGGED_IN_SALT',    'n}vhJtM=@mhw%/ 8f.jJ8Ohp&GW9fw>zdK!NAym _)&{GYzJw@@OWk+rq+$R4fTg' );
define( 'NONCE_SALT',        'S^994rm?:98{fK#mb63lq=^)NZ|V:;G-9.0o?@!q4d3psAxFRyXuc?4 cn{|lum+' );
define( 'WP_CACHE_KEY_SALT', '_le?1ieGBWT|KY+i=ETBn;O:a>C1a|pqCC!QR]A*2BmUlJ,vuAoN]rFo.II[Bjs[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
