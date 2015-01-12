<?php

function pronamic_companies_upgrade_110() {
	global $wpdb;

	// Taxonomies
	$taxonomies = get_option( 'pronamic_companies_taxonomies', false );

	if ( false === $taxonomies ) {
		$query = "SELECT DISTINCT( taxonomy ) FROM $wpdb->term_taxonomy WHERE taxonomy LIKE 'pronamic_company_%';";

		$results = $wpdb->get_results( $query );

		$taxonomies = array();

		foreach ( $results as $result ) {
			$taxonomies[] = $result->taxonomy;
		}

		update_option( 'pronamic_companies_taxonomies', $taxonomies );
	}
}
