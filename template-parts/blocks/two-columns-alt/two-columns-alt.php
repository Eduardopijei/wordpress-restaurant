<?php

/**
 * Custom Two Columns Alt Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'two-columns-alt-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-columns-alt';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
if( $no_padding = get_field( 'no_padding' ) ):
    $className .= ' no-padding';
endif;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'a-up' ) ); ?>
        <?php if( have_rows( 'columns' ) ): ?>
        <div class="row">
            <?php while( have_rows( 'columns' ) ): the_row( ); ?>
            <div class="col a-up a-delay-<?php echo get_row_index(); ?>">
                <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'w' => 'div', 'wc' => 'col-image' ) ); ?>
                <div class="col-content">
                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'h6' ) ); ?>
                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 't' => 'p' ) ); ?>
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'c' => 'cta' ) ); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>