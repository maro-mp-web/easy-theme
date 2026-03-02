<?php
/**
 * Secure Custom Fields (SCF) / Advanced Custom Fields (ACF) Integration
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

class SCF {

	/**
	 * Register actions and filters
	 */
	public function register() {
		// Define paths for JSON sync
		add_filter( 'acf/settings/save_json', array( $this, 'save_json_path' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'load_json_path' ) );

		// Register ACF/SCF Options page if needed (Uncomment if needed)
		// add_action( 'acf/init', array( $this, 'register_options_page' ) );
	}

	/**
	 * Save ACF/SCF fields as JSON in the theme folder.
	 * This ensures fields are tracked in Git.
	 *
	 * @param  string $path Default path.
	 * @return string       Modified path.
	 */
	public function save_json_path( $path ) {
		$path = get_stylesheet_directory() . '/acf-json';
		return $path;
	}

	/**
	 * Load ACF/SCF fields from the JSON in the theme folder.
	 *
	 * @param  array $paths Default array of paths.
	 * @return array        Modified array of paths.
	 */
	public function load_json_path( $paths ) {
		// Append path to existing array (don't remove original paths)
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}

	/**
	 * Register Global Options page (requires ACF Pro, but keeping it for reference)
	 */
	public function register_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title'    => 'Theme General Settings',
				'menu_title'    => 'Theme Settings',
				'menu_slug'     => 'theme-general-settings',
				'capability'    => 'edit_posts',
				'redirect'      => false,
			) );
		}
	}
}
