<?php
/**
 * Custom taxonomies for use with this theme
 *
 *
 */
function custom_taxonomies() {
    // Offer category
    register_taxonomy(
        'offer_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'offer',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Categories', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'offers',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            ),
		    'show_in_rest' => true
        )
    );
    // Culinary Type
    register_taxonomy(
        'culinary_time',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'culinary',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Time', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'culinaries',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            ),
		    'show_in_rest' => true
        )
    );
    // Room Type
    register_taxonomy(
        'room_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'room',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Category', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'rooms',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            ),
		    'show_in_rest' => true
        )
    );
}
add_action( 'init', 'custom_taxonomies');
