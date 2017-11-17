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
define('DB_NAME', 'iryanclarke');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'R U/7kVnaYnt_zv!CI~[0RmV@t@?=Fj8OB+}L0y~yaYhe&.Y#.k8a,SR^E:_D-{N');
define('SECURE_AUTH_KEY',  '&X]@c^.2$czW>J{-YnU8{|5SSaEtn.AYSjhjgf@K0WA(zs]u(`$j)Qv+e)28{Eko');
define('LOGGED_IN_KEY',    'yo{-7p:7t&r{8$BIs_f*0slo&WLTu{MS](+P1l1+=+#9<Go_#0(fD5Xv}_{`0/i.');
define('NONCE_KEY',        'jHIMA7HCB8Q~.n8_qHFii&KcjH=fg`Uf~N[ffK4;u8&[wnIr@$XCk*luV +zM-*C');
define('AUTH_SALT',        'TqLrWQ7DZf7dvxNx(`Ei#<Pfzs>r 5L kHA(L<l]ZwSuktm-&7X:;^ F#m:UZsX~');
define('SECURE_AUTH_SALT', '^bK;MVr}(a!F-(r63Z=F=Fz>ccSDn<i&SyL ykNuIj#.rGnv0nD4/h;/tKxe?rb(');
define('LOGGED_IN_SALT',   'bh?7_advhdKMu{iffW)+q9;`HcKT)Zxpw}.6,?RcKK1:lVF9]A*X$i7c$akM_*=1');
define('NONCE_SALT',       'I`&LC=Bm?/<WG^|`L{Ahsnf)UCtC3P%Mi3Y.tMy`go WRqFei+1B|lqtE:I80Q}c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'irc_';

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
