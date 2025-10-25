<?php
/**
 * Add From Server Reloaded - Main Plugin Class
 *
 * @package   Add_From_Server_Reloaded
 * @copyright Copyright (c) 2025, Very Good Plugins, https://verygoodplugins.com
 * @license   GPL-3.0+
 * @since     4.0.0
 */

namespace Add_From_Server_Reloaded;

use WP_Error;

const COOKIE = 'afsr_path';

/**
 * Main Plugin Class.
 *
 * @since 4.0.0
 */
class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @since 4.0.0
	 *
	 * @return Plugin
	 */
	public static function instance() {
		static $instance = false;
		$class           = static::class;

		return $instance ?: ( $instance = new $class );
	}

	/**
	 * Constructor.
	 *
	 * @since 4.0.0
	 */
	protected function __construct() {
		\add_action( 'admin_init', array( $this, 'admin_init' ) );
		\add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		\add_action( 'wp_ajax_afsr_batch_import', array( $this, 'ajax_batch_import' ) );
		\add_action( 'wp_ajax_afsr_check_duplicate', array( $this, 'ajax_check_duplicate' ) );
		
		// Allow additional file types.
		\add_filter( 'upload_mimes', array( $this, 'allow_additional_mimes' ) );
	}

	/**
	 * Allow additional MIME types for upload.
	 *
	 * @since 4.0.0
	 *
	 * @param  array $mimes Allowed MIME types.
	 * @return array
	 */
	public function allow_additional_mimes( $mimes ) {
		$mimes['md']   = 'text/markdown';
		$mimes['json'] = 'application/json';
		$mimes['svg']  = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Initialize admin hooks.
	 *
	 * @since 4.0.0
	 */
	public function admin_init() {
		// Register JS & CSS with cache busting.
		\wp_register_script( 
			'add-from-server-reloaded', 
			\plugins_url( '/add-from-server.js', __FILE__ ), 
			array( 'jquery' ), 
			AFSR_VERSION,
			true
		);
		
		\wp_register_style( 
			'add-from-server-reloaded', 
			\plugins_url( '/add-from-server.css', __FILE__ ), 
			array(), 
			AFSR_VERSION 
		);

		// Localize script for AJAX.
		\wp_localize_script(
			'add-from-server-reloaded',
			'afsrData',
			array(
				'ajaxurl'    => \admin_url( 'admin-ajax.php' ),
				'nonce'      => \wp_create_nonce( 'afsr_import' ),
				'processing' => __( 'Processing...', 'add-from-server-reloaded' ),
				'complete'   => __( 'Import Complete!', 'add-from-server-reloaded' ),
				'error'      => __( 'An error occurred. Please try again.', 'add-from-server-reloaded' ),
			)
		);

		\add_filter( 'plugin_action_links_' . \plugin_basename( AFSR_PLUGIN_FILE ), array( $this, 'add_upload_link' ) );

		// Handle the path selection early.
		$this->path_selection_cookie();
	}

	/**
	 * Register admin menu.
	 *
	 * @since 4.0.0
	 */
	public function admin_menu() {
		$page_slug = \add_media_page(
			__( 'Add From Server Reloaded', 'add-from-server-reloaded' ),
			__( 'Add From Server Reloaded', 'add-from-server-reloaded' ),
			'upload_files',
			'add-from-server-reloaded',
			array( $this, 'menu_page' )
		);
		
		\add_action( 'load-' . $page_slug, function() {
			\wp_enqueue_style( 'add-from-server-reloaded' );
			\wp_enqueue_script( 'add-from-server-reloaded' );
			
			// Handle settings save.
			$this->handle_settings_save();
		} );
	}

	/**
	 * Add plugin action links.
	 *
	 * @since 4.0.0
	 *
	 * @param  array $links Plugin action links.
	 * @return array
	 */
	public function add_upload_link( $links ) {
		if ( current_user_can( 'upload_files' ) ) {
			array_unshift( 
				$links, 
				'<a href="' . esc_url( admin_url( 'upload.php?page=add-from-server-reloaded' ) ) . '">' . __( 'Import Files', 'add-from-server-reloaded' ) . '</a>' 
			);
		}

		return $links;
	}

	/**
	 * Render the menu page.
	 *
	 * @since 4.0.0
	 */
	public function menu_page() {
		// Handle any imports.
		$this->handle_imports();

		echo '<div class="wrap">';
		echo '<h1>' . esc_html__( 'Add From Server Reloaded', 'add-from-server-reloaded' ) . '</h1>';

		$this->outdated_options_notice();
		$this->main_content();

		echo '</div>';
	}

	/**
	 * Get the root directory for file browsing.
	 *
	 * @since 4.0.0
	 *
	 * @return string|false Root path or false on error.
	 */
	public function get_root() {
		// Priority order for root directory:
		// 1. User-saved setting in WordPress options.
		// 2. The 'ADD_FROM_SERVER_RELOADED' constant.
		// 3. Their home directory.
		// 4. The parent directory of the current install or wp-content directory.

		$saved_root = \get_option( 'afsr_root_directory', '' );
		
		if ( ! empty( $saved_root ) ) {
			$root = $saved_root;
		} elseif ( defined( 'ADD_FROM_SERVER_RELOADED' ) ) {
			$root = ADD_FROM_SERVER_RELOADED;
		} elseif ( defined( 'ADD_FROM_SERVER' ) ) {
			// Backwards compatibility.
			$root = ADD_FROM_SERVER;
		} elseif ( str_starts_with( __FILE__, '/home/' ) ) {
			$root = implode( '/', array_slice( explode( '/', __FILE__ ), 0, 3 ) );
		} else {
			if ( str_starts_with( WP_CONTENT_DIR, ABSPATH ) ) {
				$root = dirname( ABSPATH );
			} else {
				$root = dirname( WP_CONTENT_DIR );
			}
		}

		// Normalize: Remove trailing slash for consistent path handling.
		$root = rtrim( $root, '/' );

		// Precautions: Validate root path exists and is readable.
		if ( ! is_dir( $root ) || ! is_readable( $root ) ) {
			$root = false;
		}

		// Additional security check for placeholder code.
		if (
			$root &&
			str_contains( get_option( 'frmsvr_root', '%' ), '%' ) &&
			! defined( 'ADD_FROM_SERVER_RELOADED' ) &&
			! defined( 'ADD_FROM_SERVER' ) &&
			! current_user_can( 'unfiltered_html' )
		) {
			$root = false;
		}

		/**
		 * Filters the root directory path.
		 *
		 * @since 4.0.0
		 *
		 * @param string|false $root Root directory path or false.
		 */
		return apply_filters( 'afsr_root_directory', $root );
	}

	/**
	 * Handle settings save.
	 *
	 * @since 4.0.6
	 */
	protected function handle_settings_save() {
		if ( ! isset( $_POST['afsr_save_settings'] ) ) {
			return;
		}

		if ( ! \current_user_can( 'manage_options' ) ) {
			return;
		}

		\check_admin_referer( 'afsr_settings' );

		$new_root = isset( $_POST['afsr_root_directory'] ) ? \sanitize_text_field( \wp_unslash( $_POST['afsr_root_directory'] ) ) : '';

		if ( empty( $new_root ) ) {
			\delete_option( 'afsr_root_directory' );
			\add_settings_error(
				'afsr_settings',
				'afsr_root_cleared',
				__( 'Root directory reset to default.', 'add-from-server-reloaded' ),
				'success'
			);
			return;
		}

		// Validate the path (normalize by removing trailing slash).
		$new_root = rtrim( $new_root, '/' );

		if ( ! \is_dir( $new_root ) ) {
			\add_settings_error(
				'afsr_settings',
				'afsr_invalid_path',
				\sprintf(
					/* translators: %s: directory path */
					__( 'Error: The directory "%s" does not exist on your server.', 'add-from-server-reloaded' ),
					\esc_html( $new_root )
				),
				'error'
			);
			return;
		}

		if ( ! \is_readable( $new_root ) ) {
			\add_settings_error(
				'afsr_settings',
				'afsr_not_readable',
				\sprintf(
					/* translators: %s: directory path */
					__( 'Error: The directory "%s" is not readable. Please check file permissions.', 'add-from-server-reloaded' ),
					\esc_html( $new_root )
				),
				'error'
			);
			return;
		}

		\update_option( 'afsr_root_directory', $new_root );
		\add_settings_error(
			'afsr_settings',
			'afsr_root_saved',
			\sprintf(
				/* translators: %s: directory path */
				__( 'Root directory updated! Now browsing: %s', 'add-from-server-reloaded' ),
				'<code>' . \esc_html( $new_root ) . '</code>'
			),
			'success'
		);
	}

	/**
	 * Handle path selection cookie.
	 *
	 * @since 4.0.0
	 */
	public function path_selection_cookie() {
		if ( isset( $_REQUEST['path'] ) && current_user_can( 'upload_files' ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			// Sanitize the path.
			$path = sanitize_text_field( wp_unslash( $_REQUEST['path'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			
			// Verify path is within allowed root.
			$root = $this->get_root();
			if ( ! $root ) {
				return;
			}

			$full_path = realpath( trailingslashit( $root ) . ltrim( $path, '/' ) );
			
			// Security: Ensure the path is within root.
			if ( ! $full_path || ! str_starts_with( $full_path, $root ) ) {
				return;
			}

			$_COOKIE[ COOKIE ] = $path;

			$admin_url_parts = wp_parse_url( admin_url() );
			setcookie(
				COOKIE,
				$path,
				time() + 30 * DAY_IN_SECONDS,
				isset( $admin_url_parts['path'] ) ? $admin_url_parts['path'] : '/',
				isset( $admin_url_parts['host'] ) ? $admin_url_parts['host'] : '',
				'https' === ( isset( $admin_url_parts['scheme'] ) ? $admin_url_parts['scheme'] : 'http' ),
				true
			);
		}
	}

	/**
	 * Handle file imports.
	 *
	 * @since 4.0.0
	 */
	public function handle_imports() {

		if ( empty( $_POST['files'] ) && empty( $_POST['folders'] ) ) {
			return;
		}

		check_admin_referer( 'afsr_import' );

		$files = isset( $_POST['files'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['files'] ) ) : array();
		$folders = isset( $_POST['folders'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['folders'] ) ) : array();

			$root = $this->get_root();
			if ( ! $root ) {
			wp_die( esc_html__( 'Unable to determine root directory. Please check your configuration.', 'add-from-server-reloaded' ) );
		}

		// Get all files from selected folders.
		$folder_files = array();
		foreach ( $folders as $folder ) {
			$folder_path = trailingslashit( $root ) . ltrim( $folder, '/' );
			$folder_files = array_merge( $folder_files, $this->get_files_from_folder( $folder_path, $root ) );
		}

		// Merge folder files with individually selected files.
		$files = array_merge( $files, $folder_files );

		// Enable output buffering for progress updates.
		if ( ! defined( 'DOING_AJAX' ) ) {
			flush();
			if ( function_exists( 'wp_ob_end_flush_all' ) ) {
			wp_ob_end_flush_all();
			}
		}

		$imported = 0;
		$errors   = 0;
		$error_files = array();
		$imported_files = array();

		foreach ( (array) $files as $file ) {
				$filename = trailingslashit( $root ) . ltrim( $file, '/' );

			// Security: Verify the real path to prevent directory traversal.
			$realpath = realpath( $filename );
			
			if ( ! $realpath || ! str_starts_with( $realpath, $root ) ) {
				$errors++;
				$error_files[] = array(
					'filename' => basename( $file ),
					'message'  => __( 'Security error: file is outside the allowed directory', 'add-from-server-reloaded' ),
				);
					continue;
				}

			$id = $this->handle_import_file( $realpath );

			if ( \is_wp_error( $id ) ) {
				$errors++;
				$error_files[] = array(
					'filename' => basename( $file ),
					'message'  => $id->get_error_message(),
				);
				} else {
				$imported++;
				$imported_files[] = array(
					'filename' => basename( $file ),
					'id'       => $id,
				);
			}

			if ( ! defined( 'DOING_AJAX' ) ) {
				flush();
			}
		}

		// Single summary message.
		if ( $imported > 0 || $errors > 0 ) {
			$message_class = $errors > 0 ? 'notice-warning' : 'notice-success';
			echo '<div class="notice ' . \esc_attr( $message_class ) . '"><p>';
			
			if ( $imported > 0 ) {
				echo '<strong>';
				echo sprintf(
					/* translators: %d: number of files */
					\esc_html( \_n( '%d file imported successfully.', '%d files imported successfully.', $imported, 'add-from-server-reloaded' ) ),
					absint( $imported )
				);
				echo '</strong>';
				
				// Show imported file names.
				if ( ! empty( $imported_files ) ) {
					echo '<br><small>';
					foreach ( $imported_files as $file ) {
						$edit_link = \admin_url( 'post.php?post=' . $file['id'] . '&action=edit' );
						echo '<a href="' . \esc_url( $edit_link ) . '" target="_blank">' . \esc_html( $file['filename'] ) . '</a><br>';
					}
					echo '</small>';
				}
			}
			
			if ( $errors > 0 ) {
				if ( $imported > 0 ) {
					echo '<br><br>';
				}
				echo '<strong>';
				echo sprintf(
					/* translators: %d: number of errors */
					\esc_html( \_n( '%d file failed.', '%d files failed.', $errors, 'add-from-server-reloaded' ) ),
					absint( $errors )
				);
				echo '</strong>';
				
				// Show error details.
				if ( ! empty( $error_files ) ) {
					echo '<br><small>';
					foreach ( $error_files as $error ) {
						echo '<strong>' . \esc_html( $error['filename'] ) . '</strong>: ' . \wp_kses_post( $error['message'] ) . '<br>';
					}
					echo '</small>';
				}
			}
			
			echo '</p></div>';
		}
	}

	/**
	 * Recursively get all files from a folder.
	 *
	 * @since 4.0.5
	 *
	 * @param  string $folder_path Absolute folder path.
	 * @param  string $root Root directory path.
	 * @return array Array of relative file paths.
	 */
	protected function get_files_from_folder( $folder_path, $root ) {
		$files = array();

		// Security: Verify the real path.
		$realpath = \realpath( $folder_path );
		if ( ! $realpath || ! \str_starts_with( $realpath, $root ) ) {
			return $files;
		}

		$items = \glob( $realpath . '/*' );
		if ( ! $items ) {
			return $files;
		}

		foreach ( $items as $item ) {
			// Skip hidden files and directories.
			if ( \basename( $item )[0] === '.' ) {
				continue;
			}

			$relative_item = \str_replace( $root, '', $item );
			$relative_item = \ltrim( $relative_item, '/' );

			if ( \is_dir( $item ) ) {
				// Recursively get files from subdirectory.
				$files = \array_merge( $files, $this->get_files_from_folder( $item, $root ) );
			} elseif ( \is_file( $item ) ) {
				$files[] = $relative_item;
			}
		}

		return $files;
	}

	/**
	 * AJAX handler for batch imports.
	 *
	 * @since 4.0.0
	 */
	public function ajax_batch_import() {
		check_ajax_referer( 'afsr_import', 'nonce' );

		if ( ! current_user_can( 'upload_files' ) ) {
			wp_send_json_error( array( 'message' => __( 'You do not have permission to upload files.', 'add-from-server-reloaded' ) ) );
		}

		$file = isset( $_POST['file'] ) ? sanitize_text_field( wp_unslash( $_POST['file'] ) ) : '';

		if ( empty( $file ) ) {
			wp_send_json_error( array( 'message' => __( 'No file specified.', 'add-from-server-reloaded' ) ) );
		}

		$root = $this->get_root();
		if ( ! $root ) {
			wp_send_json_error( array( 'message' => __( 'Unable to determine root directory.', 'add-from-server-reloaded' ) ) );
		}

		$filename = trailingslashit( $root ) . ltrim( $file, '/' );
		$realpath = realpath( $filename );

		// Security: Verify the real path.
		if ( ! $realpath || ! str_starts_with( $realpath, $root ) ) {
			wp_send_json_error( array( 
				'message' => sprintf(
					/* translators: %s: file name */
					__( 'Security error: %s is outside the allowed directory.', 'add-from-server-reloaded' ),
					basename( $file )
				)
			) );
		}

		$id = $this->handle_import_file( $realpath );

		if ( is_wp_error( $id ) ) {
			wp_send_json_error( array( 
				'message' => $id->get_error_message(),
				'file'    => basename( $file ),
			) );
		} else {
			wp_send_json_success( array( 
				'message'       => sprintf(
					/* translators: %s: file name */
					__( '%s imported successfully.', 'add-from-server-reloaded' ),
					basename( $file )
				),
				'file'          => basename( $file ),
				'attachment_id' => $id,
			) );
		}
	}

	/**
	 * AJAX handler for checking duplicates.
	 *
	 * @since 4.0.0
	 */
	public function ajax_check_duplicate() {
		check_ajax_referer( 'afsr_import', 'nonce' );

		if ( ! current_user_can( 'upload_files' ) ) {
			wp_send_json_error( array( 'message' => __( 'You do not have permission.', 'add-from-server-reloaded' ) ) );
		}

		$file = isset( $_POST['file'] ) ? sanitize_text_field( wp_unslash( $_POST['file'] ) ) : '';

		if ( empty( $file ) ) {
			wp_send_json_error( array( 'message' => __( 'No file specified.', 'add-from-server-reloaded' ) ) );
		}

		$duplicate = $this->check_if_duplicate( $file );

		if ( $duplicate ) {
			wp_send_json_success( array( 
				'is_duplicate' => true,
				'message'      => sprintf(
					/* translators: 1: file name, 2: attachment ID */
					__( '%1$s already exists in the media library (ID: %2$d).', 'add-from-server-reloaded' ),
					basename( $file ),
					$duplicate
				),
			) );
		} else {
			wp_send_json_success( array( 
				'is_duplicate' => false,
			) );
		}
	}

	/**
	 * Check if file is already in media library.
	 *
	 * @since 4.0.0
	 *
	 * @param  string $file File path.
	 * @return int|false Attachment ID if duplicate found, false otherwise.
	 */
	protected function check_if_duplicate( $file ) {
		global $wpdb;
		
		$uploads = \wp_upload_dir();
		$file    = \wp_normalize_path( $file );
		
		// Check if file is in uploads directory.
		if ( preg_match( '|^' . preg_quote( \wp_normalize_path( $uploads['basedir'] ), '|' ) . '(.*)$|i', $file, $mat ) ) {
			$attached_file = ltrim( $mat[1], '/' );
			
		// Query for existing attachment by exact path.
		$attachment_id = $wpdb->get_var( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->prepare(
				"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value = %s LIMIT 1",
				$attached_file
			)
		);
			
			if ( $attachment_id ) {
				return (int) $attachment_id;
			}
		}
		
	// Also check by filename in case file was imported before.
	$filename = \basename( $file );
	$attachment_id = $wpdb->get_var( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$wpdb->prepare(
			"SELECT p.ID FROM {$wpdb->posts} p 
			WHERE p.post_type = 'attachment' 
			AND p.guid LIKE %s 
			LIMIT 1",
			'%/' . $wpdb->esc_like( $filename )
		)
	);

		return $attachment_id ? (int) $attachment_id : false;
	}

	/**
	 * Handle individual file import.
	 *
	 * @since 4.0.0
	 *
	 * @param  string $file Full file path.
	 * @return int|WP_Error Attachment ID on success, WP_Error on failure.
	 */
	public function handle_import_file( $file ) {
		set_time_limit( 60 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions.Discouraged -- Set reasonable time limit per file.

		$file = wp_normalize_path( $file );

		// Security: Verify file exists and is readable.
		if ( ! file_exists( $file ) || ! is_readable( $file ) ) {
			return new WP_Error( 'file_not_readable', __( 'The file does not exist or is not readable.', 'add-from-server-reloaded' ) );
		}

		// Security: Prevent importing of PHP files or other dangerous types.
		$dangerous_extensions = array( 'php', 'phtml', 'php3', 'php4', 'php5', 'phps', 'pht', 'phar', 'exe', 'sh', 'bat', 'cmd' );
		$ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
		
		if ( in_array( $ext, $dangerous_extensions, true ) ) {
			return new WP_Error( 'dangerous_file_type', __( 'This file type cannot be imported for security reasons.', 'add-from-server-reloaded' ) );
		}

		// Initially base it on the current time.
		$time = time();

		// A writable uploads dir will pass this test.
		$uploads = wp_upload_dir( $time );
		if ( ! empty( $uploads['error'] ) ) {
			return new WP_Error( 'upload_error', $uploads['error'] );
		}

		$wp_filetype = \wp_check_filetype( $file, null );
		$type        = $wp_filetype['type'];
		$ext_check   = $wp_filetype['ext'];
		
		if ( ( ! $type || ! $ext_check ) && ! current_user_can( 'unfiltered_upload' ) ) {
			return new WP_Error( 'wrong_file_type', __( 'Sorry, this file type is not permitted for security reasons.', 'add-from-server-reloaded' ) );
		}

		// Check if file is already in media library (duplicate detection).
		$duplicate = $this->check_if_duplicate( $file );
		if ( $duplicate ) {
			$edit_link = \admin_url( 'post.php?post=' . $duplicate . '&action=edit' );
			return new WP_Error( 
				'file_exists', 
				sprintf(
					/* translators: %s: link to edit attachment */
					__( 'File already exists. <a href="%s" target="_blank">View in Media Library</a>', 'add-from-server-reloaded' ),
					\esc_url( $edit_link )
				)
			);
		}

		// Is the file already in the uploads folder?
		if ( preg_match( '|^' . preg_quote( wp_normalize_path( $uploads['basedir'] ), '|' ) . '(.*)$|i', $file, $mat ) ) {

			$filename = basename( $file );
			$new_file = $file;
			$url      = $uploads['baseurl'] . $mat[1];

			$time = filemtime( $file ) ?: time();

			// If file is in dated folder, try to match the date.
			if ( preg_match( '|^/?(?P<Ym>(?P<year>\d{4})/(?P<month>\d{2}))|', dirname( $mat[1] ), $datemat ) ) {
				// The file date and the folder it's in are mismatched. Set it to the date of the folder.
				if ( gmdate( 'Y/m', $time ) !== $datemat['Ym'] ) {
					$time = mktime( 0, 0, 0, $datemat['month'], 1, $datemat['year'] );
				}
			}

			// Get the uploads folder for the correct time.
			$uploads = wp_upload_dir( $time );
			if ( ! empty( $uploads['error'] ) ) {
				return new WP_Error( 'upload_error', $uploads['error'] );
			}
			
			$url = $uploads['baseurl'] . $mat[1];

		} else {
			// File is outside uploads directory - copy it.
			$filename = \wp_unique_filename( $uploads['path'], basename( $file ) );
			$new_file = $uploads['path'] . '/' . $filename;
			
			if ( false === @copy( $file, $new_file ) ) {
				return new WP_Error( 
					'upload_error', 
					sprintf( 
						/* translators: %s: upload directory path */
						__( 'The selected file could not be copied to %s.', 'add-from-server-reloaded' ), 
						$uploads['path'] 
					) 
				);
			}

		// Set correct file permissions.
		$stat  = stat( dirname( $new_file ) );
			$perms = $stat['mode'] & 0000666;
		chmod( $new_file, $perms ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_chmod

			// Compute the URL.
			$url = $uploads['url'] . '/' . $filename;
		}

		// Apply upload filters.
		$return   = apply_filters( 'wp_handle_upload', array( 'file' => $new_file, 'url' => $url, 'type' => $type ), 'sideload' );
		$new_file = $return['file'];
		$url      = $return['url'];
		$type     = $return['type'];

		// Generate title from filename.
		$title   = preg_replace( '!\.[^.]+$!', '', basename( $file ) );
		$content = '';
		$excerpt = '';

		// Extract metadata for audio files.
		if ( preg_match( '#^audio#', $type ) ) {
			$meta = \wp_read_audio_metadata( $new_file );
	
			if ( ! empty( $meta['title'] ) ) {
				$title = $meta['title'];
			}
	
			if ( ! empty( $title ) ) {
	
				if ( ! empty( $meta['album'] ) && ! empty( $meta['artist'] ) ) {
					/* translators: 1: audio track title, 2: album title, 3: artist name */
					$content .= sprintf( __( '"%1$s" from %2$s by %3$s.', 'add-from-server-reloaded' ), $title, $meta['album'], $meta['artist'] );
				} elseif ( ! empty( $meta['album'] ) ) {
					/* translators: 1: audio track title, 2: album title */
					$content .= sprintf( __( '"%1$s" from %2$s.', 'add-from-server-reloaded' ), $title, $meta['album'] );
				} elseif ( ! empty( $meta['artist'] ) ) {
					/* translators: 1: audio track title, 2: artist name */
					$content .= sprintf( __( '"%1$s" by %2$s.', 'add-from-server-reloaded' ), $title, $meta['artist'] );
				} else {
					/* translators: %s: audio track title */
					$content .= sprintf( __( '"%s".', 'add-from-server-reloaded' ), $title );
				}
	
			} elseif ( ! empty( $meta['album'] ) ) {
	
				if ( ! empty( $meta['artist'] ) ) {
					/* translators: 1: audio album title, 2: artist name */
					$content .= sprintf( __( '%1$s by %2$s.', 'add-from-server-reloaded' ), $meta['album'], $meta['artist'] );
				} else {
					$content .= $meta['album'] . '.';
				}
	
			} elseif ( ! empty( $meta['artist'] ) ) {
	
				$content .= $meta['artist'] . '.';
	
			}
	
			if ( ! empty( $meta['year'] ) ) {
				/* translators: %d: release year */
				$content .= ' ' . sprintf( __( 'Released: %d.', 'add-from-server-reloaded' ), $meta['year'] );
			}
	
			if ( ! empty( $meta['track_number'] ) ) {
				$track_number = explode( '/', $meta['track_number'] );
				if ( isset( $track_number[1] ) ) {
					/* translators: 1: track number, 2: total tracks */
					$content .= ' ' . sprintf( __( 'Track %1$s of %2$s.', 'add-from-server-reloaded' ), number_format_i18n( $track_number[0] ), number_format_i18n( $track_number[1] ) );
				} else {
					/* translators: %s: track number */
					$content .= ' ' . sprintf( __( 'Track %s.', 'add-from-server-reloaded' ), number_format_i18n( $track_number[0] ) );
				}
			}

			if ( ! empty( $meta['genre'] ) ) {
				/* translators: %s: genre */
				$content .= ' ' . sprintf( __( 'Genre: %s.', 'add-from-server-reloaded' ), $meta['genre'] );
			}
	
		// Use image exif/iptc data for title and caption defaults if possible.
		} elseif ( 0 === strpos( $type, 'image/' ) ) {
			$image_meta = @\wp_read_image_metadata( $new_file );
			
			if ( $image_meta && ! empty( $image_meta['title'] ) && ! is_numeric( sanitize_title( $image_meta['title'] ) ) ) {
				$title = $image_meta['title'];
			}
	
			if ( $image_meta && ! empty( $image_meta['caption'] ) ) {
				$excerpt = $image_meta['caption'];
			}
		}

		// Construct the attachment array.
		$attachment = array(
			'post_mime_type' => $type,
			'guid'           => $url,
			'post_parent'    => 0,
			'post_title'     => $title,
			'post_name'      => $title,
			'post_content'   => $content,
			'post_excerpt'   => $excerpt,
			'post_date'      => gmdate( 'Y-m-d H:i:s', $time ),
			'post_date_gmt'  => gmdate( 'Y-m-d H:i:s', $time ),
		);

		/**
		 * Filters the attachment data before import.
		 *
		 * @since 4.0.0
		 *
		 * @param array  $attachment Attachment data.
		 * @param string $file       File path.
		 */
		$attachment = apply_filters( 'afsr_import_attachment_data', $attachment, $file );

		// Backwards compatibility filter.
		$attachment = apply_filters( 'afs-import_details', $attachment, $file, 0, 'current' );

		// Save the data.
		$id = \wp_insert_attachment( $attachment, $new_file, 0 );
		
		if ( ! \is_wp_error( $id ) ) {
			// Generate attachment metadata.
			$data = \wp_generate_attachment_metadata( $id, $new_file );
			\wp_update_attachment_metadata( $id, $data );
			
			/**
			 * Fires after a file has been imported.
			 *
			 * @since 4.0.0
			 *
			 * @param int    $id   Attachment ID.
			 * @param string $file File path.
			 */
			do_action( 'afsr_file_imported', $id, $file );
		}

		return $id;
	}

	/**
	 * Get the default directory.
	 *
	 * @since 4.0.0
	 *
	 * @return string Default directory path.
	 */
	protected function get_default_dir() {
		$root = $this->get_root();

		if ( ! $root ) {
			return '';
		}

		// Always start at the configured root directory.
		return $root;
	}

	/**
	 * Create the main content for the page.
	 *
	 * @since 4.0.0
	 */
	public function main_content() {

		$url = admin_url( 'upload.php?page=add-from-server-reloaded' );

		$root = $this->get_root();
		if ( ! $root ) {
			echo '<div class="notice notice-error"><p>';
			echo esc_html__( 'Unable to determine root directory. Please check your configuration.', 'add-from-server-reloaded' );
			echo '</p><p>';
			echo sprintf(
				/* translators: %s: constant name */
				esc_html__( 'You can define the %s constant in your wp-config.php file to set a custom root directory.', 'add-from-server-reloaded' ),
				'<code>ADD_FROM_SERVER_RELOADED</code>'
			);
			echo '</p></div>';
			return;
		}

		$cwd = $this->get_default_dir();
		if ( ! empty( $_COOKIE[ COOKIE ] ) ) {
			$cookie_path = sanitize_text_field( wp_unslash( $_COOKIE[ COOKIE ] ) );
			$temp_cwd    = realpath( trailingslashit( $root ) . $cookie_path );
			
			// Validate the cookie path.
			if ( $temp_cwd && str_starts_with( $temp_cwd, $root ) ) {
				$cwd = $temp_cwd;
			}
		}

		// Validate current directory.
		if ( ! str_starts_with( $cwd, $root ) ) {
			$cwd = $root;
		}

		$cwd_relative = substr( $cwd, strlen( $root ) );

		// Build breadcrumb navigation.
		$dirparts   = array();
		$dirparts[] = '<a href="' . esc_url( add_query_arg( 'path', rawurlencode( '/' ), $url ) ) . '">' . esc_html( trailingslashit( $root ) ) . '</a> ';

		$dir_path = '';
		foreach ( array_filter( explode( '/', $cwd_relative ) ) as $dir ) {
			$dir_path  .= '/' . $dir;
			$dirparts[] = '<a href="' . esc_url( add_query_arg( 'path', rawurlencode( $dir_path ), $url ) ) . '">' . esc_html( $dir ?: basename( $root ) ) . '/</a> ';
		}

		$dirparts = implode( '', $dirparts );

		// Sort function for case-insensitive alphabetical sorting.
		$sort_by_text = function( $a, $b ) {
			return strtolower( $a['text'] ) <=> strtolower( $b['text'] );
		};

		// Get a list of files to show.
		$nodes = glob( rtrim( $cwd, '/' ) . '/*' ) ?: array();

		$directories = array_flip( array_filter( $nodes, function( $node ) {
			return is_dir( $node );
		} ) );

		// Recursive function to find importable root.
		$get_import_root = function( $path ) use ( &$get_import_root ) {
			if ( ! is_readable( $path ) ) {
				return false;
			}

			$files = glob( $path . '/*' );
			if ( ! $files ) {
				return false;
			}

			$has_files = false;
			foreach ( $files as $i => $file ) {
				if ( is_file( $file ) ) {
					$has_files = true;
					break;
				} else {
					if ( $get_import_root( $file ) ) {
						$has_files = true;
						break;
					} else {
						unset( $files[ $i ] );
					}
				}
			}
			
			if ( ! $has_files ) {
				return false;
			}

			// Rekey the array in case anything was removed.
			$files = array_values( $files );

			if ( 1 === count( $files ) && is_dir( $files[0] ) ) {
				return $get_import_root( $files[0] );
			}

			return $path;
		};

		$get_root_relative_path = function( $path ) use ( $root ) {
			$root_offset = strlen( $root );
			if ( '/' !== $root ) {
				$root_offset += 1;
			}

			return substr( $path, $root_offset );
		};

		array_walk( $directories, function( &$data, $path ) use ( $root, $cwd_relative, $get_import_root, $get_root_relative_path ) {
			$import_root = $get_import_root( $path );
			if ( ! $import_root ) {
				// Unreadable, etc.
				$data = false;
				return;
			}

			$data = array(
				'text' => substr(
						$get_root_relative_path( $import_root ),
						strlen( $cwd_relative )
					) . '/',
				'path' => $get_root_relative_path( $import_root ),
			);

			$data['text'] = ltrim( $data['text'], '/' );
		} );

		$directories = array_filter( $directories );

		// Sort the directories case insensitively.
		uasort( $directories, $sort_by_text );

		// Prefix the parent directory.
		if ( str_starts_with( dirname( $cwd ), $root ) && dirname( $cwd ) !== $cwd ) {
			$directories = array_merge(
				array(
					dirname( $cwd ) => array(
						'text' => __( 'Parent Folder', 'add-from-server-reloaded' ),
						'path' => $get_root_relative_path( dirname( $cwd ) ) ?: '/',
					),
				),
				$directories
			);
		}

		$files = array_flip( array_filter( $nodes, function( $node ) {
			return is_file( $node );
		} ) );
		
		array_walk( $files, function( &$data, $path ) use ( $root, $get_root_relative_path ) {
			$importable = ( false !== \wp_check_filetype( $path )['type'] || current_user_can( 'unfiltered_upload' ) );
			$readable   = is_readable( $path );

			// Get file modification time.
			$file_date = '';
			if ( $readable && file_exists( $path ) ) {
				$file_date = date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), filemtime( $path ) );
			}

			$data = array(
				'text'       => basename( $path ),
				'file'       => $get_root_relative_path( $path ),
				'importable' => $importable,
				'readable'   => $readable,
				'size'       => $readable ? size_format( filesize( $path ) ) : 'N/A',
				'date'       => $file_date,
				'error'      => (
					! $importable ? 'doesnt-meet-guidelines' : (
						! $readable ? 'unreadable' : false
					)
				),
			);
		} );

		// Sort case insensitively.
		uasort( $files, $sort_by_text );

		?>
		<div class="afsr-wrap">
			<form method="post" action="<?php echo esc_url( $url ); ?>" id="afsr-import-form">
			<div class="afsr-current-directory">
				<strong class="afsr-location-label"><?php esc_html_e( '📂 Current Location:', 'add-from-server-reloaded' ); ?></strong> 
				<div id="cwd"><?php echo wp_kses_post( $dirparts ); ?></div>
			</div>

				<div style="margin-bottom: 15px;">
					<?php wp_nonce_field( 'afsr_import' ); ?>
					<?php submit_button( __( 'Import Selected Files', 'add-from-server-reloaded' ), 'primary', 'import', false ); ?>
					<button type="button" class="button" id="afsr-toggle-hidden" style="margin-left: 10px;">
						<?php esc_html_e( 'Show Hidden Files', 'add-from-server-reloaded' ); ?>
					</button>
					<span class="afsr-import-status" style="margin-left: 15px;"></span>
					<span class="afsr-file-count" style="margin-left: 15px; color: #666;"></span>
				</div>

				<table class="widefat afsr-file-table">
					<thead>
					<tr>
						<td class="check-column"><input type="checkbox" id="afsr-select-all" /></td>
						<td><?php esc_html_e( 'File', 'add-from-server-reloaded' ); ?></td>
						<td><?php esc_html_e( 'Size', 'add-from-server-reloaded' ); ?></td>
						<td><?php esc_html_e( 'Last Modified', 'add-from-server-reloaded' ); ?></td>
					</tr>
					</thead>
					<tbody>
					<?php

					$folder_id = 0;
					foreach ( $directories as $dir ) {
						if ( empty( $dir['path'] ) ) {
							continue;
						}

						// Get folder modification time.
						$folder_path = trailingslashit( $root ) . ltrim( $dir['path'], '/' );
						$folder_date = '';
						if ( file_exists( $folder_path ) ) {
							$folder_date = date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), filemtime( $folder_path ) );
						}

						// Check if this is the parent folder.
						$is_parent = ( $dir['text'] === __( 'Parent Folder', 'add-from-server-reloaded' ) );
						$folder_icon = $is_parent ? '⬆️' : '📁';
						$folder_label = $is_parent ? __( '(Go Back)', 'add-from-server-reloaded' ) : $dir['text'];

						printf(
							'<tr class="afsr-folder-row">
								<th class="check-column">
									%1$s
								</th>
								<td>
									<a href="%2$s" style="text-decoration: none; display: inline-block; padding: 5px 0; font-weight: 500;">
										%3$s %4$s
									</a>
									%5$s
								</td>
								<td>%6$s</td>
								<td>%7$s</td>
							</tr>',
							$is_parent ? '&nbsp;' : '<input type="checkbox" id="folder-' . absint( $folder_id ) . '" name="folders[]" value="' . esc_attr( $dir['path'] ) . '" />', // 1
							esc_url( add_query_arg( 'path', rawurlencode( $dir['path'] ), $url ) ), // 2
							esc_html( $folder_icon ), // 3
							esc_html( $folder_label ), // 4
							! $is_parent ? '<small style="color: #666; margin-left: 10px;">' . esc_html__( '(click to browse, check to import all files)', 'add-from-server-reloaded' ) . '</small>' : '', // 5
							$is_parent ? '&nbsp;' : esc_html__( 'Folder', 'add-from-server-reloaded' ), // 6
							esc_html( $folder_date ) // 7
						);
						
						if ( ! $is_parent ) {
							$folder_id++;
						}
					}

					$file_id = 0;
					foreach ( $files as $file ) {
						$error_str = '';
						if ( 'doesnt-meet-guidelines' === $file['error'] ) {
							$error_str = __( 'Sorry, this file type is not permitted for security reasons.', 'add-from-server-reloaded' );
						} elseif ( 'unreadable' === $file['error'] ) {
							$error_str = __( 'Sorry, but this file is unreadable by your Webserver. Perhaps check your File Permissions?', 'add-from-server-reloaded' );
						}

						printf(
							'<tr class="%1$s" title="%2$s">
								<th class="check-column">
									<input type="checkbox" id="file-%3$d" name="files[]" value="%4$s" %5$s />
								</th>
								<td><label for="file-%3$d">%6$s</label></td>
							<td>%7$s</td>
							<td>%8$s</td>
							</tr>',
						esc_attr( $file['error'] ?: '' ), // 1
						esc_attr( $error_str ), // 2
						absint( $file_id++ ), // 3
						esc_attr( $file['file'] ), // 4
							disabled( false, $file['readable'] && $file['importable'], false ), // 5
							esc_html( $file['text'] ), // 6
							esc_html( $file['size'] ), // 7
							esc_html( $file['date'] ?? '' ) // 8
						);
					}

					// If we have any files that are error flagged, add the hidden row.
					if ( array_filter( array_column( $files, 'error' ) ) ) {
						printf(
							'<tr class="hidden-toggle">
								<td>&nbsp;</td>
								<td colspan="2"><a href="#">%s</a></td>
							</tr>',
							esc_html__( 'Show hidden files', 'add-from-server-reloaded' )
						);
					}

					?>
					</tbody>
					<tfoot>
					<tr>
						<td class="check-column"><input type="checkbox" id="afsr-select-all-footer" /></td>
						<td><?php esc_html_e( 'File', 'add-from-server-reloaded' ); ?></td>
						<td><?php esc_html_e( 'Size', 'add-from-server-reloaded' ); ?></td>
					</tr>
					</tfoot>
				</table>

				<br class="clear" />
				<?php wp_nonce_field( 'afsr_import' ); ?>
				<?php submit_button( __( 'Import Selected Files', 'add-from-server-reloaded' ), 'primary', 'import', false ); ?>
				<span class="afsr-import-status" style="margin-left: 15px;"></span>
			</form>

			<div class="afsr-help-section" style="margin-top: 30px; padding: 20px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
				<h2 style="margin-top: 0;"><?php esc_html_e( '📚 How to Use', 'add-from-server-reloaded' ); ?></h2>
				<p style="font-size: 14px; line-height: 1.6;">
					<?php esc_html_e( 'This plugin allows you to import files that are already on your server into the WordPress Media Library. Simply browse to the folder containing your files, select them (or select entire folders), and click "Import Selected Files".', 'add-from-server-reloaded' ); ?>
				</p>
				
				<?php if ( \current_user_can( 'manage_options' ) ) : ?>
					<h3 style="margin-top: 20px;"><?php esc_html_e( '⚙️ Change Root Directory', 'add-from-server-reloaded' ); ?></h3>
					
					<?php \settings_errors( 'afsr_settings' ); ?>
					
					<p style="font-size: 14px;">
						<?php
						printf(
							/* translators: %s: root directory path */
							esc_html__( 'Currently browsing: %s', 'add-from-server-reloaded' ),
							'<code style="background: #fff; padding: 3px 6px; border-radius: 3px; font-weight: 600;">' . esc_html( $root ) . '</code>'
						);
						?>
					</p>
					
					<form method="post" action="" style="margin-top: 15px;">
						<?php \wp_nonce_field( 'afsr_settings' ); ?>
						<table class="form-table" style="margin-top: 0;">
							<tr>
								<th scope="row" style="padding-left: 0;">
									<label for="afsr_root_directory"><?php esc_html_e( 'Root Directory Path:', 'add-from-server-reloaded' ); ?></label>
								</th>
								<td>
									<input 
										type="text" 
										name="afsr_root_directory" 
										id="afsr_root_directory" 
										class="regular-text" 
										placeholder="/var/www/your-files/" 
										value="<?php echo esc_attr( rtrim( $root, '/' ) ); ?>"
										style="width: 400px; max-width: 100%;"
									/>
									<p class="description">
										<?php esc_html_e( 'The path above is your current root directory. Change it to browse files from a different location.', 'add-from-server-reloaded' ); ?>
										<br>
										<strong><?php esc_html_e( 'Examples:', 'add-from-server-reloaded' ); ?></strong>
										<code style="background: #f5f5f5; padding: 2px 6px; border-radius: 2px; margin: 0 3px;">/var/www/media</code>
										<code style="background: #f5f5f5; padding: 2px 6px; border-radius: 2px; margin: 0 3px;">/home/username/files</code>
									</p>
								</td>
							</tr>
						</table>
						<p>
							<input type="submit" name="afsr_save_settings" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'add-from-server-reloaded' ); ?>" />
							<?php if ( \get_option( 'afsr_root_directory', '' ) ) : ?>
								<input type="submit" name="afsr_save_settings" class="button" value="<?php esc_attr_e( 'Reset to Default', 'add-from-server-reloaded' ); ?>" 
									onclick="document.getElementById('afsr_root_directory').value=''; return true;" />
							<?php endif; ?>
						</p>
					</form>
				<?php else : ?>
					<h3 style="margin-top: 20px;"><?php esc_html_e( '⚙️ Current Directory', 'add-from-server-reloaded' ); ?></h3>
					<p style="font-size: 14px;">
						<?php
						printf(
							/* translators: %s: root directory path */
							esc_html__( 'Currently browsing: %s', 'add-from-server-reloaded' ),
							'<code style="background: #fff; padding: 3px 6px; border-radius: 3px; font-weight: 600;">' . esc_html( $root ) . '</code>'
						);
						?>
					</p>
					<p style="font-size: 13px; color: #666;">
						<?php esc_html_e( 'Contact your site administrator to change the root directory.', 'add-from-server-reloaded' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	<?php
	}

	/**
	 * Display outdated options notice.
	 *
	 * @since 4.0.0
	 */
	public function outdated_options_notice() {
		$old_root = get_option( 'frmsvr_root', '' );

		if (
			$old_root &&
			str_contains( $old_root, '%' ) &&
			! defined( 'ADD_FROM_SERVER_RELOADED' ) &&
			! defined( 'ADD_FROM_SERVER' )
		) {
			printf(
				'<div class="notice notice-error"><p>%s</p></div>',
				wp_kses_post(
					/* translators: %username% and %role% are literal example text that users may have entered in settings, not string placeholders. The <a> tag links to options.php page. */
					__( 'You previously used the "Root Directory" option with a placeholder, such as %username% or %role%. Unfortunately this feature is no longer supported. As a result, Add From Server has been disabled for users who have restricted upload privileges. To make this warning go away, empty the "frmsvr_root" option on <a href="options.php#frmsvr_root">options.php</a>.', 'add-from-server-reloaded' )
				)
			);
		}

		if ( $old_root && ! str_starts_with( $old_root, $this->get_root() ) ) {
			printf(
				'<div class="notice notice-warning"><p>%s</p></div>',
				wp_kses_post(
					sprintf(
						/* translators: 1: old root path, 2: new root path */
						__( 'Warning: Root Directory changed. You previously used <code>%1$s</code> as your "Root Directory", this has been changed to <code>%2$s</code>. To restore your previous settings, add the following line to your <code>wp-config.php</code> file: <code>define( "ADD_FROM_SERVER_RELOADED", "%1$s" );</code> To make this warning go away, empty the "frmsvr_root" option on <a href="options.php#frmsvr_root">options.php</a>.', 'add-from-server-reloaded' ),
						esc_html( $old_root ),
						esc_html( $this->get_root() )
					)
				)
			);
		}
	}

}
