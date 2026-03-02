<?php
/**
 * Gutenberg Editor Setup
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

use EasyTheme\Core\ServiceInterface;

class Gutenberg implements ServiceInterface {

	public function register() {
		add_action( 'after_setup_theme', array( $this, 'configure_editor' ) );
	}

	public function configure_editor() {
		// Remove default color palette to force designers into Tailwind palette
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_attr__( 'Primary Blue', 'easy-theme' ),
				'slug'  => 'blue-600',
				'color' => '#2563eb',
			),
			array(
				'name'  => esc_attr__( 'Dark Text', 'easy-theme' ),
				'slug'  => 'gray-900',
				'color' => '#111827',
			),
			array(
				'name'  => esc_attr__( 'Light Background', 'easy-theme' ),
				'slug'  => 'gray-50',
				'color' => '#f9fafb',
			),
			array(
				'name'  => esc_attr__( 'White', 'easy-theme' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
		) );

		// Disable custom colors to strictly enforce Tailwind palette
		add_theme_support( 'disable-custom-colors' );

		// Enforce base Tailwind typography sizes (No huge manual font overrides)
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => esc_attr__( 'Small', 'easy-theme' ),
				'shortName' => esc_attr_x( 'S', 'Font size', 'easy-theme' ),
				'size'      => 14,
				'slug'      => 'sm',
			),
			array(
				'name'      => esc_attr__( 'Base', 'easy-theme' ),
				'shortName' => esc_attr_x( 'M', 'Font size', 'easy-theme' ),
				'size'      => 16,
				'slug'      => 'base',
			),
			array(
				'name'      => esc_attr__( 'Large', 'easy-theme' ),
				'shortName' => esc_attr_x( 'L', 'Font size', 'easy-theme' ),
				'size'      => 20,
				'slug'      => 'lg',
			),
			array(
				'name'      => esc_attr__( 'Extra Large', 'easy-theme' ),
				'shortName' => esc_attr_x( 'XL', 'Font size', 'easy-theme' ),
				'size'      => 24,
				'slug'      => 'xl',
			),
		) );
		add_theme_support( 'disable-custom-font-sizes' );
	}
}
