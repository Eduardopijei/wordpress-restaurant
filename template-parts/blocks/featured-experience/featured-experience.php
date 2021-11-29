<?php

/**
 * Featured Experiences Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'featured-experience-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'featured-experience';
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
        <?php 
        if( $experiences = get_field( 'experience' ) ): 
            foreach( $experiences as $experience ): ?>
            <div class="featured-experience__left">
                <div class="single-experience">
                    <div class="single-experience__featured a-up">Featured Experience</div>
                    <div class="single-experience__img gradient-overlay a-up a-delay-1">
                        <img src="<?php echo get_the_post_thumbnail_url( $experience ); ?>" alt="<?php echo get_the_title( $experience ); ?>">
                    </div>
                    <div class="single-experience__content a-up a-delay-2">
                        <h6 class="single-experience__title"><?php echo get_the_title( $experience ); ?></h6>
                        <p class="single-experience__desc"><?php echo get_the_excerpt( $experience ); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;
        endif; ?>
        <div class="featured-experience__right">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'featured-experience__heading a-up' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 't' => 'div', 'tc' => 'featured-experience__content a-up a-delay-1' ) ); ?>
        </div>
    </div>
</section>