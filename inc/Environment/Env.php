<?php
/**
 * Environment class to load .env variables securely.
 *
 * @package EasyTheme
 */

namespace EasyTheme\Environment;

use EasyTheme\Core\ServiceInterface;
use Dotenv\Dotenv;

class Env implements ServiceInterface {

	public function register() {
		// Only load if Dotenv class exists (installed via Composer)
		if ( ! class_exists( 'Dotenv\Dotenv' ) ) {
			return;
		}

		$theme_path = get_template_directory();

		// Check if .env file exists before trying to load
		if ( file_exists( $theme_path . '/.env' ) ) {
			$dotenv = Dotenv::createImmutable( $theme_path );
			$dotenv->safeLoad();
		}
	}
}
