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
define( 'DB_NAME', 'wsu-wordpress01' );

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
define( 'AUTH_KEY',         'wS2rdFx4ou4mx`m*]pPC7KH?97e+i#PjDj_iBY^e/@m1<aMJ=5vAp[0c,e)$d3f(' );
define( 'SECURE_AUTH_KEY',  'gOyLA<c{n.J_pey1~!+p eH-=}/6&([iv.U-1GzbCmW?T{<I+RAfClHz,`l]5W^V' );
define( 'LOGGED_IN_KEY',    '<,Pb?xV|6BYmh)+8wrN&`d?cMQn59.|<BsYDuyN^%pd6wup@x6O~WGg!R{9?olLD' );
define( 'NONCE_KEY',        'lqK9}|3e+^,M}D7 :8N[YdS<WV@b .d@t`k,Cba&GJ<}yT9&C<ol(H[%8-DL<6[G' );
define( 'AUTH_SALT',        '}JQ|sX]zE,.aHSv.XOWj(22rfVV}}E-N <<GDhiL13Jd[yDG@&mHwbKNLa&3VS%d' );
define( 'SECURE_AUTH_SALT', 'ZTf>j(BrEj#iiA(l0q#6.4jFL5zduu]!XLB$e!F^*`Gr6A>t7:-|rx<hS)_N-ZDz' );
define( 'LOGGED_IN_SALT',   'n1L8bwp3aXJB/}SGp.r09BAb4Kr&DJc0&I~}x,tdC**?]6I[)344humHS6Q7L58_' );
define( 'NONCE_SALT',       '$I{L/0nqu XGwD<0GRVo[gu7PH0b xztn2?:UG?&8~Q3n|TeNQCYmi;%:|8-R^Sz' );

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
