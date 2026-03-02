<?php
/**
 * WP-CLI Commands for Easy Theme
 *
 * @package EasyTheme
 */

namespace EasyTheme\CLI;

use WP_CLI;

class MakeCommand {

	/**
	 * Register the CLI command.
	 */
	public function register() {
		// Only register if WP_CLI is running
		if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
			return;
		}

		WP_CLI::add_command( 'easy make:block', array( $this, 'make_block' ) );
		WP_CLI::add_command( 'easy make:cpt', array( $this, 'make_cpt' ) );
	}

	/**
	 * Generates a template part for a Gutenberg block.
	 *
	 * ## OPTIONS
	 *
	 * <name>
	 * : The name of the block (e.g., HeroSection).
	 *
	 * ## EXAMPLES
	 *
	 *     wp easy make:block HeroSection
	 *
	 * @param array $args
	 * @param array $assoc_args
	 */
	public function make_block( $args, $assoc_args ) {
		$block_name = sanitize_title( $args[0] );
		if ( empty( $block_name ) ) {
			WP_CLI::error( 'Please provide a valid block name.' );
		}

		$dir_path = get_template_directory() . '/template-parts/blocks';
		if ( ! file_exists( $dir_path ) ) {
			mkdir( $dir_path, 0755, true );
		}

		$file_path = $dir_path . '/' . $block_name . '.php';

		if ( file_exists( $file_path ) ) {
			WP_CLI::error( 'Block file already exists: ' . $file_path );
		}

		$stub = <<<EOT
<?php
/**
 * Block: {$block_name}
 * 
 * @package EasyTheme
 */

\$classes = ['block-{$block_name}', 'relative', 'my-8'];
if ( ! empty( \$block['className'] ) ) {
	\$classes[] = \$block['className'];
}
?>

<div class="<?php echo esc_attr( implode( ' ', \$classes ) ); ?>">
	<!-- Your block HTML goes here. Tailwind fully supported. -->
	<h2 class="text-2xl font-serif text-gray-900">Custom {$args[0]} Block</h2>
</div>
EOT;

		file_put_contents( $file_path, $stub );
		WP_CLI::success( "Block created successfully at {$file_path}" );
		WP_CLI::log( "Remember to register this block in your inc/Setup/Blocks.php or via SCF JSON." );
	}

	/**
	 * Generates a Custom Post Type class scaffolding.
	 *
	 * ## OPTIONS
	 *
	 * <name>
	 * : The name of the CPT (e.g., Portfolio).
	 *
	 * ## EXAMPLES
	 *
	 *     wp easy make:cpt Portfolio
	 *
	 * @param array $args
	 * @param array $assoc_args
	 */
	public function make_cpt( $args, $assoc_args ) {
		$cpt_name_uc = sanitize_text_field( $args[0] );
		$cpt_name_lc = sanitize_title( $args[0] );

		if ( empty( $cpt_name_lc ) ) {
			WP_CLI::error( 'Please provide a valid Custom Post Type name.' );
		}

		$dir_path  = get_template_directory() . '/inc/PostTypes';
		$file_path = $dir_path . '/' . $cpt_name_uc . '.php';

		if ( ! file_exists( $dir_path ) ) {
			mkdir( $dir_path, 0755, true );
		}

		if ( file_exists( $file_path ) ) {
			WP_CLI::error( 'CPT class already exists: ' . $file_path );
		}

		$stub = <<<EOT
<?php
/**
 * Custom Post Type: {$cpt_name_uc}
 *
 * @package EasyTheme
 */

namespace EasyTheme\PostTypes;

class {$cpt_name_uc} {

	public function register() {
		add_action( 'init', array( \$this, 'register_cpt' ) );
	}

	public function register_cpt() {
		\$labels = array(
			'name'                  => _x( '{$cpt_name_uc}s', 'Post Type General Name', 'easy-theme' ),
			'singular_name'         => _x( '{$cpt_name_uc}', 'Post Type Singular Name', 'easy-theme' ),
			'menu_name'             => __( '{$cpt_name_uc}s', 'easy-theme' ),
			'all_items'             => __( 'All {$cpt_name_uc}s', 'easy-theme' ),
			'add_new_item'          => __( 'Add New {$cpt_name_uc}', 'easy-theme' ),
			'add_new'               => __( 'Add New', 'easy-theme' ),
		);

		\$args = array(
			'label'                 => __( '{$cpt_name_uc}', 'easy-theme' ),
			'labels'                => \$labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_in_rest'          => true, // Enable Gutenberg Support
		);

		register_post_type( '{$cpt_name_lc}', \$args );
	}
}
EOT;

		file_put_contents( $file_path, $stub );
		WP_CLI::success( "Custom Post Type class created at {$file_path}" );
		WP_CLI::log( "Remember to add \EasyTheme\PostTypes\\{$cpt_name_uc}::class to your get_services() array in inc/Core/Init.php!" );
	}
}
