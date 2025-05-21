<?php
/**
 * Template Name:  Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Peter_Thompson
 */
get_header(); ?>
<?php if (have_rows('hero-section')): ?>
    <?php while (have_rows('hero-section')): the_row();
        $title = get_sub_field('headline');
        $subhead = get_sub_field('subhead');
        $content = get_sub_field('content');
        $banner_image = get_field('banner_image'); // Fetch banner image
        $phone_number = get_field('phone', 'option'); // Fetch phone from theme settings
    ?>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column: Text + CTA -->
                <div class="col-lg-6 col-md-12 text-left">
                    <?php if ($title): ?>
                        <h1><?php echo esc_html($title); ?></h1>
                    <?php endif; ?>

                    <?php if ($subhead): ?>
                        <h2><?php echo esc_html($subhead); ?></h2>
                    <?php endif; ?>

                    <?php if ($content): ?>
                        <p><?php echo wp_kses_post($content); ?></p>
                    <?php endif; ?>

                    <div class="cta-buttons">
    <?php if ($phone_number): ?>
        <a href="tel:<?php echo preg_replace('/\D/', '', $phone_number); ?>" class="btn-default">
            <i class="fa fa-phone"></i> <?php echo esc_html($phone_number); ?>
        </a>
    <?php endif; ?>

<?php
$button_text = get_sub_field('button_text');
$button_url  = get_sub_field('button_url');
?>
<?php if ($button_url && $button_text): ?>
    <a href="<?php echo esc_url($button_url); ?>" class="btn-default btn-white">
        <?php echo esc_html($button_text); ?>
    </a>
<?php endif; ?>


</div>

                </div>

                <!-- Right Column: Image -->
                <div class="col-lg-6 col-md-12 text-center">
                    <?php if ($banner_image): ?>
                        <img src="<?php echo esc_url($banner_image); ?>" alt="Hero Image" class="hero-image">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>


<!-- Replace the testimonial section with Google Reviews plugin -->
<section class="reviews">
    <div class="container">
        <?php echo do_shortcode('[grw id=1293]'); ?>
    </div>
</section>

<?php if (have_rows('seller_experience')): ?>
    <?php while (have_rows('seller_experience')): the_row();
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="marketing-sells" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-md-5 col-12 order-2 order-lg-1 text-center text-lg-start">
                        <h2><?php echo $title; ?></h2>
                        <?php echo $content; ?>
                        <a href="<?php echo $button_url; ?>" class="btn-default"><?php echo $button_text; ?></a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 order-1 order-lg-2">
                        <img src="<?php echo $image; ?>"/>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('buyer_experience')): ?>
    <?php while (have_rows('buyer_experience')): the_row();
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="marketing-sells bg-white" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <img src="<?php echo $image; ?>"/>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12 text-center text-lg-start">
                        <h2><?php echo $title; ?></h2>
                        <?php echo $content; ?>
                        <a href="<?php echo $button_url; ?>" class="btn-default"><?php echo $button_text; ?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('ask_peter')): ?>
    <?php while (have_rows('ask_peter')): the_row();
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="informed-consumers" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2><?php echo $title; ?></h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 col-12 text-center">
                        <?php echo $content; ?>
                    </div>
                </div>
                <?php
                $args = array('post_type' => 'post', 'posts_per_page' => 1);
                $the_query = new WP_Query($args);
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <div class="row mt-5">
                            <a href="<?php the_permalink(); ?>"
                               class="d-flex align-items-center justify-content-between info-card-link">
                                <div class="col-lg-8 col-md-12 col-12 order-lg-2">
                                    <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                    <img src="<?php echo $thumb['0']; ?>" class="border-24"/>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12 order-lg-1">
                                    <div class="info-card">
                                        <h3><?php the_title(); ?></h3>
                                        <?php the_excerpt(); ?>
                                        <hr/>
                                        <div class="info-details justify-content-between d-flex">
                                            <p><?php echo get_the_date('M d, Y'); ?></p>
                                            <div class="btn-link" href="<?php the_permalink(); ?>">
                                                <p><?php if (ICL_LANGUAGE_CODE == 'en'): ?>Read More <?php else : ?>Lire la suite <?php endif; ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
                                                </p></div>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="<?php echo $button_url; ?>" class="btn-default"><?php echo $button_text; ?></a>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('about')): ?>
    <?php while (have_rows('about')): the_row();
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="get-to-know" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row align-items-center justify-content-between g-0">
                    <div class="col-lg-5 col-md-12 col-12">
                        <h2><?php echo $title; ?></h2>
                        <?php echo $content; ?>
                        <a href="<?php echo $button_url; ?>" class="btn-default"><?php echo $button_text; ?></a>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <figure class="fig-background">
                            <img src="<?php echo $image; ?>"/>
                        </figure>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('properties')): ?>
    <?php while (have_rows('properties')): the_row();
        $title = get_sub_field('title');
        $button_text = get_sub_field('button_text');
        $button_url = get_sub_field('button_url');
        ?>
        <section class="explore propeties-section">
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
                    <?= do_shortcode('[properties template="grid" status="EV" limit="3"]'); ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
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
                    $args = array('post_type' => 'ellis-presents', 'posts_per_page' => 3, 'post_status' => 'publish');
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
    <?php endwhile; endif;?>
<section class="instagram-feed">
    <div class="container">
        <div class="row pb-5 mb-1">
            <div class="col-lg-12 text-center text-lg-start text-md-start col-12" data-aos="fade-up" data-aos-delay="200">
                <h2>Connect with Us on Instagram</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
            </div>
        </div>
    </div>
</section>
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
