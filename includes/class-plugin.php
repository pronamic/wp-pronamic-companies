<?php

class Pronamic_Companies_Plugin {
	/**
	 * The plugin version
	 *
	 * @var string
	 */
	public $version = '1.1.1';

	/**
	 * The plugin file
	 *
	 * @var string
	 */
	public $file;

	/**
	 * The plugin dirname
	 *
	 * @var string
	 */
	public $dir_path;

	//////////////////////////////////////////////////

	/**
	 * Construct and initialize plugin
	 */
	public function __construct( $file ) {
		$this->file    = $file;
		$this->dir_path = plugin_dir_path( $file );

		register_activation_hook( $file, array( $this, 'activate' ) );
		register_deactivation_hook( $file, array( $this, 'deactivate' ) );

		add_action( 'init',      array( $this, 'init' ) );
		add_action( 'p2p_init',  array( $this, 'p2p_init' ) );

		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );

		// Admin
		if ( is_admin() ) {
			$this->admin = new Pronamic_Companies_Plugin_Admin( $this );
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Initialize
	 */
	public function init() {
		// Text domain
		$rel_path = dirname( plugin_basename( $this->file ) ) . '/languages/';

		load_plugin_textdomain( 'pronamic_companies', false, $rel_path );

		// Require
		require_once $this->dir_path . 'includes/functions.php';
		require_once $this->dir_path . 'includes/taxonomy.php';
		require_once $this->dir_path . 'includes/gravityforms.php';
		require_once $this->dir_path . 'includes/template.php';

		// Post types
		$slug = get_option( 'pronamic_company_base' );
		$slug = empty( $slug ) ? _x( 'companies', 'slug', 'pronamic_companies' ) : $slug;

		register_post_type( 'pronamic_company', array(
			'labels'             => array(
				'name'               => _x( 'Companies', 'post type general name', 'pronamic_companies' ),
				'singular_name'      => _x( 'Company', 'post type singular name', 'pronamic_companies' ),
				'add_new'            => _x( 'Add New', 'company', 'pronamic_companies' ),
				'add_new_item'       => __( 'Add New Company', 'pronamic_companies' ),
				'edit_item'          => __( 'Edit Company', 'pronamic_companies' ),
				'new_item'           => __( 'New Company', 'pronamic_companies' ),
				'view_item'          => __( 'View Company', 'pronamic_companies' ),
				'search_items'       => __( 'Search Companies', 'pronamic_companies' ),
				'not_found'          => __( 'No companies found', 'pronamic_companies' ),
				'not_found_in_trash' => __( 'No companies found in Trash', 'pronamic_companies' ),
				'parent_item_colon'  => __( 'Parent Company:', 'pronamic_companies' ),
				'menu_name'          => __( 'Companies', 'pronamic_companies' ),
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'rewrite'            => array( 'slug' => $slug ),
			'menu_icon'          => 'dashicons-building',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'pronamic_company' ),
		) );

		pronamic_companies_create_taxonomies();

		// Actions
		add_action( 'save_post', array( $this, 'save_post_company_google_maps' ), 50, 2 );
	}

	//////////////////////////////////////////////////

	/**
	 * Activate
	 */
	public function activate() {
		// Flush rewrite rules on activation
		// @see http://wpengineer.com/2044/custom-post-type-and-permalink/
		add_action( 'init', 'flush_rewrite_rules', 20 );
	}

	/**
	 * Activate
	 */
	public function deactivate() {
		// Flush rewrite rules on activation
		// @see http://wpengineer.com/2044/custom-post-type-and-permalink/
		add_action( 'init', 'flush_rewrite_rules', 20 );
	}

	/**
	 * Posts 2 Posts initialize
	 */
	public function p2p_init() {
		p2p_register_connection_type( array(
			'name' => 'posts_to_pronamic_companies',
			'from' => 'post',
			'to'   => 'pronamic_company',
		) );

		// Let's do some voodoo
		//
		// When post metdata with the meta key '_pronamic_company_id' is used we catch it and
		// prefent it from adding, we'll use the Post 2 Posts plugin to connect
		//
		// @see http://core.trac.wordpress.org/browser/tags/3.4.2/wp-includes/meta.php#L50
		add_action( 'add_post_metadata', array( $this, 'add_post_metadata_p2p_connect' ), 10, 4 );
	}

	/**
	 * Added post meta connect
	 *
	 * @param string $mid
	 * @param string $object_id
	 * @param string $meta_key
	 * @param string $meta_value
	 */
	public function add_post_metadata_p2p_connect( $mid, $object_id, $meta_key, $meta_value ) {
		if ( '_pronamic_company_id' === $meta_key ) {
			// @see https://github.com/scribu/wp-posts-to-posts/blob/1.4.2/core/type-factory.php#L77
			$p2p_type = p2p_type( 'posts_to_pronamic_companies' );

			if ( $p2p_type ) {
				// @see https://github.com/scribu/wp-posts-to-posts/blob/1.4.2/core/directed-type.php#L184
				$p2p_id = $p2p_type->connect( $object_id, $meta_value );

				if ( ! is_wp_error( $p2p_id ) ) {
					// @see http://core.trac.wordpress.org/browser/tags/3.4.2/wp-includes/meta.php#L50
					// return somehting else as null will prefent adding post metadata
					return false;
				}
			}
		}
	}

	/**
	 * Save post company Google Maps
	 *
	 * @param string $post_id
	 */
	public function save_post_company_google_maps( $post_id, $post ) {
		// Doing autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check post type
		if ( 'pronamic_company' !== get_post_type( $post ) ) {
			return;
		}

		// Revision
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		// OK
		$address  = '';

		$address .= pronamic_company_get_address( $post_id ) . "\r\n";
		$address .= pronamic_company_get_postal_code( $post_id ) . ' ' . pronamic_company_get_city( $post_id );

		update_post_meta( $post_id, '_pronamic_google_maps_address', $address );
	}

	/**
	 * Is company archive
	 */
	public function is_company_archive( $query ) {
		return (
			$query->is_post_type_archive( 'pronamic_company' )
				||
			$query->is_tax( 'pronamic_company_category' )
				||
			$query->is_tax( 'pronamic_company_character' )
				||
			$query->is_tax( 'pronamic_company_region' )
				||
			$query->is_tax( 'pronamic_company_keyword' )
				||
			$query->is_tax( 'pronamic_company_brand' )
				||
			$query->is_tax( 'pronamic_company_type' )
		);
	}

	/**
	 * Pre get posts
	 *
	 * @param WP_Query $query
	 */
	public function pre_get_posts( $query ) {
		if ( $this->is_company_archive( $query ) ) {
			// Posts per page
			$posts_per_page = get_option( 'pronamic_companies_posts_per_page' );

			if ( ! empty( $posts_per_page ) ) {
				$query->set( 'posts_per_page', $posts_per_page );
			}

			// Order by
			$orderby = get_option( 'pronamic_companies_orderby' );

			if ( ! empty( $orderby ) ) {
				$query->set( 'orderby', $orderby );
			}

			// Order
			$order = get_option( 'pronamic_companies_order' );

			if ( ! empty( $order ) ) {
				$query->set( 'order', $order );
			}
		}
	}
}
