<?php
/**
 * Auto-loading Gutenberg Blocks
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

use EasyTheme\Core\ServiceInterface;

class Blocks implements ServiceInterface
{
	public function register()
	{
		// Hook into WordPress block initialization
		add_action('init', [$this, 'register_scf_blocks']);
	}

	/**
	 * Automatically find and register all block.json files in template-parts/blocks/
	 */
	public function register_scf_blocks()
	{
		$blocks_dir = get_template_directory() . '/template-parts/blocks/';

		// Check if the directory exists
		if (!is_dir($blocks_dir)) {
			return;
		}

		// Scan directories inside template-parts/blocks/
		$block_folders = array_diff(scandir($blocks_dir), ['..', '.']);

		foreach ($block_folders as $folder) {
			$path_to_block = $blocks_dir . $folder;

			// Check if it's a directory and has a block.json file
			if (is_dir($path_to_block) && file_exists($path_to_block . '/block.json')) {
				// Register the block metadata!
				register_block_type($path_to_block);
			}
		}
	}
}
