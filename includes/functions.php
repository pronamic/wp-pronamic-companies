<?php

function pronamic_company_get_meta( $meta_key, $post_id = null, $single = true ) {
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

	return get_post_meta( $post_id, $meta_key, $single );
}

function pronamic_company_has_meta( $meta_key, $post_id = null, $single = true ) {
	$value = pronamic_company_get_meta( $meta_key, $post_id, $single );

	return ! empty( $value );
}
