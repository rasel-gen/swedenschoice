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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'swedens_choice' );

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
define( 'AUTH_KEY',         '=eC|0!W8`g!~ag-;FaoC:x0ceMp_YNeggEJ|;4y9KWT]B. beE&u=Qdma(:~5|{m' );
define( 'SECURE_AUTH_KEY',  'G%@ <LhxTpCx?<O*RaSAA3EkEqM9_&_m*/(1l~uZGF#_C~Hm>PJ+;pAYR.t&KsP|' );
define( 'LOGGED_IN_KEY',    '_Dh7LZ#,OynxJ;%hWD! >H4=:yQdq-3>^B@Trvri]C>)9H{qN!#*!adr}VSgvWn+' );
define( 'NONCE_KEY',        'Jdb&DC(/:)Y:a,GDup1ol9 U;wW?{$(_&2[W#A.|B:Sroqgz[DcZu0HrheCvO> ;' );
define( 'AUTH_SALT',        '?H0E$80#]DFwZXopf;k?9k_e`DTjD]bJ`(Mpg;401iPW X #0Bjnbp&7WTs4k;|J' );
define( 'SECURE_AUTH_SALT', 'V8&A3:Hbuaso/D=1)}bDVY+x30M=)DT F~/$_dN0~}GR=F)9#1y1RTE]2ci~X~*7' );
define( 'LOGGED_IN_SALT',   ']|/ncD^+5@F&tmzwZ~L>{673:ZoTAsK@GxpM&[sGz5`P[EiBaEdMSDQ8/I)U7`<s' );
define( 'NONCE_SALT',       'R>b_${-?X?.jLQWWFf5VZ1C-b5a92D*#6~,!PHHeJI9j$<i+,E<I} @3t%24|F%a' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'res_';

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
