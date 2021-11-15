<?php

/**
 * Custom Blockquote Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'custom-blockquote-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-blockquote';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$image = get_field('image');
$video = get_field('video');
$text = get_field('text');
$name = get_field('name');
$role = get_field('role');
if ( !empty($image) || !empty($video) ) {
    $className .= ' has-media';
}
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ($image || $video) : ?>
        <div class="custom-blockquote__image">
            <?php 
                get_template_part( 'templates/content-modules', 'image', array(
                    'image' => $image,
                    'video' => $video
                ) );
            ?>
        </div>
        <?php endif; ?>
        <div class="custom-blockquote__content">
            <?php if ($text) : ?>
                <h2 class="custom-blockquote__text a-up"><?php echo $text; ?></h2>
            <?php endif; ?>
            <?php if ($name) : ?>
                <h6 class="custom-blockquote__name a-up a-delay-1"><?php echo $name; ?></h6>
            <?php endif; ?>
            <?php if ($role) : ?>
                <p class="custom-blockquote__role a-up a-delay-2"><?php echo $role; ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>