<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Peter_Thompson
 */

get_header();
?>

<section class="informed-consumers askpere" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="row ins pb-2">
            <div class="col-lg-6 col-md-6 col-12">
                <h1><?php the_archive_title(); ?></h1>
            </div>
            <div class="col-lg-5 ms-auto col-md-6 col-12">
                <?php the_archive_description(); ?>
            </div>
        </div>
    </div>
</section>

<section class="latestpost">
    <div class="container">
        <div class="row sppr">
            <?php
            $args = array(
                'post_type'      => get_post_type(),
                'posts_per_page' => get_option( 'posts_per_page' ),
                'orderby'        => 'date',
                'order'          => 'DESC',
                'paged'          => get_query_var( 'paged', 1 ),
            );

            $custom_query = new WP_Query( $args );

            if ( $custom_query->have_posts() ) :
                while ( $custom_query->have_posts() ) :
                    $custom_query->the_post();

                    // Include the Post-Type-specific template for the content.
                    get_template_part( 'template-parts/content', get_post_type() );

                endwhile;

                the_posts_navigation();
            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;

            // Reset post data to avoid conflicts with the main query
            wp_reset_postdata();
            ?>
        </div>

        <div class="row mt-2 mb-4">
            <div class="col text-center">
                <?php wpbeginner_numeric_posts_nav(); ?>
            </div>
        </div>
    </div>
</section>

<section class="foot-cta" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="cta-wrapper">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5 col-md-5 col-12">
                    <?php $wtitle = get_field( 'widget_title', 'option' ); ?>
                    <h2><?php echo esc_html( $wtitle ); ?></h2>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="d-flex justify-content-between">
                        <?php $phone = get_field( 'phone', 'option' ); ?>
                        <?php if ( $phone ) : ?>
                            <a href="tel:<?php echo esc_attr( $phone ); ?>" class="btn-default btn-white">
                                <i class="fa fa-bookmark-o"></i> <?php echo esc_html( $phone ); ?>
                            </a>
                        <?php endif; ?>

                        <?php $email = get_field( 'email', 'option' ); ?>
                        <?php if ( $email ) : ?>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="btn-default btn-white">
                                <b><i class="fa fa-chevron-left"></i> <?php echo esc_html( $email ); ?></b>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
