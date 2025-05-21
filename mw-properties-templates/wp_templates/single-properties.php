<?php

/**
 * Template Name: Single Property Page
 * Template Post Type: properties
 *
 * @package    Mw_Properties
 * @subpackage Mw_Properties/public
 * @author     Marketing Websites
 */

//add_filter( 'acf/settings/current_language',  '__return_false' );

$_GET['lang'] = $lang = ICL_LANGUAGE_CODE ?? 'en';
$_GET['mls'] = get_query_var("mls") ?? 0;

if (!empty($_GET['mls'])) {
    $result_obj = json_decode(file_get_contents("https://realestate.marketingwebsites.ca/api.php/property/" . $_GET['mls'] . "?lang=" . $_GET['lang']), true)['results'];
    $agent = $result_obj[$_GET['mls']]['agents'][0]['code'];
    $collaboration = Mw_Properties_Collaboration::is_collaboration($_GET['mls']);
} else {
    $result_obj[0] = get_fields();
    $_GET['mls'] = 0;
    $agent = get_field('agent_codes', 'option');
}

if ($_GET['mls'] == 0) {
    $result_obj[$_GET['mls']]['description'] = $result_obj[$_GET['mls']]['description'] ?? "";
    $result_obj[$_GET['mls']]['addendum'] = $result_obj[$_GET['mls']]['addendum'] ?? "";

    $result_obj[$_GET['mls']]['property']['property_type_code'] = $result_obj[$_GET['mls']]['property']['property_type']['value'] ?? "";
    $result_obj[$_GET['mls']]['property']['property_type'] = $result_obj[$_GET['mls']]['property']['property_type']['label'] ?? "";

    $result_obj[$_GET['mls']]['property']['region_code'] = $result_obj[$_GET['mls']]['property']['region_name']['value'] ?? "";
    $result_obj[$_GET['mls']]['property']['region_name'] = $result_obj[$_GET['mls']]['property']['region_name']['label'] ?? "";

    $result_obj[$_GET['mls']]['property']['municipality_name'] = $result_obj[$_GET['mls']]['property']['municipality']['label'] ?? "";
    $result_obj[$_GET['mls']]['property']['municipality'] = $result_obj[$_GET['mls']]['property']['municipality']['value'] ?? "";

    $result_obj[$_GET['mls']]['property']['property_category'] = $result_obj[$_GET['mls']]['property']['property_category']['value'] ?? "";

    $result_obj[$_GET['mls']]['property']['status'] = $result_obj[$_GET['mls']]['property']['status']['value'] ?? "";

    $result_obj[$_GET['mls']]['property']['building_type_code'] = $result_obj[$_GET['mls']]['property']['building_type']['value'] ?? "";
    $result_obj[$_GET['mls']]['property']['building_type'] = $result_obj[$_GET['mls']]['property']['building_type']['label'] ?? "";

    $images = [];
    if (isset($result_obj[$_GET['mls']]['images'])) {
        foreach ($result_obj[$_GET['mls']]['images'] as $key => $image) {
            $images[$key]['photourl'] = $image['sizes']['large'];
            $images[$key]['thumburl'] = $image['sizes']['thumbnail'];
            $images[$key]['title'] = $image['title'];
        }
    }

    if (isset($result_obj[$_GET['mls']]['image_urls'])) {
        foreach (explode(",", $result_obj[$_GET['mls']]['image_urls']) as $key => $image) {
            $images[$key]['photourl'] = $image;
            $images[$key]['thumburl'] = $image;
            $images[$key]['title'] = $image;
        }
    }

    $result_obj[$_GET['mls']]['images'] = $images;

    $custom_mls = $result_obj[0]['property']['mls_no'];
}

$agents = get_field('agent_codes', 'option');
$json = file_get_contents("https://realestate.marketingwebsites.ca/api.php/open_houses");
$oh = json_decode($json, true)['results'];

/*GET Related properties from API*/
$cat = $result_obj[$_GET['mls']]['property']['property_category'];
$type = $result_obj[$_GET['mls']]['property']['property_type_code'];
$region = $result_obj[$_GET['mls']]['property']['region_code'];

