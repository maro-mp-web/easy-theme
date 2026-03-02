<?php
/**
 * Media & Breakpoints Setup
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

use EasyTheme\Core\ServiceInterface;

class Media implements ServiceInterface {

	public function register() {
		// Initialize the image sizes matching Tailwind breakpoints
		add_action( 'after_setup_theme', array( $this, 'tailwind_image_sizes' ) );
		// Push sizes to the UI drop-down
		add_filter( 'image_size_names_choose', array( $this, 'display_image_sizes' ) );
	}

	public function tailwind_image_sizes() {
		// Default sizes:
		// sm: 640px
		// md: 768px
		// lg: 1024px
		// xl: 1280px

		add_image_size( 'tw-sm', 640, 9999, false );
		add_image_size( 'tw-md', 768, 9999, false );
		add_image_size( 'tw-lg', 1024, 9999, false );
		add_image_size( 'tw-xl', 1280, 9999, false );
	}

	public function display_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'tw-sm' => __( 'Tailwind SM (640w)', 'easy-theme' ),
			'tw-md' => __( 'Tailwind MD (768w)', 'easy-theme' ),
			'tw-lg' => __( 'Tailwind LG (1024w)', 'easy-theme' ),
			'tw-xl' => __( 'Tailwind XL (1280w)', 'easy-theme' ),
		) );
	}
}
