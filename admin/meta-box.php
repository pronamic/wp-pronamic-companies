<?php

global $post;

wp_nonce_field( 'pronamic_companies_save_post', 'pronamic_companies_nonce' );

?>

<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="pronamic_company_contact"><?php _e( 'Contact', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_contact" name="_pronamic_company_contact" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_contact', true ) ); ?>" type="text" size="25" class="regular-text" />
			</td>
		</tr>
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
				<?php if ( false ) : ?>
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
			<th scope="row">
				<label for="pronamic_company_kvk_establishment"><?php _e( 'Chamber of Commerce Number', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_kvk_establishment" name="_pronamic_company_kvk_establishment" placeholder="<?php esc_attr_e( 'Chamber of Commerce Establishment', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_kvk_establishment', true ) ); ?>" type="text" size="42" class="regular-text" />
				<br />
				<input id="pronamic_company_kvk_number" name="_pronamic_company_kvk_number" placeholder="<?php esc_attr_e( 'Chamber of Commerce Number', 'pronamic_companies' ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_kvk_number', true ) ); ?>" type="text" size="12" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="pronamic_company_tax_number"><?php _e( 'Tax Number', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_tax_number" name="_pronamic_company_tax_number" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_tax_number', true ) ); ?>" type="tel" size="20" class="regular-text" />
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
				<label for="pronamic_company_website"><?php _e( 'Website URL', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_website" name="_pronamic_company_website" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_website', true ) ); ?>" type="url" size="25" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="pronamic_company_rss"><?php _e( 'RSS URL', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_rss" name="_pronamic_company_rss" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_rss', true ) ); ?>" type="url" size="25" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="pronamic_company_video"><?php _e( 'Video URL', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_video" name="_pronamic_company_video" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_video', true ) ); ?>" type="url" size="25" class="regular-text" />
			</td>
		</tr>

		<tr>
			<th scope="col" colspan="2">
				<h4 class="title"><?php _e( 'Social Networks', 'pronamic_companies' ); ?></h3>
			</th>
		</tr>

		<tr>
			<th scope="row">
				<label for="pronamic_company_twitter"><?php _e( 'Twitter Username', 'pronamic_companies' ); ?></label>
			</th>
			<td>
				<input id="pronamic_company_twitter" name="_pronamic_company_twitter" value="<?php echo esc_attr( get_post_meta( $post->ID, '_pronamic_company_twitter', true ) ); ?>" type="text" size="25" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="pronamic_company_facebook"><?php _e( 'Facebook URL', 'pronamic_companies' ); ?></label>
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
