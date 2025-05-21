<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Peter_Thompson
 */
?>
<?php global $count;?>
<?php
if ( is_singular() ) :?>
<div class="col-lg-12 small-text-center col-sm-12 col-xs-12">
	<p><?php the_content();?></p>
</div>
<?php else :?>
<div class="col-lg-6 <?php if($count==1){?> d-none <?php } ?> col-md-12 col-12">
	<a class="blogcard" href="<?php the_permalink();?>">
		<div class="img">
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			<img src="<?php echo $thumb['0'];?>" alt="" />
		</div>
		<div class="text">
			<h6><?php echo get_the_date('M d, Y'); ?></h6>
			<h3><?php the_title();?></h3>
			<div class="shortIntro">
				<?php $short_content =  get_field('short_content');?>
				<?php echo $short_content;?>
			</div>
			<hr/>
			<div class="btn-link"><?php if (ICL_LANGUAGE_CODE == 'en'): ?>Read More <?php else : ?>Lire la suite <?php endif; ?> <img src="<?php echo get_template_directory_uri();?>/assets/img/arrow-right-grey.svg"></div>
		</div>
	</a>
</div>
<?php endif; ?>
