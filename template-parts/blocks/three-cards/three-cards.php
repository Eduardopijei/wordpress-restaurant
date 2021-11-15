<?php

/**
 * Three cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'three-cards-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'three-cards';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<?php if( have_rows( 'cards' ) ): ?> 
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="three-cards__inner">
            <?php while( have_rows( 'cards' ) ): the_row( ); ?>
                <div class="card a-up">
                    <div class="card-image">
                        <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'is' => 'three-cards' ) ); ?>
                        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'span', 'tc' => 'card-text') ); ?>
                    </div>
                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'h6', 'tc' => 'card-title') ); ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary a-up a-delay-1' ) ); ?>
    </div>
</section>
<?php endif; ?>