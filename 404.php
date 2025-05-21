<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Peter_Thompson
 */

get_header();
?>
<section class="textinfo">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-12  text-center  col-md-12 col-12">
				<h1>404</h1>
			</div>
			<div class="col-lg-12 text-center col-md-12 col-12">
				<?php $ptitle = get_field('404_page_title','option');?>
				<h1>
					<?php echo $ptitle;?>
				</h1>
				<?php if( have_rows('404_button', 'option') ): ?>
				<?php while( have_rows('404_button', 'option') ): the_row(); ?>
				<a href="<?php the_sub_field('button_url'); ?>" class="btn-default"><?php the_sub_field('button_text'); ?></a>
				<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
