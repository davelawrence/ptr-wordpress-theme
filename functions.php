<?php
/**
 * Peter Thompson functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Peter_Thompson
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function peter_thompson_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Peter Thompson, use a find and replace
        * to change 'peter-thompson' to the name of your theme in all the template files.
        */
    load_theme_textdomain('peter-thompson', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'peter-thompson'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'peter_thompson_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}

add_action('after_setup_theme', 'peter_thompson_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function peter_thompson_content_width()
{
    $GLOBALS['content_width'] = apply_filters('peter_thompson_content_width', 640);
}

add_action('after_setup_theme', 'peter_thompson_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function peter_thompson_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'peter-thompson'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'peter-thompson'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'peter_thompson_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function peter_thompson_scripts()
{
    wp_enqueue_style('peter-thompson-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('peter-thompson-style', 'rtl', 'replace');

    // STYLE
    wp_enqueue_style('peter-thompson-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('peter-thompson-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('peter-thompson-aos', get_template_directory_uri() . '/assets/css/aos.css');
    wp_enqueue_style('peter-thompson-fancybox', get_template_directory_uri() . '/assets/css/fancyapps.min.css');
    wp_enqueue_style('peter-thompson-custom', get_template_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_style('peter-thompson-helper', get_template_directory_uri() . '/assets/css/helper.css');
    wp_enqueue_style('peter-thompson-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

    // SCRIPT
    wp_enqueue_script('peter-thompson-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('peter-thompson-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '20152515', true);
    wp_enqueue_script('peter-thompson-aos', get_template_directory_uri() . '/assets/js/aos.js', array(), '20152515', true);
    wp_enqueue_script('peter-thompson-fancybox', get_template_directory_uri() . '/assets/js/fancyapps.min.js', array(), '20152515', true);
    wp_enqueue_script('peter-thompson-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20152515', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'peter_thompson_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

// Nearby Cities shortcode
require_once get_template_directory()
  . '/mw-properties-templates/shortcodes/nearby-cities.php';

if (function_exists('acf_add_options_page')) {
    acf_add_options_page('Theme Options');
}


function register_my_menus()
{
    register_nav_menus(
        array(
            'footer-menu' => __('Footer Menu'),
        )
    );
}

add_action('init', 'register_my_menus');

function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);


function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);


add_filter('wpcf7_autop_or_not', '__return_false');

function wpbeginner_numeric_posts_nav()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link());

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link());

    echo '</ul></div>' . "\n";

}

// to use classic editor and classic widget without the plugins
add_filter('use_block_editor_for_post', '__return_false', 10);

function classic_widgets()
{
    remove_theme_support('widgets-block-editor');
}

add_action('after_setup_theme', 'classic_widgets');

// removing the default gutenburg style.css
add_action('wp_print_styles', 'wps_deregister_styles', 100);
function wps_deregister_styles()
{
    wp_dequeue_style('wp-block-library');
}

// fixing testimonial translation
function testimonial_args($args, $post_type)
{
    if ('testimonial' == $post_type) {
        $args['has_archive'] = false;
    }

    return $args;
}

// removing comments from dashboard
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/*function properties_args($args, $post_type)
{
    if ('properties' == $post_type) {
        $args['has_archive'] = false;
    }

    return $args;
}

add_filter( 'register_post_type_args', 'properties_args', 999, 2 );*/

// Add author schema
add_filter('wpseo_schema_person', 'modify_person_to_author', 11, 2);
function modify_person_to_author($data, $context) {
    if (!empty($data['@type'])) {
        $data['@type'] = ['Author', 'Person'];
    }
    return $data;
	
}
function custom_author_archive_posts_per_page($query) {
    if ($query->is_author() && $query->is_main_query()) {
        $query->set('posts_per_page', 6);
    }
}
add_action('pre_get_posts', 'custom_author_archive_posts_per_page');

// Add the custom phone number field to the user profile page
function add_author_phone_field($user) { ?>
    <h3>Contact Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="author_phone">Phone Number</label></th>
            <td>
                <input type="text" name="author_phone" id="author_phone" 
                       value="<?php echo esc_attr(get_the_author_meta('author_phone', $user->ID)); ?>" 
                       class="regular-text" />
            </td>
        </tr>
    </table>
<?php }
add_action('show_user_profile', 'add_author_phone_field');
add_action('edit_user_profile', 'add_author_phone_field');

// Save the custom phone number field
function save_author_phone_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'author_phone', sanitize_text_field($_POST['author_phone']));
}
add_action('personal_options_update', 'save_author_phone_field');
add_action('edit_user_profile_update', 'save_author_phone_field');

//Add real estate listing schema to yoast
function add_real_estate_schema_to_yoast($data) {
    if (is_singular('properties')) { // Ensure this only runs on property pages
        global $post;

        $property_schema = [
            "@context" => "https://schema.org",
            "@type" => "RealEstateListing",
            "@id" => get_permalink() . "#realestate",
            "mainEntityOfPage" => [
                "@id" => get_permalink() . "#webpage"
            ],
            "name" => get_the_title(),
            "url" => get_permalink(),
            "image" => get_the_post_thumbnail_url(),
            "description" => get_the_excerpt(),
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => get_post_meta($post->ID, 'property_address', true),
                "addressLocality" => get_post_meta($post->ID, 'property_city', true),
                "addressRegion" => "QC",
                "postalCode" => get_post_meta($post->ID, 'property_postal_code', true),
                "addressCountry" => "CA"
            ],
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => get_post_meta($post->ID, 'property_latitude', true),
                "longitude" => get_post_meta($post->ID, 'property_longitude', true)
            ],
            "offers" => [
                "@type" => "Offer",
                "price" => get_post_meta($post->ID, 'property_price', true),
                "priceCurrency" => "CAD",
                "availability" => "https://schema.org/InStock"
            ]
        ];

        // Attach to Yoast's JSON-LD graph
        $data['@graph'][] = $property_schema;
    }

    return $data;
}
add_filter('wpseo_json_ld_output', 'add_real_estate_schema_to_yoast', 20);

