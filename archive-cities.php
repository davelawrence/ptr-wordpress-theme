<?php
/**
 * The template for displaying archive pages
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
            <div class="col-lg-6 col-md-6 col-12">
                <h1><?php the_archive_title(); ?></h1>
                <?php if ( the_archive_description() ) : ?>
                    <p class="archive-subtitle"><?php the_archive_description(); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-5 ms-auto col-md-6 col-12">
                <!-- Additional content if needed -->
            </div>
        </div>
    </div>
</section>

<section class="latestpost">
	<div class="container">
		<div class="row sppr">
			<?php global $count;?>
			<?php $count = 0;?>

			<?php
			// Fetch all posts from the custom post type "cities"
			$args = array(
  			 'post_type' => 'cities', // Specify the custom post type
   			 'posts_per_page' => -1, // Fetch all posts
);
$query = new WP_Query($args);

if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post(); 
        get_template_part( 'template-parts/content', get_post_type() ); 
    endwhile; 
endif; 

// Reset post data
wp_reset_postdata();
?>



	</div>
</section>
<section class="foot-cta" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="cta-wrapper">
			<div class="row align-items-center justify-content-between">
				<div class="col-lg-5 col-md-5 col-12">
					<?php $wtitle = get_field('widget_title','option');?>
					<h2><?php echo $wtitle;?></h2>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
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
