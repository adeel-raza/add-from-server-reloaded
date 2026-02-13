<?php
/**
 * Handle old WordPress and PHP versions
 *
<<<<<<< HEAD
 * @package Add_From_Server_Reloaded
 * @since   4.0.0
 */

namespace Add_From_Server_Reloaded;
=======
 * @package AFSRReloaded
 * @since   4.0.0
 */

namespace AFSRReloaded;
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)

class Plugin {
	public static function instance() {
		return new Plugin();
	}

	protected function __construct() {
		global $wp_version;

		$error = sprintf(
			/* translators: 1: Minimum WordPress version, 2: Minimum PHP version, 3: Current WordPress version, 4: Current PHP version */
			__( 'This plugin requires WordPress %1$s or greater, and PHP %2$s or greater. You are currently running WordPress %3$s and PHP %4$s. Please contact your website host or server administrator for more information. The plugin has been deactivated.', 'add-from-server-reloaded' ),
<<<<<<< HEAD
			AFSR_MIN_WP,
			AFSR_MIN_PHP,
=======
			AFSRRELOADED_MIN_WP,
			AFSRRELOADED_MIN_PHP,
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
			$wp_version,
			phpversion()
		);

		// Handle activation gracefully with a block screen.
		if (
			isset( $_REQUEST['action'] ) && // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			(
					'activate' === $_REQUEST['action'] || // phpcs:ignore WordPress.Security.NonceVerification.Recommended
					'error_scrape' === $_REQUEST['action'] // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			) &&
			isset( $_REQUEST['plugin'] ) && // phpcs:ignore WordPress.Security.NonceVerification.Recommended
<<<<<<< HEAD
			plugin_basename( AFSR_PLUGIN_FILE ) === $_REQUEST['plugin'] // phpcs:ignore WordPress.Security.NonceVerification.Recommended
=======
			plugin_basename( AFSRRELOADED_PLUGIN_FILE ) === $_REQUEST['plugin'] // phpcs:ignore WordPress.Security.NonceVerification.Recommended
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
		) {
			die( esc_html( $error ) );
		}

		add_action( 'pre_current_active_plugins', function() use( $error ) {
			printf(
				'<div class="error"><p><strong>%s</strong>: %s</p></div>',
				esc_html__( 'Add From Server Reloaded', 'add-from-server-reloaded' ),
				esc_html( $error )
			);
		} );
	}
}
