<?php

/**
 * Custom About Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'about-block-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'about-block';
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
        <?php if( $people = get_terms( 'people_category' ) ): ?>
            <div class="people-category">
                <select name="" id="" class="people-filter" jcf-select>
                    <?php foreach( $people as $person ): ?>
                        <option value="<?php echo $person->term_id; ?>"><?php echo $person->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="people-container">
            <?php if( $heading = get_field( 'heading', 'people_category_' . $people[0]->term_id ) ): ?>
            <h3 class="people-title"><?php echo $heading; ?></h3>
            <?php endif; ?>
            <?php 
            $args = array(
                'post_type'         => 'people',
                'post_status'       => 'publish',
                'tax_query'         => array(
                    array(
                        'taxonomy'      => 'people_category',
                        'field'         => 'term_id',
                        'terms'         => $people[0]->term_id   
                    )
                ),  
                'posts_per_page'    => 3,
            );
            $query = new WP_Query( $args );
            if( $query->have_posts() ): ?>
            <div class="people-grid">
                <?php while( $query->have_posts() ): $query->the_post();
                    get_template_part( 'templates/loop', 'people', array( 'id' => get_the_ID() ) );
                endwhile; ?> 
            </div>
            <?php endif; 
            if( $query->max_num_pages > 1 ): ?>
                <div class="people-grid__cta">
                    <button class="btn" id="load-more-people" data-page="1">Load More</button>
                </div>
            <?php endif;
            wp_reset_query(  ); ?>
        </div>
    </div>
</section>