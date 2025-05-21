<?php
/**
* Template Name:  Contact
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
?>
<section class="page-banner" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10 col-12">
				<h1><?php echo $title;?></h1>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="contact-form" data-aos="fade-up" data-aos-delay="200">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10 col-12">
				<?php if( have_rows('page_content') ): ?>
				<?php while( have_rows('page_content') ): the_row(); 
				$content = get_sub_field('content');
				?>
				<?php echo $content;?>
				<?php endwhile;?>
				<?php endif;?>
				<p>&nbsp;</p>
				<?php echo do_shortcode('[contact-form-7 id="62fc9e3" title="Contact Page"]');?>
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