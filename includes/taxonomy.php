<?php

function pronamic_companies_create_taxonomies() {
	/* Company Category */
	$slug = get_option( 'pronamic_company_category_base' );
	$slug = empty( $slug ) ? _x( 'company-category', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_category', 'pronamic_company',
		array(
			'hierarchical' => true,
			'labels' => array(
				'name'              => _x( 'Company Category', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Category', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Categories', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Categories', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Category', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Category:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Category', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Category', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Category', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Category Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Categories', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);

	/* Company Character */
	$slug = get_option( 'pronamic_company_character_base' );
	$slug = empty( $slug ) ? _x( 'company-character', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_character', 'pronamic_company',
		array(
			'hierarchical' => false,
			'labels'       => array(
				'name'              => _x( 'Company Character', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Character', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Characters', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Characters', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Character', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Character:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Character', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Character', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Character', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Character Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Characters', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);

	/* Company Region */
	$slug = get_option( 'pronamic_company_region_base' );
	$slug = empty( $slug ) ? _x( 'company-region', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_region', 'pronamic_company',
		array(
			'hierarchical' => true,
			'labels'       => array(
				'name'              => _x( 'Company Region', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Region', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Regions', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Regions', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Region', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Region:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Region', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Region', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Region', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Region Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Regions', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);

	/* Company Keyword */
	$slug = get_option( 'pronamic_company_keyword_base' );
	$slug = empty( $slug ) ? _x( 'company-keyword', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_keyword', 'pronamic_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name'              => _x( 'Company Keyword', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Keyword', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Keywords', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Keywords', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Keyword', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Keyword:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Keyword', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Keyword', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Keyword', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Keyword Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Keywords', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);

	/* Company Brand */
	$slug = get_option( 'pronamic_company_brand_base' );
	$slug = empty( $slug ) ? _x( 'company-brand', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_brand', 'pronamic_company',
		array(
			'hierarchical' => false,
			'labels' => array(
				'name'              => _x( 'Company Brand', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Brand', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Brands', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Brands', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Brand', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Brand:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Brand', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Brand', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Brand', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Brand Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Brands', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);

	/* Company Type */
	$slug = get_option( 'pronamic_company_type_base' );
	$slug = empty( $slug ) ? _x( 'company-type', 'slug', 'pronamic_companies' ) : $slug;

	register_taxonomy( 'pronamic_company_type', 'pronamic_company',
		array(
			'hierarchical' => true,
			'labels' => array(
				'name'              => _x( 'Company Type', 'category general name', 'pronamic_companies' ),
				'singular_name'     => _x( 'Company Type', 'category singular name', 'pronamic_companies' ),
				'search_items'      => __( 'Search Company Types', 'pronamic_companies' ),
				'all_items'         => __( 'All Company Types', 'pronamic_companies' ),
				'parent_item'       => __( 'Parent Company Type', 'pronamic_companies' ),
				'parent_item_colon' => __( 'Parent Company Type:', 'pronamic_companies' ),
				'edit_item'         => __( 'Edit Company Type', 'pronamic_companies' ),
				'update_item'       => __( 'Update Company Type', 'pronamic_companies' ),
				'add_new_item'      => __( 'Add New Company Type', 'pronamic_companies' ),
				'new_item_name'     => __( 'New Company Type Name', 'pronamic_companies' ),
				'menu_name'         => __( 'Types', 'pronamic_companies' ),
			),
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $slug ),
		)
	);
}
