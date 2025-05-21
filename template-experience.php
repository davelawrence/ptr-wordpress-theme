<?php
/**
* Template Name:  Experience
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
$image = get_sub_field('image');
$title = get_sub_field('title');
$content = get_sub_field('content');
?>
<section class="buysell-banner">
	<div class="container">
		<div class="row align-items-center pb-2 g-0" data-aos="fade-up" data-aos-delay="200">
			<div class="col-lg-6 text-center order-lg-2 order-md-1 col-md-12 col-12">
				<img src="<?php echo $image;?>" alt="" />
			</div>
			<div class="col-lg-6 order-lg-1 order-md-2 col-md-12 col-12">
				<h1><?php echo $title;?></h1>
				<?php echo $content;?>
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>
<?php endif;?>
<section class="buysell-info">
	<div class="container">
		<?php $mtitle = get_field('main_title');?>
		<?php if($mtitle){?>
		<div class="row justify-content-center pb-2" data-aos="fade-up" data-aos-delay="200">
			<div class="col-lg-12 text-center col-md-12 col-12">
				<?php echo $mtitle;?>
			</div>
		</div>
		<?php } ?>
		<?php if( have_rows('content_with_image') ): ?>
		<?php $services = 1; ?>
		<?php while( have_rows('content_with_image') ): the_row(); 
		$image = get_sub_field('image');
		$title = get_sub_field('title');
		$content = get_sub_field('content');
		?>
		<?php if($services == 1 OR $services% 2 != 0 ) { ?>
		<div class="row align-items-center mbs" data-aos="fade-up" data-aos-delay="200">
			<div class="col-lg-6 text-center order-lg-2 order-md-1 col-md-12 col-12">
				<img src="<?php echo $image;?>" alt="" />
			</div>
			<div class="col-lg-6 order-lg-1 order-md-2 col-md-12 col-12">
				<h3><?php echo $title;?></h3>
				<?php echo $content;?>
			</div>
		</div>
		<?php } ?>
		<?php if($services%2==0) { ?>
		<div class="row align-items-center mbs" data-aos="fade-up" data-aos-delay="200">
			<div class="col-lg-6 text-center col-md-12 col-12 order-md-1">
				<img src="<?php echo $image;?>" alt="" />
			</div>
			<div class="col-lg-6 order-lg-1 col-md-12 col-12 order-md-2">
				<h3><?php echo $title;?></h3>
				<?php echo $content;?>
			</div>
		</div>
		<?php } ?>
		<?php $services++;?>
		<?php endwhile;?>
		<?php endif;?>
		<?php if( have_rows('widget') ): ?>
		<?php while( have_rows('widget') ): the_row(); 
		$title = get_sub_field('title');
		$content = get_sub_field('content');
		?>
        <div class="row ml-auto mr-auto w-100 g-0 down mbs" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-6 text-center text-lg-start text-md-start col-md-6 col-12">
                <h2><?php echo $title;?></h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <?php echo $content;?>
            </div>
        </div>
		<?php endwhile;?>
		<?php endif;?>
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