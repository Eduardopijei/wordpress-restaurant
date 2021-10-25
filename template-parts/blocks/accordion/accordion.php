<?php

/**
 * Custom Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'accordions-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordions';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$heading_tag = get_field( 'heading_tag' ) ?: 'h3';
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<div class="container">
    <?php if ($heading) : ?>
        <<?php echo $heading_tag; ?> class="accordions-heading a-up"><?php echo $heading; ?></<?php echo $heading_tag; ?>>
    <?php endif; ?>
    <?php if (have_rows('accordions')) : ?>
        <?php while (have_rows('accordions')) : the_row(); ?>
            <div class="accordion a-up">
                <?php if ($title = get_sub_field('title')) : ?>
                    <div class="accordion-title"><?php echo $title; ?></div>
                <?php endif; ?>
                <?php if ($content = get_sub_field('content')) : ?>
                    <div class="accordion-content">
                        <div class="accordion-content__inner">
                            <?php echo $content; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
</section>