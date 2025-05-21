<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Peter_Thompson
 */

get_header();
?>
<section class="informed-consumers askpere" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row ins pb-2">
			<div class="col-lg-6 col-md-12 col-12">
				<?php $btitle = get_field('blog_page_title','option');?>
				<h1><?php echo $btitle;?></h1>
			</div>
			<div class="col-lg-5 ms-auto col-md-12 col-12">
				<?php $bcontent = get_field('blog_page_content','option');?>
				<?php echo $bcontent;?>
			</div>
		</div>
		<?php 
		$args = array( 'post_type' => 'post', 'posts_per_page' => 1, 'post_status' => 'publish' );
		$the_query = new WP_Query( $args ); 
		?>
		<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div class="row mt-5">
			<a href="<?php the_permalink();?>" class="d-flex align-items-center justify-content-between info-card-link">
				<div class="col-lg-8 col-md-12 col-12 order-lg-2">
					<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<img src="<?php echo $thumb['0'];?>" class="border-24" />
				</div>
				<div class="col-lg-4 col-md-12 col-12 order-lg-1">
					<div class="info-card">
						<h2><?php the_title();?></h2>
						<?php the_excerpt();?>
						<hr />
						<div class="info-details justify-content-between d-flex">
							<p><?php echo get_the_date('M d, Y'); ?></p>
							<div class="btn-link" href="<?php the_permalink();?>"><p><?php if (ICL_LANGUAGE_CODE == 'en'): ?>Read More <?php else : ?>Lire la suite <?php endif; ?> <img src="<?php echo get_template_directory_uri();?>/assets/img/arrow-right-grey.svg"></p></div>
						</div>
					</div>
				</div>

			</a>
		</div>
		<?php endwhile;
		wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</section>
<section class="latestpost">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 small-text-center col-md-6 col-12">
				<?php $ptitle = get_field('posts_title','option');?>
				<h2><?php echo $ptitle;?></h2>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12">

					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<div class="position-relative">
							<form role="search" method="get"  action="<?php echo home_url( '/' ); ?>">
								<input class="form-control search" type="search"
									   placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
									   value="<?php echo get_search_query() ?>" name="s"
									   title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
								<div class="search_icon"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row sppr">
			<?php global $count;?>
			<?php $count = 0;?>
			<?php
			if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
			the_post(); $count++;

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			// the_posts_navigation();

			else :

			get_template_part( 'template-parts/content', 'none' );

			endif;
			?>


		</div>
		<div class="row mt-2 mb-4">
			<div class="col text-center">
				<?php wpbeginner_numeric_posts_nav(); ?>
			</div>
		</div>
	</div>
</section>
<section class="foot-cta" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="cta-wrapper">
 			<div class="row align-items-center justify-content-between justify-content-md-center">
				<div class="col-lg-5 col-md-10 col-12  ">
					<?php $wtitle = get_field('widget_title','option');?>
					<h2><?php echo $wtitle;?></h2>
				</div>
				<div class="col-lg-6 col-md-12 col-12">
					<div class="d-flex justify-content-between">
						<?php $phone = get_field('phone','option');?>
						<?php if($phone){?>
						<a href="tel:<?php echo $phone;?>" class="btn-default btn-white"><i class="fa fa-bookmark-o"></i> <?php echo $phone;?></a>
						<?php } ?>
						<?php $email = get_field('email','option');?>
						<?php if($email){?>
						<a href="mailto:<?php echo $email;?>" class="btn-default btn-white"><b><i class="fa fa-chevron-left"></i> <?php echo $email;?></b></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
