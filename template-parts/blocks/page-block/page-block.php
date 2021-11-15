<?php

/**
 * Page Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'page-block-' . $block['id'];


// Create class attribute allowing for custom "className" and "align" values.
$className = 'page-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'page-block__heading a-up' ) ); ?>
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f', 't' => 'h6', 'tc' => 'page-block__subheading a-up a-delay-1' ) ); ?>
    </div>
    <div class="page-block__banner gradient-overlay a-up a-delay-2">
        <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'o' => 'f', 'is' => 'page-block', 'c' => 'page-block__img' ) ); ?>
        <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'link', 'o' => 'f', 'c' => 'btn btn--primary page-block__cta') ); ?>
    </div>
</div>