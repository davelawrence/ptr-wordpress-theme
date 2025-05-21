<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Peter_Thompson
 */

get_header();
?>
<section class="informed-consumers askpere" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row ins pb-2">
			<div class="col-lg-6 col-md-6 col-12">
				<h2><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'peter-thompson' ), '<span>' . get_search_query() . '</span>' );
					?></h2>
			</div>
		</div>
	</div>
</section>
<section class="latestpost">
	<div class="container">
		<div class="row sppr">

			<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
			the_post();

			/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
			get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

			else :

			get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>
	</div>
</section>
<?php
get_footer();
