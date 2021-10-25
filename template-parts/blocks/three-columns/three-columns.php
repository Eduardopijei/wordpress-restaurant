<?php

/**
 * Custom Three Columns Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'three-columns-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'three-columns';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading'); 
$content = get_field('content');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="row a-up">
            <?php if ($heading) : ?>
            <div class="col-heading">
                <h3><?php echo $heading; ?></h3>
            </div>
            <?php endif; ?>
            <?php if ($content) : ?>
            <div class="col-content">
                <?php echo $content; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>