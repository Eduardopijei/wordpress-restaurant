<?php

/**
 * Home Map Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'home-map-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home-map';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$default_location_id = get_field( 'default_location' );
$default_location = get_field( 'location', $default_location_id[0] );
$args = array(
    'post_type' => 'location',
    'post_status' => 'publish',
    'posts_per_page' => -1,
);
$locations = new WP_Query( $args );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="home-map__bg">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'home-map__heading a-op' ) ); ?>
        <?php if( $locations->have_posts() ): ?>
        <div class="home-map__map acf-map" 
            data-zoom="10" 
            data-id="<?php echo $default_location_id[0]; ?>"
            data-lat="<?php echo $default_location['lat']; ?>"
            data-lng="<?php echo $default_location['lng']; ?>">
            <?php 
            while( $locations->have_posts() ): $locations->the_post();
                if( $location = get_field( 'location', get_the_ID() ) ): ?>
                    <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-id="<?php echo get_the_ID(); ?>" data-icon="<?php echo get_field( 'location_icon', get_the_ID() ); ?>">
                        <h6 class="marker-title"><?php echo get_the_title(); ?></h6>
                    </div>
            <?php endif;
            endwhile; ?> 
        </div>
        <?php endif; 
        wp_reset_query(); ?>
    </div>
    <div class="home-map__content">
        <div class="container">
            <div class="home-map__places a-up a-delay-1">
                <div class="tab">
                    <div class="tab-links">
                        <a href="#tab-walking" class="tab-link active">
                            WALKING 
                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.88672 4.15468C9.80279 4.15468 10.5454 3.39645 10.5454 2.46113C10.5454 1.52581 9.80279 0.767578 8.88672 0.767578C7.97065 0.767578 7.22803 1.52581 7.22803 2.46113C7.22803 3.39645 7.97065 4.15468 8.88672 4.15468Z" fill="#9C9C9C"/>
                            <path d="M13.2635 11.4235L9.96312 5.8101C9.6646 5.27705 9.03577 4.71711 7.90357 4.76675C6.914 4.81014 5.30104 6.44503 4.16306 7.19903C3.63351 7.54982 3.65068 8.49354 3.55718 9.05748C3.43461 9.79586 3.31221 10.5342 3.18947 11.2724C3.06724 12.0074 3.67261 12.3403 4.26744 12.0117C4.59333 11.8319 4.73596 11.3754 4.79291 11.032C4.93996 10.1465 5.13614 9.45531 5.28319 8.56974L6.32835 7.70361C5.97339 9.87119 5.65226 11.1518 5.32637 14.0737C5.22998 14.9383 5.11387 15.8241 4.91412 16.0898C4.26829 16.9493 3.7741 17.7941 3.11909 18.6464C2.19208 19.8523 3.84227 20.7787 4.69091 19.6746C5.27129 18.9194 5.85167 18.1643 6.43188 17.4093C7.25468 16.3385 7.21932 14.5924 7.43386 13.2833C8.08462 14.7184 8.73521 16.1528 9.38597 17.5879C9.68704 18.2523 9.98862 18.9168 10.29 19.5816C10.8527 20.8219 12.5867 20.1795 11.9956 18.877C11.1569 17.0281 10.4889 15.1791 9.65015 13.3303C9.38852 12.7528 8.97814 12.1908 9.06705 11.5625C9.21342 10.5337 9.35996 9.50512 9.50599 8.4767L9.5575 8.17659L11.9536 12.2302C12.0973 12.4732 12.3501 12.6079 12.6092 12.6079C12.7438 12.6079 12.8801 12.5716 13.0037 12.4954C13.3657 12.2729 13.4819 11.7928 13.2635 11.4235Z" fill="#9C9C9C"/>
                            </svg>
                        </a>
                        <a href="#tab-driving" class="tab-link">Driving</a>
                    </div>
                    <div class="tab-contents">
                        <div class="tab-content active" id="tab-walking">
                            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'location_heading', 'o' => 'f', 't' => 'h4' ) ); ?>
                            <ul id="tab-walking__list">
                                <!-- Dynamic contents here -->
                            </ul>
                        </div>
                        <div class="tab-content" id="tab-driving">
                            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'location_heading', 'o' => 'f', 't' => 'h4' ) ); ?>
                            <ul id="tab-driving__list">
                                <!-- Dynamic contents here -->
                            </ul>
                        </div>
                    </div>
                </div>
                <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'location_cta', 'o' => 'f', 'c' => 'btn btn--primary home-map__places--cta' ) ); ?>
            </div>
            <div class="home-map__posts a-up a-delay-2">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'posts_heading', 'o' => 'f', 't' => 'h6', 'tc' => 'home-map__posts--heading' ) ); ?>
                <div class="home-map__posts--grid">
                   <!-- Dynamic contents -->
                </div>
                <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'posts_cta', 'o' => 'f', 'c' => 'btn btn--accent home-map__posts--cta' ) ); ?>
            </div>
        </div>
    </div>
</section>