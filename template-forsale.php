<?php
/**
 * Template Name:  Home For Sale
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Peter_Thompson
 */
get_header(); ?>
<?php if( have_rows('banner') ): ?>
<?php while( have_rows('banner') ): the_row();
$title = get_sub_field('title');
$content = get_sub_field('content');
$button_text = get_sub_field('button_text');
$button_url = get_sub_field('button_url');
?>
<section class="banner-new">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5 col-md-5 col-12">
				<h2><?php echo $title;?></h2>
				<?php echo $content;?>
				<a href="<?php echo $button_url;?>" class="btn-default"><?php echo $button_text;?></a>
			</div>
			<div class="col-lg-7 col-md-7 col-12">
				<div class="row banner-imgs">
					<div class="col-lg-6 col-md-6 col-12">
						<?php if( have_rows('images') ): ?>
						<?php $icounter = 1;?>
						<?php while( have_rows('images') ): the_row();
						$image = get_sub_field('image');
						?>
						<img src="<?php echo $image;?>">
						<?php if($icounter%2==0) { ?>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<?php } ?>
						<?php $icounter++;?>
						<?php endwhile;?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>

<?php if( have_rows('for_sale') ): ?>
	<?php while( have_rows('for_sale') ): the_row();
	$code = get_sub_field('municipality_code');
	$title = get_sub_field('title');
	$button_text = get_sub_field('button_text');
	$button_url = get_sub_field('button_url');
	?>
		<section class="explore propeties-section newpage">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="d-flex align-items-center justify-content-between">
							<h2><?php echo $title;?></h2>
							<a href="<?php echo $button_url;?>" class="btn-default"><?php echo $button_text;?></a>
						</div>
					</div>
				</div>
				<div class="row row-cols-md-3 row-cols-1 mt-5">
					<?= do_shortcode('[properties template="homesale" limit="6" order="rand" status="EV" municipalities="' . $code . '"]'); ?>
				</div>
			</div>
		</section>
	<?php endwhile;?>
<?php endif;?>

<?php if( have_rows('finding_dream') ): ?>
<?php while( have_rows('finding_dream') ): the_row();
$title = get_sub_field('title');
$content = get_sub_field('content');
$button_text = get_sub_field('button_text');
$button_url = get_sub_field('button_url');
?>
<section class="finding-dreams">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
					<p><?php echo $content;?></p>
				</div>
				<?php if( have_rows('points') ): ?>
				<?php $pcounter = 1;?>
				<?php while( have_rows('points') ): the_row();
				$content = get_sub_field('content');
				$image = get_sub_field('image');
				$title = get_sub_field('title');
				?>
				<div class="dream-card">
					<div class="img">
						<img src="<?php echo $image;?>" alt="" />
					</div>
					<div class="text">
						<h3><?php echo $pcounter;?>. <?php echo $title;?></h3>
						<p><?php echo $content;?></p>
					</div>
				</div>
				<?php if($pcounter==2) { ?>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<?php } ?>
				<?php $pcounter++;?>
				<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<a href="<?php echo $button_url;?>" class="btn-default"><?php echo $button_text;?></a>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="reviews newpage" data-aos="fade-up" data-aos-delay="200">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 pe-0">
				<div class="owl-carousel owl-theme reviews-carousel">
					<?php if( have_rows('testimonials') ): ?>
					<?php while( have_rows('testimonials') ): the_row();
					$name = get_sub_field('name');
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$content = get_sub_field('content');
					$location = get_sub_field('location');
					?>
					<div class="item">
						<div class="card">
							<div class="rating-text">
								<h2><?php echo $title;?></h2>
								<p><?php echo $content;?></p>
							</div>
							<div class="d-flex profile align-items-center">
								<div class="profile-details d-flex align-items-center">
									<img src="<?php echo $image;?>" />
									<div>
										<h6><?php echo $name;?></h6>
										<span><?php echo $location;?></span>
									</div>
								</div>
							</div>
							<div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
						</div>
					</div>
					<?php endwhile;?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if( have_rows('statistics') ): ?>
<?php while( have_rows('statistics') ): the_row();
$image = get_sub_field('image');
$title = get_sub_field('title');
$content = get_sub_field('content');
?>
<section class="latest-real" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-6 col-12">
				<img src="<?php echo $image;?>" />
			</div>
			<div class="col-lg-5 ms-auto col-md-5 col-12">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
					<p><?php echo $content;?></p>
				</div>
				<div class="row">
					<?php if( have_rows('numbers') ): ?>
					<?php while( have_rows('numbers') ): the_row();
					$number = get_sub_field('number');
					$title = get_sub_field('title');
					?>
					<div class="col-lg-6 col-md-6 col-6">
						<div class="stats"><?php echo $number;?></div>
						<h3><?php echo $title;?></h3>
					</div>
					<?php endwhile;?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<?php if( have_rows('offer') ): ?>
