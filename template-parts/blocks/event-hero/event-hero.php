<?php

/**
 * Event Hero Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'event-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'event-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
global $post;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'o' => 'f', 'c' => 'event-hero__bg', 'v2x' => false ) ); ?>
    <?php 
    $type = get_post_type( $post );
    if( $type == 'tribe_event' ): 
        $start_day = tribe_get_start_date( $post->ID, false, 'd' );
        $start_month = tribe_get_start_date( $post->ID, false, 'F' );
        $end_day = tribe_get_end_date( $post->ID, false, 'd' );
        $end_month = tribe_get_end_date( $post->ID, false, 'F' ); 
    else: 
        $start_day = get_the_date( 'd', $post );
        $start_month = get_the_date( 'F', $post );
    endif; ?>
    <div class="event-hero__date">
        <div class="date">
            <div class="date-day"><?php echo $start_day; ?></div>
            <div class="date-month"><?php echo $start_month; ?></div>
        </div>
    </div>
    
</section>