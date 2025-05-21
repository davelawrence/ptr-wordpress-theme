<?php
/**
* Template Name: Privacy Policy
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package Peter_Thompson
*/
get_header(); ?>
<section class="textinfo">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-12 col-md-12 col-12">
				<?php $ptitle = get_field('page_title');?>
				<h1><?php echo $ptitle;?></h1>
			</div>
			<div class="col-lg-12 col-md-12 col-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; else: ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();