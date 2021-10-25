<?php

/**
 * Custom Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'custom-media-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-media';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$image = get_field('image'); 
$video = get_field('video');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if ($video) : ?>
        <div class="img-a-video">
            <?php if ($image): ?>
                <div class="img-a-img">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
            <?php endif; ?>
            <div class="img-a-bg-video">
                <video autoplay playsinline muted preload="metadata" src="<?php echo $video; ?>" poster="<?php echo $image['url']; ?>">
                    <source src="<?php echo $video; ?>" type="video/mp4">
                </video>
            </div>
        </div>
    <?php elseif ($image) : ?>
        <div class="img-a">
            <div class="img-a-img">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            </div>
        </div>
    <?php endif; ?>
</section>