<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Peter_Thompson
 */

?>
<div class="col-lg-6 <?php if($count==1){?> d-none <?php } ?> col-md-12 col-12">
	<a class="blogcard" href="<?php the_permalink();?>">
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<?php if ( has_post_thumbnail() ) {?> 
		<div class="img">
			<img src="<?php echo $thumb['0'];?>" alt="" />
		</div>
		<?php } ?>
		<div class="text">
			<h6><?php echo get_the_date('M d, Y'); ?></h6>
			<h3><?php the_title();?></h3>
			<?php the_excerpt();?>
			<div class="btn-link">Read more <img src="<?php echo get_template_directory_uri();?>/assets/img/arrow-right-grey.svg"></div>
		</div>
	</a>
</div>