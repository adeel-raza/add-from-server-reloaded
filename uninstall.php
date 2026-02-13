<?php
/**
 * Uninstall Add From Server Reloaded
 *
 * Removes all plugin data when the plugin is deleted.
 *
 * @package   AFSRReloaded
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
function afsrreloaded_delete_plugin_options() {
	// Delete the root directory setting.
	delete_option( 'afsrreloaded_root_directory' );
	
	// Delete legacy option from original plugin (if it exists).
	delete_option( 'frmsvr_root' );
}

/**
 * Clean up on uninstall.
 *
 * @since 5.0.0
 */
function afsrreloaded_uninstall() {
	// Check if user has permission to delete plugins.
	if ( ! current_user_can( 'delete_plugins' ) ) {
		return;
	}

	// Delete all plugin options.
	afsrreloaded_delete_plugin_options();

	// Note: We don't delete imported media files because they belong to the user.
	// The files imported to Media Library remain after plugin deletion.
	
	// Note: Cookies are client-side and will expire naturally.
	// No server-side cleanup needed for cookies.
}

// Run the uninstall function.
afsrreloaded_uninstall();
