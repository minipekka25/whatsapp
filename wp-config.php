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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FFpzBi:f7:H~^NEl?FiSN!3Q 6@QR]_9SgQ0Jw7fUX2J);)86|Uc/Lw+{l*V^x<k' );
define( 'SECURE_AUTH_KEY',  '/ql1zf=-otb9X|vE:y*[Q$l:0Q:yJ}oCP+r<F$~&jnlk#uYQs8G_:yS__5:)L]8|' );
define( 'LOGGED_IN_KEY',    '+<eJ4Iw`()(%RpW~D$eCf(/C#Cj`JM[m%eE<])h9!n<@{;_i:>!Oo,tMytu4zsmj' );
define( 'NONCE_KEY',        'u}&RfpfE@z;|BdMt:B{A8kr48cdE;mD *#_3mwfmh^fT(8Zy@A_Y!0V<<3*HKQ6B' );
define( 'AUTH_SALT',        '.!LV?3g5SGF+=pT4W.#yP.^wo)gS.oA{J6}^?5xizBC<jqD#}lI@)^J[_Iaa1pyV' );
define( 'SECURE_AUTH_SALT', 'wlO(M%S^BY0y_^}GJ *I)=pFB_pB*lVj:A{h(8y#*ysm4z(hf .Rn[z=L,a()c-@' );
define( 'LOGGED_IN_SALT',   '}W/=J#(JW^gYYx?o]BIwS lBi34 %E }aoD&f+_T#Q0o9UHB@/$(& M3@{^c4&y+' );
define( 'NONCE_SALT',       'L7^dUu*GM%<+7h!cfzMzu,O sfL*]_un]_3c`f)dtD|TJ!@AnRIL&jMgW[w)FXS]' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
