<?php
/*
Plugin Name: Pronamic Companies
Plugin URI: http://pronamic.eu/wordpress/companies/
Description: This plugin add some basic company directory functionality to WordPress

Version: 1.0
Requires at least: 3.0

Author: Pronamic
Author URI: http://pronamic.eu/

Text Domain: pronamic_companies
Domain Path: /languages/

License: GPL
*/

/**
 * Flush data
 */
function pronamic_companies_rewrite_flush() {
    pronamic_companies_init();

    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'pronamic_companies_rewrite_flush');

////////////////////////////////////////////////////////////

/**
 * Register post type
 */
function pronamic_companies_init() {
	$relPath = dirname(plugin_basename(__FILE__)) . '/languages/';

	load_plugin_textdomain('pronamic_companies', false, $relPath);

	register_post_type('pronamic_company', array(
		'labels' => array(
			'name' => _x('Companies', 'post type general name', 'pronamic_companies') , 
			'singular_name' => _x('Company', 'post type singular name', 'pronamic_companies') , 
			'add_new' => _x('Add New', 'company', 'pronamic_companies') , 
			'add_new_item' => __('Add New Company', 'pronamic_companies') , 
			'edit_item' => __('Edit Company', 'pronamic_companies') , 
			'new_item' => __('New Company', 'pronamic_companies') , 
			'view_item' => __('View Company', 'pronamic_companies') , 
			'search_items' => __('Search Companies', 'pronamic_companies') , 
			'not_found' =>  __('No companies found', 'pronamic_companies') , 
			'not_found_in_trash' => __('No companies found in Trash', 'pronamic_companies') ,  
			'parent_item_colon' => __('Parent Company:', 'pronamic_companies') , 
			'menu_name' => __('Companies', 'pronamic_companies')
		) , 
		'public' => true ,
		'publicly_queryable' => true ,
		'show_ui' => true ,
		'show_in_menu' => true ,
		'query_var' => true ,
		'capability_type' => 'page' ,
		'has_archive' => true ,
		'rewrite' => array('slug' => 'bedrijvengids') ,
		'menu_icon' => get_bloginfo('template_url') . '/admin/icons/company.png' ,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'custom-fields') 
	));

	/* Include the company category taxonomy */
	register_taxonomy('pronamic_company_category', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name' => _x('Company Category', 'category general name', 'pronamic_companies') ,
				'singular_name' => _x('Company Category', 'category singular name', 'pronamic_companies') ,
				'search_items' =>  __('Search Company Categories', 'pronamic_companies') , 
				'all_items' => __('All Company Categories', 'pronamic_companies') , 
				'parent_item' => __('Parent Company Category', 'pronamic_companies') , 
				'parent_item_colon' => __('Parent Company Category:', 'pronamic_companies') ,
				'edit_item' => __('Edit Company Category', 'pronamic_companies') ,
				'update_item' => __('Update Company Category', 'pronamic_companies') ,
				'add_new_item' => __('Add New Company Category', 'pronamic_companies') ,
				'new_item_name' => __('New Company Category Name', 'pronamic_companies') ,
				'menu_name' => __('Categories', 'pronamic_companies')
			) , 
			'show_ui' => true , 
			'query_var' => true
		)
	);

	/* Include the company index taxonomy */
	register_taxonomy('pronamic_company_character', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name' => _x('Company Character', 'category general name', 'pronamic_companies') ,
				'singular_name' => _x('Company Character', 'category singular name', 'pronamic_companies') ,
				'search_items' =>  __('Search Company Characters', 'pronamic_companies') , 
				'all_items' => __('All Company Characters', 'pronamic_companies') , 
				'parent_item' => __('Parent Company Character', 'pronamic_companies') , 
				'parent_item_colon' => __('Parent Company Character:', 'pronamic_companies') ,
				'edit_item' => __('Edit Company Character', 'pronamic_companies') ,
				'update_item' => __('Update Company Character', 'pronamic_companies') ,
				'add_new_item' => __('Add New Company Character', 'pronamic_companies') ,
				'new_item_name' => __('New Company Character Name', 'pronamic_companies') ,
				'menu_name' => __('Characters', 'pronamic_companies')
			) , 
			'show_ui' => true , 
			'query_var' => true
		)
	);
	
	/* Include the company region taxonomy */
	register_taxonomy('pronamic_company_region', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name' => _x('Company Region', 'category general name', 'pronamic_companies') ,
				'singular_name' => _x('Company Region', 'category singular name', 'pronamic_companies') ,
				'search_items' =>  __('Search Company Regions', 'pronamic_companies') ,
				'all_items' => __('All Company Regions', 'pronamic_companies') ,
				'parent_item' => __('Parent Company Region', 'pronamic_companies') ,
				'parent_item_colon' => __('Parent Company Region:', 'pronamic_companies') ,
				'edit_item' => __('Edit Company Region', 'pronamic_companies') ,
				'update_item' => __('Update Company Region', 'pronamic_companies') ,
				'add_new_item' => __('Add New Company Region', 'pronamic_companies') ,
				'new_item_name' => __('New Company Region Name', 'pronamic_companies') ,
				'menu_name' => __('Regions', 'pronamic_companies')
			) , 
			'show_ui' => true , 
			'query_var' => true
		)
	);
}
add_action('init', 'pronamic_companies_init');

