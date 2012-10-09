<?php

/**
 * Gravity Forms - Field advanced settings
 * 
 * @param int $position
 * @param int $form_id
 */
function pronamic_companies_gform_field_advanced_settings( $position, $form_id ) {
	if ( $position == 100 ): ?>

		<li class="address_setting field_setting" style="display: list-item;">
			<input type="checkbox" id="pronamic_companies_is_visiting_address" onclick="SetFieldProperty('isCompanyVisitingAddress', this.checked); ToggleInputName();" />

			<label for="pronamic_companies_is_visiting_address" class="inline">
				<?php _e('Is Company Visiting Address', 'pronamic_companies'); ?>
			</label>
		</li>
		<li class="address_setting field_setting" style="display: list-item;">
			<input type="checkbox" id="pronamic_companies_is_mailing_address" onclick="SetFieldProperty('isCompanyMailingAddress', this.checked); ToggleInputName();" />

			<label for="pronamic_companies_is_mailing_address" class="inline">
				<?php _e('Is Company Mailing Address', 'pronamic_companies'); ?>
			</label>
		</li>

	<?php endif;
}

add_action( 'gform_field_advanced_settings', 'pronamic_companies_gform_field_advanced_settings', 10, 2 );

/**
 * Gravity Forms - Editor JavaScript
 */
function pronamic_companies_gform_editor_js() {
	?>
	<script type="text/javascript">
		jQuery(document).bind("gform_load_field_settings", function(event, field, form) {
			if(field.type == "address") {
				var isCompanyVisitingAddress = typeof field.isCompanyVisitingAddress == "boolean" ? field.isCompanyVisitingAddress : false;
				jQuery("#pronamic_companies_is_visiting_address").prop("checked", isCompanyVisitingAddress);

				var isCompanyMailingAddress = typeof field.isCompanyMailingAddress == "boolean" ? field.isCompanyMailingAddress : false; 			
				jQuery("#pronamic_companies_is_mailing_address").prop("checked", isCompanyMailingAddress);
			}
		});
	</script>
	<?php
}

add_action( 'gform_editor_js', 'pronamic_companies_gform_editor_js' );

/**
 * Gravity Forms - Post data
 * 
 * @param array $post_data
 * @param array $form
 * @param array $lead
 */
function pronamic_companies_gform_post_data( $post_data, $form, $lead ) {
	// Map forms fields to custom fields
	$map = array();

	// Form fields
	foreach ( $form['fields'] as $field ) {
		if ( isset( $field['isCompanyVisitingAddress'] ) ) {
			$is_company_visiting_address = filter_var( $field['isCompanyVisitingAddress'], FILTER_VALIDATE_BOOLEAN );

			if ( $is_company_visiting_address ) {
				$id = '' . $field['id'] . '.';
				
				$map['_pronamic_company_address'] = $id . '1'; // Street value
				// $map['_pronamic_company_address_2'] = $id . '2'; // Street 2 value
				$map['_pronamic_company_city'] = $id . '3'; // City value
				// $map['_pronamic_company_state'] = $id . '4'; // State value
				$map['_pronamic_company_postal_code'] = $id . '5'; // Zip code
				$map['_pronamic_company_country'] = $id . '6'; // Country value
			}
		}

		if ( isset( $field['isCompanyMailingAddress'] ) ) {
			$is_company_visiting_address = filter_var( $field['isCompanyMailingAddress'], FILTER_VALIDATE_BOOLEAN );

			if ( $is_company_visiting_address ) {
				$id = '' . $field['id'] . '.';
				
				$map['_pronamic_company_mailing_address'] = $id . '1'; // Street value
				// $map['_pronamic_company_mailing_address_2'] = $id . '2'; // Street 2 value
				$map['_pronamic_company_mailing_city'] = $id . '3'; // City value
				// $map['_pronamic_company_mailing_state'] = $id . '4'; // State value
				$map['_pronamic_company_mailing_postal_code'] = $id . '5'; // Zip code
				$map['_pronamic_company_mailing_country'] = $id . '6'; // Country value
			}
		}
	}

	// Mapping
	if( ! isset( $post_data['post_custom_fields'] ) ) {
		$post_data['post_custom_fields'] = array();
	}

	$fields =& $post_data['post_custom_fields'];

	foreach( $map as $meta_key => $field_id ) {
		if( isset( $lead[$field_id] ) ) {
			$fields[$meta_key] = $lead[$field_id];
		}
	}

	return $post_data;
}

add_filter( 'gform_post_data', 'pronamic_companies_gform_post_data', 10, 3 );

/**
 * Gravity Forms - Pre render
 * 
 * @param unknown_type $form
 */
function pronamic_companies_gform_update_post_field_default_value( $field ) {
	$field_type = RGFormsModel::get_input_type( $field );

	if ( $field_type = 'address' ) {
		var_dump( $field );
	}

	return $field;
}

add_filter( 'gform_update_post_field_default_value', 'pronamic_companies_gform_update_post_field_default_value' );
