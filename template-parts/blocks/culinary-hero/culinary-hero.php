<?php

/**
 * Culinary Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'culinary-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'culinary-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$image = get_field( 'image' );
$logo = get_field( 'logo' );
$opacity = get_field( 'gradient_opacity' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if( $image ): ?>
        <div class="culinary-hero__bg gradient-overlay">
            <img src="<?php echo $image; ?>" alt="">
        </div>
    <?php endif; ?>
    <?php if( $logo ): ?>
        <img class="culinary-hero__logo" src="<?php echo $logo; ?>" alt="">
    <?php endif; ?>
</section>

<style>
    #<?php echo $id; ?> .culinary-hero__bg::after {
        opacity: <?php echo floatval(intval($opacity) / 100); ?> !important;
    }
</style>