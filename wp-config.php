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
define( 'DB_NAME', 'wp_plugins' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'G@br13l02122005' );

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
define( 'AUTH_KEY',         ')$)$: bZHdJ-~^.0CtlZQ$fz!*,^g*:^Sg!sm)NE%#kAwLjR(0g@`R+Rp)kK36eu' );
define( 'SECURE_AUTH_KEY',  '/,M2VV^U^aUkqv#.:nFQ^z|Mu&!!hI@.n+1.5q5f{:(4Kme5-K6jf$N4.F!:RbDj' );
define( 'LOGGED_IN_KEY',    'I*ne#5R&.K@3F5m],du`eq^os0nk1[K3?m*O;bhYhz/dz_0XC6etwt,_Ao0wKDM]' );
define( 'NONCE_KEY',        'S6<L)r.x)L^,$Nl}t1z|io$hjCE}8jQ1QMyi;Wi1$6mcaxjv}r*r<|!Qv/A&4Z9Z' );
define( 'AUTH_SALT',        'BFB)QwO2hTq[=X+sxuMzU`;`TESLls[3Hd+;cHGQ7[[CPAk[#2W)#mo^)DFt9C~`' );
define( 'SECURE_AUTH_SALT', 'whZ]X*EY5xT,[;sry`~k88_|}k?TbwBeB)kN~#5|Wegq==%@H=$Pn5n7rke3V?}P' );
define( 'LOGGED_IN_SALT',   'S&P6L_pum3gTtNEbx;j1BzZQifxL~Pu]VIppLBkfT5|d;FYxP-}-EXuH-m{mNQl5' );
define( 'NONCE_SALT',       '^LAc>cP5PMglKW}S|cj4eXiJf@*1/&$Z:|YC,Jk7v{IW<8N]wx3[ aZWX-UJl<{Y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
