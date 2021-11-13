<?php

/**
 * Rooms Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'rooms-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rooms-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'background_image', 'o' => 'f', 'c' => 'rooms-hero__bg' ) ); ?>
    <div class="rooms-hero__content">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'rooms-hero__heading a-up' ) ); ?>
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f', 't' => 'h6', 'tc' => 'rooms-hero__subheading a-up a-delay-1' ) ); ?>
    </div>
</section>