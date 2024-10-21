<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'avalon-logistics' );

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
define( 'AUTH_KEY',         'o:U)u}+fF)uud_eA<9b]e0bB|Ll}onZ|_~l!TJT3Z:a$;Y*^Y8i=(--$9BFPb<_H' );
define( 'SECURE_AUTH_KEY',  'IL2?qy}%6ng?fgd9[O|&!1nwj~p](%>&frh;1~.r5nly^lw.mdy&h;8#%*%,gprz' );
define( 'LOGGED_IN_KEY',    'p@O5drlvhoIqxEeF?^h!_<tP 1F<PynIqE=0p9y>u6DFT#yXKNPE_FB+,zc=ag`L' );
define( 'NONCE_KEY',        '+w}9$2sgh?L0%|Xd)1hbhziK:hP5p/n3xiw3fO9b*BM5&8J.Uqf0NyK|+O%i4A4R' );
define( 'AUTH_SALT',        'j-~KwoS8uVAv5bd_r6MW;bBWyM]eop.8kZH[bryU<H|q9lfaij:0L C^u1E-NNZ<' );
define( 'SECURE_AUTH_SALT', 'oFXIo+zko7>1BjnZ?@IF mlJeq_X+y.nb`>x;KaA{iLsm!>KrSiL-an3rw6ka,&q' );
define( 'LOGGED_IN_SALT',   'ck{!riD=<*Gkn}hM]&^|]Xc~wdRQu,xWxF_WJud*r[vA(RNo;M^s-.,g1Z+bTR/(' );
define( 'NONCE_SALT',       '_aM_0_Y36yA5tDL5c7.h{JMUUG lx0:oi#kEc{|+X41leffx77*X]9^Jy:cO?FI^' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
