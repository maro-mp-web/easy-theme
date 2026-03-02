<?php
/**
 * Security and Optimization settings
 *
 * @package EasyTheme
 */

namespace EasyTheme\Setup;

class Security {
	public function register() {
		// 1. Remove Emojis
		add_action( 'init', array( $this, 'disable_emojis' ) );

		// 2. Disable XML-RPC
		add_filter( 'xmlrpc_enabled', '__return_false' );

		// 3. Disable RSS Feeds
		add_action( 'do_feed', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_rdf', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_rss', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_rss2', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_atom', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_rss2_comments', array( $this, 'disable_feeds' ), 1 );
		add_action( 'do_feed_atom_comments', array( $this, 'disable_feeds' ), 1 );

		// 4. Disable REST API for non-authenticated users
		add_filter( 'rest_authentication_errors', array( $this, 'restrict_rest_api' ) );

		// 5. Clean up `<head>` (Remove WP version, RSD, WLW, Shortlink, etc.)
		add_action( 'init', array( $this, 'cleanup_head' ) );

		// 6. Remove WP Version from Styles and Scripts
		add_filter( 'style_loader_src', array( $this, 'remove_wp_version_strings' ) );
		add_filter( 'script_loader_src', array( $this, 'remove_wp_version_strings' ) );

		// 7. Disable oEmbed Discovery Links
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		// 8. Disallow File Edit (if not defined in wp-config.php)
		if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
			define( 'DISALLOW_FILE_EDIT', true );
		}
	}

	/**
	 * Disable emojis in WordPress
	 */
	public function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		// Remove from TinyMCE
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojis_tinymce' ) );
		// Remove emoji DNS prefetch
		add_filter( 'wp_resource_hints', array( $this, 'disable_emojis_remove_dns_prefetch' ), 10, 2 );
	}

	public function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		}
		return array();
	}

	public function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}

	/**
	 * Disable RSS feeds and redirect to homepage
	 */
	public function disable_feeds() {
		wp_die(
			/* translators: %s: Homepage URL */
			sprintf( __( 'No feed available, please visit the <a href="%s">homepage</a>!', 'easy-theme' ), esc_url( home_url( '/' ) ) )
		);
	}

	/**
	 * Restrict REST API to logged-in users only
	 */
	public function restrict_rest_api( $result ) {
		// If a previous authentication check was applied, pass that result along without modification.
		if ( ! empty( $result ) ) {
			return $result;
		}

		if ( ! is_user_logged_in() ) {
			return new \WP_Error(
				'rest_not_logged_in',
				__( 'You are not currently logged in.', 'easy-theme' ),
				array( 'status' => 401 )
			);
		}

		return $result;
	}

	/**
	 * Clean up the `<head>` section from useless tags
	 */
	public function cleanup_head() {
		remove_action( 'wp_head', 'wp_generator' ); // Remove WP version
		remove_action( 'wp_head', 'rsd_link' ); // Remove RSD link
		remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove WLW manifest link
		remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // Remove shortlink
	}

	/**
	 * Remove WP version from scripts and styles
	 */
	public function remove_wp_version_strings( $src ) {
		global $wp_version;
		parse_str( parse_url( $src, PHP_URL_QUERY ), $query );
		if ( ! empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	}
}