<?php while( have_rows('offer') ): the_row();
$content = get_sub_field('content');
$image = get_sub_field('image');
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$full_width_content = get_sub_field('full_width_content');
?>
<section class="learn-about" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center col-md-12 col-12">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
					<p><?php echo $sub_title;?></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 pe-lg-5 col-md-6 col-12">
				<?php echo $content;?>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<img class="imgstyle w-100" src="<?php echo $image;?>" />
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-12">
			<?php echo $full_width_content;?>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<?php 
$related_post = get_field('select_member');

if ($related_post):
$image = get_field('image', $related_post->ID);
$bio = get_field('bio', $related_post->ID);
$designation = get_field('designation', $related_post->ID);
$phone = get_field('phone', $related_post->ID);
$email = get_field('email', $related_post->ID);
?>
<section class="about-john" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-4 ps-lg-5 col-md-5 col-12">
				<div class="img">
					<img src="<?php echo $image;?>" />
				</div>
			</div>
			<div class="col-lg-8 col-md-7 col-12">
				<div class="section-title">
					<?php echo $bio;?>
					<h2><?php echo esc_html($related_post->post_title); ?></h2>
					<?php if($designation){?>
					<div class="icons  first ">
						<img src="<?php echo home_url();?>/wp-content/uploads/2025/02/icon-location-dark.png.webp" alt=""> <a href="#"><?php echo $designation;?></a>
					</div>
					<?php } ?>
					<?php if($phone){?>
					<div class="icons ">
						<img src="<?php echo home_url();?>/wp-content/uploads/2025/02/icon-call.svg" alt=""> <a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a>
					</div>
					<?php } ?>
					<?php if($email){?>
					<div class="icons ">
						<img src="<?php echo home_url();?>/wp-content/uploads/2025/02/icon-email.svg" alt=""> <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if( have_rows('widget') ): ?>
<?php while( have_rows('widget') ): the_row();
$content = get_sub_field('content');
$title = get_sub_field('title');
?>
<section class="contact-info" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 bg col-md-12 col-12">
				<div class="row align-items-center">
					<div class="col-lg-5 col-md-6 col-12">
						<div class="section-title white">
							<h2><?php echo $title;?></h2>
							<p><?php echo $content;?></p>
							<?php if( have_rows('contact_details') ): ?>
							<?php while( have_rows('contact_details') ): the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$value = get_sub_field('value');
							$url = get_sub_field('url');
							?>
							<div class="icon-card">
								<img src="<?php echo $icon;?>" alt="" />
								<div>
									<h5><?php echo $title;?><br/><a href="<?php echo $url;?>"><?php echo $value;?></a></h5>
								</div>
							</div>
							<?php endwhile;?>
							<?php endif;?>
						</div>
					</div>
					<div class="col-lg-7 col-md-6 col-12">
						<div class="bg-white">
							<?php echo do_shortcode('[contact-form-7 id="c46ff31" title="Home for Sale Form"]');?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<?php if( have_rows('review') ): ?>
<?php while( have_rows('review') ): the_row();
$image = get_sub_field('image');
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
?>
<section class="review-statics" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 text-center col-md-12 col-12">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
					<p><?php echo $sub_title;?></p>
				</div>
			</div>
			<div class="col-lg-11 text-center col-md-12 col-12">
				<img src="<?php echo $image;?>" class="w-100 radius" />
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="explore article">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<?php $atitle = get_field('articles_title');?>
					<h2><?php echo $atitle?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="owl-carousel owl-theme article-carousel">
					<?php
	// Get the selected category from the ACF field on the current page
	$selected_category = get_field('select_post_category'); 

						if ($selected_category): // Ensure a category is selected
						$args = array(
							'post_type'      => 'post',  // Adjust if you're using a custom post type
							'posts_per_page' => 10,      // Limit to 10 posts
							'tax_query'      => array(
								array(
									'taxonomy' => 'category', // Change if using a custom taxonomy
									'field'    => 'term_id',
									'terms'    => $selected_category->term_id, // Get category ID from ACF
								),
							),
						);

						$query = new WP_Query($args);

						if ($query->have_posts()): 
						while ($query->have_posts()): $query->the_post(); 
					?>
					<div class="item">
						<a href="<?php the_permalink();?>" class="card">
							
							<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
							<?php if ( has_post_thumbnail() ) {?>
							<img src="<?php echo $thumb['0'];?>" class="card-img-top" />
							<?php } ?>
							<div class="card-body">
								<h3><?php the_title();?></h3>
								<hr />
								<p class="btn-link d-flex align-items-center">
									<?php
									$categories = get_the_category();
									
									?>
									<?php echo $categories[0]->name;?>
									<span class="ms-auto"><?php echo get_the_date(); ?></span>
								</p>
							</div>
						</a>
					</div>
					<?php 
					endwhile; 
					wp_reset_postdata(); 
					else:
					echo "<p>No posts found for the selected category.</p>";
					endif; 

					else:
					echo "<p>No category selected.</p>";
					endif;
					?>
				</div>
			</div>
			<div class="col-12 text-end">
				<div class="custom-nav"></div>
			</div>
		</div>
	</div>
</section>
<?php if( have_rows('faqs') ): ?>
<?php while( have_rows('faqs') ): the_row();
$title = get_sub_field('title');
?>
<section class="faq">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center col-md-12 col-12">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-12 col-12">
				<div class="accordion" id="accordionExample">
					<?php if( have_rows('faq') ): ?>
					<?php $fcounter = 1;?>
					<?php while( have_rows('faq') ): the_row();
					$question = get_sub_field('question');
					$answer = get_sub_field('answer');
					?>
					<div class="accordion-item">
						<div class="accordion-header">
							<button class="accordion-button <?php if($fcounter==1){?> <?php } else { ?> collapsed<?php } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $fcounter;?>" aria-expanded="true" aria-controls="collapse<?php echo $fcounter;?>">
								<h3><span><?php echo $fcounter;?>.</span> <?php echo $question;?></h3>
							</button>
						</div>
						<div id="collapse<?php echo $fcounter;?>" class="accordion-collapse collapse <?php if($fcounter==1){?> show <?php } ?>" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<?php echo $answer;?>
							</div>
						</div>
					</div>
					<?php $fcounter++;?>
					<?php endwhile;?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<?php if( have_rows('nearby_cities') ): ?>
<?php while( have_rows('nearby_cities') ): the_row();
$title = get_sub_field('title');
?>
<section class="nearby-cities">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center col-md-12 col-12">
				<div class="section-title white">
					<h2><?php echo $title;?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if( have_rows('cities') ): ?>
			<?php while( have_rows('cities') ): the_row();
			$title = get_sub_field('title');
			?>
			<div class="col-lg-5 col-md-8 col-12">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<h3><?php echo $title;?></h3>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<ul>
							<?php if( have_rows('city') ): ?>
							<?php $ccounter = 1;?>
							<?php while( have_rows('city') ): the_row();
							$name = get_sub_field('name');
							$url = get_sub_field('url');
							?>
							<li><a href="<?php echo $url;?>"><?php echo $name;?></a></li>
							<?php if($ccounter==13) { ?>
						</ul>
					</div>
					<div class="col-lg-6 col-md-6 col-12">
						<ul>
							<?php } ?>
							<?php $ccounter++;?>
							<?php endwhile;?>
							<?php endif;?>
						</ul>
					</div>
				</div>
			</div>
			<?php endwhile;?>
			<?php endif;?>
			<?php if( have_rows('west_island_cities') ): ?>
			<?php while( have_rows('west_island_cities') ): the_row();
			$title = get_sub_field('title');
			?>
			<div class="col-lg-3 col-md-4 col-12">
				<h3><?php echo $title;?></h3>
				<ul>
					<?php if( have_rows('city') ): ?>
					<?php $ccounter = 1;?>
					<?php while( have_rows('city') ): the_row();
					$name = get_sub_field('name');
					$url = get_sub_field('url');
					?>
					<li><a href="<?php echo $url;?>"><?php echo $name;?></a></li>
					<?php endwhile;?>
					<?php endif;?>
				</ul>
			</div>
			<?php endwhile;?>
			<?php endif;?>
			<?php if( have_rows('cta') ): ?>
			<?php while( have_rows('cta') ): the_row();
			$image = get_sub_field('image');
			$title = get_sub_field('title');
			$content = get_sub_field('content');
			$button_text = get_sub_field('button_text');
			$button_url = get_sub_field('button_url');
			?>
			<div class="col-lg-4 align-self-center col-md-12 col-12">
				<div class="small-card">
					<img src="<?php echo $image;?>" />
					<h3><?php echo $title;?></h3>
					<p><?php echo $content;?></p>
					<a href="<?php echo $button_url;?>" class="btn-default"><?php echo $button_text;?></a>
				</div>
			</div>
			<?php endwhile;?>
			<?php endif;?>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="small-card-info">
	<div class="container">
		<div class="row">
			<?php if( have_rows('cta') ): ?>
			<?php $bcounter = 1;?>
			<?php while( have_rows('cta') ): the_row();
			$title = get_sub_field('title');
			$content = get_sub_field('content');
			$button_text = get_sub_field('button_text');
			$button_url = get_sub_field('button_url');
			?>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="small-card <?php if($bcounter%2==0){?> <?php } else { ?> blue <?php } ?>">
					<h3><?php echo $title;?></h3>
					<p><?php echo $content;?></p>
					<a href="<?php echo $button_url;?>" class="btn-default"><?php echo $button_text;?></a>
				</div>
			</div>
			<?php $bcounter++;?>
			<?php endwhile;?>
			<?php endif;?>
		</div>
	</div>
</section>
<?php
get_footer();