/**
 * Handle multilingual property URLs (hreflang tags)
 */
add_action('wp_head', 'ptre_fix_property_hreflang_tags', 0);
function ptre_fix_property_hreflang_tags() {
    if (get_post_type() !== 'properties') {
        return;
    }

    // Stop WPML's own hreflang tags
    remove_action('wp_head', ['WPML_SEO_HeadLangs', 'head_langs']);

    $base_url = get_permalink();
    if (!$base_url) return; // Safety check

    $langs = [
        'en' => 'en-CA',
        'fr' => 'fr-CA',
    ];

    foreach ($langs as $code => $hreflang) {
        $localized = apply_filters('wpml_permalink', $base_url, $code);
        if (!$localized) continue; // Skip if WPML fails to provide URL

        // Properly decode HTML entities
        $localized = html_entity_decode($localized, ENT_QUOTES, 'UTF-8');
        
        // Ensure we have valid UTF-8
        if (!mb_check_encoding($localized, 'UTF-8')) {
            $localized = mb_convert_encoding($localized, 'UTF-8', 'UTF-8');
        }
        
        // Parse and properly encode URL components
        $parts = wp_parse_url($localized);
        if (!$parts || !isset($parts['path'])) continue; // Skip if URL parsing fails

        $segments = explode('/', trim($parts['path'], '/'));
        $segments = array_map(function($segment) {
            // Remove any invalid UTF-8 sequences before encoding
            $clean = mb_convert_encoding($segment, 'UTF-8', 'UTF-8');
            return rawurlencode($clean);
        }, $segments);

        $url = $parts['scheme'] . '://' . $parts['host'] . '/' . implode('/', $segments) . '/';

        printf(
            "<link rel='alternate' hreflang='%s' href='%s' />\n",
            esc_attr($hreflang),
            esc_url($url)
        );
    }

    // x-default (English version)
    $default = apply_filters('wpml_permalink', $base_url, 'en');
    if ($default) {
        $default = html_entity_decode($default, ENT_QUOTES, 'UTF-8');
        
        // Ensure valid UTF-8
        if (!mb_check_encoding($default, 'UTF-8')) {
            $default = mb_convert_encoding($default, 'UTF-8', 'UTF-8');
        }

        $parts = wp_parse_url($default);
        if ($parts && isset($parts['path'])) {
            $segments = array_map(function($segment) {
                $clean = mb_convert_encoding($segment, 'UTF-8', 'UTF-8');
                return rawurlencode($clean);
            }, explode('/', trim($parts['path'], '/')));
            
            $url = $parts['scheme'] . '://' . $parts['host'] . '/' . implode('/', $segments) . '/';

            printf(
                "<link rel='alternate' hreflang='x-default' href='%s' />\n",
                esc_url($url)
            );
        }
    }
}

/**
 * Property URL rewrite rules
 */
function ptre_add_property_rewrite_rules() {
    // English URLs
    add_rewrite_rule(
        '^properties/[^/]+/([0-9]+)/?$',
        'index.php?pagename=properties&mls=$matches[1]',
        'top'
    );

    // French URLs
    add_rewrite_rule(
        '^fr/properties/[^/]+/([0-9]+)/?$',
        'index.php?pagename=properties&mls=$matches[1]&lang=fr',
        'top'
    );
}
add_action('init', 'ptre_add_property_rewrite_rules', 10);

