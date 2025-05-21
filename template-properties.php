<?php
/**
 * Template Name:  Archive Properties
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Peter_Thompson
 */

// 1) Set your strings up front
if ( defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE === 'fr' ) {
    $pt_title = 'Parcourez les maisons à vendre dans l’Ouest-de-l’Île et Vaudreuil-Soulanges | Peter Thompson Immobilier';
    $pt_desc  = 'Commencez votre parcours immobilier en explorant les maisons à vendre dans les régions de l’Ouest-de-l’Île et de Vaudreuil-Soulanges. Contactez-nous pour planifier une visite !';
} else {
    $pt_title = 'Browse Homes for Sale in West Island & Vaudreuil-Soulanges | Peter Thompson Real Estate';
    $pt_desc  = 'Start your real estate journey by exploring homes for sale across the West Island and Vaudreuil-Soulanges regions. Contact us to schedule your visit!';
}

// 2) Hook into the head
add_action( 'wp_head', function() use ( $pt_title, $pt_desc ) {
    echo "<title>" . esc_html( $pt_title ) . "</title>\n";
    echo "<meta name=\"description\" content=\"" . esc_attr( $pt_desc ) . "\" />\n";
}, 1 );

get_header(); ?>

    <section class="page-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-10 col-12 text-center">
                    <h1><?= ICL_LANGUAGE_CODE === 'en' ? 'Browse Homes for Sale in West Island & Vaudreuil Soulanges' : 'Parcourez les maisons à vendre dans l’Ouest-de-l’Île et Vaudreuil-Soulanges' ?></h1>
                    <p><?= ICL_LANGUAGE_CODE === 'en' ? 'Start your real estate journey by exploring some of the homes for sale across the West Island and Vaudreuil-Soulanges regions. If you see any you like, simply fill out the form on that property page and we will reach out to schedule your visit!': 'Commencez votre parcours immobilier en explorant les maisons à vendre dans les régions de l’Ouest-de-l’Île et de Vaudreuil-Soulanges. Si une propriété vous intéresse, remplissez simplement le formulaire sur la page de cette maison et on vous contactera pour planifier une visite!' ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="explore propeties-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <form class="prop-search"
      					method="get"
      					action="<?php echo esc_url( get_post_type_archive_link('properties') ); ?>">

                        <!--<input type="hidden" name="search">-->
                        <select name="status" class="form-control">
                            <option value=""><?= ICL_LANGUAGE_CODE === 'en' ? 'Select' : 'Selectionner' ?></option>
                            <option value="open" <?= $_GET['status'] === 'open' ? 'selected' : '' ?>>
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'Open House' : 'Visite libre'; ?>
                            </option>
                            <option value="sale" <?= $_GET['status'] === 'sale' ? 'selected' : '' ?>>
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'For Sale' : 'À vendre'; ?>
                            </option>
                            <option value="rent" <?= $_GET['status'] === 'rent' ? 'selected' : '' ?>>
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'For Rent' : 'À louer'; ?>
                            </option>
                            <option value="sold" <?= $_GET['status'] === 'sold' ? 'selected' : '' ?>>
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'Sold' : 'Vendu'; ?>
                            </option>
                        </select>
                        <input type="text" name="q"
                               placeholder="<?= ICL_LANGUAGE_CODE === 'en' ? 'Search' : 'Rechercher' ?>"
                               class="form-control"
                               value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>"/>
                        <button type="submit" class="prop-search-btn">
                            <img src="/wp-content/uploads/2024/06/search-icon.png" alt="search icon">
                        </button>

                        <a href="<?php echo esc_url( get_post_type_archive_link('properties') ); ?>"
   class="prop-search-btn reset--btn bg-danger" style="line-height: 40px;">
    <img src="/wp-content/uploads/2024/07/rotate-left-circular-arrow-interface-symbol.png"
         style="filter: invert(1)" alt="reset icon">
</a>

                    </form>
                </div>
            </div>


            <?php if ($_GET['status'] === 'open') {
                echo do_shortcode('[properties template="grid" open_house="1"  pagination="1" q="' . $_GET['q'] . '"]');
            } else if ($_GET['status'] === 'sold') {
                echo do_shortcode('[properties template="grid" status="VE"  pagination="1" q="' . $_GET['q'] . '"]');
            } else if ($_GET['status'] === 'rent') {
                echo do_shortcode('[properties template="grid" min_price_rent="100" status="EV"  pagination="1" q="' . $_GET['q'] . '"]');
            } else if ($_GET['status'] === 'sale') {
                echo do_shortcode('[properties template="grid" min_price="10000" status="EV"  pagination="1" q="' . $_GET['q'] . '"]');
            } else {
                echo do_shortcode('[properties template="grid" pagination="1" q="' . $_GET['q'] . '"]');
            }
            ?>

        </div>
    </section>
<?php
get_footer();