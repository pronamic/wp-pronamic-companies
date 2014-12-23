<h2>
	<?php _e( 'Plugins', 'pronamic_companies' ); ?>
</h2>

<?php

$plugin_tips = array(
	'gravityforms/gravityforms.php' => array(
		'slug' => 'gravityforms',
		'name' => 'Gravity Forms',
	),
	'gravity-forms-custom-post-types/gfcptaddon.php' => array(
		'slug' => 'gravity-forms-custom-post-types',
		'name' => 'Gravity Forms + Custom Post Types',
	),
	'gravity-forms-update-post/gravityforms-update-post.php' => array(
		'slug' => 'gravity-forms-update-post',
		'name' => 'Gravity Forms - Update Post',
	),
	'gravityformsuserregistration/userregistration.php' => array(
		'slug' => 'gravityformsuserregistration',
		'name' => 'Gravity Forms User Registration Add-On',
	),
	'posts-to-posts/posts-to-posts.php' => array(
		'slug' => 'posts-to-posts',
		'name' => 'Posts 2 Posts',
	),
	'pronamic-google-maps/pronamic-google-maps.php' => array(
		'slug' => 'pronamic-google-maps',
		'name' => 'Pronamic Google Maps',
	),
	'pronamic-subscriptions/pronamic-subscriptions.php' => array(
		'slug' => 'pronamic-subscriptions',
		'name' => 'Pronamic Subscriptions',
	),
);

?>

<table class="form-table">
	<?php foreach ( $plugin_tips as $file => $data ) : ?>
		<tr>
			<td>
				<?php echo esc_html( $data['name'] ); ?>
			</td>
			<td>
				<?php

				if ( is_plugin_active( $file ) ) {
					echo '&#9745;';
				} else {
					echo '&#9744;';
				}

				?>
			</td>
			<td>
				<?php

				$search_url = add_query_arg(
					array(
						'tab'  => 'search',
						'type' => 'term',
						's'    => $data['slug'],
					),
					'plugin-install.php'
				);

				?>
				<a href="<?php echo esc_attr( $search_url ); ?>">
					<?php _e( 'Search Plugin', 'pronamic_companies' ); ?>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
