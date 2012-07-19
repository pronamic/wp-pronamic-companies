<?php
/*
Plugin Name: Pronamic Companies
Plugin URI: http://pronamic.eu/wordpress/companies/
Description: This plugin add some basic company directory functionality to WordPress

Version: 0.1.1
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

register_activation_hook( __FILE__, 'pronamic_companies_rewrite_flush' );

////////////////////////////////////////////////////////////

/**
 * Register post type
 */
function pronamic_companies_init() {
	$relPath = dirname( plugin_basename( __FILE__ ) ) . '/languages/';

	load_plugin_textdomain( 'pronamic_companies', false, $relPath );

	register_post_type( 'pronamic_company', array(
		'labels' => array(
			'name' => _x( 'Companies', 'post type general name', 'pronamic_companies' ) , 
			'singular_name' => _x( 'Company', 'post type singular name', 'pronamic_companies' ) , 
			'add_new' => _x( 'Add New', 'company', 'pronamic_companies' ) , 
			'add_new_item' => __( 'Add New Company', 'pronamic_companies' ) , 
			'edit_item' => __( 'Edit Company', 'pronamic_companies' ) , 
			'new_item' => __( 'New Company', 'pronamic_companies' ) , 
			'view_item' => __( 'View Company', 'pronamic_companies' ) , 
			'search_items' => __( 'Search Companies', 'pronamic_companies' ) , 
			'not_found' =>  __( 'No companies found', 'pronamic_companies' ) , 
			'not_found_in_trash' => __( 'No companies found in Trash', 'pronamic_companies' ) ,  
			'parent_item_colon' => __( 'Parent Company:', 'pronamic_companies' ) , 
			'menu_name' => __( 'Companies', 'pronamic_companies' )
		) , 
		'public' => true ,
		'publicly_queryable' => true ,
		'show_ui' => true ,
		'show_in_menu' => true ,
		'query_var' => true ,
		'capability_type' => 'post' ,
		'has_archive' => true ,
		'rewrite' => array( 'slug' => _x( 'companies', 'slug', 'pronamic_companies' ) ) , 
		'menu_icon' => plugins_url( 'admin/icons/company.png', __FILE__ ) , 
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ) 
	));

	/* Include the company category taxonomy */
	register_taxonomy( 'pronamic_company_category', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name' => _x( 'Company Category', 'category general name', 'pronamic_companies' ) ,
				'singular_name' => _x( 'Company Category', 'category singular name', 'pronamic_companies' ) ,
				'search_items' =>  __( 'Search Company Categories', 'pronamic_companies' ) , 
				'all_items' => __( 'All Company Categories', 'pronamic_companies' ) , 
				'parent_item' => __( 'Parent Company Category', 'pronamic_companies' ) , 
				'parent_item_colon' => __( 'Parent Company Category:', 'pronamic_companies' ) ,
				'edit_item' => __( 'Edit Company Category', 'pronamic_companies' ) ,
				'update_item' => __( 'Update Company Category', 'pronamic_companies' ) ,
				'add_new_item' => __( 'Add New Company Category', 'pronamic_companies' ) ,
				'new_item_name' => __( 'New Company Category Name', 'pronamic_companies' ) ,
				'menu_name' => __( 'Categories', 'pronamic_companies' )
			) , 
			'show_ui' => true , 
			'query_var' => true , 
			'rewrite' => array( 'slug' => _x( 'company-category', 'slug', 'pronamic_companies' ) )
		)
	);

	/* Include the company index taxonomy */
	register_taxonomy( 'pronamic_company_character', 'pronamic_company', 
		array( 
			'hierarchical' => false , 
			'labels' => array(
				'name' => _x( 'Company Character', 'category general name', 'pronamic_companies' ) ,
				'singular_name' => _x( 'Company Character', 'category singular name', 'pronamic_companies' ) ,
				'search_items' =>  __( 'Search Company Characters', 'pronamic_companies' ) , 
				'all_items' => __( 'All Company Characters', 'pronamic_companies' ) , 
				'parent_item' => __( 'Parent Company Character', 'pronamic_companies' ) , 
				'parent_item_colon' => __( 'Parent Company Character:', 'pronamic_companies' ) ,
				'edit_item' => __( 'Edit Company Character', 'pronamic_companies' ) ,
				'update_item' => __( 'Update Company Character', 'pronamic_companies' ) ,
				'add_new_item' => __( 'Add New Company Character', 'pronamic_companies' ) ,
				'new_item_name' => __( 'New Company Character Name', 'pronamic_companies' ) ,
				'menu_name' => __( 'Characters', 'pronamic_companies' )
			) , 
			'show_ui' => true , 
			'query_var' => true
		)
	);
	
	/* Include the company region taxonomy */
	register_taxonomy( 'pronamic_company_region', 'pronamic_company', 
		array( 
			'hierarchical' => true , 
			'labels' => array(
				'name' => _x( 'Company Region', 'category general name', 'pronamic_companies' ) ,
				'singular_name' => _x( 'Company Region', 'category singular name', 'pronamic_companies' ) ,
				'search_items' =>  __( 'Search Company Regions', 'pronamic_companies' ) ,
				'all_items' => __( 'All Company Regions', 'pronamic_companies' ) ,
				'parent_item' => __( 'Parent Company Region', 'pronamic_companies' ) ,
				'parent_item_colon' => __( 'Parent Company Region:', 'pronamic_companies' ) ,
				'edit_item' => __( 'Edit Company Region', 'pronamic_companies' ) ,
				'update_item' => __( 'Update Company Region', 'pronamic_companies' ) ,
				'add_new_item' => __( 'Add New Company Region', 'pronamic_companies' ) ,
				'new_item_name' => __( 'New Company Region Name', 'pronamic_companies' ) ,
				'menu_name' => __( 'Regions', 'pronamic_companies' )
			) , 
			'show_ui' => true , 
			'query_var' => true
		)
	);
}

