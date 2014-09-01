-- Post type - Company

UPDATE
	wp_posts
SET
	post_type = 'pronamic_company'
WHERE
	post_type = 'company'
;

-- Taxonomy - Character
UPDATE
	wp_term_taxonomy
SET
	taxonomy = 'pronamic_company_character'
WHERE 
	taxonomy = 'character'
;

-- Taxonomy - Character
UPDATE
	wp_term_taxonomy
SET
	taxonomy = 'pronamic_company_category'
WHERE 
	taxonomy = 'company_tag'
;

-- Taxonomy - Tag
UPDATE
	wp_term_taxonomy
SET
	taxonomy = 'pronamic_company_category'
WHERE 
	taxonomy = 'company_category'
;

-- Taxonomy - Region
UPDATE
	wp_term_taxonomy
SET
	taxonomy = 'pronamic_company_region'
WHERE 
	taxonomy = 'region'
;

-- Meta - Address
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_address'
WHERE 
	meta_key = '_emg_company_address'
;

-- Meta - Postal Code
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_postal_code'
WHERE 
	meta_key = '_emg_company_postal_code'
;

-- Meta - City
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_city'
WHERE 
	meta_key = '_emg_company_city'
;

-- Meta - Country
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_country'
WHERE 
	meta_key = '_emg_company_country'
;

-- Meta - Phone number
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_phone_number'
WHERE 
	meta_key = '_emg_company_telephone_number'
;

-- Meta - Fax number
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_fax_number'
WHERE 
	meta_key = '_emg_company_fax_number'
;

-- Meta - Website
UPDATE
	wp_postmeta
SET
	meta_key = '_pronamic_company_website'
WHERE 
	meta_key = '_emg_company_url'
;










