<?php
add_shortcode('properties', function ($atts) {
    add_filter('acf/settings/current_language', '__return_false');

    $api_conf = shortcode_atts([
        // custom
        'agents' => '',

        // api options
        'category' => '',
        'region' => '',
        'type' => '',
        'municipalities' => '',
        'beds' => '',
        'baths' => '',
        'min_price' => '',
        'max_price' => '',
        'min_price_rent' => '',
        'max_price_rent' => '',
        'search_mls' => '',
        'status' => '',
        'start' => '',
        'limit' => '',
        'order' => '',
        'dir' => '',
        'open_house' => '',
        'q' => '',

        // results filter
        'mode' => "", // 'hybrid' for api + CPT (default), 'api' for just api, 'pocket' for just CPT, 'collaboration' for just collaboration
        'show_protected' => "", // include protected pocket listings

        // shortcode options
        'id' => '',
        'rows' => '',
        'open' => '',
        'filter' => '',
        'pagination' => '',
        'pagination_lazy' => '', // layloaded properties
        'title' => '',
        'map' => '',
        'cluster' => '',
        'slider' => '',
        'slick' => '',
        'color' => '',
        'accents' => '',
        'search' => '',
        'homepage' => '',
        'exclude_mls' => '',
        'hide_collaboration' => '',

        // new custom template
        'template' => '',
        'wrap' => ''
    ], $atts);

    $api_config = [
        // custom
        'agents' => $api_conf['agents'],

        // api options
        'category' => $api_conf['category'],
        'region' => $api_conf['region'],
        'type' => $api_conf['type'],
        'municipalities' => $api_conf['municipalities'],
        'beds' => $api_conf['beds'],
        'baths' => $api_conf['baths'],
        'min_price' => $api_conf['min_price'],
        'max_price' => $api_conf['max_price'],
        'min_price_rent' => $api_conf['min_price_rent'],
        'max_price_rent' => $api_conf['max_price_rent'],
        'search_mls' => $api_conf['search_mls'],
        'status' => $api_conf['status'],
        'start' => $api_conf['start'],
        'limit' => $api_conf['limit'],
        'order' => $api_conf['order'],
        'dir' => $api_conf['dir'],
        'open_house' => $api_conf['open_house'],
        'q' => $api_conf['q'],

        // results filter
        'mode' => $api_conf['mode'], // 'hybrid' for api + CPT (default), 'api' for just api, 'pocket' for just CPT
        'show_protected' => $api_conf['show_protected'], // include protected pocket listings

        // shortcode options
        'id' => $api_conf['id'],
        'rows' => $api_conf['rows'],
        'open' => $api_conf['open'],
        'filter' => $api_conf['filter'],
        'pagination' => $api_conf['pagination'],
        'pagination_lazy' => $api_conf['pagination_lazy'],
        'title' => $api_conf['title'],
        'map' => $api_conf['map'],
        'cluster' => $api_conf['cluster'],
        'slider' => $api_conf['slider'],
        'slick' => $api_conf['slick'],
        'color' => $api_conf['color'],
        'accents' => $api_conf['accents'],
        'searchBox' => $api_conf['search'], // change to searchBox to prevent recursion
        'homepage' => $api_conf['homepage'],
        'exclude_mls' => $api_conf['exclude_mls'], // comma-separated list of MLS' to exclude (post_id does not work)
        'hide_collaboration' => $api_conf['hide_collaboration'],

        // new custom template
        'template' => $api_conf['template'],
        'wrap' => $api_conf['wrap']
    ];

    $this->real_estate_api = new Mw_real_estate($api_config);
	
    $display = $this->real_estate_api->displayAllProperties();

    add_filter('acf/settings/current_language', function () {
        return ICL_LANGUAGE_CODE;
    });

    return $display;

});
