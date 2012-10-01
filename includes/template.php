<?php

/**
 * Get the company address
 * 
 * @return string
 */
function pronamic_company_get_address( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_address', true );
}

/**
 * Check if company has address
 */
function pronamic_company_has_address( $post_id = null ) {
	$address = pronamic_company_get_address( $post_id );

	return !empty( $address );
}

/**
 * Output the company address
 */
function pronamic_company_the_address( $post_id = null ) {
	echo pronamic_company_get_address( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company postal code
 * 
 * @return string
 */
function pronamic_company_get_postal_code( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_postal_code', true );
}

/**
 * Check if company has postal code
 */
function pronamic_company_has_postal_code( $post_id = null ) {
	$postal_code = pronamic_company_get_postal_code( $post_id );

	return !empty( $postal_code );
}

/**
 * Output the company postal code
 */
function pronamic_company_the_postal_code( $post_id = null ) {
	echo pronamic_company_get_postal_code( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company city
 * 
 * @return string
 */
function pronamic_company_get_city( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_city', true );
}

/**
 * Check if company has city
 */
function pronamic_company_has_city( $post_id = null ) {
	$city = pronamic_company_get_city( $post_id );

	return !empty( $city );
}

/**
 * Output the company city
 */
function pronamic_company_the_city( $post_id = null ) {
	echo pronamic_company_get_city( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company phone number
 * 
 * @return string
 */
function pronamic_company_get_phone_number( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_phone_number', true );
}

/**
 * Check if company has phone number
 */
function pronamic_company_has_phone_number( $post_id = null ) {
	$phone_number = pronamic_company_get_phone_number( $post_id );

	return !empty( $phone_number );
}

/**
 * Output the company phone number
 */
function pronamic_company_the_phone_number( $post_id = null ) {
	echo pronamic_company_get_phone_number( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company fax number
 * 
 * @return string
 */
function pronamic_company_get_fax_number( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_fax_number', true );
}

/**
 * Check if company has fax number
 */
function pronamic_company_has_fax_number( $post_id = null ) {
	$fax_number = pronamic_company_get_phone_number( $post_id );

	return !empty( $fax_number );
}

/**
 * Output the company phone number
 */
function pronamic_company_the_fax_number( $post_id = null ) {
	echo pronamic_company_get_fax_number( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company email
 * 
 * @return string
 */
function pronamic_company_get_email( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_email', true );
}

/**
 * Check if company has email
 */
function pronamic_company_has_email( $post_id = null ) {
	$email = pronamic_company_get_email( $post_id );

	return !empty( $email );
}

/**
 * Output the company email
 */
function pronamic_company_the_email( $post_id = null ) {
	echo pronamic_company_get_email( $post_id );
}

//////////////////////////////////////////////////

/**
 * Get the company website
 * 
 * @return string
 */
function pronamic_company_get_website( $post_id = null ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, '_pronamic_company_website', true );
}

/**
 * Check if company has website
 */
function pronamic_company_has_website( $post_id = null ) {
	$website = pronamic_company_get_website( $post_id );

	return !empty( $website );
}

/**
 * Output the company website
 */
function pronamic_company_the_website( $post_id = null ) {
	echo pronamic_company_get_website( $post_id );
}

//////////////////////////////////////////////////

