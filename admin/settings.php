<?php 

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
	
	<?php Pronamic_Companies_Plugin::admin_include( 'plugins.php' ); ?>	
	<?php Pronamic_Companies_Plugin::admin_include( 'pronamic.php' ); ?>
</div>