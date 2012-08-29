<div class="wrap">
	<?php screen_icon(); ?>

	<h2>
		<?php _e( 'Companies Export', 'pronamic_companies' ); ?>
	</h2>

	<?php 
	
	global $wpdb;

	$results = $wpdb->get_results("
		SELECT
			post.ID , 
			post.post_title , 

			MAX(IF(meta.meta_key = '_pronamic_company_address', meta.meta_value, NULL)) AS company_address  , 
			MAX(IF(meta.meta_key = '_pronamic_company_postal_code', meta.meta_value, NULL)) AS company_postal_code , 
			MAX(IF(meta.meta_key = '_pronamic_company_city', meta.meta_value, NULL)) AS company_city , 
			MAX(IF(meta.meta_key = '_pronamic_company_country', meta.meta_value, NULL)) AS company_country , 

			MAX(IF(meta.meta_key = '_pronamic_company_mailing_address', meta.meta_value, NULL)) AS company_mailing_address  , 
			MAX(IF(meta.meta_key = '_pronamic_company_mailing_postal_code', meta.meta_value, NULL)) AS company_mailing_postal_code , 
			MAX(IF(meta.meta_key = '_pronamic_company_mailing_city', meta.meta_value, NULL)) AS company_mailing_city , 
			MAX(IF(meta.meta_key = '_pronamic_company_mailing_country', meta.meta_value, NULL)) AS company_mailing_country , 

			MAX(IF(meta.meta_key = '_pronamic_company_phone_number', meta.meta_value, NULL)) AS company_phone_number , 
			MAX(IF(meta.meta_key = '_pronamic_company_fax_number', meta.meta_value, NULL)) AS company_fax_number , 

			MAX(IF(meta.meta_key = '_pronamic_company_email', meta.meta_value, NULL)) AS company_email , 
			MAX(IF(meta.meta_key = '_pronamic_company_website', meta.meta_value, NULL)) AS company_website , 

			MAX(IF(meta.meta_key = '_emg_company_subscription_id', meta.meta_value, NULL)) AS company_subscription_id , 
			
			user.user_login , 
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
		GROUP BY
			post.ID
		;
	");

	if( ! empty( $results ) ): ?>

		<div class="tablenav top">
			
		</div>

		<table cellspacing="0" class="widefat fixed">
			<thead>
				<tr>
					<th scope="col"><?php _e( 'Name', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="4"><?php _e( 'Visiting Address', 'pronamic_companies' ); ?></th>
					
					<th scope="col" colspan="4"><?php _e( 'Mailing Address', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php _e( 'Subscription', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="2"><?php _e( 'User', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php _e( 'Categories', 'pronamic_companies' ); ?></th>
				</tr>
				<tr>
					<th scope="col"></th>

					<th scope="col"><?php _e( 'Address', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'Postal Code', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'City', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'Country', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php _e( 'Address', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'Postal Code', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'City', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'Country', 'pronamic_companies' ); ?></th>

					<th scope="col"></th>

					<th scope="col"><?php _e( 'Username', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php _e( 'E-mail', 'pronamic_companies' ); ?></th>

					<th scope="col"></th>
				</tr>
			</thead>
	
			<tbody>
				<?php foreach ( $results as $result ): ?>
					<tr>
						<td><?php echo $result->post_title; ?></td>

						<td><?php echo $result->company_address; ?></td>
						<td><?php echo $result->company_postal_code; ?></td>
						<td><?php echo $result->company_city; ?></td>
						<td><?php echo $result->company_country; ?></td>

						<td><?php echo $result->company_mailing_address; ?></td>
						<td><?php echo $result->company_mailing_postal_code; ?></td>
						<td><?php echo $result->company_mailing_city; ?></td>
						<td><?php echo $result->company_mailing_country; ?></td>

						<td><?php echo $result->company_subscription_id; ?></td>

						<td><?php echo $result->user_login; ?></td>
						<td><?php echo $result->user_email; ?></td>

						<td>
							<?php	
						
							$terms = get_the_terms( $result->ID, 'pronamic_company_category' );

							if ( $terms && ! is_wp_error( $terms ) ) {
								$categories = array();
								
								foreach ( $terms as $term ) {
									$categories[] = $term->name;
								}

								echo implode( ', ', $categories );
							}

							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php endif; ?>
</div>