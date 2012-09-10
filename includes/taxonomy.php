<?php

function pronamic_companies_create_taxonomies() {
	/* Company category */
	register_taxonomy( 'pronamic_company_category', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name'              => _x( 'Company Category', 'category general name', 'pronamic_companies' ) ,
				'singular_name'     => _x( 'Company Category', 'category singular name', 'pronamic_companies' ) ,
				'search_items'      => __( 'Search Company Categories', 'pronamic_companies' ) , 
				'all_items'         => __( 'All Company Categories', 'pronamic_companies' ) , 
				'parent_item'       => __( 'Parent Company Category', 'pronamic_companies' ) , 
				'parent_item_colon' => __( 'Parent Company Category:', 'pronamic_companies' ) ,
				'edit_item'         => __( 'Edit Company Category', 'pronamic_companies' ) ,
				'update_item'       => __( 'Update Company Category', 'pronamic_companies' ) ,
				'add_new_item'      => __( 'Add New Company Category', 'pronamic_companies' ) ,
				'new_item_name'     => __( 'New Company Category Name', 'pronamic_companies' ) ,
				'menu_name'         => __( 'Categories', 'pronamic_companies' )
			) , 
			'show_ui'      => true , 
			'query_var'    => true , 
			'rewrite'      => array( 'slug' => _x( 'company-category', 'slug', 'pronamic_companies' ) )
		)
	);

	/* Company character */
	register_taxonomy( 'pronamic_company_character', 'pronamic_company', 
		array( 
			'hierarchical' => false , 
			'labels'       => array(
				'name'              => _x( 'Company Character', 'category general name', 'pronamic_companies' ) ,
				'singular_name'     => _x( 'Company Character', 'category singular name', 'pronamic_companies' ) ,
				'search_items'      => __( 'Search Company Characters', 'pronamic_companies' ) , 
				'all_items'         => __( 'All Company Characters', 'pronamic_companies' ) , 
				'parent_item'       => __( 'Parent Company Character', 'pronamic_companies' ) , 
				'parent_item_colon' => __( 'Parent Company Character:', 'pronamic_companies' ) ,
				'edit_item'         => __( 'Edit Company Character', 'pronamic_companies' ) ,
				'update_item'       => __( 'Update Company Character', 'pronamic_companies' ) ,
				'add_new_item'      => __( 'Add New Company Character', 'pronamic_companies' ) ,
				'new_item_name'     => __( 'New Company Character Name', 'pronamic_companies' ) ,
				'menu_name'         => __( 'Characters', 'pronamic_companies' )
			) , 
			'show_ui'      => true , 
			'query_var'    => true
		)
	);
	
	/* Company region */
	register_taxonomy( 'pronamic_company_region', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels'       => array(
				'name'              => _x( 'Company Region', 'category general name', 'pronamic_companies' ) ,
				'singular_name'     => _x( 'Company Region', 'category singular name', 'pronamic_companies' ) ,
				'search_items'      => __( 'Search Company Regions', 'pronamic_companies' ) ,
				'all_items'         => __( 'All Company Regions', 'pronamic_companies' ) ,
				'parent_item'       => __( 'Parent Company Region', 'pronamic_companies' ) ,
				'parent_item_colon' => __( 'Parent Company Region:', 'pronamic_companies' ) ,
				'edit_item'         => __( 'Edit Company Region', 'pronamic_companies' ) ,
				'update_item'       => __( 'Update Company Region', 'pronamic_companies' ) ,
				'add_new_item'      => __( 'Add New Company Region', 'pronamic_companies' ) ,
				'new_item_name'     => __( 'New Company Region Name', 'pronamic_companies' ) ,
				'menu_name'         => __( 'Regions', 'pronamic_companies' )
			) , 
			'show_ui'      => true , 
			'query_var'    => true
		)
	);
}

