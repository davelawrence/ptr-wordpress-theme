<?php
/**
 * The template for displaying single partners
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Peter_Thompson
 */

get_header();
?>

    <section class="single--team position-relative">
        <div class="container">
            <div class="wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="img position-relative">
                            <img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>">
                            <!--<span class="designation--label"><?php /*the_field('designation'); */?></span>-->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="inner">
                            <h1><?php the_title(); ?></h1>
                            <h5><?php the_field('designation'); ?></h5>

                            <div class="bio">
                                <?php the_field('bio'); ?>
                            </div>

                            <hr>
                            <ul>
                                <li><a href="mailto:<?php the_field('email') ?>"><i
                                            class="fa fa-envelope"></i> <?php the_field('email') ?></a></li>
                                <li><a href="tel:<?php the_field('phone') ?>"><i
                                            class="fa fa-phone"></i> <?php the_field('phone') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="explore padd-lg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2><?= ICL_LANGUAGE_CODE === 'en' ? 'Latest posts' : 'Articles récents' ?></h2>
                        <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn-default"><?= ICL_LANGUAGE_CODE === 'en' ? 'Browse all posts' : 'Consulter tous les articles' ?></a>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-2 row-cols-lg-3 row-cols-1 mt-5">
                <?php
                $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post_status' => 'publish');
                $the_query = new WP_Query($args);
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <div class="col">
                            <a href="<?php the_permalink(); ?>" class="card">
                                <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                <img src="<?php echo $thumb[0]; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <div class="date"><?php echo get_the_date('M d, Y'); ?></div>
                                    <h3><?php the_title(); ?></h3>
                                    <div class="shortIntro">
                                        <?php $short_content = get_field('short_content'); ?>
                                        <?php echo $short_content; ?>
                                    </div>
                                    <hr/>
                                    <p class="btn-link"><?php if (ICL_LANGUAGE_CODE == 'en'): ?>Read More <?php else : ?>Lire la suite <?php endif; ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </section>

<?php
get_footer();