$related_obj = json_decode(file_get_contents("https://realestate.marketingwebsites.ca/api.php/properties?agents=$agent&region_code=$region&property_category=$cat&property_type_code=$type&limit=5&order=rand"));

$address = $result_obj[$_GET['mls']]['property']['civic_number_start'] . " " . str_replace("-", " ", $result_obj[$_GET['mls']]['property']['street_name']) . ", " . explode("/", $result_obj[$_GET['mls']]['property']['municipality_name'])[0] . ", QC " . substr($result_obj[$_GET['mls']]['property']['postal_code'], 0, 3);
$street = $result_obj[$_GET['mls']]['property']['civic_number_start'] . " " . str_replace("-", " ", $result_obj[$_GET['mls']]['property']['street_name']);
$city = explode("/", $result_obj[$_GET['mls']]['property']['municipality_name'])[0] . ", QC " . substr($result_obj[$_GET['mls']]['property']['postal_code'], 0, 3);
$longlat = $result_obj[$_GET['mls']]['property']['latitude'] . "," . $result_obj[$_GET['mls']]['property']['longitude'];
$vr = $result_obj[$_GET['mls']]['property']['virtual_visit_url'];
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$title = $address;
$ogImg = $result_obj[$_GET['mls']]['images'][0]['photourl'];

$price_rent_per = '';
if (ICL_LANGUAGE_CODE === 'en') {
    if ($result_obj[$_GET['mls']]['property']['price_rent_per'] === 'A') {
        $price_rent_per = 'sqft/Y';
    } else {
        $price_rent_per = $result_obj[$_GET['mls']]['property']['price_rent_per'];
    }

} else {

    if ($result_obj[$_GET['mls']]['property']['price_rent_per'] === 'A') {
        $price_rent_per = 'pi²/AN';
    } else {
        $price_rent_per = $result_obj[$_GET['mls']]['property']['price_rent_per'];
    }
}

$property_price = $result_obj[$_GET['mls']]['property']['price_buy'] != "0" ? "$" . number_format($result_obj[$_GET['mls']]['property']['price_buy'], 0) . (intval($result_obj[$_GET['mls']]['property']['price_rent']) != 0 ? " " . __("or", "mw-properties") . " $" . number_format($result_obj[$_GET['mls']]['property']['price_rent'], 0) . "/" . $price_rent_per : "") : "$" . number_format($result_obj[$_GET['mls']]['property']['price_rent'], 0) . "/" . $price_rent_per;

if ($result_obj[$_GET['mls']]['property']['ind_taxes_prix_demande'] === "O" || $result_obj[$_GET['mls']]['property']['ind_taxes_prix_location_demande'] === "O") {
    $property_price .= ' <small>+' . (ICL_LANGUAGE_CODE == 'fr' ? 'tps/tvq' : 'gst/qst') . '</small>';
}

$characteristics = [];
if ($result_obj[$_GET['mls']]['characteristics']) {
    foreach ($result_obj[$_GET['mls']]['characteristics'] as $key => $room) {
        $characteristics[$room['title']][] = $room['value'];
    }
}

// ────────────────────────────────────────────────────────────
// CUSTOM TITLE = [Street] – Home for Sale in [Town] (EN)
//                [Street] – Maison à vendre à [Town] (FR)
// ────────────────────────────────────────────────────────────

