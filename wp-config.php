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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'GT3ao3DmXdl4qhV88jpNS2WtML3qezDWYj1tbnhyEpk4yYDhJ1Y3LXKBqPegrYo2Ob/GP0hIaaMtpJ21NQDYKQ==');
define('SECURE_AUTH_KEY',  'QQogJ9OpBnLrVbWvRQvTzOeV8e15WhbMXPCPW1nceg/hn9OF9tw5FX8WQzjgAxFtEZu4bGUo32pynI1xM9wLvg==');
define('LOGGED_IN_KEY',    'SXvfPUlKbWVwsoiTwfZNTLQjnjc151BQKP3Xp4KXhkLPTH0VaWmO9bHAeB0mBq8vPrxxfpTV7kbxN5ZlPuns+Q==');
define('NONCE_KEY',        'vJF1C4WAp2QSgpLUEnawtSSNvu+zIo1l40m8+6HsD2BS08Yl8/Twa2kLRUGJRmJ4Qi6aXYftLt1SiAX6AyE6qw==');
define('AUTH_SALT',        'UTJlYcuFXOnL0Re0Q/Fee08d/63T5gSZgNo/B7LZb8nEn8wMumxi6AFjESyftZZcnWDTIzsngcSPJ3mVPvoCFQ==');
define('SECURE_AUTH_SALT', 'pm0OF1DTYDCjSDDG+bBCTMBHnGC18dARBftfBqIaEI2uqMS29yxKWMIZAVnNS0cNwgJNzbzlIWg6lrkxKm3a6w==');
define('LOGGED_IN_SALT',   'qgV8dMzkH/ktUBiw6+FtF4hSadSDsxlqA9EiACYfnCoeeg/tIasuHIFUBbyQ/b/RZjBLXa9dsCl3dBcqBlejwg==');
define('NONCE_SALT',       'yrVAZCcde5eAlHFv/cUls1OXik9NZfdqMziomAXfBHgClnIYwvj1IlarlFZWWCGn/HrCuzaOSB8NT9CvpL9B2A==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
