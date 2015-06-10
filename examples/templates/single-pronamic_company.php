<?php get_header(); ?>

<div>

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				
				<dl>
					<dt><?php esc_html_e( 'Contact', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_contact(); ?></dd>
					
					<dt><?php esc_html_e( 'Address', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_address(); ?></dd>
					
					<dt><?php esc_html_e( 'Postal Code', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_postal_code(); ?></dd>
					
					<dt><?php esc_html_e( 'City', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_city(); ?></dd>
					
					<dt><?php esc_html_e( 'KvK Establishment', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_kvk_establishment(); ?></dd>
					
					<dt><?php esc_html_e( 'KvK Number', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_kvk_number(); ?></dd>
					
					<dt><?php esc_html_e( 'Tax number', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_tax_number(); ?></dd>
					
					<dt><?php esc_html_e( 'Phone Number', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_phone_number(); ?></dd>
					
					<dt><?php esc_html_e( 'Fax Number', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_fax_number(); ?></dd>
					
					<dt><?php esc_html_e( 'Email', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_email(); ?></dd>
					
					<dt><?php esc_html_e( 'Website', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_website(); ?></dd>
					
					<dt><?php esc_html_e( 'Twitter', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_twitter(); ?></dd>
					
					<dt><?php esc_html_e( 'Facebook', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_facebook(); ?></dd>
					
					<dt><?php esc_html_e( 'LinkedIN', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_linkedin(); ?></dd>
					
					<dt><?php esc_html_e( 'Google+', 'textdomain' ); ?></dt>
					<dd><?php pronamic_company_the_google_plus(); ?></dd>
				</dl>
			</div>
		</article>
	
	<?php endwhile; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