add_filter( 'pre_get_document_title', function() use ( $street, $city ) {
    // pull just the town name (before the comma)
    $town = explode( ',', $city )[0];

    if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'fr' ) {
        return sprintf( '%s – Maison à vendre à %s', $street, $town );
    }

    return sprintf( '%s – Home for Sale in %s', $street, $town );
}, 50 );

	if ( defined( 'WPSEO_VERSION' ) ) {
  	  add_filter( 'wpseo_title', function() use ( $street, $city ) {
        $town = explode( ',', $city )[0];

        if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'fr' ) {
            return sprintf( '%s – Maison à vendre à %s', $street, $town );
        }

        return sprintf( '%s – Home for Sale in %s', $street, $town );
    } );

    add_filter( 'wpseo_opengraph_title', function() use ( $street, $city ) {
        $town = explode( ',', $city )[0];

        if ( defined( 'ICL_LANGUAGE_CODE' ) && ICL_LANGUAGE_CODE === 'fr' ) {
            return sprintf( '%s – Maison à vendre à %s', $street, $town );
        }

        return sprintf( '%s – Home for Sale in %s', $street, $town );
    } );
    add_filter("wpseo_metadesc", function () use ($result_obj) {
        return strip_tags($result_obj[$_GET['mls']]['description']);
    });
    add_filter("wpseo_opengraph_type", function () {
        return 'website';
    });

    add_filter("wpseo_opengraph_image", 'ag_yoast_seo_tw_share_images');
    add_filter('wpseo_twitter_image', 'ag_yoast_seo_tw_share_images');
    function ag_yoast_seo_tw_share_images($img)
    {
        global $ogImg;

        return $ogImg;
    }
} else {
    add_action('wp_head', 'addOgTags');
    function addOgTags()
    {
        global $result_obj;
        echo '
        <!-- OG TAGS STARTS -->
        <meta name="description" content="' . strip_tags($result_obj[$_GET['mls']]['description']) . '" />
        <meta property="og:site_name" content="' . $_SERVER["HTTP_HOST"] . '"/>
        <meta property="og:type" content="WebSite">
        <meta property="og:url" content="https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '">
        <meta property="og:image" content="' . $result_obj[$_GET['mls']]['images'][0]['photourl'] . '">
        <meta property="og:title"  content="' . $result_obj[$_GET['mls']]['property']['civic_number_start'] . " " . str_replace("-", " ", $result_obj[$_GET['mls']]['property']['street_name']) . ", " . explode("/", $result_obj[$_GET['mls']]['property']['municipality_name'])[0] . ", QC " . substr($result_obj[$_GET['mls']]['property']['postal_code'], 0, 3) . '">
        <meta property="og:description"  content="' . strip_tags($result_obj[$_GET['mls']]['description']) . '">
        <!-- OG TAGS ENDS -->
        ';
    }
}

get_header(); ?>

    <style>
        #header {
            background: #0e0e0e;
        }
    </style>

    <?php /*if (!empty($vr)):
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $vr, $matches);
    preg_match("~(?:https?://)?vimeo\.com/(?:[^\d]+)?(\d+)~i", $vr, $matches_2);

    if (isset($matches['1'])) {
        $vr = 'https://www.youtube.com/embed/' . $matches['1'];
    } else if (isset($matches_2[1])) {
        $vr = 'https://player.vimeo.com/video/' . $matches_2[1];
    }
    */ ?><!--
    <div id="video" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe style="margin-top: 5px" class="embed-responsive-item"
                                width="100%"
                                height="450"
                                frameborder="0" style="border:0"
                                src="<?php /*echo $vr */ ?>">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
