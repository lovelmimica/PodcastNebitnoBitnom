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

define( 'DB_NAME', "nebitnoobitnomco_db" );


/** MySQL database username */

define( 'DB_USER', "nebitnoobitnomco_admin" );


/** MySQL database password */

define( 'DB_PASSWORD', "Sabirnica1221" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         ';,6QcG,UUjMhk>#D%kVq?yjuf$8qrS)zBdjq|1U/jJl^1Eq+N7,^FGBX<j&4=w.A' );

define( 'SECURE_AUTH_KEY',  '/`ep[$Li7hz5@Vbr8USJ5uGXFwN^uoOp;NmOB^E,F}XY=?Y@ybaBW]Wy*L]0kbXV' );

define( 'LOGGED_IN_KEY',    'G?>0NM=NA~6NLzTNxJz;ZbBO!Zx}&I>eeqa}pIlrd`m4sC.B@3{u7u~kZtFY%S[H' );

define( 'NONCE_KEY',        'Vyi-F!J<Y6_dq2 !x>5gWmH-rJCGN=HFTE#2*N}RFoT1;PS|MgxOP`w5Ov3E5irG' );

define( 'AUTH_SALT',        '<s^:E3Cg|9c_<XZ6C8OZ?i(-?$+V%Z7%vdX#~{MQOju/pm;*Pe S+)R33~k>X-Lf' );

define( 'SECURE_AUTH_SALT', 'vFzBf(ejIQ6=XoDOHR)dC!SI`17=@.A(gaJNdi25DD6sFlK.Rr;mQakEF$J,VL&t' );

define( 'LOGGED_IN_SALT',   '+SLk<eMY?~9bdjgtHJ#HJNVnSLA%|o6X]l.|fI%d1wf$&iQU#4<}MeO6uC8YcQ=j' );

define( 'NONCE_SALT',       '@i:3s$]m6Es^}KWT?m;/v?~w;G}T?S;<i}9z#e5mLF^ujTPk{CF;EDlbwFb3XJ3P' );


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

define( 'WP_DEBUG', false );


/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

