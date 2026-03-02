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
			\EasyTheme\Environment\Env::class,
			\EasyTheme\Setup\ThemeSupport::class,
			\EasyTheme\Setup\Gutenberg::class,
			\EasyTheme\Setup\Media::class,
			\EasyTheme\Setup\Enqueue::class,
			\EasyTheme\Setup\Security::class,
			\EasyTheme\Setup\SCF::class,
			\EasyTheme\CLI\MakeCommand::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it implements ServiceInterface
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			
			// OOP Best Practice: Ensure the object adheres to the contract!
			if ( $service instanceof ServiceInterface ) {
				$service->register();
			} else {
				// Prevent faulty developer code from silent failing
				if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
					error_log( 'Class ' . get_class( $service ) . ' must implement ServiceInterface to be registered automatically.' );
				}
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
