<?php

/**
 * Blog More Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'blog-more-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blog-more';
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
        <div class="blog-more__content">
            <div class="blog-more__content--inner">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'blog-more__title a-up' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 't' => 'div', 'tc' => 'blog-more__text a-up a-delay-1' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary blog-more__btn a-up a-delay-2' ) ); ?>
            </div>
        </div>
        <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'o' => 'f', 'w' => 'div', 'wc' => 'blog-more__image a-up', 'is' => 'blog-more' ) ); ?>
    </div>
</section>