<?php

/**
 * Offers Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'offers-grid-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'offers-grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php $terms = get_terms( 'offer_category' );
        if( $terms ): ?>
        <div class="offer-category">
            <select name="" id="" class="offer-category__select" jcf-select>
                <option value="">Type of offer</option>
                <?php foreach( $terms as $term ): ?>
                    <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        <?php $args = array(
            'post_type' => 'offer',
            'post_status' => 'publish',
            'posts_per_page' => 6
        );
        $query = new WP_Query( $args );
        if( $query->have_posts() ): ?>
        <div class="loop-offers" id="offers-grid">
            <?php 
            while( $query->have_posts() ): $query->the_post(); 
                get_template_part( 'templates/loop', 'offer', array( 'post' => get_the_ID() ) ); 
            endwhile; ?>
        </div>
        <?php 
        endif; 
        if( $query->max_num_pages > 1 ): ?>
        <div class="offers-grid__cta">
            <button class="btn" id="load-more-offers" data-page="1">View More Offers</button>
        </div>
        <?php endif;
        wp_reset_query(  ); ?>
    </div>
</section>