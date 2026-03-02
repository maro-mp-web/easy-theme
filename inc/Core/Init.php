<?php
/**
 * Initialize all core theme services
 *
 * @package EasyTheme
 */

namespace EasyTheme\Core;

class Init {

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [
			\EasyTheme\Setup\ThemeSupport::class,
			\EasyTheme\Setup\Enqueue::class,
			\EasyTheme\Setup\Security::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  string $class class name
	 * @return object        instance new instance of the class
	 */
	private static function instantiate( $class ) {
		return new $class();
	}
}
