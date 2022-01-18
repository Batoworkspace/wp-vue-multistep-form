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
define( 'DB_NAME', 'multistep' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         ' @8|&6(N6CF@2po)~sw|ui1X.e@&vvMf(AW@X6%U_Xk[=&(6eAYXsAoZfq6:E-8_' );
define( 'SECURE_AUTH_KEY',  'K!IpRA1F}`j-;8lp7Y2cDjR1xwj|:g1!Gkv:j_.<bN#/j)5=wcg68.9ud,@/R&{Y' );
define( 'LOGGED_IN_KEY',    '<W(8n0ghgxQH1L~l%f|VGtr9uBfH:iWQ7>Z!]g&,C$<3_R*a*HJp?P8#z-3i8G.f' );
define( 'NONCE_KEY',        'pv*#<^(xitWnC)GQRTxs)E3FP(`f<k^m$817)/p`Sa)L]84g8^#A3bHHQ!6o;g,g' );
define( 'AUTH_SALT',        'rA`!SdKjwQ{M1/4~`?B2FMJY5Fl2MBe5LD^J|^4G>|{I>#$dQn$Yu3h&5x+6q&~4' );
define( 'SECURE_AUTH_SALT', '{BbrmJdZ~=T,bW?1GWTs`C2y,Jl5&n=w~Fg?kqB#$IPUF`f3r_vD!(NUwfb(``+}' );
define( 'LOGGED_IN_SALT',   '%NYB^>udrd.}.YkT*Bt}#,5{PI,In.eLZrElU4J6b4R:WaBVEPR9&c?PFuEr%kPX' );
define( 'NONCE_SALT',       'f<@!$|Dt.h^s`*TjUKM2jsb;#bY2?0lxs2YX8bQGtLd0t]q0VSNl>|L!0&!@y<&G' );

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