////////////////////////////////////////////////////////////

/**
 * Meta boxes
 */
add_action('add_meta_boxes', 'pronamic_companies_add_information_box');
add_action('save_post', 'pronamic_companies_save_postdata');

/* Add metaboxes */
function pronamic_companies_add_information_box() {
    add_meta_box( 
        'pronamic_companies_information',
        __( 'Company information', 'pronamic_companies'),
        'pronamic_companies_information_box',
        'pronamic_company' ,
        'side' ,
        'high'
    );
}

/**
 * Print metaboxes
 */
function pronamic_companies_information_box($post) {
	global $post;

	wp_nonce_field(plugin_basename(__FILE__), 'pronamic_companies_nonce');

	?>

	<label for="pronamic_company_address"><?php _e('Address', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_address" name="pronamic_company_address" value="<?php echo get_post_meta($post->ID, '_pronamic_company_address', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_postal"><?php _e('Postal', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_postal" name="_pronamic_company_postal_code" value="<?php echo get_post_meta($post->ID, '_pronamic_company_postal_code', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_city"><?php _e('City', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_city" name="pronamic_company_city" value="<?php echo get_post_meta($post->ID, '_pronamic_company_city', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_country"><?php _e('Country', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_country" name="pronamic_company_country" value="<?php echo get_post_meta($post->ID, '_pronamic_company_country', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_phone_number"><?php _e('Phone number', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_phone_number" name="pronamic_company_phone_number" value="<?php echo get_post_meta($post->ID, '_pronamic_company_phone_number', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_fax_number"><?php _e('Fax number', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_fax_number" name="pronamic_company_fax_number" value="<?php echo get_post_meta($post->ID, '_pronamic_company_fax_number', true) ?>" size="25" />
	</div>

	<label for="_pronamic_company_email"><?php _e('Email address', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_email_address" name="_pronamic_company_email" value="<?php echo get_post_meta($post->ID, '_pronamic_company_email', true) ?>" size="25" />
	</div>

	<label for="pronamic_company_website"><?php _e('Website', 'pronamic_companies'); ?></label>
	<div class="input-text-wrap">
		<input type="text" id="pronamic_company_website" name="pronamic_company_website" value="<?php echo get_post_meta($post->ID, '_pronamic_company_website', true) ?>" size="25" />
	</div>

	<?php
}

/**
 * Save metaboxes
 */
function pronamic_companies_save_postdata($post_id) {
	global $post;

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if(!isset($_POST['pronamic_companies_nonce']))
		return;

	if(!wp_verify_nonce($_POST['pronamic_companies_nonce'], plugin_basename(__FILE__)))
		return;

	if(!current_user_can('edit_post', $post->ID))
		return;
		
	// Save data
	if(isset($_POST['pronamic_company_address'])) {
		update_post_meta($post->ID, '_pronamic_company_address', $_POST['pronamic_company_address']);
	}

	if(isset($_POST['pronamic_company_postal_code'])) {
		update_post_meta($post->ID, 'pronamic_company_postal_code', $_POST['pronamic_company_postal_code']);
	}

	if(isset($_POST['pronamic_company_city'])) {
		update_post_meta($post->ID, '_pronamic_company_city', $_POST['pronamic_company_city']);
	}

	if(isset($_POST['pronamic_company_country'])) {
		update_post_meta($post->ID, 'pronamic_company_country', $_POST['pronamic_company_country']);
	}

	if(isset($_POST['pronamic_company_phone_number'])) {
		update_post_meta($post->ID, '_pronamic_company_phone_number', $_POST['pronamic_company_phone_number']);
	}

	if(isset($_POST['pronamic_company_fax_number'])) {
		update_post_meta($post->ID, '_pronamic_company_fax_number', $_POST['pronamic_company_fax_number']);
	}

	if(isset($_POST['_pronamic_company_email'])) {
		update_post_meta($post->ID, '_pronamic_company_email', $_POST['_pronamic_company_email']);
	}

	if(isset($_POST['pronamic_company_website'])) {
		update_post_meta($post->ID, '_pronamic_company_website', $_POST['pronamic_company_website']);
	}
}
