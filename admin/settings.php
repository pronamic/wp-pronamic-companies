<?php

global $pronamic_companies_plugin;

// Flush rewrite rules, same setup as WordPress permalinks options page:
// https://github.com/WordPress/WordPress/blob/3.4.2/wp-admin/options-permalink.php#L143
flush_rewrite_rules();

$tabs = array(
	'pronamic_companies_general'    => __( 'General', 'pronamic_companies' ),
	'pronamic_companies_pages'      => __( 'Pages', 'pronamic_companies' ),
	'pronamic_companies_permalinks' => __( 'Permalinks', 'pronamic_companies' ),
	'pronamic_companies_plugins'    => __( 'Plugins', 'pronamic_companies' ),
);

$current_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
$current_tab = empty( $current_tab ) ? key( $tabs ) : $current_tab;

?>
<div class="wrap">
	<?php if ( empty( $tabs ) ) : ?>

		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<?php else : ?>

		<h2 class="nav-tab-wrapper">
			<?php

			foreach ( $tabs as $tab => $title ) {
				$classes = array( 'nav-tab' );

				if ( $current_tab === $tab ) {
					$classes[] = 'nav-tab-active';
				}

				$url = add_query_arg( 'tab', $tab );
				printf(
					'<a class="nav-tab %s" href="%s">%s</a>',
					esc_attr( implode( ' ', $classes ) ),
					esc_attr( $url ),
					esc_html( $title )
				);
			}
			?>
		</h2>

	<?php endif; ?>

	<?php if ( 'pronamic_companies_plugins' === $current_tab ) : ?>

		<div style="margin-bottom: 20px;">
			<?php include $pronamic_companies_plugin->dir_path . 'admin/plugins.php'; ?>
		</div>

	<?php else : ?>

		<form action="options.php" method="post">
			<?php settings_fields( $current_tab ); ?>

			<?php do_settings_sections( $current_tab ); ?>

			<?php submit_button(); ?>
		</form>

	<?php endif; ?>

	<div style="margin-bottom: 20px;">
		<?php include $pronamic_companies_plugin->dir_path . 'admin/pronamic.php'; ?>
	</div>
</div>
