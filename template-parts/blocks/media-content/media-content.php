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
if ($direction == true) $className .= ' media-content--left';
$className .= ' ' . get_field('vertical_direction') ?: 'middle';
$className .= (get_field('content_padding') == false) ? ' no-padding' : '';
$has_slider = get_field( 'has_slider' );
$className .= $has_slider ? ' has-slider' : '';
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if( $has_slider): ?>
            <?php if( $images = get_field( 'gallery' ) ): ?>
            <div class="media-content__media">
                <?php foreach( $images as $image ): ?>
                    <?php 
                        get_template_part( 'templates/content-module', 'media', array(
                            'image' => $image,
                        ) );
                    ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php elseif ($image || $video) : ?>
            <div class="media-content__media">
                <?php 
                    get_template_part( 'templates/content-module', 'media', array(
                        'image' => $image,
                        'video' => $video
                    ) );
                ?>
            </div>
        <?php endif; ?>
        <div class="media-content__content">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'media-content__title a-up' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'text', 'o' => 'f', 't' => 'div', 'tc' => 'media-content__text a-up a-delay-1' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary media-content__btn a-up a-delay-2' ) ); ?>
        </div>
    </div>
</section>