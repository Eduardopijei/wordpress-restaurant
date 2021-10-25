<?php

/**
 * Responsive Spacer Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'responsive-spacer-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'responsive-spacer';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$large = get_field('large');
$medium = get_field('medium');
$small = get_field('small');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
</section>
<style>
    <?php echo '#' . esc_attr($id); ?> {
        width: 100%;
    }
    <?php if ($small) : ?>
    <?php echo '#' . esc_attr($id); ?> {
        height: <?php echo $small; ?>px;
    }
    <?php endif; ?>
    <?php if ($medium) : ?>
        @media (min-width: 769px) {
            <?php echo '#' . esc_attr($id); ?> {
                height: <?php echo $medium; ?>px;
            }
        }
    <?php endif; ?>
    <?php if ($large) : ?>
        @media (min-width: 1201px) {
            <?php echo '#' . esc_attr($id); ?> {
                height: <?php echo $large; ?>px;
            }
        }
    <?php endif; ?>
</style>