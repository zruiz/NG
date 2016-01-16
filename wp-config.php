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
define('DB_NAME', 'ngyachting');

/** MySQL database username */
define('DB_USER', 'ngyachting');

/** MySQL database password */
define('DB_PASSWORD', 'NGYatching88');

/** MySQL hostname */
define('DB_HOST', 'ngyachting.mysql.db:3306');

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
define('AUTH_KEY',         'pU864yo/tp392lu2dsplguwdeg2wV4f4TNHrZrMxPO6N9COyGYVkxwNd8KMc');
define('SECURE_AUTH_KEY',  'PQbR3d0onpKirtiX14HmH19BabeSlPkMr0/g66EVdp4PBq8Y6ZHAKl7WoWy9');
define('LOGGED_IN_KEY',    'wAhtNgFlfY4EfWT0w4KUr043+goxqxR+qFa+HhtBt0+oGihQpyO64dnbiqh7');
define('NONCE_KEY',        'CEeuf0q6EdmFOSHXdrwkegfxfVakAwn7WgyyA/wOQfZdTE2rniMQGrmove6Y');
define('AUTH_SALT',        'I92CAQ9Tu2/u6Lk8wIBp8rUfB4OLdudahOkzX6C+CBYOWhsfbeLcAf2fNZsg');
define('SECURE_AUTH_SALT', '5jR8ZZqB3i+G5tRiRa1wwEGTBBBBqXqqSy6zl5dbnNKlNALeewDo7qJNrpBi');
define('LOGGED_IN_SALT',   'yfGUxba/3YES2GE0KRxhcxUTIYUjfmxzZ2CUsFBxAMRP/eKH3OhgUUg9ANpj');
define('NONCE_SALT',       'g6dS1DXF3CIMgnya9MkGG5G4b83ddPc/teya1G+Qha07n5eEZ0R5eYe1/hf3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wor2529_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
