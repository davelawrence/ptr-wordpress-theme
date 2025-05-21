<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Peter_Thompson
 */

get_header();

$code = get_field('region_code');

$args = array(
    'post_type' => 'ellis-presents',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_key' => 'city',
    'meta_value' => strtolower(get_the_title())
);

$query = new WP_Query($args);
$fetch_codes = get_field('mw_realestate', 'option')['fetch_codes'];
$is_agency = get_field('mw_realestate', 'option')['fetch_agency'];
$fetchBy = $is_agency ? 'agency' : 'agents';

// Add debugging info here
echo '<!-- Debug Info:
Region Code: ' . $code . '
Fetch By: ' . $fetchBy . ' 
Fetch Codes: ' . $fetch_codes . '
-->';

// Debug API calls
$ev_url = "https://realestate.marketingwebsites.ca/api.php/properties?${fetchBy}=${fetch_codes}&status=EV&municipality_code=${code}";
$ve_url = "https://realestate.marketingwebsites.ca/api.php/properties?${fetchBy}=${fetch_codes}&status=VE&municipality_code=${code}";

echo '<!-- API Debug:
EV URL: ' . $ev_url . '
VE URL: ' . $ve_url . '
-->';

// Get active listings with error checking
$ev_response = @file_get_contents($ev_url);
if ($ev_response === false) {
    echo '<!-- Error fetching EV listings: ' . error_get_last()['message'] . ' -->';
    $ev_listings = 0;
} else {
    $ev_data = json_decode($ev_response, true);
    echo '<!-- EV Response: ';
    print_r($ev_data);
    echo ' -->';
    $ev_listings = $ev_data['results_count'] ?? 0;
}

// Get sold listings with error checking
$ve_response = @file_get_contents($ve_url);
if ($ve_response === false) {
    echo '<!-- Error fetching VE listings: ' . error_get_last()['message'] . ' -->';
    $ve_listings = 0;
} else {
    $ve_data = json_decode($ve_response, true);
    echo '<!-- VE Response: ';
    print_r($ve_data);
    echo ' -->';
    $ve_listings = $ve_data['results_count'] ?? 0;
}

echo '<!-- Final counts - EV: ' . $ev_listings . ', VE: ' . $ve_listings . ' -->';

?>
    <section class="community-cols">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 col-md-12 col-12">
					<?php
if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
}
?>
                    <h1 class="mb-3"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>

                <div class="col-lg-4 col-md-12 col-12 sticky-col">
                    <div class="card">
                        <div class="card-body">
                            <?php echo do_shortcode('[contact-form-7 id="80116e7" title="Get in touch"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php if ($ev_listings > 0): ?>
    <section class="explore properties-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2><b><?= get_field('for_sale_title', 'option'); ?>
                                <?php the_title(); ?>
                            </b>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 mt-3">
                <?= do_shortcode('[properties template="grid" order="price" dir="desc" status="EV" municipalities="' . $code . '"]'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($ve_listings > 0): ?>
    <section class="explore propeties-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2><b><?= get_field('for_sold_title', 'option'); ?>
                                <?php the_title(); ?>
                            </b>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-1 row-cols-lg-3 row-cols-1 mt-3">
                <?= do_shortcode('[properties template="grid" order="price" dir="desc" status="VE" municipalities="' . $code . '" min_price="1"]'); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <section class="explore">
        <div class="container">
            <div class="row row-cols-md-1 row-cols-lg-3 row-cols-1">
                <?php
                $args = array(
                    'post_type' => 'ellis-presents',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'meta_key' => 'city',
                    'meta_value' => strtolower(get_the_title()));

                echo '<!-- Ellis Presents Debug:
                Args: ';
                print_r($args);
                echo '
                Post Count: ' . $query->post_count . '
                Posts Found: ' . $query->found_posts . '
                -->';

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