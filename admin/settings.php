<?php

// Flush rewrite rules, same setup as WordPress permalinks options page:
// https://github.com/WordPress/WordPress/blob/3.4.2/wp-admin/options-permalink.php#L143
flush_rewrite_rules();

?>
<div class="wrap">
	<?php screen_icon(); ?>

	<h2>
		<?php _e( 'Companies Settings', 'pronamic_companies' ); ?>
	</h2>

	<form name="form" action="options.php" method="post">
		<?php settings_fields( 'pronamic_companies' ); ?>

		<?php do_settings_sections( 'pronamic_companies' ); ?>

		<?php submit_button(); ?>
	</form>

	<div style="margin-bottom: 20px;">
		<?php Pronamic_Companies_Plugin_Admin::include_file( 'plugins.php' ); ?>
	</div>

	<div style="margin-bottom: 20px;">
		<?php Pronamic_Companies_Plugin_Admin::include_file( 'pronamic.php' ); ?>
	</div>
</div>
