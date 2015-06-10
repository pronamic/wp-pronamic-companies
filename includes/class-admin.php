<?php

class Pronamic_Companies_Plugin_Admin {
	public $plugin;

	//////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;

		// Actions
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		// Settings
		$this->settings = new Pronamic_Companies_Plugin_Settings( $plugin );
	}

	//////////////////////////////////////////////////

	/**
	 * Admin initialize
	 */
	public function admin_init() {
		// Actions
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'save_post', array( $this, 'save_post_company_details' ),       50, 2 );
		add_action( 'save_post', array( $this, 'save_post_title_index_automatic' ), 50, 2 );

		add_action( 'manage_posts_custom_column', array( $this, 'custom_column' ), 10, 2 );

		// Filters
		add_filter( 'manage_edit-pronamic_company_columns' ,  array( $this, 'company_columns' ) );

		// Maybe update
		$this->maybe_update();

		// Maybe export
		$this->maybe_export();
	}

	//////////////////////////////////////////////////

	/**
	 * Admin menu
	 */
	public function admin_menu() {
		add_submenu_page(
			'edit.php?post_type=pronamic_company', // parent_slug
			__( 'Companies Export', 'pronamic_companies' ), // page_title
			__( 'Export', 'pronamic_companies' ), // menu_title
			'read', // capability
			'pronamic_companies_export', // menu_slug
			array( $this, 'page_export' ) // function
		);

		add_submenu_page(
			'edit.php?post_type=pronamic_company', // parent_slug
			__( 'Companies Settings', 'pronamic_companies' ), // page_title
			__( 'Settings', 'pronamic_companies' ), // menu_title
			'read', // capability
			'pronamic_companies_settings', // menu_slug
			array( $this, 'page_settings' ) // function
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Enqueue scripts
	 *
	 * @param string $hook
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();

		if ( 'pronamic_company' === $screen->id ) {
			wp_enqueue_style( 'pronamic_companies', plugins_url( '/admin/css/admin.css', $this->plugin->file ) );
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Add meta boxes
	 */
	public function add_meta_boxes() {
		$post_types = get_post_types( '', 'names' );

		foreach ( $post_types as $post_type ) {
			if ( post_type_supports( $post_type, 'pronamic_company' ) ) {
				add_meta_box(
					'pronamic_companies_meta_box', // id
					__( 'Company Details', 'pronamic_companies' ), // title
					array( $this, 'meta_box_company_details' ), // callback
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
	public function meta_box_company_details( $post ) {
		include $this->plugin->dir_path . 'admin/meta-box.php';
	}

	//////////////////////////////////////////////////

	/**
	 * Save post character term
	 *
	 * @param string $post_id
	 * @param stdClass $post
	 */
	public function save_post_title_index_automatic( $post_id, $post ) {
		if ( is_object_in_taxonomy( $post->post_type, 'pronamic_company_character' ) ) {
			$character = strtoupper( substr( $post->post_title, 0, 1 ) );

			$result = wp_set_object_terms( $post_id, $character, 'pronamic_company_character', false );
		}
	}

	/**
	 * Save metaboxes
	 */
	public function save_post_company_details( $post_id, $post ) {
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
	public function company_columns( $columns ) {
		$columns['pronamic_company_address'] = __( 'Address', 'pronamic_companies' );

		$columns_new = array();

		foreach ( $columns as $name => $label ) {
			$columns_new[ $name ] = $label;

			if ( 'title' === $name ) {
				$columns_new['pronamic_company_address']           = $columns['pronamic_company_address'];
				$columns_new['taxonomy-pronamic_company_category'] = $columns['pronamic_company_category'];
			}
		}

		return $columns_new;
	}

	public function custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'pronamic_company_address' :
				echo esc_html( get_post_meta( $post_id, '_pronamic_company_address', true ) ), '<br />';
				echo esc_html( get_post_meta( $post_id, '_pronamic_company_postal_code', true ) . ' ' . get_post_meta( $post_id, '_pronamic_company_city', true ) );

				break;
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Get export
	 */
	public function get_export() {
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
	 * Maybe update
	 */
	public function maybe_update() {
		if ( get_option( 'pronamic_companies_version' ) !== $this->plugin->version ) {
			require_once $this->plugin->dir_path . 'admin/includes/upgrade.php';

			$current = get_option( 'pronamic_companies_version' );

			if ( empty( $current ) ) {
				pronamic_companies_upgrade_110();
			}

			update_option( 'pronamic_companies_version', $this->plugin->version );
		}
	}

	/**
	 * Maybe export to CSV
	 */
	public function maybe_export() {
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
		$results = $this->get_export();

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
	 * Page export
	 */
	public function page_export() {
		include $this->plugin->dir_path . 'admin/export.php';
	}

	/**
	 * Page settings
	 */
	public function page_settings() {
		include $this->plugin->dir_path . 'admin/settings.php';
	}
}
