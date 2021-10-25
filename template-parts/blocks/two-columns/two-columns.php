<?php

/**
 * Custom Two Columns Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'two-columns-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-columns';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$left_column = get_field('left_column'); 
$right_column = get_field('right_column');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="row">
            <?php if ($left_column) : ?>
            <div class="col col-left a-right">
                <?php echo $left_column; ?>
            </div>
            <?php endif; ?>
            <?php if ($right_column) : ?>
            <div class="col col-right a-left">
                <?php echo $right_column; ?>
            </div>
            <?php endif; ?>
            <span class="line a-down"></span>
        </div>
    </div>
</section>