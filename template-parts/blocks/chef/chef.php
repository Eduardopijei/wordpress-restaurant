<?php

/**
 * Chef Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'chef-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'chef';
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
        <div class="chef-top">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'chef-heading a-up' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 'w' => 'div', 'wc' => 'chef-content a-up a-delay-1' ) ); ?>
        </div>
        <?php if( have_rows( 'chef' ) ): ?>
        <div class="chef-grid a-up">
            <?php while( have_rows( 'chef' ) ): the_row(); ?>
                <div class="chef-card">
                    <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'is' => 'culinary-grid', 'c' => 'chef-image' ) ); ?>
                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'role', 't' => 'h3', 'tc' => 'chef-role' ) ); ?>
                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'name', 't' => 'h6', 'tc' => 'chef-name' ) ); ?> 
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>