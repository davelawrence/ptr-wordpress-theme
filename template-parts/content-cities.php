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
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
    <a class="blogcard" href="<?php the_permalink();?>">
        <div class="text">
            <h3><?php the_title(); ?></h3>
        </div>
    </a>
</div>
<?php endif; ?>