add_action( 'init', 'pronamic_companies_init' );

////////////////////////////////////////////////////////////

function pronamic_companies_admin_enqueue(){
	wp_enqueue_style( 'pronamic_companies', plugins_url('/assets/css/admin.css', __FILE__ ) );
}

add_action( 'admin_enqueue_scripts', 'pronamic_companies_admin_enqueue' );

/**
 * Meta boxes
 */
add_action( 'add_meta_boxes', 'pronamic_companies_add_information_box' );

/* Add metaboxes */
function pronamic_companies_add_information_box() {
    add_meta_box( 
        'pronamic_companies_meta_box' , // id
        __( 'Company information', 'pronamic_companies') , // title
        'pronamic_companies_information_box' , // callback
        'pronamic_company' , // post_type
        'normal' , // context
        'high' // priority
    );
}

/**
 * Print metaboxes
 */
function pronamic_companies_information_box($post) {
	global $post;

	wp_nonce_field( plugin_basename( __FILE__ ), 'pronamic_companies_nonce' );

	?>

	<table class="form-table">
		<tbody>
			<tr>
				<th scope="col" colspan="2">
					<h4 class="title"><?php _e( 'Addresses', 'pronamic_companies' ); ?></h3>
				</th>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_address"><?php _e( 'Visiting Address', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<textarea id="pronamic_company_address" name="_pronamic_company_address" placeholder="<?php esc_attr_e( 'Address', 'pronamic_companies' ); ?>" rows="1" cols="60"><?php echo esc_textarea( get_post_meta( $post->ID, '_pronamic_company_address', true ) ); ?></textarea>
					<br />
					<input id="pronamic_company_postal_code" name="_pronamic_company_postal_code" placeholder="<?php esc_attr_e( 'Postal Code', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_postal_code', true ) ); ?>" type="text" size="10" />
					<input id="pronamic_company_city" name="_pronamic_company_city" placeholder="<?php esc_attr_e( 'City', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_city', true ) ); ?>" type="text" size="25" />
					<br />
					<input id="pronamic_company_country" name="_pronamic_company_country" placeholder="<?php esc_attr_e( 'Country', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_country', true ) ); ?>" type="text" size="42" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_address"><?php _e( 'Mailing Address', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<?php if( false ): ?>
					<label>
						<input name="" type="checkbox" /> 
						<?php _e( 'Mailing address equals visiting address.', 'pronamic_companies' ); ?>
					</label>
					<br />
					<?php endif; ?>
					<textarea id="pronamic_company_mailing_address" name="_pronamic_company_mailing_address" placeholder="<?php esc_attr_e( 'Address', 'pronamic_companies' ); ?>" rows="1" cols="60"><?php echo esc_textarea( get_post_meta( $post->ID, '_pronamic_company_mailing_address', true ) ); ?></textarea>
					<br />
					<input id="pronamic_company_mailing_postal_code" name="_pronamic_company_mailing_postal_code" placeholder="<?php esc_attr_e( 'Postal Code', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_mailing_postal_code', true ) ); ?>" type="text" size="10" />
					<input id="pronamic_company_mailing_city" name="_pronamic_company_mailing_city" placeholder="<?php esc_attr_e( 'City', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_mailing_city', true ) ); ?>" type="text" size="25" />
					<br />
					<input id="pronamic_company_mailing_country" name="_pronamic_company_mailing_country" placeholder="<?php esc_attr_e( 'Country', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_mailing_country', true ) ); ?>" type="text" size="42" />
				</td>
			</tr>

			<tr>
				<th scope="col" colspan="2">
					<h4 class="title"><?php _e( 'Phone', 'pronamic_companies' ); ?></h3>
				</th>
			</tr>

			<tr>
				<th scope="row">
					<label for="pronamic_company_phone_number"><?php _e( 'Phone Number', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_phone_number" name="_pronamic_company_phone_number" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_phone_number', true ) ); ?>" type="tel" size="25" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_fax_number"><?php _e( 'Fax Number', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_fax_number" name="_pronamic_company_fax_number" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_fax_number', true ) ); ?>" type="tel" size="25" class="regular-text" />
				</td>
			</tr>

			<tr>
				<th scope="col" colspan="2">
					<h4 class="title"><?php _e( 'Online', 'pronamic_companies' ); ?></h3>
				</th>
			</tr>

			<tr>
				<th scope="row">
					<label for="pronamic_company_email"><?php _e( 'E-mail Address', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_email" name="_pronamic_company_email" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_email', true ) ); ?>" type="email" size="25" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_website"><?php _e( 'Website', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_website" name="_pronamic_company_website" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_website', true ) ); ?>" type="url" size="25" class="regular-text" />
				</td>
			</tr>

			<tr>
				<th scope="col" colspan="2">
					<h4 class="title"><?php _e( 'Social Networks', 'pronamic_companies' ); ?></h3>
				</th>
			</tr>

			<tr>
				<th scope="row">
					<label for="pronamic_company_twitter"><?php _e( 'Twitter', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_twitter" name="_pronamic_company_twitter" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_twitter', true ) ); ?>" type="text" size="25" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_facebook"><?php _e( 'Facebook', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_facebook" name="_pronamic_company_facebook" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_facebook', true ) ); ?>" type="text" size="25" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_linkedin"><?php _e( 'LinkedIN', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_linkedin" name="_pronamic_company_linkedin" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_linkedin', true ) ); ?>" type="text" size="25" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="pronamic_company_google_plus"><?php _e( 'Google+', 'pronamic_companies' ); ?></label>
				</th>
				<td>
					<input id="pronamic_company_google_plus" name="_pronamic_company_google_plus" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_google_plus', true ) ); ?>" type="text" size="25" class="regular-text" />
				</td>
			</tr>
		</tbody>
	</table>

	<?php
}

/**
 * Save metaboxes
 */
function pronamic_companies_save_post( $post_id ) {
	global $post;

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if( ! isset( $_POST['pronamic_companies_nonce'] ) )
		return;

	if( ! wp_verify_nonce( $_POST['pronamic_companies_nonce'], plugin_basename( __FILE__ ) ) )
		return;

	if( ! current_user_can( 'edit_post', $post->ID ) )
		return;
		
	// Save data
	$data = filter_input_array( INPUT_POST, array(
		// Visiting Address
		'_pronamic_company_address' => FILTER_SANITIZE_STRING , 
		'_pronamic_company_postal_code' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_city' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_country' => FILTER_SANITIZE_STRING ,
		// Visiting Address
		'_pronamic_company_mailing_address' => FILTER_SANITIZE_STRING , 
		'_pronamic_company_mailing_postal_code' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_mailing_city' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_mailing_country' => FILTER_SANITIZE_STRING ,
		// Phone
		'_pronamic_company_phone_number' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_fax_number' => FILTER_SANITIZE_STRING ,
		// Social
		'_pronamic_company_email' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_website' => FILTER_SANITIZE_STRING ,
		// Social Networks
		'_pronamic_company_twitter' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_facebook' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_linkedin' => FILTER_SANITIZE_STRING ,
		'_pronamic_company_google_plus' => FILTER_SANITIZE_STRING 
	));

	foreach( $data as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	// Google Maps address
	$address  = '';

	$address .= $data['_pronamic_company_address'] . "\r\n";
	$address .= $data['_pronamic_company_postal_code'] . ' ' . $data['_pronamic_company_city'] . "\r\n";
	$address .= $data['_pronamic_company_country'];

	update_post_meta( $post_id, '_pronamic_google_maps_address', $address );
}


add_action( 'save_post', 'pronamic_companies_save_post', 50 );

/**
 * Columns
 * 
 * @param array $columns
 */
function pronamic_companies_set_columns( $columns ) {
	$new_columns = array();

	if( isset( $columns['cb'] ) ) {
		$new_columns['cb'] = $columns['cb'];
	}

	// $newColumns['thumbnail'] = __('Thumbnail', 'pronamic_companies');

	if( isset( $columns['title'] ) ) {
		$new_columns['title'] = __( 'Company', 'pronamic_companies' );
	}

	if( isset( $columns['author'] ) ) {
		$new_columns['author'] = $columns['author'];
	}

	$new_columns['pronamic_company_address'] = __( 'Address', 'pronamic_companies' );

	$new_columns['pronamic_company_categories'] = __( 'Categories', 'pronamic_companies' );

	if( isset( $columns['comments'] ) ) {
		$new_columns['comments'] = $columns['comments'];
	}

	if( isset( $columns['date'] ) ) {
		$new_columns['date'] = $columns['date'];
	}
	
	return $new_columns;
}

add_filter( 'manage_edit-pronamic_company_columns' , 'pronamic_companies_set_columns' );

function pronamic_companies_custom_columns( $column, $post_id ) {
	switch( $column ) {
		case 'pronamic_company_address':
			echo get_post_meta( $post_id, '_pronamic_company_address', true ), '<br />';
			echo get_post_meta( $post_id, '_pronamic_company_postal_code', true ), ' ', get_post_meta( $post_id, '_pronamic_company_city', true );

			break;
		case 'pronamic_company_categories':
			$terms = get_the_term_list( $post_id, 'pronamic_company_category' , '' , ', ' , '' );

			if( is_string( $terms ) ) {
				echo $terms;
			} else {
				echo __( 'No Category', 'pronamic_companies' );
			}

			break;
	}
}

add_action( 'manage_posts_custom_column' , 'pronamic_companies_custom_columns', 10, 2 );

/**
 * Posts 2 Posts
 */
function pronamic_companies_p2p() {
	if ( function_exists( 'p2p_register_connection_type' ) ) {
		p2p_register_connection_type( array(
			'name' => 'posts_to_pronamic_companies',
			'from' => 'post',
			'to' => 'pronamic_company'
		) );
	}
}

add_action( 'wp_loaded', 'pronamic_companies_p2p' );

