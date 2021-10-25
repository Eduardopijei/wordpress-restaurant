<?php

/**
 * Custom Wysiwig Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'custom-wysiwig-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-wysiwig';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$content = get_field('content'); 

$h1_color = get_field('h1_color');
$h2_color = get_field('h2_color');
$h3_color = get_field('h3_color');
$h4_color = get_field('h4_color');
$h5_color = get_field('h5_color');
$h6_color = get_field('h6_color');
$text_color = get_field('text_color');
$anchor_color = get_field('anchor_color');
?>
<?php if ($content) : ?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> a-up">
    <div class="container">
        <?php echo $content; ?>
    </div>
</section>
<?php endif; ?>
<style>
    <?php if ($h1_color) : ?>
        #<?php echo esc_attr($id); ?> h1 {
            color: <?php echo $h1_color; ?>;
        }
    <?php endif; ?>
    <?php if ($h2_color) : ?>
        #<?php echo esc_attr($id); ?> h2 {
            color: <?php echo $h2_color; ?>;
        }
    <?php endif; ?>
    <?php if ($h3_color) : ?>
        #<?php echo esc_attr($id); ?> h3 {
            color: <?php echo $h3_color; ?>;
        }
    <?php endif; ?>
    <?php if ($h4_color) : ?>
        #<?php echo esc_attr($id); ?> h4 {
            color: <?php echo $h4_color; ?>;
        }
    <?php endif; ?>
    <?php if ($h5_color) : ?>
        #<?php echo esc_attr($id); ?> h5 {
            color: <?php echo $h5_color; ?>;
        }
    <?php endif; ?>
    <?php if ($h6_color) : ?>
        #<?php echo esc_attr($id); ?> h6 {
            color: <?php echo $h6_color; ?>;
        }
    <?php endif; ?>
    <?php if ($text_color) : ?>
        #<?php echo esc_attr($id); ?> p {
            color: <?php echo $text_color; ?>;
        }
    <?php endif; ?>
    <?php if ($anchor_color) : ?>
        #<?php echo esc_attr($id); ?> a:not(.btn, .link, .cta) {
            color: <?php echo $anchor_color; ?>;
        }
    <?php endif; ?>
</style>