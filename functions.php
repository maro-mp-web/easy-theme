<?php
/**
 * EasyTheme Functions
 *
 * @package EasyTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if Composer autoload exists and require it
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
    // Better to provide an admin notice if composer is not installed
    add_action('admin_notices', function() {
        echo '<div class="notice notice-error"><p>Composer autoload missing. Please run <code>composer install</code> in your theme directory.</p></div>';
    });
    return;
}

// Initialize the theme
use EasyTheme\Core\Init;

if ( class_exists( 'EasyTheme\\Core\\Init' ) ) {
	Init::register_services();
}
