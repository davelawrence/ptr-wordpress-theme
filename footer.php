<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Peter_Thompson
 */

function search_data()
{
    $search = '';
    if (isset($_POST['search_posts'])) {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'posts',
            'post_status' => 'publish',
            's' => $_POST['search_posts']
        );
    }
    $services_data = get_posts($args);
}

add_action('wp_ajax_search_data', 'search_data');
add_action('wp_ajax_nopriv_search_data', 'search_data');

?>

<section class="footer" data-aos="fade-in" data-aos-delay="200">
    <div class="container">
        <div class="row justify-content-md-center justify-content-between">
            <div class="col-lg-6 col-md-8 col-12 order-2 order-lg-1 text-center text-lg-start">
                <div class="footer-logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php the_field('logo', 'option'); ?>"/>
                    </a>
                </div>
                <ul class="social-links">
                    <?php if (have_rows('social_media', 'option')): ?>
                        <?php while (have_rows('social_media', 'option')): the_row(); ?>
                            <li><a href="<?php the_sub_field('url'); ?>" target="_blank"><i
                                            class="<?php the_sub_field('icon'); ?>"></i></a></li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php $phone = get_field('phone', 'option'); ?>
                    <?php if ($phone) { ?>
                        <li><a href="tel:<?php echo $phone; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                    <?php } ?>
                </ul>
				<div class="reviews-widget">
				<?php echo do_shortcode( '[grw id=1019]' ); ?>
				</div>
            </div>
            <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-2 text-center text-lg-start">
                <div class="subscribe-form">
                    <h3><?php the_field('newsletter_title', 'option'); ?></h3>
                    <?php echo do_shortcode('[mc4wp_form id=197]'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <?php
                wp_nav_menu(array(
                    'container' => false,
                    'menu_class' => false,
                    'theme_location' => 'footer-menu',
                    'menu_id' => 'footer-links',
                    'menu_class' => 'legal-links',
                ));
                ?>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo get_template_directory_uri();?>/assets/js/owl.carousel.min.js"></script>
<!-- cookie popup -->
<script src="https://marketingwebsites.ca/privacy/js/privacy_policy_<?= strtolower(ICL_LANGUAGE_CODE) == 'fr' ? 'fr' : 'en' ?>.js"></script>

<!-- chatbot -->
<script src="https://marketingwebsites.ca/message/js/message.js" data-id="J.uryAdmDrqdlZAbTj3uEg" data-lang="<?= strtolower(ICL_LANGUAGE_CODE) == 'fr' ? 'fr' : 'en' ?>" data-color="#000a40"></script>

<script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src='https://app.expquebec.com/website_ping.php';fjs.parentNode.insertBefore(js,fjs);}(document,'script','utilmo-ping'));</script>

<?php wp_footer(); ?>

<script>
    jQuery("#search_posts").keyup(function () {
        var search_posts = jQuery(this).val();
        var ajax_url = jQuery('#ajax_url_input').val();
        jQuery.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'search_data',
                search_posts: search_posts,
            },
            beforeSend: function () {
            },
            success: function (data) {
            }
        });
    });
</script>

<script>
    (function ($) {
        let lang = "<?= ICL_LANGUAGE_CODE; ?>";
        if (lang === 'en') {
            $('.prop-label.open').text('Open House');
            $('.mixitup-control[data-filter=".open"]').text('Open House');
        } else {
            $('.prop-label.open').text('Visite Libre');
            $('.mixitup-control[data-filter=".open"]').text('Visite Libre');
        }
    })(jQuery);
</script>

</body>
</html>
