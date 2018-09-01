<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
 
 define('WP_MEMORY_LIMIT', '64M');


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'marmoles_wp990');

/** MySQL database username */
define('DB_USER', 'marmoles_wp990');

/** MySQL database password */
define('DB_PASSWORD', '2S2Pu4]!7f');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'ozr9ondqmlnp25xaq3amwhrrui7unovivqut80vp290hu9nkfplnwdszynhjx9vu');
define('SECURE_AUTH_KEY',  'pilq2vtarpf16vm0hyjywfkxq6mrsqkzqkyjvnu3pkjuycp6hojxcqnwrinjzlc3');
define('LOGGED_IN_KEY',    'jgphrpkqprly5tl01mm2jtmrqvsgemjilfnifw0jzoylouqssanff26ih6gfzguv');
define('NONCE_KEY',        'b2dgzdu1mjjfvknn7gjgyjuhnsahuebyuxx15natxauwrfk6oiu62wkwe1tjnlls');
define('AUTH_SALT',        'n4x76tonag1gophfjbq6t6laipa45j9dnrjr4pgmltqytjkf90s1hphuegkr3pke');
define('SECURE_AUTH_SALT', 'o7e7mxja31qccnwpr9wpozzwpv10exxzgmkwxsmlmlkggazlszqtf33p43euolch');
define('LOGGED_IN_SALT',   'bkel8ox5jgpwnq0kffzc7hwsga9ocyyvsz5daqrbpnyrunt1olth4icg1j0hp8cp');
define('NONCE_SALT',       'vwmafdja4bjoeca7wc1u3h17lajeqmjw4e8ljzru39sjtvl70gbbethnxdjnah5w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_55';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
