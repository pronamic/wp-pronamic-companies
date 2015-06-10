<?php

class Pronamic_Companies_Plugin_Settings {
	public $plugin;

	//////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;

		// Actions
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	//////////////////////////////////////////////////

	/**
	 * Admin initialize
	 */
	public function admin_init() {
		// Taxonomies
		$taxonomies = get_option( 'pronamic_companies_taxonomies' );
		$taxonomies = is_array( $taxonomies ) ? $taxonomies : array();

		// Settings - General
		add_settings_section(
			'pronamic_companies_read', // id
			__( 'Read', 'pronamic_companies' ), // title
			array( $this, 'settings_section' ), // callback
			'pronamic_companies_general' // page
		);

		// Posts per page
		register_setting( 'pronamic_companies_general', 'pronamic_companies_posts_per_page' );

		add_settings_field(
			'pronamic_companies_posts_per_page', // id
			__( 'Company pages show at most', 'pronamic_companies' ), // title
			array( $this, 'input_posts_per_page' ),  // callback
			'pronamic_companies_general', // page
			'pronamic_companies_read', // section
			array( 'label_for' => 'pronamic_companies_posts_per_page' ) // args
		);

		// Order by
		register_setting( 'pronamic_companies_general', 'pronamic_companies_orderby' );

		add_settings_field(
			'pronamic_companies_orderby', // id
			__( 'Company pages order by', 'pronamic_companies' ), // title
			array( $this, 'select_orderby' ),  // callback
			'pronamic_companies_general', // page
			'pronamic_companies_read', // section
			array( 'label_for' => 'pronamic_companies_orderby' ) // args
		);

		// Order
		register_setting( 'pronamic_companies_general', 'pronamic_companies_order' );

		add_settings_field(
			'pronamic_companies_order', // id
			__( 'Company pages order', 'pronamic_companies' ), // title
			array( $this, 'select_order' ),  // callback
			'pronamic_companies_general', // page
			'pronamic_companies_read', // section
			array( 'label_for' => 'pronamic_companies_order' ) // args
		);

		// Settings - Other
		add_settings_section(
			'pronamic_companies_taxonomies', // id
			__( 'Taxonomies', 'pronamic_companies' ), // title
			array( $this, 'settings_section' ), // callback
			'pronamic_companies_general' // page
		);

		register_setting( 'pronamic_companies_general', 'pronamic_companies_taxonomies' );

		add_settings_field(
			'pronamic_companies_taxonomies', // id
			__( 'Taxonomies', 'pronamic_companies' ), // title
			array( $this, 'input_taxonomies' ),  // callback
			'pronamic_companies_general', // page
			'pronamic_companies_taxonomies', // section
			array( 'label_for' => 'pronamic_companies_taxonomies' ) // args
		);

		// Settings - Pages
		add_settings_section(
			'pronamic_companies_pages', // id
			__( 'Pages', 'pronamic_companies' ), // title
			array( $this, 'settings_section' ), // callback
			'pronamic_companies_pages' // page
		);

		// Company Register Page
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_register_page_id' );

		add_settings_field(
			'pronamic_companies_register_page_id', // id
			__( 'Company Register Page', 'pronamic_companies' ), // title
			array( $this, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_register_page_id' ) // args
		);

		// Company Upgrade Page
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_upgrade_page_id' );

		add_settings_field(
			'pronamic_companies_upgrade_page_id', // id
			__( 'Company Upgrade Page', 'pronamic_companies' ), // title
			array( $this, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_upgrade_page_id' ) // args
		);

		// Company Downgrade Page
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_downgrade_page_id' );

		add_settings_field(
			'pronamic_companies_downgrade_page_id', // id
			__( 'Company Downgrade Page', 'pronamic_companies' ), // title
			array( $this, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_downgrade_page_id' ) // args
		);

		// Company Edit Page
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_edit_page_id' );

		add_settings_field(
			'pronamic_companies_edit_page_id', // id
			__( 'Company Edit Page', 'pronamic_companies' ), // title
			array( $this, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_edit_page_id' ) // args
		);

		// Company New Post Page
		register_setting( 'pronamic_companies_pages', 'pronamic_companies_new_post_page_id' );

		add_settings_field(
			'pronamic_companies_new_post_page_id', // id
			__( 'Company New Post Page', 'pronamic_companies' ), // title
			array( $this, 'input_page' ),  // callback
			'pronamic_companies_pages', // page
			'pronamic_companies_pages', // section
			array( 'label_for' => 'pronamic_companies_new_post_page_id' ) // args
		);

		if ( in_array( 'pronamic_company_keyword', $taxonomies ) ) {
			register_setting( 'pronamic_companies_pages', 'pronamic_companies_keywords_page_id' );

			add_settings_field(
				'pronamic_companies_keywords_page_id', // id
				__( 'Company Keywords Page', 'pronamic_companies' ), // title
				array( $this, 'input_page' ),  // callback
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
				array( $this, 'input_page' ),  // callback
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
			array( $this, 'settings_section' ), // callback
			'pronamic_companies_permalinks' // page
		);

		register_setting( 'pronamic_companies_permalinks', 'pronamic_company_base' );

		add_settings_field(
			'pronamic_company_base', // id
			__( 'Company base', 'pronamic_companies' ), // title
			array( $this, 'input_text' ),  // callback
			'pronamic_companies_permalinks', // page
			'pronamic_companies_permalinks', // section
			array( 'label_for' => 'pronamic_company_base' ) // args
		);

		if ( in_array( 'pronamic_company_category', $taxonomies ) ) {
			register_setting( 'pronamic_companies_permalinks', 'pronamic_company_category_base' );

			add_settings_field(
				'pronamic_company_category_base', // id
				__( 'Category base', 'pronamic_companies' ), // title
				array( $this, 'input_text' ),  // callback
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
				array( $this, 'input_text' ),  // callback
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
				array( $this, 'input_text' ),  // callback
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
				array( $this, 'input_text' ),  // callback
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
				array( $this, 'input_text' ),  // callback
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
				array( $this, 'input_text' ),  // callback
				'pronamic_companies_permalinks', // page
				'pronamic_companies_permalinks', // section
				array( 'label_for' => 'pronamic_company_type_base' ) // args
			);
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Settings section
	 */
	public function settings_section() {

	}

	/**
	 * Input text
	 *
	 * @param array $args
	 */
	public function input_text( $args ) {
		printf(
			'<input name="%s" id="%s" type="text" value="%s" class="%s" />',
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			esc_attr( get_option( $args['label_for'] ) ),
			'regular-text code'
		);
	}

	/**
	 * Input posts per page
	 *
	 * @param array $args
	 */
	public function input_posts_per_page( $args ) {
		printf(
			'<input name="%s" type="number" step="1" min="1" id="%s" value="%s" class="small-text"> %s',
			esc_attr( $args['label_for'] ),
			esc_attr( $args['label_for'] ),
			esc_attr( get_option( $args['label_for'] ) ),
			esc_html__( 'companies', 'pronamic_companies' )
		);
	}

	/**
	 * Input page
	 *
	 * @param array $args
	 */
	public function input_page( $args ) {
		$name = $args['label_for'];

		wp_dropdown_pages( array(
			'name'             => $name,
			'selected'         => get_option( $name, '' ),
			'show_option_none' => __( '&mdash; Select a page &mdash;', 'pronamic_companies' ),
		) );
	}

	/**
	 * Select orderby
	 *
	 * @param array $args
	 */
	public function select_orderby( $args ) {
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
	public function select_order( $args ) {
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

	public function input_taxonomies( $args ) {
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
			sprintf( '<legend class="screen-reader-text"><span>%s</span></legend>', esc_html__( 'Taxonomies', 'pronamic_companies' ) ),
			// @codingStandardsIgnoreStart
			implode( '<br />', $inputs )
			// @codingStandardsIgnoreEnd
		);
	}
}
