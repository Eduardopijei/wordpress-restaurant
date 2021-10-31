<?php

/**
 * Content Background Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'content-background-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'content-background gradient-overlay';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'background', 'o' => 'f', 'w' => 'div', 'wc' => 'content-background__bg' ) ); ?>
    <div class="content-background__inner">
        <div class="container">
            <div class="content">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'content-background__heading a-right' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 'o' => 'f', 't' => 'h6', 'tc' => 'content-background__description a-right a-delay-1' ) ); ?>
            </div>
            <?php if( have_rows( 'ctas' ) ): ?>
            <div class="buttons a-left">
                <?php while( have_rows( 'ctas' ) ): the_row( ); ?>
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'c' => 'btn btn--outline' ) ); ?> 
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>