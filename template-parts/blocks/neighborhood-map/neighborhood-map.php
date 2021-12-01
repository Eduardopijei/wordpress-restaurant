<?php

/**
 * Neighborhood Map Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'neighborhood-map-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'neighborhood-map';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$default_location_id = get_field( 'default_location' );
$default_location = get_field( 'location', $default_location_id[0] );
$terms = get_terms( array(
    'taxonomy' => 'location_category',
    'hide_empty' => false,
) );
$args = array(
    'post_type' => 'location',
    'post_status' => 'publish',
    'post_not_in' => $default_location_id,
    'tax_query' => array( 
        array(
            'taxonomy' => 'location_category',
            'field' => 'slug',
            'terms' => $terms[0]->slug
        )
    )
);
$locations = new WP_Query( $args );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="neighborhood-map__bg">
        <div class="neighborhood-map__title">
            <h6>Experience it all</h6>
            <?php if( $terms ): ?>
                <select name="" id="" class="neighborhood-map__category" jcf-select>
                    <?php foreach( $terms as $term ): ?>
                        <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </div>
        <?php  
        if( $locations->have_posts() ): ?>
        <div class="neighborhood-map__map acf-map"
            data-zoom="16"
            data-id="<?php echo $default_location_id[0]; ?>"
            data-lat="<?php echo $default_location['lat']; ?>"
            data-lng="<?php echo $default_location['lng']; ?>">
            <?php 
            while( $locations->have_posts() ): $locations->the_post();
                $id = get_the_ID();
                if( $location = get_field( 'location', $id ) ): ?>
                    <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-id="<?php echo $id; ?>" data-icon="<?php echo get_field( 'location_icon', $id ); ?>">
                        <div class="marker-info">
                            <div class="marker-img">
                                <img src="<?php echo get_the_post_thumbnail_url( $id ); ?>" alt="<?php echo get_the_title( $id ); ?>">
                            </div>
                            <div class="marker-content">
                                <h6 class="marker-title"><?php echo get_the_title( $id ); ?></h6>
                                <h6 class="marker-excerpt"><?php echo get_the_excerpt( $id ); ?></h6>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endwhile; ?> 
        </div>
        <?php endif;
        wp_reset_query(  ); ?>
    </div>
    <?php if( $locations->have_posts() ): ?>
        <div class="neighborhood-map__locations--wrapper">
            <div class="container">
                <div class="neighborhood-map__locations">
                    <?php while( $locations->have_posts() ): $locations->the_post(); 
                    $id = get_the_ID(); ?>
                    <div class="location-card location-card--location">
                        <div class="location-card__img gradient-overlay">
                            <img src="<?php echo get_the_post_thumbnail_url( $id ); ?>" 
                                alt="<?php echo get_the_title( $id ); ?>">
                            <h6 class="location-card__title"><?php echo get_the_title( $id ); ?></h6>
                        </div>
                        <div class="location-card__distance">
                            <span class="label">Distance</span>
                            <?php $location = get_field( 'location', $id );
                            $distance = ((ACOS(SIN($default_location['lat'] * PI() / 180) * SIN($location['lat'] * PI() / 180) + COS($default_location['lat'] * PI() / 180) * COS($location['lat'] * PI() / 180) * COS(($default_location['lng'] - $location['lng']) * PI() / 180)) * 180 / PI()) * 60 * 1.1515); ?>
                            <span class="value"><?php echo number_format((float)$distance, 2, '.', ''); ?> Miles</span>
                        </div>
                        <a href="<?php echo get_the_permalink( $id ); ?>" class="btn btn--primary location-card__cta">
                            More Info
                        </a>
                    </div>
                    <?php if( $nposts = get_field( 'posts', $id ) ):
                        foreach( $nposts as $npost ): ?>
                            <a href="<?php echo get_the_permalink( $npost ); ?>" class="location-card location-card--post">
                                <div class="location-card__img gradient-overlay">
                                    <img src="<?php echo get_the_post_thumbnail_url( $npost ); ?>" 
                                    alt="<?php echo get_the_title( $npost ); ?>">
                                    <h6 class="location-card__title"><?php echo get_the_title( $npost ); ?></h6>
                                </div>
                                <div class="location-card__content">
                                    <p class="location-card__excerpt"><?php echo get_the_excerpt( $npost ); ?></p>
                                </div>       
                            </a>
                    <?php endforeach;
                    endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php endif;
    wp_reset_query(  ); ?>
</section>