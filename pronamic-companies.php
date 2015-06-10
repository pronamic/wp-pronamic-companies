<?php
/*
Plugin Name: Pronamic Companies
Plugin URI: http://www.pronamic.eu/plugins/pronamic-companies/
Description: This plugin adds a basic company directory functionality to WordPress.

Version: 1.1.1
Requires at least: 3.0

Author: Pronamic
Author URI: http://www.pronamic.eu/

Text Domain: pronamic_companies
Domain Path: /languages/

License: GPL

GitHub URI: https://github.com/pronamic/wp-pronamic-companies
*/

foreach ( glob( plugin_dir_path( __FILE__ ) . 'includes/class-*.php' ) as $file ) {
	include_once $file;
}

global $pronamic_companies_plugin;

$pronamic_companies_plugin = new Pronamic_Companies_Plugin( __FILE__ );
