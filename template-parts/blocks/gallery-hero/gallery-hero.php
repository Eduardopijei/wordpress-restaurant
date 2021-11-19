<?php

/**
 * Gallery Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'gallery-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gallery-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$images = get_field( 'gallery' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if( $images) : ?>
        <div class="gallery-hero__images">
            <?php foreach( $images as $key=>$image ): ?>
                <div class="gallery-hero__image">
                    <img class="lazyload" 
                        data-src="<?php echo $image['sizes']['gallery-hero-' . ($key + 1)]; ?>" 
                        data-srcset="<?php echo $image['sizes']['gallery-hero-' . ($key + 1) . '-2x']; ?> 2x" 
                        alt="<?php echo $image['alt']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="static-images">
            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/dynamic/hero-gallery-default.png" alt="">
            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/dynamic/hero-gallery-default.png" alt="">
            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/dynamic/hero-gallery-default.png" alt="">
        </div>
    <?php endif; ?>
</section>