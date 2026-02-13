<?php
/**
 * Uninstall Add From Server Reloaded
 *
 * Removes all plugin data when the plugin is deleted.
 *
<<<<<<< HEAD
 * @package   Add_From_Server_Reloaded
=======
 * @package   AFSRReloaded
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
 * @copyright Copyright (c) 2025, eLearning evolve, https://elearningevolve.com
 * @license   GPL-3.0+
 * @since     5.0.0
 */

// If uninstall not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin options.
 *
 * Removes all options created by the plugin from the WordPress options table.
 *
 * @since 5.0.0
 */
<<<<<<< HEAD
function afsr_delete_plugin_options() {
	// Delete the root directory setting.
	delete_option( 'afsr_root_directory' );
=======
function afsrreloaded_delete_plugin_options() {
	// Delete the root directory setting.
	delete_option( 'afsrreloaded_root_directory' );
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
	
	// Delete legacy option from original plugin (if it exists).
	delete_option( 'frmsvr_root' );
}

/**
 * Clean up on uninstall.
 *
 * @since 5.0.0
 */
<<<<<<< HEAD
function afsr_uninstall() {
=======
function afsrreloaded_uninstall() {
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
	// Check if user has permission to delete plugins.
	if ( ! current_user_can( 'delete_plugins' ) ) {
		return;
	}

	// Delete all plugin options.
<<<<<<< HEAD
	afsr_delete_plugin_options();
=======
	afsrreloaded_delete_plugin_options();
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)

	// Note: We don't delete imported media files because they belong to the user.
	// The files imported to Media Library remain after plugin deletion.
	
	// Note: Cookies are client-side and will expire naturally.
	// No server-side cleanup needed for cookies.
}

// Run the uninstall function.
<<<<<<< HEAD
afsr_uninstall();
=======
afsrreloaded_uninstall();







>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)

