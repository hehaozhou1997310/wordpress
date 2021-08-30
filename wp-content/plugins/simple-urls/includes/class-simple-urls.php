<?php
/**
 * Simple URLs file.
 *
 * @package simple-urls
 */

/**
 * Simple URLs class.
 */
class Simple_Urls {

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'template_redirect', array( $this, 'count_and_redirect' ) );
		add_filter( 'wp_link_query', array( $this, 'use_amazon_url_instead_of_cloaked' ), 100 );

	}

	/**
	 * Load textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'simple-urls', false, SIMPLE_URLS_DIR . '/languages' );
	}

	/**
	 * Register Post Type.
	 */
	public function register_post_type() {

		$slug = 'surl';

		$rewrite_slug_default = 'go';

		$labels = array(
			'name'               => __( 'Simple URLs', 'simple-urls' ),
			'singular_name'      => __( 'URL', 'simple-urls' ),
			'add_new'            => __( 'Add New', 'simple-urls' ),
			'add_new_item'       => __( 'Add New URL', 'simple-urls' ),
			'edit'               => __( 'Edit', 'simple-urls' ),
			'edit_item'          => __( 'Edit URL', 'simple-urls' ),
			'new_item'           => __( 'New URL', 'simple-urls' ),
			'view'               => __( 'View URL', 'simple-urls' ),
			'view_item'          => __( 'View URL', 'simple-urls' ),
			'search_items'       => __( 'Search URL', 'simple-urls' ),
			'not_found'          => __( 'No URLs found', 'simple-urls' ),
			'not_found_in_trash' => __( 'No URLs found in Trash', 'simple-urls' ),
			'messages'           => array(
				0  => '', // Unused. Messages start at index 1.
				/* translators: %s: link for the update */
				1  => __( 'URL updated. <a href="%s">View URL</a>', 'simple-urls' ),
				2  => __( 'Custom field updated.', 'simple-urls' ),
				3  => __( 'Custom field deleted.', 'simple-urls' ),
				4  => __( 'URL updated.', 'simple-urls' ),
				/* translators: %s: date and time of the revision */
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'Post restored to revision from %s', 'simple-urls' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore
				/* translators: %s: URL to view */
				6  => __( 'URL updated. <a href="%s">View URL</a>', 'simple-urls' ),
				7  => __( 'URL saved.', 'simple-urls' ),
				8  => __( 'URL submitted.', 'simple-urls' ),
				9  => __( 'URL scheduled', 'simple-urls' ),
				10 => __( 'URL draft updated.', 'simple-urls' ),
			),
		);

		$labels = apply_filters( 'simple_urls_cpt_labels', $labels );

		$rewrite_slug = apply_filters( 'simple_urls_slug', $rewrite_slug_default );

		$rewrite_slug = sanitize_title( $rewrite_slug, $rewrite_slug_default );

		// Ref: https://developer.wordpress.org/reference/functions/add_post_type_support/.
		$supports_array = apply_filters( 'simple_urls_post_type_supports', array( 'title' ) );

		// Ref: https://developer.wordpress.org/reference/functions/register_post_type/.
		register_post_type(
			$slug,
			array(
				'labels'              => $labels,
				'public'              => true,
				'exclude_from_search' => apply_filters( 'simple_urls_exclude_from_search', true ),
				'show_ui'             => true,
				'query_var'           => true,
				'menu_position'       => 20,
				'supports'            => $supports_array,
				'rewrite'             => array(
					'slug'       => $rewrite_slug,
					'with_front' => false,
				),
				'show_in_rest'        => true,
			)
		);

	}

	/**
	 * Count and redirect function.
	 */
	public function count_and_redirect() {

		if ( ! is_singular( 'surl' ) ) {
			return;
		}

		global $wp_query;

		// Update the count.
		$count = isset( $wp_query->post->_surl_count ) ? (int) $wp_query->post->_surl_count : 0;
		update_post_meta( $wp_query->post->ID, '_surl_count', $count + 1 );

		// Handle the redirect.
		$redirect = isset( $wp_query->post->ID ) ? get_post_meta( $wp_query->post->ID, '_surl_redirect', true ) : '';

		/**
		 * Filter the redirect URL.
		 *
		 * @since 0.9.5
		 *
		 * @param string  $redirect The URL to redirect to.
		 * @param int  $var The current click count.
		 */
		$redirect = apply_filters( 'simple_urls_redirect_url', $redirect, $count );

		/**
		 * Action hook that fires before the redirect.
		 *
		 * @since 0.9.5
		 *
		 * @param string  $redirect The URL to redirect to.
		 * @param int  $var The current click count.
		 */
		do_action( 'simple_urls_redirect', $redirect, $count );

		if ( ! empty( $redirect ) ) {
			wp_redirect( esc_url_raw( $redirect ), 301 ); // phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect -- the redirect URL was added by a user with access to the admin and is filterable. Adding to allowed_redirect_hosts does little to improve security here.
			exit;
		} else {
			wp_safe_redirect( home_url(), 302 );
			exit;
		}

	}

	/**
	 * Use Amazon product url instead of cloaked url when search/insert a link into a post/page
	 *
	 * @param array $results An array of associative arrays of query results.
	 * @return array $results Full wp_link_query array of query results with updated permalinks.
	 */
	public function use_amazon_url_instead_of_cloaked( $results ) {
		foreach ( $results as $key => $post ) {
			$post_id   = isset( $post['ID'] ) ? $post['ID'] : null;
			$redirect  = isset( $post_id ) ? get_post_meta( $post_id, '_surl_redirect', true ) : '';
			$permalink = $post['permalink'] ?? '';

			if ( self::is_amazon_url( $redirect ) ) {
				// Set Amazon product url.
				$results[ $key ]['permalink'] = $redirect;
			}
		}

		return $results;
	}

	/**
	 * Get amazon domains
	 *
	 * @return array All of the valid Amazon domains.
	 */
	public static function get_domains() {
		return array(
			'amazon.com',          // US.
			'amazon.ca',           // Canada.
			'amazon.co.uk',        // UK.
			'amazon.com.au',       // Australia.
			'amazon.com.br',       // Brazil.
			'amazon.com.mx',       // Mexico.
			'amazon.fr',           // France.
			'amazon.de',           // Germany.
			'amazon.it',           // Italy.
			'amazon.in',           // India.
			'amazon.es',           // Spain.
			'amazon.cn',           // China.
			'amazon.co.jp',        // Japan.
			'amazon.nl',           // Netherlands.
			'amazon.se',           // Sweden.
			'amazon.sg',           // Singapore.
			'amazon.com.tr',       // Turkey.
			'amazon.ae',           // United Arab Emirates.
			'amzn.com',            // Short URL.
			'amzn.to',             // Short URL.
			'amazon-adsystem.com', // Amazon Embed.
			'smile.amazon.com',    // Amazon Smile.
		);
	}

	/**
	 * Check whether a url is amazon link or not
	 *
	 * @param string $url Url.
	 * @return bool If a url is a valid amazon url or not.
	 */
	public static function is_amazon_url( $url ) {
		if ( empty( $url ) ) {
			return false;
		}

		$domains = self::get_domains();
		$url     = self::add_https( $url );

		if ( ! self::validate_url( $url ) ) {
			return false;
		}

		$parsed_url = wp_parse_url( $url );
		if ( ! isset( $parsed_url['host'] ) ) {
			return false;
		}

		$domain = ltrim( $parsed_url['host'], 'www.' );

		if ( in_array( $domain, $domains, true ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Add https to the url
	 *
	 * @param string $url URL.
	 * @return string $url URL with https
	 */
	public static function add_https( $url ) {
		$url = trim( $url );
		if ( '' === $url || is_null( $url ) ) {
			return $url;
		}

		return preg_replace( '#^http(?=://)#', 'https', $url );
	}

	/**
	 * Validate URL
	 *
	 * @param string $url URL.
	 * @return bool if the url submitted is valid or not
	 */
	public static function validate_url( $url ) {
		return ( ( strpos( $url, 'http://' ) === 0 || strpos( $url, 'https://' ) === 0 ) && filter_var( $url, FILTER_VALIDATE_URL ) !== false );
	}

}