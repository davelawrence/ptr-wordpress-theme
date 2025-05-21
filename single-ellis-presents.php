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
					<?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
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
                    <?php 
$video_code = get_field('video_code');

if ($video_code) { 
    // Check if it's already an iframe
    if (strpos($video_code, '<iframe') !== false) {
        // If the stored field already contains an iframe, output as is
        echo '<div class="video-embed" style="border-radius: 15px; overflow: hidden;">' . $video_code . '</div>';
    } else {
        // Convert YouTube or Vimeo URLs into proper iframe embeds
        if (strpos($video_code, 'youtube.com') !== false || strpos($video_code, 'youtu.be') !== false) {
            // Extract video ID from URL
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $video_code, $matches);
            $video_id = isset($matches[1]) ? $matches[1] : '';
            $video_embed_url = "https://www.youtube.com/embed/" . $video_id;
        } elseif (strpos($video_code, 'vimeo.com') !== false) {
            preg_match('/vimeo\.com\/(\d+)/', $video_code, $matches);
            $video_id = isset($matches[1]) ? $matches[1] : '';
            $video_embed_url = "https://player.vimeo.com/video/" . $video_id;
        } else {
            $video_embed_url = esc_url($video_code);
        }

        // Output the iframe embed
        if (!empty($video_embed_url)) {
            echo '<div class="video-embed" style="border-radius: 15px; overflow: hidden;">
                <iframe width="640" height="360" src="' . esc_url($video_embed_url) . '" frameborder="0" allowfullscreen></iframe>
            </div>';
        }
    }
} 
?>

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
            <div class="row row-cols-lg-3 row-cols-md-1 row-cols-1 mt-5">
                <?php
                $args = array(
                    'post_type' => 'ellis-presents', 'numberposts' => 3, 'offset' => 0, 'post_status' => 'publish', 'order' => 'ASC', 'post__not_in' => array($post->ID));
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
                                <p class="btn-link">Read More <img
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
// Ensure this runs only if a video exists
$video_code = get_field('video_code');

if ($video_code) {
    $video_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $video_title = get_the_title();
    $video_description = get_the_excerpt();
    $video_url = esc_url($video_code); // Ensure the URL is valid

    ?>
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "<?php echo esc_html($video_title); ?>",
    "description": "<?php echo esc_html($video_description); ?>",
    "thumbnailUrl": "<?php echo esc_url($video_thumbnail); ?>",
    "uploadDate": "<?php echo get_the_date('c'); ?>",
    "contentUrl": "<?php echo esc_url($video_url); ?>",
    "embedUrl": "<?php echo esc_url($video_url); ?>",
    "url": "<?php echo get_permalink(); ?>",
    "publisher": {
        "@type": "Organization",
        "name": "Peter Thompson Real Estate",
        "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>"
        }
    }
}
</script>

    <?php
}
?>

<?php
get_footer();