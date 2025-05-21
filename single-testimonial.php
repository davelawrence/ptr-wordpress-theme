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
                <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                <?php if (has_post_thumbnail()) { ?>
                    <div class="col-lg-7 order-lg-2 blogimg ms-auto col-md-12 col-12">
                        <img src="<?php echo $thumb['0']; ?>" alt=""/>
                    </div>
                <?php } ?>
                <div class="col-lg-5 order-lg-1 col-md-12 col-12">
                    <h6><?php echo get_the_date('M d, Y'); ?></h6>
                    <h1><?php the_title(); ?></h1>
                    <?php $short_content = get_field('short_content'); ?>
                    <?php echo $short_content; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="blogmiddle">
        <div class="container">
            <div class="row justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-7 spbottom col-md-12 col-12">
                    <?php $top_content = get_field('top_content'); ?>
                    <?php echo $top_content; ?>
                    <?php $video_code = get_field('video_code'); ?>
                    <?php if ($video_code) { ?>
                        <a class="vidbox" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                            <img class="w-100" src="<?php echo $thumb['0']; ?>" alt=""/>
                            <img class="play" src="<?php echo get_template_directory_uri(); ?>/assets/img/play.webp"
                                 alt=""/>
                        </a>
                    <?php } ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    else: ?>
                    <?php endif; ?>
                    <hr/>
                    <?php if (have_rows('about_youtube', 'option')): ?>
                        <?php while (have_rows('about_youtube', 'option')): the_row(); ?>
                            <?php the_sub_field('content'); ?>
                            <a href="<?php the_sub_field('url'); ?>" target="_blank"
                               class="blog_content_footer_yt w-inline-block">
                                <div class="footer_yt-image">
                                    <img src="<?php the_sub_field('image'); ?>" loading="lazy" alt=""
                                         class="image-full-width">
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
    <div class="modal vidmodal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <?php echo $video_code; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="explore innerblog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <?php $ptitle = get_field('posts_title', 'option'); ?>
                        <h2><?php echo $ptitle; ?></h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-lg-3  row-cols-md-1 row-cols-1 mt-5">
                <?php
                $args = array(
                    'numberposts' => 3, 'offset' => 0, 'post_status' => 'publish', 'order' => 'ASC', 'post__not_in' => array($post->ID));
                $lastposts = get_posts($args);
                foreach ($lastposts as $post) : setup_postdata($post); ?>
                    <div class="col">
                        <a href="<?php the_permalink(); ?>" class="card">
                            <div class="img">
                                <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                <img src="<?php echo $thumb['0']; ?>" class="card-img-top"/>
                            </div>
                            <div class="card-body">
                                <div class="date"><?php echo get_the_date('M d, Y'); ?></div>
                                <h3><?php the_title(); ?></h3>
                                <?php the_excerpt(); ?>
                                <hr/>
                                <p class="btn-link"><?= ICL_LANGUAGE_CODE === 'en' ? 'Read More' : 'Lire la suite'; ?>
                                    <img
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

<?php if (have_rows('testimonial', 'option')): while (have_rows('testimonial', 'option')): the_row();
    $title = get_sub_field('title');
    $button = get_sub_field('button');
    $url = get_sub_field('url');
    ?>
    <section class="foot-cta" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="cta-wrapper">
                <div class="col-lg-6 col-md-6 col-12">
                    <h2><?= $title; ?></h2>
                </div>
                <div class="col-lg-6 col-md-6 col-12 text-lg-end text-sm-start">
                    <a href="<?= $url; ?>" target="_blank" rel="noopener" class="btn-default btn-white">
                        <i class="fa fa-google"></i>
                        <?= $button; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; endif; ?>

<?php
get_footer();
