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
define( 'AUTH_KEY',          'Bqxl$`_!0u5OW([V{1_}UJF7jiGq5*P!SfgmdEB%4;LojP4lR<Gcx1Wu4N62bT,j' );
define( 'SECURE_AUTH_KEY',   '(x-xh?J<.pEDR7z`vN<+qq7<Cl$37&.Wxm+8m*gU|hmc3Zrpht$aP{Gk^$VI%uC?' );
define( 'LOGGED_IN_KEY',     'CGxzcY):IDOXjs0t9+P2tL$R~nw ]|5QdyJt2l&lv=03fhSjw=p]rY3 {w17BgDC' );
define( 'NONCE_KEY',         'zTdwe~5Lkq~:dGl7IV)FN/`9IIzAbA-5nLV7l|U{FcLs{ ,0r0^$zC(^O_5}YIp;' );
define( 'AUTH_SALT',         '!i<ydpE%feiwp+r]S7fp]+ODf_=dW=q)Go&~%BNj&)~#w{9JQTncN~(G~Dd4h=<0' );
define( 'SECURE_AUTH_SALT',  '!i#0~Ron*vX9,CxRtB,P/NAW~y+uJ4_(y2Y^U0F:O}6d0b]}O=+fF C^g*Pa<Z&[' );
define( 'LOGGED_IN_SALT',    'KL1x.d7mi_ct2dbIC!FwR i_jQ/=N1q,W[AG?oIJW>~i9K!LIs}u*qB/83(D_Qu)' );
define( 'NONCE_SALT',        'YBRzY.X7ky-h)(cDtJ|TY:jM3hR%:WuQ M7+>]Nl>Z]j>,sm8]@u*ci09S,?dK]A' );
define( 'WP_CACHE_KEY_SALT', 'DXj:mkMZ6@+u 0P^:3rwflgFm+r;KZMI`ola8v_F1fAo!eU>wFgz{9*vOPc%+Z2;' );


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
