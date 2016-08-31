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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '12345');

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
define('AUTH_KEY',         '(F8{(,IPM0@b`9/^.#UWJ1SFByzb enei/zT?wgo?~xDzs<;@N9d1JHTj|5@CI,+');
define('SECURE_AUTH_KEY',  '=AmTtpb*NXo|G/8kaM__:+I/;wF3jhP^yI#q*S-)[[9LT{j)arx0f!Yk*hgbaW05');
define('LOGGED_IN_KEY',    'OvdibxX<AQ9v;|2pidczY_KD)E:c%lq73spci0y?XIB%?IH]X(jH2/O!!=RT~_9L');
define('NONCE_KEY',        'x[7XoCW7[K4WDuh-QDB7C1)tQd0<yntyC.[7/qoz=lhc9/8@q=hy^vw}@i[>Jiqt');
define('AUTH_SALT',        'j-:SwHkjvteT){4H71lY>B}#!fp8{D!39d}q0j;]&=r[Y6:/<%3-S,GMgMX6]qVI');
define('SECURE_AUTH_SALT', 's,P+%CVJj ~dnQ.:N(.M*szu|HIR{9P`X(#@oyNA]i6bscdOjGx=yf&8c8p;rymC');
define('LOGGED_IN_SALT',   'Fr(gql%9YRzu?O`K1WMbo-89S~l78RF-f.El(>lLGG{hf0)Jh/,+j/z77!_7~Wx1');
define('NONCE_SALT',       '%[~SEfMpSvA*,:b%&+!0EtDhRdb:*}-d.&[vuxM<P::0PSROua0jA5!W,:s-Nw~8');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
