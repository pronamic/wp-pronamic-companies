<?php

/**
 * Gravity Forms - Field advanced settings
 *
 * @param int $position
 * @param int $form_id
 */
function pronamic_companies_gform_field_advanced_settings( $position, $form_id ) {
	if ( $position == 100 ) : ?>

		<li class="address_setting field_setting" style="display: list-item;">
			<input type="checkbox" id="pronamic_companies_is_visiting_address" onclick="SetFieldProperty('isCompanyVisitingAddress', this.checked); ToggleInputName();" />

			<label for="pronamic_companies_is_visiting_address" class="inline">
				<?php _e( 'Is Company Visiting Address', 'pronamic_companies' ); ?>
			</label>
		</li>
		<li class="address_setting field_setting" style="display: list-item;">
			<input type="checkbox" id="pronamic_companies_is_mailing_address" onclick="SetFieldProperty('isCompanyMailingAddress', this.checked); ToggleInputName();" />

			<label for="pronamic_companies_is_mailing_address" class="inline">
				<?php _e( 'Is Company Mailing Address', 'pronamic_companies' ); ?>
			</label>
		</li>

	<?php elseif ( $position == 500 ) : ?>

		<li class="prepopulate_field_setting field_setting" style="display: list-item;">
			<input type="checkbox" id="pronamic_populate_current_user_companies" onclick="SetFieldProperty('populateCurrentUserCompanies', this.checked); ToggleInputName();" />

			<label for="pronamic_populate_current_user_companies" class="inline">
				<?php _e( 'Populate with Current User Companies', 'pronamic_companies' ); ?>
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

			var populateCurrentUserCompanies = typeof field.populateCurrentUserCompanies == "boolean" ? field.populateCurrentUserCompanies : false;
			jQuery("#pronamic_populate_current_user_companies").prop("checked", populateCurrentUserCompanies);
		});
	</script>
	<?php
}

add_action( 'gform_editor_js', 'pronamic_companies_gform_editor_js' );

/**
 * Gravity Forms - Populate subscription
 *
 * @param array $form
 */
function pronamic_companies_gform_populate_current_user_companies( $form ) {
	foreach ( $form['fields'] as &$field ) {
		if ( isset( $field['populateCurrentUserCompanies'] ) ) {
			$populate_current_user_companies = filter_var( $field['populateCurrentUserCompanies'], FILTER_VALIDATE_BOOLEAN );

			if ( $populate_current_user_companies ) {
				global $user_ID;

				// Make sure we only get subscriptions once
				if ( ! isset( $companies ) ) {
					$companies = get_posts( array(
						'post_type' => 'pronamic_company',
						'nopaging'  => true,
						'author'    => $user_ID,
					) );
				}

				// Build new choices array
				$field['choices'] = array();

				foreach ( $companies as $company ) {
					$field['choices'][] = array(
						'text'       => $company->post_title,
						'value'      => '' . $company->ID,
						'isSelected' => false,
					);
				}
			}
		}
	}

	return $form;
}

