<?php
/**
 * Register basic theme support
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

class ThemeSupport implements \EasyTheme\Core\ServiceInterface {
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
	}

	public function setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		
        // Add support for block styles
        add_theme_support( 'wp-block-styles' );

		// Register nav menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'easy-theme' ),
			'footer'  => esc_html__( 'Footer Menu', 'easy-theme' ),
		) );
	}
}
