<?php
/**
 * Plugin Name:       Add From Server Reloaded
 * Plugin URI:        https://wordpress.org/plugins/add-from-server-reloaded/
 * Description:       Bypass WordPress upload limit. Import large files from your server to Media Library. No PHP configuration needed. Batch import supported.
 * Version:           5.0.0
 * Author:            eLearning evolve
 * Author URI:        https://elearningevolve.com/about/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       add-from-server-reloaded
 * Requires PHP:      7.4
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Tested up to:      6.9
 *
 * @since             4.0.0
 * @package           Add From Server Reloaded
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'AFSRRELOADED_MIN_WP' ) || define( 'AFSRRELOADED_MIN_WP', '6.0' );
defined( 'AFSRRELOADED_MIN_PHP' ) || define( 'AFSRRELOADED_MIN_PHP', '7.4' );
defined( 'AFSRRELOADED_VERSION' ) || define( 'AFSRRELOADED_VERSION', '5.0.0' );
defined( 'AFSRRELOADED_PLUGIN_FILE' ) || define( 'AFSRRELOADED_PLUGIN_FILE', __FILE__ );
defined( 'AFSRRELOADED_PLUGIN_DIR_PATH' ) || define( 'AFSRRELOADED_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
defined( 'AFSRRELOADED_PLUGIN_DIR_URL' ) || define( 'AFSRRELOADED_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

// Only run in admin area.
if ( ! is_admin() ) {
	return;
}

// Load PHP8 compat functions.
require __DIR__ . '/compat.php';

// Old versions of WordPress or PHP.
if (
	version_compare( $GLOBALS['wp_version'], AFSRRELOADED_MIN_WP, '<' )
	||
	version_compare( phpversion(), AFSRRELOADED_MIN_PHP, '<' )
) {
	require __DIR__ . '/old-versions.php';
} else {
	require __DIR__ . '/class.add-from-server.php';
}

AFSRReloaded\Plugin::instance();
