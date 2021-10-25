<?php

/**
 * Media Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'media-content-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'media-content';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$direction = get_field('content_direction');
$image = get_field('image');
$video = get_field('video');
$heading = get_field('heading');
$text = get_field('text');
$cta = get_field('cta');
if ($direction == true) $className .= ' media-content--left';
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ($image || $video) : ?>
            <div class="media-content__media">
                <?php 
                    get_template_part( 'templates/content-modules', 'image', array(
                        'image' => $image,
                        'video' => $video
                    ) );
                ?>
            </div>
        <?php endif; ?>
        <div class="media-content__content">
            <?php if ($heading) : ?>
                <h2 class="media-content__title a-up"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php if ($text) : ?>
                <div class="media-content__text a-up a-delay-1">
                    <?php echo $text; ?>
                </div>
            <?php endif; ?>
            <?php if ($cta) : ?>
                <a href="<?php echo $cta['url']; ?>" 
                    class="cta media-content__cta a-up a-delay-2" 
                    target="<?php echo $cta['target']; ?>">
                    <?php echo $cta['title']; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>