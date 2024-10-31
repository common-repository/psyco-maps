<?php
/*
Plugin Name: psyco maps
Plugin URI: http://psyco1996.altervista.org/portfolio/psyco-maps
Description: Custom Google Maps for WordPress.
Author: Carmine De santis
Author URI:
Text Domain: psyco-maps
Domain Path: /languages/
Version: 1.0
*/

define( 'PSYCO_MAPS_VERSION', '1.1' );
define( 'PSYCO_MAPS_PLUGIN', __FILE__ );
define( 'PSYCO_MAPS_BASENAME', plugin_basename( PSYCO_MAPS_PLUGIN ) );
define( 'PSYCO_MAPS_NAME', trim( dirname( PSYCO_MAPS_BASENAME ), '/' ) );
define( 'PSYCO_MAPS_DIR', untrailingslashit( dirname( PSYCO_MAPS_PLUGIN ) ) );

// richiama
require_once PSYCO_MAPS_DIR . '/functions.php';

?>
