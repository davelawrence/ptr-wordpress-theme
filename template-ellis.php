<?php
/**
* Template Name:  Ellis Presents
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package Peter_Thompson
*/
get_header(); ?>
<?php if( have_rows('page_content') ): ?>
<?php while( have_rows('page_content') ): the_row(); 
$title = get_sub_field('title');
$content = get_sub_field('content');
?>
<section class="elis-main" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1><?php echo $title;?></h1>
				<?php echo $content;?>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="explore">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-flex align-items-center justify-content-between">
					<?php $ptitle = get_field('properties_title');?>
					<h2><?php echo $ptitle;?></h2>
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
		<div class="row row-cols-lg-3  row-cols-md-1 row-cols-1 mt-5 g-4">
			<?php 
	$args = array( 'post_type' => 'ellis-presents', 'posts_per_page' => -1 );  $the_query = new WP_Query( $args ); 
			?>
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="col">
				<a href="<?php the_permalink();?>" class="card">
					<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<img src="<?php echo $thumb['0'];?>" class="card-img-top" />
					<div class="card-body">
						<div class="date"><?php echo get_the_date('M d, Y'); ?></div>
						<h3><?php the_title();?></h3>
						<div class="shortIntro">
							<?php $short_content =  get_field('short_content');?>
							<?php echo $short_content;?>
						</div>
						<hr />
						<p class="btn-link">Read More <img src="<?php echo get_template_directory_uri();?>/assets/img/arrow-right-grey.svg"></p>
					</div>
				</a>
			</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
			<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
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