// Remove WPML's x-default fallback as we handle it ourselves
add_filter('wpml_hreflangs', function($hreflangs) {
    unset($hreflangs['x-default']);
    return $hreflangs;
}, 10);

/**
 * Add quick edit functionality for Cities categories
 */
function add_cities_quick_edit_columns($columns) {
    // Add the categories column before the date column
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'date') {
            $new_columns['cities_categories'] = __('Categories', 'peter-thompson');
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_cities_posts_columns', 'add_cities_quick_edit_columns');

function cities_custom_column($column, $post_id) {
    if ($column === 'cities_categories') {
        $terms = get_the_terms($post_id, 'cities_categories');
        if (!empty($terms) && !is_wp_error($terms)) {
            $term_names = array();
            foreach ($terms as $term) {
                $term_names[] = $term->name;
            }
            echo implode(', ', $term_names);
        }
    }
}
add_action('manage_cities_posts_custom_column', 'cities_custom_column', 10, 2);

function add_cities_quick_edit_fields($column_name, $post_type) {
    if ($post_type !== 'cities' || $column_name !== 'cities_categories') {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label class="inline-edit-categories-label">
                <span class="title"><?php _e('Categories', 'peter-thompson'); ?></span>
                <div style="margin-top: 5px;">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'cities_categories',
                        'hide_empty' => false,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            ?>
                            <label style="display: block; margin-bottom: 5px;">
                                <input type="checkbox" name="cities_categories[]" value="<?php echo esc_attr($term->term_id); ?>">
                                <?php echo esc_html($term->name); ?>
                            </label>
                            <?php
                        }
                    }
                    ?>
                </div>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action('quick_edit_custom_box', 'add_cities_quick_edit_fields', 10, 2);

function cities_quick_edit_save($post_id) {
    if (!current_user_can('edit_post', $post_id) || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // If cities_categories is set but empty, it means all checkboxes were unchecked
    if (isset($_POST['cities_categories'])) {
        $categories = array_map('intval', $_POST['cities_categories']);
        wp_set_object_terms($post_id, $categories, 'cities_categories');
    }
}
add_action('save_post_cities', 'cities_quick_edit_save');

function cities_quick_edit_javascript() {
    global $post_type;
    if ($post_type !== 'cities') {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        var wp_inline_edit = inlineEditPost.edit;
        inlineEditPost.edit = function(id) {
            wp_inline_edit.apply(this, arguments);
            var post_id = 0;
            if (typeof(id) === 'object') {
                post_id = parseInt(this.getId(id));
            } else {
                post_id = parseInt(id);
            }
            
            // Get the existing categories
            var categories = $('#post-' + post_id)
                .find('.column-cities_categories')
                .text()
                .split(', ')
                .map(function(cat) { return cat.trim(); })
                .filter(function(cat) { return cat !== ''; });
            
            // Check the appropriate boxes
            var checkboxes = $('#edit-' + post_id).find('input[name="cities_categories[]"]');
            checkboxes.each(function() {
                var label = $(this).parent().text().trim();
                if (categories.includes(label)) {
                    $(this).prop('checked', true);
                }
            });
        };
    });
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'cities_quick_edit_javascript');

/**
 * Enqueue custom CSS fixes
 */
function peter_thompson_enqueue_custom_fixes() {
    wp_enqueue_style(
        'peter-thompson-custom-fixes',
        get_stylesheet_directory_uri() . '/assets/css/custom-fixes.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-fixes.css')
    );
}
add_action('wp_enqueue_scripts', 'peter_thompson_enqueue_custom_fixes');

/**
 * Add aggregate ratings to Yoast JSON
 */
add_filter('wpseo_json_ld_output', function ($data) {
    if (!is_front_page()) return $data;

    foreach ($data['@graph'] as &$node) {
        if (
            isset($node['@type']) &&
            in_array('Organization', (array) $node['@type'], true) &&
            $node['@id'] === 'https://peterthompson.ca/#organization'
        ) {
            $node['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => '5.0',
                'reviewCount' => '115'
            ];
        }
    }

    return $data;
}, 20);

// Fix: Set canonical to current URL for single property pages (with mls query var)
add_filter('wpseo_canonical', function($canonical) {
    if (get_query_var('mls')) {
        return home_url($_SERVER['REQUEST_URI']);
    }
    return $canonical;
}, 20);

