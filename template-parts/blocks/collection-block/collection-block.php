<?php

/**
 * Block Collection Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'collection-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'collection';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> a-up">
    <div class="collection-inner">
        <div class="container">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'collection-heading' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 't' => 'div', 'tc' => 'collection-content' ) ); ?>
        </div>
        <?php if( have_rows( 'collections' ) ): ?>
            <div class="collection-items">
                <?php while( have_rows( 'collections' ) ): the_row( ); ?>
                    <div class="collection-item gradient-overlay">
                        <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'c' => 'collection-image', 'is' => 'collection-image' ) ); ?>
                        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'h6', 'tc' => 'collection-caption' ) ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>