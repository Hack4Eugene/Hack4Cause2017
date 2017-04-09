<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'affec_wpdb');

/** MySQL database username */
define('DB_USER', 'affec_wpuser');

/** MySQL database password */
define('DB_PASSWORD', 'yGFt&#&)ztVx');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'wH$)|Bz^JUG{szX!sYZS:+eu&p>*.Ic}HqBlb_rSFdI,D)-oXFh4z{Zc8O$pA&I>');
define('SECURE_AUTH_KEY',  'Z^bRFX5#7nes+T1C3#_@WWSqD-9214Dc`xx-,vg]zpp$tY{69ugw [y}Vya6byi#');
define('LOGGED_IN_KEY',    '~g;N5_x*rKb8iKK2<kM%8!-r!UHLYdJi!F>T|@mjV7d4IgX:5b2m<i|B)},n _4:');
define('NONCE_KEY',        '46a_wRZ=+_O!;05i=RpR&SKIej+9Ab_gH(lCU.G$HrP!uS7%cO^26>UV|T>tu$C?');
define('AUTH_SALT',        '?~5LFpw61uO,M!!+Wl<N%HJ:[?]8hp SYD(Wc{OZpCNIF1#]UM9l[ntjA3TClb:c');
define('SECURE_AUTH_SALT', '16Vz75[Y!r0/!z!&O6ZR>%;W;`J4Q|NkB<Ek=`PHLl3=uf}]Xy.qHrGkgcgX22s`');
define('LOGGED_IN_SALT',   'bc 1q_PK@m08^X^wPpcnU.@2GX27%Pry J>pd_fP_?8;ywN.Cri.Y,Rm(4vXDKXY');
define('NONCE_SALT',       '`r}tkv%E5ur qycDb$8|7$^XQ(tDT1oN..=B#p9!]]y-g,O;<^tedvZ|Uhz4*A[9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_MEMORY_LIMIT', '64M');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
