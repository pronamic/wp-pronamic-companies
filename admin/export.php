<?php

global $pronamic_companies_plugin;

?>
<div class="wrap">
	<h2><?php esc_html_e( 'Companies Export', 'pronamic_companies' ); ?></h2>

	<?php

	$results = $pronamic_companies_plugin->admin->get_export();

	if ( ! empty( $results ) ) : ?>

		<h3><?php esc_html_e( 'Overview', 'pronamic_companies' ); ?></h3>

		<table cellspacing="0" class="widefat fixed">
			<thead>
				<tr>
					<th scope="col"><?php esc_html_e( 'ID', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Name', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="4"><?php esc_html_e( 'Visiting Address', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="4"><?php esc_html_e( 'Mailing Address', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="2"><?php esc_html_e( 'Chamber of Commerce and Tax Information', 'pronamic_companies' ); ?>

					<th scope="col"><?php esc_html_e( 'Subscription', 'pronamic_companies' ); ?></th>

					<th scope="col" colspan="2"><?php esc_html_e( 'User', 'pronamic_companies' ); ?></th>
                    <th scope="col" colspan="2"><?php esc_html_e( 'Contact', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php esc_html_e( 'Categories', 'pronamic_companies' ); ?></th>
				</tr>
				<tr>
					<th scope="col"></th>
					<th scope="col"></th>

					<th scope="col"><?php esc_html_e( 'Address', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Postal Code', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'City', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Country', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php esc_html_e( 'Address', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Postal Code', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'City', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Country', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php esc_html_e( 'Chamber of Commerce Number', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'Tax Number', 'pronamic_companies' ); ?></th>

					<th scope="col"></th>

					<th scope="col"><?php esc_html_e( 'Username', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'E-mail', 'pronamic_companies' ); ?></th>

					<th scope="col"><?php esc_html_e( 'Contact', 'pronamic_companies' ); ?></th>
					<th scope="col"><?php esc_html_e( 'E-mail', 'pronamic_companies' ); ?></th>

					<th scope="col"></th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ( $results as $result ) : ?>

					<tr>
						<td><?php echo esc_html( $result->ID ); ?></td>
						<td><?php echo esc_html( $result->post_title ); ?></td>

						<td><?php echo esc_html( $result->company_address ); ?></td>
						<td><?php echo esc_html( $result->company_postal_code ); ?></td>
						<td><?php echo esc_html( $result->company_city ); ?></td>
						<td><?php echo esc_html( $result->company_country ); ?></td>

						<td><?php echo esc_html( $result->company_mailing_address ); ?></td>
						<td><?php echo esc_html( $result->company_mailing_postal_code ); ?></td>
						<td><?php echo esc_html( $result->company_mailing_city ); ?></td>
						<td><?php echo esc_html( $result->company_mailing_country ); ?></td>

						<td><?php echo esc_html( sprintf( __( 'Chamber of Commerce %s: %s', 'pronamic_companies' ), $result->kvk_establishment, $result->kvk_number ) ); ?></td>
						<td><?php echo esc_html( $result->tax_number ); ?></td>

						<td><?php echo esc_html( $result->company_subscription_id ); ?></td>

						<td><?php echo esc_html( $result->user_login ); ?></td>
						<td><?php echo esc_html( $result->user_email ); ?></td>

						<td><?php echo esc_html( $result->company_contact ); ?></td>
						<td><?php echo esc_html( $result->company_email ); ?></td>

						<td>
							<?php

							$terms = get_the_terms( $result->ID, 'pronamic_company_category' );

							if ( $terms && ! is_wp_error( $terms ) ) {
								$categories = array();

								foreach ( $terms as $term ) {
									$categories[] = $term->name;
								}

								echo esc_html( implode( ', ', $categories ) );
							}

							?>
						</td>
					</tr>

				<?php endforeach; ?>

			</tbody>
		</table>

	<?php endif; ?>

	<form method="post" action="">
		<?php wp_nonce_field( 'pronamic_companies_export', 'pronamic_companies_nonce' ); ?>

		<p>
			<?php submit_button( __( 'Export to CSV', 'pronamic_companies' ), 'secondary', 'pronamic_companies_export' ); ?>
		</p>
	</form>

	<?php

	include $pronamic_companies_plugin->dir_path . 'admin/pronamic.php';

	?>
</div>
