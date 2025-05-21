<?php
if ( function_exists('get_field') ) :

    $faqs = get_field('faqs');

    if ( !empty($faqs) && is_array($faqs) ) {

        $main_entities = [];

        foreach ( $faqs as $block ) {

            if ( !empty($block['faq']) && is_array($block['faq']) ) {
                foreach ( $block['faq'] as $entry ) {
                    $question = isset($entry['question']) ? trim($entry['question']) : '';
                    $answer   = isset($entry['answer']) ? trim($entry['answer']) : '';

                    if ( $question && $answer ) {
                        $main_entities[] = [
                            "@type" => "Question",
                            "name" => wp_strip_all_tags($question),
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => wp_kses_post($answer)
                            ]
                        ];
                    }
                }
            }
        }

        if ( !empty($main_entities) ) {
            $faq_schema = [
                "@context" => "https://schema.org",
                "@type" => "FAQPage",
                "mainEntity" => $main_entities
            ];

            echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
        }
    }

endif;
?>


