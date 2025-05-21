<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Peter_Thompson
 */

get_header();
?>
<section class="blogdetals">
	<div class="container">
		<div class="row align-items-center pb-2" data-aos="fade-up" data-aos-delay="200">
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			<?php if ( has_post_thumbnail() ) {?> 
			<div class="col-lg-7 order-lg-2 blogimg ms-auto col-md-12 col-12">
				<img src="<?php echo $thumb['0'];?>" alt="" />
			</div>
			<?php } ?>
			<div class="col-lg-5 order-lg-1 col-md-12 col-12">
				<h6><?php echo get_the_date('M d, Y'); ?></h6>
				<?php
				if ( function_exists('yoast_breadcrumb') ) {
				  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				}
				?>
				<h1><?php the_title();?></h1>
				<?php $short_content = get_field('short_content');?>
				<?php echo $short_content;?>
			</div>
		</div>
	</div>
</section>
<section class="blogmiddle">
	<div class="container">
		<div class="row justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
			<div class="col-lg-7 spbottom col-md-12 col-12">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php
// grab the raw URL from ACF
$video_url = get_field('video_code');

if ( $video_url ) {
    // this will generate the correct <iframe> (and WP’s internal cache helps performance)
    echo '<div class="video-embed" style="border-radius:15px;overflow:hidden;">'
       . wp_oembed_get( esc_url($video_url) )
       . '</div>';
}

$top_content = get_field('top_content');
echo $top_content;
?>


<?php the_content(); ?>

				<?php endwhile; endif; ?>

				<hr/>
				<?php if( have_rows('about_youtube', 'option') ): ?>
					<?php while( have_rows('about_youtube', 'option') ): the_row(); ?>
						<?php the_sub_field('content'); ?>
						<a href="<?php the_sub_field('url'); ?>" target="_blank" class="blog_content_footer_yt w-inline-block">
							<div class="footer_yt-image">
								<img src="<?php the_sub_field('image'); ?>" loading="lazy" alt="" class="image-full-width">
							</div>
							<div class="footer_yt-text-button">
								<p class="text-size-16"><?php the_sub_field('name'); ?></p>
								<div class="footer_yt-button"></div>
							</div>
						</a>
					<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

<section class="explore innerblog">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-flex align-items-center justify-content-between">
					<?php $ptitle = get_field('posts_title','option'); ?>
					<h2><?php echo $ptitle; ?></h2>
				</div>
			</div>
		</div>
		<div class="row row-cols-lg-3 row-cols-md-1 row-cols-1 mt-5">
			<?php
			$current_post_id = get_the_ID();
			$current_lang = apply_filters( 'wpml_current_language', null );

			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post__not_in'   => array( $current_post_id ),
				'orderby'        => 'date',
				'order'          => 'DESC',
				'lang'           => $current_lang,
			);

			$latest_posts = new WP_Query( $args );

			if ( $latest_posts->have_posts() ) :
				while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
					<div class="col">
						<a href="<?php the_permalink();?>" class="card">
							<div class="img">
								<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="card-img-top" />
							</div>
							<div class="card-body">
								<div class="date"><?php echo get_the_date('M d, Y'); ?></div>
								<h3><?php the_title();?></h3>
								<?php the_excerpt();?>
								<hr />
								<p class="btn-link">
									<?php echo (ICL_LANGUAGE_CODE == 'fr') ? 'Lire la suite' : 'Read More'; ?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
								</p>
							</div>
						</a>
					</div>
				<?php endwhile;
				wp_reset_postdata();
			endif;
			?>
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
