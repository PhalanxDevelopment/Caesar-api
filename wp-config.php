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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cstsoftc_api');

/** MySQL database username */
define('DB_USER', 'cstsoftc_api');

/** MySQL database password */
define('DB_PASSWORD', 'Hackers!@#4');

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
define('AUTH_KEY',         'Y}FM=Cl=zKdUb<-ZJjQyMDF2%9M9P=]S[!dtQI`O$)/Po~{r?P_2^:N.GA`FPWw3');
define('SECURE_AUTH_KEY',  'v_YZGV{^|A7HU :!XNz#%?pWNX_~D=(SmvO)A&1mHb]l1{n|k6 Np1Pd$hso3NsO');
define('LOGGED_IN_KEY',    'rf%2v)I*@g];L]O<Z$VA,0;4=tD4sq{ $9B&sAiUSoG2=`FKXL<Z:>_igDrnkKmO');
define('NONCE_KEY',        'he 66^7_NO7<(tu^t]TM?_}hW!^sh}Vro/pT(g53fLa)]a<Wv+V6f{qpyC:m!*ze');
define('AUTH_SALT',        '2)@&ds/fXsqGtR4w&N$Q$&FWnD(sLoAoUBqG5+>gW${bWMul,owua ~!pAl@!PnH');
define('SECURE_AUTH_SALT', 'sV:dpjLSi?zKQe,tzXPulNQvpl[M@Dvo=HD#h:Kse_y_d?77^!R`rqhg-~RmbmT?');
define('LOGGED_IN_SALT',   'h&ef]c{MlT%ovj*{fO!4fe8;1W~xSH;6Djj]@8^*{_toC3Y)WL~4?vC9rQ#v!FF+');
define('NONCE_SALT',       '&QWXY)qJ)R3EjnNSB8OEY{K @%|DXLCQD,.SGyn!(/CU;SOja6(UIcw43WiZzU3O');
define('JWT_AUTH_SECRET_KEY', 'v_YZGV{^|A7HU :!XNz#%?pWNX_~D=(SmvO)A&1mHb]l1{n|k6 Np1Pd$hso3NsO');
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
