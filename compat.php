<?php
/**
 * PHP 8 Compatibility Functions
 * Symfony Polyfill https://github.com/symfony/polyfill/blob/master/src/Php80/Php80.php
 *
<<<<<<< HEAD
 * @package Add_From_Server_Reloaded
=======
 * @package AFSRReloaded
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
 * @since   4.0.0
 */

if ( ! function_exists( 'str_starts_with' ) ) {
	/**
	 * Check if string starts with substring.
	 *
	 * @param string $haystack The string to search in.
	 * @param string $needle The substring to search for.
	 * @return bool
	 */
	function str_starts_with( $haystack, $needle ) {
<<<<<<< HEAD
		return 0 === strncmp( $haystack, $needle, strlen( $needle ) );
=======
		 return 0 === strncmp( $haystack, $needle, strlen( $needle ) );
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
	}
}

if ( ! function_exists( 'str_ends_with' ) ) {
	/**
	 * Check if string ends with substring.
	 *
	 * @param string $haystack The string to search in.
	 * @param string $needle The substring to search for.
	 * @return bool
	 */
	function str_ends_with( $haystack, $needle ) {
<<<<<<< HEAD
		return '' === $needle || ( '' !== $haystack && 0 === substr_compare( $haystack, $needle, -strlen( $needle ) ) );
=======
		 return '' === $needle || ( '' !== $haystack && 0 === substr_compare( $haystack, $needle, -strlen( $needle ) ) );
>>>>>>> 7a9d599 (Initial commit of Add From Server Reloaded plugin v5.1.0)
	}
}

if ( ! function_exists( 'str_contains' ) ) {
	/**
	 * Check if string contains substring.
	 *
	 * @param string $haystack The string to search in.
	 * @param string $needle The substring to search for.
	 * @return bool
	 */
	function str_contains( $haystack, $needle ) {
		return '' === $needle || false !== strpos( $haystack, $needle );
	}
}
