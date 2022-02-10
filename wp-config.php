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
define( 'DB_NAME', 'rakeshm_wp51465' );

/** MySQL database username */
define( 'DB_USER', 'rakeshm_wp51465' );

/** MySQL database password */
define( 'DB_PASSWORD', '39YS(9p9(q' );

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
define( 'AUTH_KEY',         'kavv53vee0vj3h5hlrmrzheifjvjie6glcxhulymibtnbg9rcwedaexaa1t33mxi' );
define( 'SECURE_AUTH_KEY',  'lcn1xc2fa0wndyqqqusoaepapq852snycj9trbvookhvwzrw21imvrwdq68xm6j9' );
define( 'LOGGED_IN_KEY',    'fh2rorz8jamgagiypowuvryksfhbfgxt61rcz1xpzmindeahbcwn0zlzxqjtcu51' );
define( 'NONCE_KEY',        'lqakicw9tifz6ptegakvy3smg1vfn9w6cutjgffjlkgzhrvapoifbds04buoasgd' );
define( 'AUTH_SALT',        'ddvfoimlo7iv2f2kwi6n5ofgi1haxywqlcnkzx2wckfioxce0fb0zmbixhkkgvay' );
define( 'SECURE_AUTH_SALT', 'ehfobj2v3dslrvhpmc9sf4sbi1b52mzq87doqhdqr9o27rfibsztmgxglir3fi5p' );
define( 'LOGGED_IN_SALT',   'krsuinsdr1mwtnm8he5vmictvv3db5azeeivneios1qpjetgvu3lgkzpsihsb0r2' );
define( 'NONCE_SALT',       'p92bipeq6kysiypma6eprarliapmbeawngupe0w3egagz4jqqkugrjotgusj7jdz' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpjwrhnf_';

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
