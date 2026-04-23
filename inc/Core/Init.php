<?php
/**
 * Initialize all core theme services
 *
 * @package EasyTheme
 */

namespace EasyTheme\Core;

use DI\ContainerBuilder;
use Exception;

class Init
{
	/**
	 * @var \DI\Container
	 */
	private static $container;

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{
		return [
			\EasyTheme\Environment\Env::class,
			\EasyTheme\Setup\ThemeSupport::class,
			\EasyTheme\Setup\Gutenberg::class,
			\EasyTheme\Setup\Media::class,
			\EasyTheme\Setup\Enqueue::class,
			\EasyTheme\Setup\Security::class,
			\EasyTheme\Setup\SCF::class,
			\EasyTheme\Setup\Blocks::class,
			\EasyTheme\CLI\MakeCommand::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it implements ServiceInterface
	 */
	public static function register_services()
	{
		try {
			$builder = new ContainerBuilder();

			// If we want to add custom definitions, we can do it here:
			// $builder->addDefinitions([...]);

			self::$container = $builder->build();

			foreach (self::get_services() as $class) {
				$service = self::$container->get($class);

				// OOP Best Practice: Ensure the object adheres to the contract!
				if ($service instanceof ServiceInterface) {
					$service->register();
				} else {
					// Prevent faulty developer code from silent failing
					if (defined('WP_DEBUG') && WP_DEBUG) {
						error_log(
							'Class ' .
								get_class($service) .
								' must implement ServiceInterface to be registered automatically.',
						);
					}
				}
			}
		} catch (Exception $e) {
			if (defined('WP_DEBUG') && WP_DEBUG) {
				error_log('EasyTheme DI Container Error: ' . $e->getMessage());
			}
		}
	}

	/**
	 * Access the container instance
	 * @return \DI\Container
	 */
	public static function get_container()
	{
		return self::$container;
	}
}
