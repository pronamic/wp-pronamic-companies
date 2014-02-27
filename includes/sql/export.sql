SELECT
	post.ID , 
	post.post_title , 
	MAX(IF(meta.meta_key = "_pronamic_company_address", meta.meta_value, NULL)) AS company_address  , 
	MAX(IF(meta.meta_key = "_pronamic_company_postal", meta.meta_value, NULL)) AS company_postal , 
	MAX(IF(meta.meta_key = "_pronamic_company_city", meta.meta_value, NULL)) AS company_city , 
	MAX(IF(meta.meta_key = "_pronamic_company_country", meta.meta_value, NULL)) AS company_country , 
	MAX(IF(meta.meta_key = '_pronamic_company_kvk_establishment', meta.meta_value, NULL)) AS kvk_establishment ,
	MAX(IF(meta.meta_key = '_pronamic_company_kvk_number', meta.meta_value, NULL)) AS kvk_number ,
	MAX(IF(meta.meta_key = '_pronamic_company_tax_number', meta.meta_value, NULL)) AS tax_number ,
	MAX(IF(meta.meta_key = "_pronamic_company_phone_number", meta.meta_value, NULL)) AS company_phone_number , 
	MAX(IF(meta.meta_key = "_pronamic_company_fax_number", meta.meta_value, NULL)) AS company_fax_number , 
	MAX(IF(meta.meta_key = "_pronamic_company_email", meta.meta_value, NULL)) AS company_email , 
	MAX(IF(meta.meta_key = "_pronamic_company_website", meta.meta_value, NULL)) AS company_website 
FROM
	wp_posts AS post
		LEFT JOIN
	wp_postmeta AS meta
			ON post.ID = meta.post_id
WHERE
	post_type = "pronamic_company"
GROUP BY
	post.ID
;

-- 
-- http://stackoverflow.com/questions/8058670/mysql-rows-to-columns-join-statement-problems
-- http://www.artfulsoftware.com/infotree/queries.php#77
-- 