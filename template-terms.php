<?php
/**
* Template Name: Terms
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package Peter_Thompson
*/
get_header(); ?>
<section class="textinfo terms">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-12 col-md-12 col-12">
				<?php $ptitle = get_field('page_title');?>
				<h1><?php echo $ptitle;?></h1>
				<?php $pcontent = get_field('page_content');?>
				<?php echo $pcontent;?>
			</div>
			<div class="col-lg-12 mt-5 mb-5 col-md-12 col-12">
				<?php echo do_shortcode('[ez-toc]');?>
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