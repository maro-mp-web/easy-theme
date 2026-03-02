<?php
/**
 * SVG Helper Class
 *
 * @package EasyTheme
 */

namespace EasyTheme\Helpers;

class Svg {

	/**
	 * Render an inline SVG file from the theme's assets/images directory.
	 *
	 * @param string $filename Name of the file without .svg extension.
	 * @param string $class    Optional CSS class to append.
	 *
	 * @return string Inline SVG contents, or empty string on failure.
	 */
	public static function render( $filename, $class = '' ) {
		$file_path = get_template_directory() . '/assets/images/' . $filename . '.svg';

		if ( ! file_exists( $file_path ) ) {
			return '<!-- SVG Not Found: ' . esc_html( $filename ) . ' -->';
		}

		$svg_content = file_get_contents( $file_path );

		// Optionally inject custom CSS classes into the root <svg> tag
		if ( ! empty( $class ) && false !== strpos( $svg_content, '<svg' ) ) {
			// Basic preg_replace to add classes to the <svg> element.
			// It handles cases where a class attribute might already exist.
			if ( preg_match( '/<svg[^>]*class="([^"]*)"/i', $svg_content ) ) {
				$svg_content = preg_replace( '/(<svg[^>]*class=")([^"]*)(")/i', '$1$2 ' . esc_attr( $class ) . '$3', $svg_content );
			} else {
				$svg_content = preg_replace( '/(<svg)/i', '$1 class="' . esc_attr( $class ) . '"', $svg_content );
			}
		}

		return $svg_content;
	}

	/**
	 * Helper function wrapper (can be called statically anywhere).
	 * Example usage: \EasyTheme\Helpers\Svg::render('logo', 'w-10 h-10 text-blue-500')
	 */
}