add_filter( 'gform_admin_pre_render', 'pronamic_companies_gform_populate_current_user_companies' );
add_filter( 'gform_pre_render',       'pronamic_companies_gform_populate_current_user_companies' );

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
			$is_company_address = filter_var( $field['isCompanyVisitingAddress'], FILTER_VALIDATE_BOOLEAN );

			if ( $is_company_address ) {
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
			$is_company_address = filter_var( $field['isCompanyMailingAddress'], FILTER_VALIDATE_BOOLEAN );

			if ( $is_company_address ) {
				$id = '' . $field['id'] . '.';

				$map['_pronamic_company_mailing_address'] = $id . '1'; // Street value
				// $map['_pronamic_company_mailing_address_2'] = $id . '2'; // Street 2 value
				$map['_pronamic_company_mailing_city'] = $id . '3'; // City value
				// $map['_pronamic_company_mailing_state'] = $id . '4'; // State value
				$map['_pronamic_company_mailing_postal_code'] = $id . '5'; // Zip code
				$map['_pronamic_company_mailing_country'] = $id . '6'; // Country value
			}
		}

		if ( isset( $field['populateCurrentUserCompanies'] ) ) {
			$populate_current_user_companies = filter_var( $field['populateCurrentUserCompanies'], FILTER_VALIDATE_BOOLEAN );

			if ( $populate_current_user_companies ) {
				$post_data['post_custom_fields']['_pronamic_company_id'] = RGFormsModel::get_field_value( $field );
			}
		}
	}

	// Mapping
	if ( ! isset( $post_data['post_custom_fields'] ) ) {
		$post_data['post_custom_fields'] = array();
	}

	$fields =& $post_data['post_custom_fields'];

	foreach ( $map as $meta_key => $field_id ) {
		if ( isset( $lead[ $field_id ] ) ) {
			$fields[ $meta_key ] = $lead[ $field_id ];
		}
	}

	return $post_data;
}

add_filter( 'gform_post_data', 'pronamic_companies_gform_post_data', 10, 3 );

/**
 * Gravity Forms - Update post field default value
 *
 * @see http://plugins.trac.wordpress.org/browser/gravity-forms-update-post/tags/0.5.3/gravityforms-update-post.php#L190
 * @param array $field
 * @return array
 */
function pronamic_companies_gform_update_post_field_default_value( $field ) {
	global $gform_update_post;

	if ( isset( $gform_update_post, $gform_update_post->options, $gform_update_post->options['request_id'] ) ) {
		$name = $gform_update_post->options['request_id'];

		$post_id = filter_input( INPUT_GET, $name, FILTER_SANITIZE_STRING );

		if ( ! empty( $post_id ) ) {
			$field_type = RGFormsModel::get_input_type( $field );

			if ( 'address' == $field_type ) {
				if ( isset( $field['isCompanyVisitingAddress'] ) ) {
					$is_company_address = filter_var( $field['isCompanyVisitingAddress'], FILTER_VALIDATE_BOOLEAN );

					if ( $is_company_address ) {
						$field['defaultValue'] = array(
							$field['id'] . '.1' => get_post_meta( $post_id, '_pronamic_company_address', true ), // Street value
							// $field['id'] . '.2' => get_post_meta( $post_id, '', true ), // Street 2 value
							$field['id'] . '.3' => get_post_meta( $post_id, '_pronamic_company_city', true ), // City value
							// $field['id'] . '.4' => get_post_meta( $post_id, '', true ), // State value
							$field['id'] . '.5' => get_post_meta( $post_id, '_pronamic_company_postal_code', true ), // Zip code
							$field['id'] . '.6' => get_post_meta( $post_id, '_pronamic_company_country', true ) // Country value
						);
					}
				}

				if ( isset( $field['isCompanyMailingAddress'] ) ) {
					$is_company_address = filter_var( $field['isCompanyMailingAddress'], FILTER_VALIDATE_BOOLEAN );

					if ( $is_company_address ) {
						$field['defaultValue'] = array(
							$field['id'] . '.1' => get_post_meta( $post_id, '_pronamic_company_mailing_address', true ), // Street value
							// $field['id'] . '.2' => get_post_meta( $post_id, '', true ), // Street 2 value
							$field['id'] . '.3' => get_post_meta( $post_id, '_pronamic_company_mailing_city', true ), // City value
							// $field['id'] . '.4' => get_post_meta( $post_id, '', true ), // State value
							$field['id'] . '.5' => get_post_meta( $post_id, '_pronamic_company_mailing_postal_code', true ), // Zip code
							$field['id'] . '.6' => get_post_meta( $post_id, '_pronamic_company_mailing_country', true ) // Country value
						);
					}
				}
			}
		}
	}

	return $field;
}

add_filter( 'gform_update_post_field_default_value', 'pronamic_companies_gform_update_post_field_default_value' );
