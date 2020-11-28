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
define( 'DB_NAME', 'liveevent' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1:8889' );

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
define( 'AUTH_KEY',          'I_M.!r>sk)Ij,-C~1E+z%D!<Y,BAU?}1$UKv{f#@1vtqF7a:,84]:,oN+1+%.iEO' );
define( 'SECURE_AUTH_KEY',   'J>TkZYvJ#=z%@2iY1P*=}KPJ5EJ:lI5jk!OLPRGfu+vVxXe,QG`[*q<[|pZPTvg8' );
define( 'LOGGED_IN_KEY',     '/K];C7[R0Eju$hiUt61#{g/S`//-5#2#F cZUjdE,$JZzi(lqFQAp(V1-q^&2LqY' );
define( 'NONCE_KEY',         '=Hm%P:3h.%oFxy-#@%xdj#M0s-XT|;*P=d|/-DKtvyj~~k/%C1$Ee.mS*}P|GBg~' );
define( 'AUTH_SALT',         ')kb3ZrZ-?LJ8!`yr7uyl*f#@i>9=@W)p)XZ)%jzZI2rQ %O3DDqcO~)NQ4fD#=sd' );
define( 'SECURE_AUTH_SALT',  '0OzTxl1m=.x,>(pX-}SLXP^vFY<S1~xot<Q%i347~D;M,m<^@IoGi74Hz_hPY-*A' );
define( 'LOGGED_IN_SALT',    '-v^h&L[DHkaK/[kL4JgzQ0-V$l-3<j(1p*Gk`QT#(ck53)WQUN2&6w]xGR~8.#y=' );
define( 'NONCE_SALT',        '5^5V)SO2)D6{af3kxF*&CRK <-6Anf4+!BE1v@lO[X!pOFH>=a^8SeiD1@SeYnh-' );
define( 'WP_CACHE_KEY_SALT', '|WQc[i%qZH>`WI,xj/Fi{sV=QS@i[7*&W!H=L[^UXTQFN=d${dJxl] X5/x`3eAf' );

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