--><?php /*endif */ ?>

    <section class="property-banner" data-aos="fade-up" data-aos-delay="200"
             style="background-image: url('<?= $result_obj[$_GET['mls']]['images'][0]['photourl'] ?>');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <a href="javascript:void(0);" class="btn-default" id="images-popup">
                        <?= count($result_obj[$_GET['mls']]['images']); ?>
                        <i class="fa fa-camera"></i> <?= $lang === 'en' ? 'Browse Gallery' : 'Galerie'; ?>
                    </a>

                    <?php if (!empty($vr)): ?>
                        <a href="<?= $vr; ?>" class="btn-default" target="_blank" rel="noopener">
                            <i class="fa fa-video-camera"></i> <?= $lang === 'en' ? 'Watch Video Tour' : 'Visite virtuelle'; ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($result_obj[$_GET['mls']]['property']['status'] == 'VE') { ?>
                        <h3 class="property_sold text-uppercase text-white text-center bg-accent d-inline-block property-tag">
                            <?php echo ($_GET['lang'] == 'en') ? 'Sold' : 'Vendu' ?></h3>
                    <?php } ?>
                    <?php if (array_key_exists($_GET['mls'], $oh)): ?>
                        <div class="open-house d-inline-block property-tag">
                            <h3 class="text-uppercase text-center text-white"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'OPEN HOUSE' : 'VISITE LIBRE') ?></h3>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <section class="community-cols pdetails">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 lts col-md-12 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <?php
                            if ($result_obj[$_GET['mls']]['property']['price_buy'] > 0 && $result_obj[$_GET['mls']]['property']['price_rent'] > 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for rent/sale." : "à louer/vendre");
                            } else if ($result_obj[$_GET['mls']]['property']['price_buy'] > 0 && $result_obj[$_GET['mls']]['property']['price_rent'] == 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for sale." : "à vendre");
                            } else if ($result_obj[$_GET['mls']]['property']['price_buy'] == 0 && $result_obj[$_GET['mls']]['property']['price_rent'] > 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for rent." : "à louer");
                            }
                            ?>
                            <h1 class="sp-address mb-4"><?php echo $street ?>, <?php echo $city ?></h1>
                            <?php if ($result_obj[$_GET['mls']]['property']['status'] == "EV") { ?>
                                <div class="property-price-ctn">
                                    <h2><?= $result_obj[$_GET['mls']]['property']['price_buy'] != "0" ? "$" . number_format($result_obj[$_GET['mls']]['property']['price_buy'], 0) : "$" . number_format($result_obj[$_GET['mls']]['property']['price_rent'], 0) . "/" . $result_obj[$_GET['mls']]['property']['price_rent_per']; ?></h2>
                                    <span>- MLS: <?= $_GET['mls']; ?></span>
                                </div>
                            <?php } ?>
                            <div class="badges margin-bottom-32px">
                                <span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/649f1b5831e1f1e01693f802_icon-3-features-property-posts-realtor-template.svg"
                                         alt="bedroom icon">
                                    <?php echo $result_obj[$_GET['mls']]['property']['bedrooms'] ?>
                                </span>
                                <span>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/649f1b5831e1f1e01693f7ff_icon-2-features-property-posts-realtor-template.svg"
                                         alt="bathroom icon">
                                    <?php echo $result_obj[$_GET['mls']]['property']['bathrooms'] ?> 
                                </span>
                            </div>
                            <hr/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p><?= nl2br($result_obj[$_GET['mls']]['description']); ?> </p>
                            <p><?= nl2br($result_obj[$_GET['mls']]['addendum']); ?></p>
                            <p>&zwj;</p>
                            <p class="mb-3">
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'BUILDING:' : 'BÂTIMENT :'; ?>
                            </p>
                            <div class="resp_table mb-5">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th class="prop-table"
                                            class="ft"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Type' : 'Type'); ?></th>
                                        <td class="ft text-right"><?php echo $result_obj[$_GET['mls']]['property']['property_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Style' : 'Style'); ?></th>
                                        <td class="text-right"><?php echo $result_obj[$_GET['mls']]['property']['building_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Dimensions' : 'Dimensions'); ?></th>
                                        <td class="text-right"><?php echo $result_obj[$_GET['mls']]['property']['profondeur_batiment'] . "x" . $result_obj[$_GET['mls']]['property']['facade_batiment'] . " " . $result_obj[$_GET['mls']]['property']['um_dimension_batiment'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Lot Size' : 'La Taille Du Lot'); ?></th>
                                        <td class="text-right"><?php echo $result_obj[$_GET['mls']]['property']['superficie_terrain'] . " " . $result_obj[$_GET['mls']]['property']['um_superficie_terrain'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mb-3">
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'ROOM DETAILS' : 'DÉTAILS DES PIÈCES'; ?>
                            </p>
                            <div class="resp_table mb-5">
                                <table class="table">
                                    <tbody id="roomDetails">
                                    <tr>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Room' : 'Pièce'); ?></th>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Dimensions' : 'Dimensions'); ?></th>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Level' : 'Niveau'); ?></th>
                                        <th class="prop-table"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'Flooring' : 'Sol'); ?></th>
                                    </tr>
                                    <?php if ($result_obj[$_GET['mls']]['room_details'] && COUNT($result_obj[$_GET['mls']]['room_details']) > 0) {
                                        foreach ($result_obj[$_GET['mls']]['room_details'] as $room) {
                                            $dim = explode("x", $room['dimensions']);
                                            ?>
                                            <tr>
                                                <td data-title="<?php _e("Room", "mw-properties"); ?>"><?php echo $room['title'] ?></td>
                                                <td data-title="<?php _e("Dimensions", "mw-properties"); ?>"><?php echo $dim[0] . " x " . $dim[1] ?></td>
                                                <td data-title="<?php _e("Level", "mw-properties"); ?>"><?php echo Mw_real_estate::switchRoom($room['etage'], $lang) ?></td>
                                                <td data-title="<?php _e("Flooring", "mw-properties"); ?>"><?php echo $room['value'] ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <th colspan="4" class="text-center">N/A</th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mb-3">
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'CHARACTERISTICS' : 'CARACTÉRISTIQUES'; ?>
                            </p>
                            <div class="resp_table mb-5">
                                <table class="table">
                                    <tbody id="charateristics">
                                    <?php if ($result_obj[$_GET['mls']]['characteristics'] && COUNT($result_obj[$_GET['mls']]['characteristics']) > 0) {
                                        foreach ($characteristics as $key => $room) { ?>
                                            <tr>
                                                <th class="prop-table" width="20%"><?php echo $key ?></th>
                                                <td><?php echo implode(", ", $room) ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <th colspan="2" class="text-center">N/A</th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mb-3">
                                <?= ICL_LANGUAGE_CODE === 'en' ? 'EXPENSES' : 'DÉPENSES'; ?>
                            </p>
                            <div class="resp_table mb-5">
                                <table class="table">
                                    <tbody>
                                    <?php if (isset($result_obj[$_GET['mls']]['expenses']) && !empty($result_obj[$_GET['mls']]['expenses'])) { ?>
                                        <?php foreach ($result_obj[$_GET['mls']]['expenses'] as $expense) {
                                            $eyr = $expense['year'] != 0 ? " (" . $expense['year'] . ")" : "";
                                            ?>
                                            <tr>
                                                <th class="prop-table"><?php echo $expense['title'] . $eyr ?></th>
                                                <td class="text-right"><?php echo "$ " . $expense['amount'] . " / " . Mw_real_estate::switchFreq($expense['frequency'], $lang) ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <th colspan="2" class="text-center">N/A</th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <h3><?= ICL_LANGUAGE_CODE === 'en' ? 'Gallery' : 'Galerie'; ?></h3>
                        </div>
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <a class="imgbox" data-fancybox="gallery"
                                   data-src="<?= $result_obj[$_GET['mls']]['images'][$i]['photourl'] ?>">
                                    <img src="<?= $result_obj[$_GET['mls']]['images'][$i]['photourl'] ?>" alt=""/>
                                    <div class="overlay">
                                        <img class=""
                                             src="<?php echo get_template_directory_uri(); ?>/assets/img/eye.svg"
                                             alt=""/>
                                    </div>
                                </a>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5 col-md-12 col-12 sticky-col">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($result_obj[$_GET['mls']]['property']['price_buy'] > 0 && $result_obj[$_GET['mls']]['property']['price_rent'] > 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for rent/sale." : "à louer/vendre");
                            } else if ($result_obj[$_GET['mls']]['property']['price_buy'] > 0 && $result_obj[$_GET['mls']]['property']['price_rent'] == 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for sale." : "à vendre");
                            } else if ($result_obj[$_GET['mls']]['property']['price_buy'] == 0 && $result_obj[$_GET['mls']]['property']['price_rent'] > 0) {
                                $prop_status = (ICL_LANGUAGE_CODE === 'en' ? "for rent." : "à louer");
                            }
                            ?>
                            <?php if ($result_obj[$_GET['mls']]['property']['status'] == "EV") { ?>
                                <h4><?= $result_obj[$_GET['mls']]['property']['property_type'] . " " . $prop_status; ?></h4>
                                <div class="property-price-ctn">
                                    <h2><?= $result_obj[$_GET['mls']]['property']['price_buy'] != "0" ? "$" . number_format($result_obj[$_GET['mls']]['property']['price_buy'], 0) : "$" . number_format($result_obj[$_GET['mls']]['property']['price_rent'], 0) . "/" . $result_obj[$_GET['mls']]['property']['price_rent_per']; ?></h2>
                                </div>
                            <?php } ?>
                            <?php echo do_shortcode('[contact-form-7 id="dfb474a" title="Request Info"]'); ?>
                        </div>
                    </div>

                    <?php if (array_key_exists($_GET['mls'], $oh)): ?>
                        <div class="open-house text-white">
                            <h3 class="text-uppercase text-white text-center"><?php echo(ICL_LANGUAGE_CODE == 'en' ? 'OPEN HOUSE' : 'VISITE LIBRE') ?></h3>
                            <p class="text-center">
                                <?php echo date_i18n("l, j F, Y", strtotime($oh[$_GET['mls']][0]['date_start'])); ?>
                                |
                                <span class="big"><?php echo $oh[$_GET['mls']][0]['time_start'] . ' - ' . $oh[$_GET['mls']][0]['time_end']; ?></span>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <!--Featured props start-->
<?php $indicatorCount = 0;
$new_arr = [];
foreach ($related_obj->results as $key => $value) {
    if ($value->property->mls_no != $_GET['mls']) {
        $indicatorCount++;
        $new_arr[] = $value;
        if ($indicatorCount == 6)
            break;
    } else
        unset($related_obj->results[$key]);

} ?>

<?php if ($related_obj->results): ?>
    <section class="explore propeties-section pdetails">
        <div class="container">
            <div class="row pt-5">
                <div class="col-12 mt-5">
                    <h2><?= ICL_LANGUAGE_CODE === 'en' ? 'Related properties' : 'Propriétés connexes'; ?></h2>
                </div>
            </div>
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 mt-5">
                <?php
                $related = array_chunk($new_arr, 6);
                ?>
                <?php for ($i = 0; $i < (count($new_arr) / 6); $i++): ?>
                    <?php foreach ($related[$i] as $key => $value): ?>
                        <?php if ($value->property->mls_no != $_GET['mls']): ?>
                            <?php
                            $address = $value->property->civic_number_start . " " . $value->property->street_name;
                            //$price = $value->property->price_buy != "0" ? number_format($value->property->price_buy, 0) : number_format($value->property->price_rent, 0) . "/" . $value->property->price_rent_per;
                            ?>
                            <div class="col">
                                <a href="<?php echo esc_url(get_property_permalink($value->property)); ?>" class="card">
                                    <img src="<?= $value->images[0]->photourl; ?>" class="card-img-top"/>
                                    <span class="badge bg-primary">For Sale</span>
                                    <div class="card-body">
                                        <h3><?= $address . " " . $value->property->municipality_name; ?></h3>
                                        <p><?= descriptionExcerpt($value->property->remarks); ?></p>
                                        <hr/>
                                        <div class="d-flex prop-feat">
                                            <div>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-bedroom.svg"/> <?= $value->property->bedrooms; ?>
                                            </div>
                                            <div>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-bathroom.svg"/> <?= $value->property->bathrooms; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
function format_telephone($phone_number)
{
    $cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
    preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
    return "({$matches[1]}) {$matches[2]}-{$matches[3]}";
}

?>
    <script>
        window.MW = window.MW || {};
        MW.current_property = {mls: "<?= $_GET['mls'] ?>", lat: <?= $longlat[0] ?>, long: <?= $longlat[1] ?>};
        (function ($) {
            $(function () {
                $("input[name='property-mls']").val(MW.current_property.mls);

            });
        })(jQuery);
    </script>

    <script>
        (function ($) {
            var init = false,
                map,
                streetMap;
            $(function () {

                $("#openModal").click(function (e) {
                    e.preventDefault();
                    $("#video").modal('toggle');
                    return false;
                });

                Fancybox.bind("[data-fancybox]", {});

                $('#images-popup').on('click', function () {
                    Fancybox.show(
                        [
                            <?php foreach ($result_obj[$_GET['mls']]['images'] as $img) { ?>
                            {

                                src: "<?= $img['photourl'] ?>",
                                type: "image",
                            },
                            <?php } ?>
                        ]
                    );
                });
            });
        })(jQuery);
    </script>


<?php get_footer(); ?>