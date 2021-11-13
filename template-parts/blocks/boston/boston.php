<?php

/**
 * Bostom Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'boston-module-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'boston-module';
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
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'boston-module__heading heading--mobile a-up' ) ); ?>
        <div class="boston-module__inner">
            <div class="boston-module__image a-up">
                <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'o' => 'f', 'is' => 'boston-module' ) ); ?>
            </div>
            <div class="boston-module__content">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'boston-module__heading a-up' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'subheading', 'o' => 'f', 't' => 'h6', 'tc' => 'boston-module__subheading a-up a-delay-1' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 't' => 'div', 'tc' => 'boston-module__desc a-up a-delay-2' ) ); ?>
                <div class="boston-module__buttons a-up a-delay-2">
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'button', 'o' => 'f', 'c' => 'btn btn--primary btn-booking') ); ?>
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'cta cta-reverse') ); ?>
                </div>
            </div>
        </div>
    </div>
</section>