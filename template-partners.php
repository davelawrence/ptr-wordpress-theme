<?php
/**
 * Template Name:  Partners
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Peter_Thompson
 */
get_header(); ?>
<?php if (have_rows('page_content')): ?>
    <?php while (have_rows('page_content')): the_row();
        $left_content = get_sub_field('left_content');
        $title = get_sub_field('title');
        $right_content = get_sub_field('right_content');
        ?>
        <section class="aboutinfo">
            <div class="container">
                <div class="row pb-2">
                    <div class="col-lg-12 col-md-12 col-12" data-aos="fade-up" data-aos-delay="200">
                        <h1><?php echo $title; ?></h1>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12" data-aos="fade-up" data-aos-delay="200">
                        <?php echo $left_content; ?>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12" data-aos="fade-up" data-aos-delay="200">
                        <?php echo $right_content; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="aboutimgs">
            <div class="container">
                <div class="row cwidth pb-2" data-aos="fade-left" data-aos-delay="200">
                    <?php if (have_rows('images')): ?>
                        <?php while (have_rows('images')): the_row();
                            $image = get_sub_field('image');
                            ?>
                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="image-wrapper">
                                    <img class="w-100" src="<?php echo $image; ?>" alt=""/>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('numbers')): ?>
    <?php while (have_rows('numbers')): the_row();
        $title = get_sub_field('title');
        ?>
        <section class="aboutlook">
            <div class="container">
                <div class="row text-center pb-2">
                    <div class="col-lg-12 col-md-12 col-12 text-md-center" data-aos="fade-up" data-aos-delay="200">
                        <h2><?php echo $title; ?></h2>
                    </div>
                </div>
                <div class="row text-center">
                    <?php if (have_rows('number')): ?>
                        <?php while (have_rows('number')): the_row();
                            $value = get_sub_field('value');
                            $title = get_sub_field('title');
                            ?>
                            <div class="col-lg-4 col-md-12 col-12  text-md-center points" data-aos="fade-up"
                                 data-aos-delay="200">
                                <h3><?php echo $value; ?></h3>
                                <p><?php echo $title; ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
    <section class="aboutteam">
        <div class="container">
            <div class="row pb-5 mb-1">
                <?php $teamtitle = get_field('team_title'); ?>
                <div class="col-lg-12 text-center text-lg-star text-md-start col-md-12 col-12" data-aos="fade-up"
                     data-aos-delay="200">
                    <h2><?php echo $teamtitle; ?></h2>
                </div>
            </div>
            <div class="row spr row-cols-lg-3 row-cols-md-1 row-cols-1">
                <?php
                $args = array('post_type' => 'partners', 'posts_per_page' => -1, 'post_status' => 'publish');
                $the_query = new WP_Query($args);
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post();
                        $image = get_field('image');
                        $designation = get_field('designation');
                        $phone = get_field('phone');
                        $email = get_field('email');
                        ?>
                        <div class="cols" data-aos="fade-up" data-aos-delay="200">
                            <div class="teambox">
                                <div class="img">
                                    <a href="<?php the_permalink(); ?>" class="d-block">
                                        <img src="<?php echo $image; ?>" alt=""/>
                                    </a>
                                </div>
                                <div class="text">
                                    <h3><a href="<?php the_permalink(); ?>"
                                           class="text-dark text-decoration-none"><?php the_title(); ?></a></h3>
                                    <p><?php echo $designation; ?></p>
                                    <hr/>
                                    <?php if ($phone) { ?>
                                        <div class="cinfo">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/call.svg"
                                                 alt=""/>
                                            <div>
                                                <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($email) { ?>
                                        <div class="cinfo">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/email.svg"
                                                 alt=""/>
                                            <div>
                                                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php if (have_rows('ellis_presents')): ?>
    <?php while (have_rows('ellis_presents')): the_row();
        $title = get_sub_field('title');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="explore">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2><?php echo $title; ?></h2>
                            <a href="<?php echo $button_url; ?>" class="btn-default"><?php echo $button_text; ?></a>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-md-1 row-cols-lg-3 row-cols-1 mt-5">
                    <?php
                    $args = array('post_type' => 'ellis-presents', 'posts_per_page' => 3);
                    $the_query = new WP_Query($args);
                    ?>
                    <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="col">
                                <a href="<?php the_permalink(); ?>" class="card">
                                    <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                    <img src="<?php echo $thumb['0']; ?>" class="card-img-top"/>
                                    <div class="card-body">
                                        <div class="date"><?php echo get_the_date('M d, Y'); ?></div>
                                        <h3><?php the_title(); ?></h3>
                                        <?php the_excerpt(); ?>
                                        <hr/>
                                        <p class="btn-link">Read More <img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
                                        </p>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
    <section class="foot-cta" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row align-items-center justify-content-between justify-content-md-center">
                    <div class="col-lg-5 col-md-10 col-12  ">
                        <?php $wtitle = get_field('widget_title', 'option'); ?>
                        <h2><?php echo $wtitle; ?></h2>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="d-flex justify-content-between">
                            <?php $phone = get_field('phone', 'option'); ?>
                            <?php if ($phone) { ?>
                                <a href="tel:<?php echo $phone; ?>" class="btn-default btn-white"><i
                                            class="fa fa-bookmark-o"></i> <?php echo $phone; ?></a>
                            <?php } ?>
                            <?php $email = get_field('email', 'option'); ?>
                            <?php if ($email) { ?>
                                <a href="mailto:<?php echo $email; ?>" class="btn-default btn-white"><b><i
                                                class="fa fa-chevron-left"></i> <?php echo $email; ?></b></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();