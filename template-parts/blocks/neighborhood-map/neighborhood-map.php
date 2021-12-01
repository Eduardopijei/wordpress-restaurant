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
$terms = get_terms( array(
    'taxonomy' => 'location_category',
    'hide_empty' => false,
) );


$args = array(
    'post_type' => 'location',
    'post_status' => 'publish',
    'posts_per_page' => -1,
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
        $args = array(
            'post_type' => 'location',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array( 
                array(
                    'taxonomy' => 'location_category',
                    'field' => 'slug',
                    'terms' => $terms[0]->slug
                )
            )
        );
        $locations = new WP_Query( $args ); 
        if( $locations->have_posts() ): ?>
        <div class="neighborhood-map__map acf-map"
            data-zoom="16">
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
        <?php endif; ?>
    </div>
</section>