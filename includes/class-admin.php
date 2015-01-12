<?php

class Pronamic_Companies_Plugin_Admin {
	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
	}

	//////////////////////////////////////////////////

	/**
	 * Admin initialize
	 */
	public static function admin_init() {
		// Actions
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );

		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );

		add_action( 'save_post', array( __CLASS__, 'save_post_company_details' ),       50, 2 );
		add_action( 'save_post', array( __CLASS__, 'save_post_title_index_automatic' ), 50, 2 );

		add_action( 'manage_posts_custom_column', array( __CLASS__, 'custom_column' ), 10, 2 );

		// Filters
		add_filter( 'manage_edit-pronamic_company_columns' ,  array( __CLASS__, 'company_columns' ) );

		// Export
		self::maybe_export();

		// Taxonomies
		$taxonomies = get_option( 'pronamic_companies_taxonomies' );
		$taxonomies = is_array( $taxonomies ) ? $taxonomies : array();

		// Settings - General
		add_settings_section(
		'pronamic_companies_read', // id
		__( 'Read', 'pronamic_companies' ), // title
		array( __CLASS__, 'settings_section' ), // callback
		'pronamic_companies_general' // page
		);

		add_settings_field(
		'pronamic_companies_posts_per_page', // id
		__( 'Company pages show at most', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_text' ),  // callback
		'pronamic_companies_general', // page
		'pronamic_companies_read', // section
		array( 'label_for' => 'pronamic_companies_posts_per_page' ) // args
		);

		add_settings_field(
		'pronamic_companies_orderby', // id
		__( 'Company pages order by', 'pronamic_companies' ), // title
		array( __CLASS__, 'select_orderby' ),  // callback
		'pronamic_companies_general', // page
		'pronamic_companies_read', // section
		array( 'label_for' => 'pronamic_companies_orderby' ) // args
		);

		add_settings_field(
		'pronamic_companies_order', // id
		__( 'Company pages order', 'pronamic_companies' ), // title
		array( __CLASS__, 'select_order' ),  // callback
		'pronamic_companies_general', // page
		'pronamic_companies_read', // section
		array( 'label_for' => 'pronamic_companies_order' ) // args
		);

		// Settings - Other
		add_settings_section(
		'pronamic_companies_taxonomies', // id
		__( 'Taxonomies', 'pronamic_companies' ), // title
		array( __CLASS__, 'settings_section' ), // callback
		'pronamic_companies_general' // page
		);

		add_settings_field(
		'pronamic_companies_taxonomies', // id
		__( 'Taxonomies', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_taxonomies' ),  // callback
		'pronamic_companies_general', // page
		'pronamic_companies_taxonomies', // section
		array( 'label_for' => 'pronamic_companies_taxonomies' ) // args
		);

		// Settings - Pages
		add_settings_section(
		'pronamic_companies_pages', // id
		__( 'Pages', 'pronamic_companies' ), // title
		array( __CLASS__, 'settings_section' ), // callback
		'pronamic_companies_pages' // page
		);

		add_settings_field(
		'pronamic_companies_register_page_id', // id
		__( 'Company Register Page', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_page' ),  // callback
		'pronamic_companies_pages', // page
		'pronamic_companies_pages', // section
		array( 'label_for' => 'pronamic_companies_register_page_id' ) // args
		);

		add_settings_field(
		'pronamic_companies_upgrade_page_id', // id
		__( 'Company Upgrade Page', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_page' ),  // callback
		'pronamic_companies_pages', // page
		'pronamic_companies_pages', // section
		array( 'label_for' => 'pronamic_companies_upgrade_page_id' ) // args
		);

		add_settings_field(
		'pronamic_companies_downgrade_page_id', // id
		__( 'Company Downgrade Page', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_page' ),  // callback
		'pronamic_companies_pages', // page
		'pronamic_companies_pages', // section
		array( 'label_for' => 'pronamic_companies_downgrade_page_id' ) // args
		);

		add_settings_field(
		'pronamic_companies_edit_page_id', // id
		__( 'Company Edit Page', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_page' ),  // callback
		'pronamic_companies_pages', // page
		'pronamic_companies_pages', // section
		array( 'label_for' => 'pronamic_companies_edit_page_id' ) // args
		);

		add_settings_field(
		'pronamic_companies_new_post_page_id', // id
		__( 'Company New Post Page', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_page' ),  // callback
		'pronamic_companies_pages', // page
		'pronamic_companies_pages', // section
		array( 'label_for' => 'pronamic_companies_new_post_page_id' ) // args
		);

		if ( in_array( 'pronamic_company_keyword', $taxonomies ) ) {
			register_setting( 'pronamic_companies_pages', 'pronamic_companies_keywords_page_id' );

			add_settings_field(
			'pronamic_companies_keywords_page_id', // id
			__( 'Company Keywords Page', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_keywords_page_id' ) // args
			);
		}

		if ( in_array( 'pronamic_company_brand', $taxonomies ) ) {
			register_setting( 'pronamic_companies_pages', 'pronamic_companies_brands_page_id' );

			add_settings_field(
			'pronamic_companies_brands_page_id', // id
			__( 'Company Brands Page', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_brands_page_id' ) // args
			);
		}

		// Permalinks
		// Un we can't add the permalink options to permalink settings page
		// @see http://core.trac.wordpress.org/ticket/9296
		add_settings_section(
		'pronamic_companies_permalinks', // id
		__( 'Permalinks', 'pronamic_companies' ), // title
		array( __CLASS__, 'settings_section' ), // callback
		'pronamic_companies_permalinks' // page
		);

		register_setting( 'pronamic_companies_permalinks', 'pronamic_company_base' );

		add_settings_field(
		'pronamic_company_base', // id
		__( 'Company base', 'pronamic_companies' ), // title
		array( __CLASS__, 'input_text' ),  // callback
		'pronamic_companies_permalinks', // page
		'pronamic_companies_permalinks', // section
		array( 'label_for' => 'pronamic_company_base' ) // args
		);

		if ( in_array( 'pronamic_company_category', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_category_base' );

			add_settings_field(
			'pronamic_company_category_base', // id
			__( 'Category base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_category_base' ) // args
			);
		}

		if ( in_array( 'pronamic_company_character', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_character_base' );

			add_settings_field(
			'pronamic_company_character_base', // id
			__( 'Character base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_character_base' ) // args
			);
		}

		if ( in_array( 'pronamic_company_region', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_region_base' );

			add_settings_field(
			'pronamic_company_region_base', // id
			__( 'Region base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_region_base' ) // args
			);
		}

		if ( in_array( 'pronamic_company_keyword', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_keyword_base' );

			add_settings_field(
			'pronamic_company_keyword_base', // id
			__( 'Keyword base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_keyword_base' ) // args
			);
		}

		if ( in_array( 'pronamic_company_brand', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_brand_base' );

			add_settings_field(
			'pronamic_company_brand_base', // id
			__( 'Brand base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_brand_base' ) // args
			);
		}

		if ( in_array( 'pronamic_company_type', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_type_base' );

			add_settings_field(
			'pronamic_company_type_base', // id
			__( 'Type base', 'pronamic_companies' ), // title
			array( __CLASS__, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_type_base' ) // args
			);
		}

		// Register settings
		register_setting( 'pronamic_companies_general', 'pronamic_companies_posts_per_page' );
		register_setting( 'pronamic_companies_general', 'pronamic_companies_orderby' );
		register_setting( 'pronamic_companies_general', 'pronamic_companies_order' );

		register_setting( 'pronamic_companies_general', 'pronamic_companies_taxonomies' );

		register_setting( 'pronamic_companies_pages', 'pronamic_companies_register_page_id' );
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_upgrade_page_id' );
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_downgrade_page_id' );
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_edit_page_id' );
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_new_post_page_id' );
	}

	//////////////////////////////////////////////////

	/**
	 * Admin menu
	 */
	public static function admin_menu() {
		add_submenu_page(
		'edit.php?post_type=pronamic_company', // parent_slug
		__( 'Companies Export', 'pronamic_companies' ), // page_title
		__( 'Export', 'pronamic_companies' ), // menu_title
		'read', // capability
		'pronamic_companies_export', // menu_slug
		array( __CLASS__, 'page_export' ) // function
		);

		add_submenu_page(
		'edit.php?post_type=pronamic_company', // parent_slug
		__( 'Companies Settings', 'pronamic_companies' ), // page_title
		__( 'Settings', 'pronamic_companies' ), // menu_title
		'read', // capability
		'pronamic_companies_settings', // menu_slug
		array( __CLASS__, 'page_settings' ) // function
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Enqueue scripts
	 *
	 * @param string $hook
	 */
	public static function enqueue_scripts( $hook_suffix ) {
		$screen = get_current_screen();

		if ( 'pronamic_company' == $screen->id ) {
			wp_enqueue_style( 'pronamic_companies', plugins_url( '/admin/css/admin.css', Pronamic_Companies_Plugin::$file ) );
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Add meta boxes
	 */
	public static function add_meta_boxes() {
		$post_types = get_post_types( '', 'names' );

		foreach ( $post_types as $post_type ) {
			if ( post_type_supports( $post_type, 'pronamic_company' ) ) {
				add_meta_box(
				'pronamic_companies_meta_box', // id
				__( 'Company Details', 'pronamic_companies' ), // title
				array( __CLASS__, 'meta_box_company_details' ), // callback
				$post_type, // post_type
				'normal', // context
				'high' // priority
				);
			}
		}
	}

	/**
	 * Meta box company details
	 *
	 * @param stdClass $post
	 */
	public static function meta_box_company_details( $post ) {
		include 'admin/meta-box.php';
	}

	//////////////////////////////////////////////////

	/**
	 * Save post character term
	 *
	 * @param string $post_id
	 * @param stdClass $post
	 */
	public static function save_post_title_index_automatic( $post_id, $post ) {
		if ( is_object_in_taxonomy( $post->post_type, 'pronamic_company_character' ) ) {
			$character = strtoupper( substr( $post->post_title, 0, 1 ) );

			$result = wp_set_object_terms( $post_id, $character, 'pronamic_company_character', false );
		}
	}

	/**
	 * Save metaboxes
	 */
	public static function save_post_company_details( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['pronamic_companies_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['pronamic_companies_nonce'], 'pronamic_companies_save_post' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return;
		}

		// Save data
		$data = filter_input_array( INPUT_POST, array(
				'_pronamic_company_contact'             => FILTER_SANITIZE_STRING,
				// Visiting Address
				'_pronamic_company_address'             => FILTER_SANITIZE_STRING,
				'_pronamic_company_postal_code'         => FILTER_SANITIZE_STRING,
				'_pronamic_company_city'                => FILTER_SANITIZE_STRING,
				'_pronamic_company_country'             => FILTER_SANITIZE_STRING,
				// Mailing Address
				'_pronamic_company_mailing_address'     => FILTER_SANITIZE_STRING,
				'_pronamic_company_mailing_postal_code' => FILTER_SANITIZE_STRING,
				'_pronamic_company_mailing_city'        => FILTER_SANITIZE_STRING,
				'_pronamic_company_mailing_country'     => FILTER_SANITIZE_STRING,
				// Chamber of Commerce and Tax information
				'_pronamic_company_kvk_establishment'   => FILTER_SANITIZE_STRING,
				'_pronamic_company_kvk_number'          => FILTER_SANITIZE_STRING,
				'_pronamic_company_tax_number'          => FILTER_SNAITIZE_STRING,
				// Phone
				'_pronamic_company_phone_number'        => FILTER_SANITIZE_STRING,
				'_pronamic_company_fax_number'          => FILTER_SANITIZE_STRING,
				// Online
				'_pronamic_company_email'               => FILTER_SANITIZE_STRING,
				'_pronamic_company_website'             => FILTER_SANITIZE_STRING,
				'_pronamic_company_rss'                 => FILTER_SANITIZE_STRING,
				'_pronamic_company_video'               => FILTER_SANITIZE_STRING,
				// Social Networks
				'_pronamic_company_twitter'             => FILTER_SANITIZE_STRING,
				'_pronamic_company_facebook'            => FILTER_SANITIZE_STRING,
				'_pronamic_company_linkedin'            => FILTER_SANITIZE_STRING,
				'_pronamic_company_google_plus'         => FILTER_SANITIZE_STRING,
		) );

		foreach ( $data as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	/**
	 * Columns
	 *
	 * @param array $columns
	 */
	public static function company_columns( $columns ) {
		$new_columns = array();

		if ( isset( $columns['cb'] ) ) {
			$new_columns['cb'] = $columns['cb'];
		}

		// $new_columns['thumbnail'] = __('Thumbnail', 'pronamic_companies');

		if ( isset( $columns['title'] ) ) {
			$new_columns['title'] = __( 'Company', 'pronamic_companies' );
		}

		if ( isset( $columns['author'] ) ) {
			$new_columns['author'] = $columns['author'];
		}

		$new_columns['pronamic_company_address'] = __( 'Address', 'pronamic_companies' );

		$new_columns['pronamic_company_categories'] = __( 'Categories', 'pronamic_companies' );

		if ( isset( $columns['comments'] ) ) {
			$new_columns['comments'] = $columns['comments'];
		}

		if ( isset( $columns['date'] ) ) {
			$new_columns['date'] = $columns['date'];
		}

		return $new_columns;
	}

	public static function custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'pronamic_company_address' :
				echo esc_html( get_post_meta( $post_id, '_pronamic_company_address', true ) ), '<br />';
				echo esc_html( get_post_meta( $post_id, '_pronamic_company_postal_code', true ) . ' ' . get_post_meta( $post_id, '_pronamic_company_city', true ) );

				break;
			case 'pronamic_company_categories' :
				$terms = get_the_term_list( $post_id, 'pronamic_company_category' , '' , ', ' , '' );

				if ( is_string( $terms ) ) {
					echo esc_html( $terms );
				} else {
					echo esc_html__( 'No Category', 'pronamic_companies' );
				}

				break;
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Settings section
	 */
	public static function settings_section() {

	}

	/**
	 * Input text
	 *
	 * @param array $args
	 */
	public static function input_text( $args ) {
		printf(
		'<input name="%s" id="%s" type="text" value="%s" class="%s" />',
		esc_attr( $args['label_for'] ),
		esc_attr( $args['label_for'] ),
		esc_attr( get_option( $args['label_for'] ) ),
		'regular-text code'
				);
	}

	/**
	 * Input page
	 *
	 * @param array $args
	 */
	public static function input_page( $args ) {
		$name = $args['label_for'];

		wp_dropdown_pages( array(
		'name'             => $name,
		'selected'         => get_option( $name, '' ),
		'show_option_none' => __( '&mdash; Select a page &mdash;', 'pronamic_companies' )
		) );
	}

	/**
	 * Select orderby
	 *
	 * @param array $args
	 */
	public static function select_orderby( $args ) {
		$name = $args['label_for'];

		$current = get_option( $name );

		$orderbys = array(
				''         => __( '&mdash; Select Order By &mdash;', 'pronamic_companies' ),
				'none'     => __( 'None', 'pronamic_companies' ),
				'ID'       => __( 'ID', 'pronamic_companies' ),
				'author'   => __( 'Author', 'pronamic_companies' ),
				'title'    => __( 'Title', 'pronamic_companies' ),
				'name'     => __( 'Name', 'pronamic_companies' ),
				'date'     => __( 'Date', 'pronamic_companies' ),
				'modified' => __( 'Modified', 'pronamic_companies' ),
				'rand'     => __( 'Random', 'pronamic_companies' ),
		);

		printf( '<select name="%s" id="%s">', esc_attr( $name ), esc_attr( $name ) );
		foreach ( $orderbys as $orderby => $label ) {
			printf(
			'<option value="%s" %s>%s</option>',
			esc_attr( $orderby ),
			selected( $orderby, $current, false ),
			esc_html( $label )
			);
		}
		printf( '</select>' );
	}

	/**
	 * Input order
	 *
	 * @param array $args
	 */
	public static function select_order( $args ) {
		$name = $args['label_for'];

		$current = get_option( $name );

		$orders = array(
				''     => __( '&mdash; Select Order &mdash;', 'pronamic_companies' ),
				'DESC' => __( 'Descending', 'pronamic_companies' ),
				'ASC'  => __( 'Ascending', 'pronamic_companies' ),
		);

		printf( '<select name="%s" id="%s">', esc_attr( $name ), esc_attr( $name ) );
		foreach ( $orders as $order => $label ) {
			printf(
			'<option value="%s" %s>%s</option>',
			esc_attr( $order ),
			selected( $order, $current, false ),
			esc_html( $label )
			);
		}
		printf( '</select>' );
	}

	public static function input_taxonomies( $args ) {
		$name = $args['label_for'];

		$current = get_option( $name );
		$current = is_array( $current ) ? $current : array();

		$taxonomies = array(
				'pronamic_company_category'  => __( 'Categories', 'pronamic_companies' ),
				'pronamic_company_character' => __( 'Characters', 'pronamic_companies' ),
				'pronamic_company_region'    => __( 'Regions', 'pronamic_companies' ),
				'pronamic_company_keyword'   => __( 'Keywords', 'pronamic_companies' ),
				'pronamic_company_brand'     => __( 'Brands', 'pronamic_companies' ),
				'pronamic_company_type'      => __( 'Types', 'pronamic_companies' ),
		);

		$inputs = array();
		foreach ( $taxonomies as $taxonomy => $label ) {
			$inputs[] = sprintf(
					'<label for="%s">%s %s</label>',
					esc_attr( $taxonomy ),
					sprintf(
							'<input name="%s[]" type="checkbox" id="%s" value="%s" %s>',
							esc_attr( $name ),
							esc_attr( $taxonomy ),
							esc_attr( $taxonomy ),
							checked( true, in_array( $taxonomy, $current ), false )
					),
					$label
			);
		}

		printf(
		'<fieldset>%s %s</fieldset>',
		sprintf( '<legend class="screen-reader-text"><span>%s</span></legend>', __( 'Taxonomies', 'pronamic_companies' ) ),
		implode( '<br />', $inputs )
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Get export
	 */
	public static function get_export() {
		global $wpdb;

		$results = $wpdb->get_results( "
				SELECT
				post.ID,
				post.post_title,

				MAX( IF( meta.meta_key = '_pronamic_company_address', meta.meta_value, NULL ) ) AS company_address,
				MAX( IF( meta.meta_key = '_pronamic_company_postal_code', meta.meta_value, NULL ) ) AS company_postal_code,
				MAX( IF( meta.meta_key = '_pronamic_company_city', meta.meta_value, NULL ) ) AS company_city,
				MAX( IF( meta.meta_key = '_pronamic_company_country', meta.meta_value, NULL ) ) AS company_country,
				MAX( IF( meta.meta_key = '_pronamic_company_kvk_establishment', meta.meta_value, NULL ) ) AS kvk_establishment,
				MAX( IF( meta.meta_key = '_pronamic_company_kvk_number', meta.meta_value, NULL ) ) AS kvk_number,
				MAX( IF( meta.meta_key = '_pronamic_company_tax_number', meta.meta_value, NULL ) ) AS tax_number,

				MAX( IF( meta.meta_key = '_pronamic_company_mailing_address', meta.meta_value, NULL ) ) AS company_mailing_address,
				MAX( IF( meta.meta_key = '_pronamic_company_mailing_postal_code', meta.meta_value, NULL ) ) AS company_mailing_postal_code,
				MAX( IF( meta.meta_key = '_pronamic_company_mailing_city', meta.meta_value, NULL ) ) AS company_mailing_city,
				MAX( IF( meta.meta_key = '_pronamic_company_mailing_country', meta.meta_value, NULL ) ) AS company_mailing_country,

				MAX( IF( meta.meta_key = '_pronamic_company_phone_number', meta.meta_value, NULL ) ) AS company_phone_number,
				MAX( IF( meta.meta_key = '_pronamic_company_fax_number', meta.meta_value, NULL ) ) AS company_fax_number,

				MAX( IF( meta.meta_key = '_pronamic_company_email', meta.meta_value, NULL ) ) AS company_email,
				MAX( IF( meta.meta_key = '_pronamic_company_website', meta.meta_value, NULL ) ) AS company_website,

				MAX( IF( meta.meta_key = '_pronamic_subscription_id', meta.meta_value, NULL ) ) AS company_subscription_id,

				MAX( IF( meta.meta_key = '_pronamic_company_contact', meta.meta_value, NULL ) ) AS company_contact,

				user.user_login,
				user.user_email
				FROM
				$wpdb->posts AS post
				LEFT JOIN
				$wpdb->postmeta AS meta
				ON post.ID = meta.post_id
				LEFT JOIN
				$wpdb->users AS user
				ON post.post_author = user.ID
				WHERE
				post_type = 'pronamic_company'
				AND
				post_status IN ( 'publish', 'pending', 'draft', 'future' )
				GROUP BY
				post.ID
				;
				" );

		return $results;
	}

	/**
	 * Export to CSV
	 */
	public static function maybe_export() {
		if ( empty( $_POST ) || ! wp_verify_nonce( filter_input( INPUT_POST, 'pronamic_companies_nonce', FILTER_SANITIZE_STRING ), 'pronamic_companies_export' ) ) {
			return;
		}

		// Set headers for download
		$filename = sprintf(
				__( 'pronamic-companies-export-%s.csv', 'pronamic_companies' ),
				date( 'Y-m-d_H-i' )
		);

		header( 'Content-Encoding: ' . get_bloginfo( 'charset' ) );
		header( 'Content-Type: text/csv; charset=' . get_bloginfo( 'charset' ) );
		header( 'Content-Disposition: attachment; filename=' . $filename );

		// Results
		$results = self::get_export();

		$data = array();

		$resource = fopen( 'php://output', 'w' );

		// Header
		$header = array(
				__( 'ID', 'pronamic_companies' ),
				__( 'Name', 'pronamic_companies' ),
				__( 'Address', 'pronamic_companies' ),
				__( 'Postal Code', 'pronamic_companies' ),
				__( 'City', 'pronamic_companies' ),
				__( 'Country', 'pronamic_companies' ),
				__( 'Address', 'pronamic_companies' ),
				__( 'Postal Code', 'pronamic_companies' ),
				__( 'City', 'pronamic_companies' ),
				__( 'Country', 'pronamic_companies' ),
				__( 'Subscription ID', 'pronamic_companies' ),
				__( 'User Login', 'pronamic_companies' ),
				__( 'User E-mail', 'pronamic_companies' ),
				__( 'Contact', 'pronamic_companies' ),
				__( 'E-mail', 'pronamic_companies' ),
				__( 'Categories', 'pronamic_companies' ),
		);

		fputcsv( $resource, $header );

		foreach ( $results as $result ) {
			$categories = array();

			$terms = get_the_terms( $result->ID, 'pronamic_company_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$categories[] = $term->parent . ',' . $term->name;
				}
			}

			// Row
			$row = array(
					$result->ID,
					$result->post_title,
					$result->company_address,
					$result->company_postal_code,
					$result->company_city,
					$result->company_country,
					$result->company_mailing_address,
					$result->company_mailing_postal_code,
					$result->company_mailing_city,
					$result->company_mailing_country,
					$result->company_subscription_id,
					$result->user_login,
					$result->user_email,
					$result->company_contact,
					$result->company_email,
					implode( "\r\n", $categories ),
			);

			fputcsv( $resource, $row );
		}

		exit;
	}

	//////////////////////////////////////////////////

	/**
	 * Admin include file
	 *
	 * @param string $file
	 */
	public static function include_file( $file ) {
		include Pronamic_Companies_Plugin::$dirname . '/admin/' . $file;
	}

	//////////////////////////////////////////////////

	/**
	 * Page export
	 */
	function page_export() {
		include 'admin/export.php';
	}

	/**
	 * Page settings
	 */
	function page_settings() {
		include 'admin/settings.php';
	}
}
