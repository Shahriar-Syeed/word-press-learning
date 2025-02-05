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
define( 'AUTH_KEY',          'O[rn e/&@1ykfazJ.<vLsaZHI9!>}A)a+5j3f+O&|a>f|%&]V4y189YuX [&+v3.' );
define( 'SECURE_AUTH_KEY',   'vX1+!`E<[B&=RH5-O$YtT/ef9VgMJGo=0ON$!GsN:/oOka*]vuxIVM!>vE;PCDg#' );
define( 'LOGGED_IN_KEY',     'iBnr`f{CMvYm,xg~LuX_EK2NeoI|*/pTwZzinc?Ys/%?wDqio>JYcW75FEdhx2Q?' );
define( 'NONCE_KEY',         's>Ubz49{BR+H?:&D=;}O9Nqw`j*,Y7(Xbzr6pjZ8ZGh)Z9!Wd+N&RUcJ >?Lp42G' );
define( 'AUTH_SALT',         'M&?!{r:!8dw0}kg9HS!F95Nta+55!5eD$LU7})*}>C+Cm|PAzp`%W<{ndJ8Ll*^-' );
define( 'SECURE_AUTH_SALT',  'DD=5Be0o0VAIICkf_<G-p>8_&s[?]3[7]4|bQy6at#]n{X$&?zjP_W+:$>CL5wY+' );
define( 'LOGGED_IN_SALT',    'F@WO+)r?M-jx-m5P,Nf{`+^(N@?o;.jy]o6:J.< }%AH5-Pb(&?JRgdS&Cw+id]_' );
define( 'NONCE_SALT',        '?FO/];2e^mM<1[V)`yF^P`MA[gW.7!]T,vSit WA}{2^Y__ps6E!P.Oe(Hti7w$G' );
define( 'WP_CACHE_KEY_SALT', '0S&!N85wm4OMvm}~fxuS(OSDS]6*d_R;xlm,&]`9^k4((yjQAVNAc#>Y1{qaVwn0' );


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
