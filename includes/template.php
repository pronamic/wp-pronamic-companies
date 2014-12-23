<?php

function pronamic_company_get_contact( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_contact', $post_id );
}

function pronamic_company_the_contact( $post_id = null ) {
	echo esc_html( pronamic_company_get_contact( $post_id ) );
}

/**
 * Get the company address
 *
 * @return string
 */
function pronamic_company_get_address( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_address', $post_id );
}

/**
 * Check if company has address
 */
function pronamic_company_has_address( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_address', $post_id );
}

/**
 * Output the company address
 */
function pronamic_company_the_address( $post_id = null ) {
	echo esc_html( pronamic_company_get_address( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company postal code
 *
 * @return string
 */
function pronamic_company_get_postal_code( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_postal_code', $post_id );
}

/**
 * Check if company has postal code
 */
function pronamic_company_has_postal_code( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_postal_code', $post_id );
}

/**
 * Output the company postal code
 */
function pronamic_company_the_postal_code( $post_id = null ) {
	echo esc_html( pronamic_company_get_postal_code( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company city
 *
 * @return string
 */
function pronamic_company_get_city( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_city', $post_id );
}

/**
 * Check if company has city
 */
function pronamic_company_has_city( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_city', $post_id );
}

/**
 * Output the company city
 */
function pronamic_company_the_city( $post_id = null ) {
	echo esc_html( pronamic_company_get_city( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company chamber of commerce establishment
 *
 * @return string
 */
function pronamic_company_get_kvk_establishment( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_kvk_establishment', $post_id );
}

/**
 * Check if company has chamber of commerce establishment
 */
function pronamic_company_has_kvk_establishment( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_kvk_establishment', $post_id );
}

/**
 * Output the company chamber of commerce establishment
 */
function pronamic_company_the_kvk_establishment( $post_id = null ) {
	echo esc_html( pronamic_company_get_kvk_establishment( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company chamber of commerce number
 *
 * @return string
 */
function pronamic_company_get_kvk_number( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_kvk_number', $post_id );
}

/**
 * Check if company has chamber of commerce number
 */
function pronamic_company_has_kvk_number( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_kvk_number', $post_id );
}

/**
 * Output the company chamber of commerce number
 */
function pronamic_company_the_kvk_number( $post_id = null ) {
	echo esc_html( pronamic_company_get_kvk_number( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company tax number
 *
 * @return string
 */
function pronamic_company_get_tax_number( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_tax_number', $post_id );
}

/**
 * Check if company has tax number
 */
function pronamic_company_has_tax_number( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_tax_number', $post_id );
}

/**
 * Output the company tax number
 */
function pronamic_company_the_tax_number( $post_id = null ) {
	echo esc_html( pronamic_company_get_tax_number( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company phone number
 *
 * @return string
 */
function pronamic_company_get_phone_number( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_phone_number', $post_id );
}

/**
 * Check if company has phone number
 */
function pronamic_company_has_phone_number( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_phone_number', $post_id );
}

/**
 * Output the company phone number
 */
function pronamic_company_the_phone_number( $post_id = null ) {
	echo esc_html( pronamic_company_get_phone_number( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company fax number
 *
 * @return string
 */
function pronamic_company_get_fax_number( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_fax_number', $post_id );
}

/**
 * Check if company has fax number
 */
function pronamic_company_has_fax_number( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_fax_number', $post_id );
}

/**
 * Output the company phone number
 */
function pronamic_company_the_fax_number( $post_id = null ) {
	echo esc_html( pronamic_company_get_fax_number( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company email
 *
 * @return string
 */
function pronamic_company_get_email( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_email', $post_id );
}

/**
 * Check if company has email
 */
function pronamic_company_has_email( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_email', $post_id );
}

/**
 * Output the company email
 */
function pronamic_company_the_email( $post_id = null ) {
	echo esc_html( pronamic_company_get_email( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company website
 *
 * @return string
 */
function pronamic_company_get_website( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_website', $post_id );
}

/**
 * Check if company has website
 */
function pronamic_company_has_website( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_website', $post_id );
}

/**
 * Output the company website
 */
function pronamic_company_the_website( $post_id = null ) {
	echo esc_html( pronamic_company_get_website( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company Twitter
 *
 * @return string
 */
function pronamic_company_get_twitter( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_twitter', $post_id );
}

/**
 * Check if company has Twitter
 */
function pronamic_company_has_twitter( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_twitter', $post_id );
}

/**
 * Output the company Twitter
 */
function pronamic_company_the_twitter( $post_id = null ) {
	echo esc_html( pronamic_company_get_twitter( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company Facebook
 *
 * @return string
 */
function pronamic_company_get_facebook( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_facebook', $post_id );
}

/**
 * Check if company has Facebook
 */
function pronamic_company_has_facebook( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_facebook', $post_id );
}

/**
 * Output the company Facebook
 */
function pronamic_company_the_facebook( $post_id = null ) {
	echo esc_html( pronamic_company_get_facebook( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company LinkedIN
 *
 * @return string
 */
function pronamic_company_get_linkedin( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_linkedin', $post_id );
}

/**
 * Check if company has Facebook
 */
function pronamic_company_has_linkedin( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_linkedin', $post_id );
}

/**
 * Output the company Facebook
 */
function pronamic_company_the_linkedin( $post_id = null ) {
	echo esc_html( pronamic_company_get_linkedin( $post_id ) );
}

//////////////////////////////////////////////////

/**
 * Get the company Google+
 *
 * @return string
 */
function pronamic_company_get_google_plus( $post_id = null ) {
	return pronamic_company_get_meta( '_pronamic_company_google_plus', $post_id );
}

/**
 * Check if company has Google+
 */
function pronamic_company_has_google_plus( $post_id = null ) {
	return pronamic_company_has_meta( '_pronamic_company_google_plus', $post_id );
}

/**
 * Output the company Google+
 */
function pronamic_company_the_google_plus( $post_id = null ) {
	echo esc_html( pronamic_company_get_google_plus( $post_id ) );
}
