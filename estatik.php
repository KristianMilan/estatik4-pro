<?php

/**
 * Plugin Name:       Estatik PRO
 * Plugin URI:        http://estatik.net
 * Description:       A PRO version of Estatik Real Estate plugin for Wordpress.
 * Version:           4.0.6
 * Author:            Estatik
 * Author URI:        http://estatik.net
 * Text Domain:       es
 * License:           GPL2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'ES_FILE', __FILE__ );
define( 'ES_PLUGIN_PATH', dirname( ES_FILE ) );
define( 'ES_PLUGIN_URL', plugin_dir_url( ES_FILE ) );
define( 'ES_PLUGIN_INCLUDES', dirname( ES_FILE ) . DS . 'includes' . DS );
define( 'ES_PLUGIN_CLASSES', dirname( ES_FILE ) . DS . 'includes' . DS . 'classes' . DS );
define( 'ES_PLUGIN_BASENAME', plugin_basename( __FILE__) );
define( 'ESTATIK4', true );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function es_load_textdomain() {
	load_plugin_textdomain( 'es', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'es_load_textdomain' );

require 'plugin-update-checker/plugin-update-checker.php';

$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://estatik.net/wp-update-server/?action=get_metadata&slug=estatik4-pro', //Metadata URL.
	__FILE__,
	'estatik4-pro'
);

require_once ES_PLUGIN_CLASSES . 'class-estatik.php';

Estatik::get_instance();
