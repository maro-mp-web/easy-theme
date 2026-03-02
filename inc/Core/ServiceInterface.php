<?php
/**
 * Service Interface
 *
 * @package EasyTheme
 */

namespace EasyTheme\Core;

/**
 * All setup classes that need to be instantiated and 
 * registered during theme initialization must implement this interface.
 */
interface ServiceInterface {

	/**
	 * Register any actions or filters into WordPress.
	 */
	public function register();

}
