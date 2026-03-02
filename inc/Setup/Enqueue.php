<?php
/**
 * Enqueue scripts and styles
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

class Enqueue implements \EasyTheme\Core\ServiceInterface {
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action( 'wp_head', array( $this, 'vite_head_module_hook' ) );
	}

    public function vite_head_module_hook() {
        if ( $this->is_vite_running() ) {
            echo '<script type="module" crossorigin src="http://localhost:5173/@vite/client"></script>';
            echo '<script type="module" crossorigin src="http://localhost:5173/src/js/main.js"></script>';
        }
    }

	public function enqueue() {
        // Only load standard WP CSS
		wp_enqueue_style( 'easy-style', get_stylesheet_uri(), array(), '1.0.0' );

        $dist_uri = get_template_directory_uri() . '/dist/';
        $dist_path = get_template_directory() . '/dist/';
        
        // If manifest exists, we are in production
        $manifest_path = $dist_path . '.vite/manifest.json';
        
        if ( ! $this->is_vite_running() && file_exists( $manifest_path ) ) {
            $manifest = json_decode( file_get_contents( $manifest_path ), true );

            if ( isset( $manifest['src/js/main.js'] ) ) {
                $js_file = $manifest['src/js/main.js']['file'];
                wp_enqueue_script( 'easy-main-js', $dist_uri . $js_file, array(), null, true );

                // Add module type manually later if needed, but modern WP allows some ways.
                // Or we can just print it in footer.
                // Let's use script_loader_tag hook if we want module support.
                if ( isset( $manifest['src/js/main.js']['css'] ) ) {
                    foreach ( $manifest['src/js/main.js']['css'] as $css_file ) {
                        wp_enqueue_style( 'easy-main-css', $dist_uri . $css_file, array(), null );
                    }
                }
            }
        }
	}

    private function is_vite_running() {
        // Simple check if local vite is running.
        // For local development only
        if ( wp_get_environment_type() === 'local' || defined('WP_DEBUG') && WP_DEBUG ) {
            $connection = @fsockopen('localhost', '5173', $errno, $errstr, 1);
            if ( is_resource( $connection ) ) {
                fclose( $connection );
                return true;
            }
        }
        return false;
    }
}
