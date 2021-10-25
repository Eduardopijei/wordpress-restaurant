<?php

/**
 * Contact Form Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'contact-form-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'contact-form';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$code = get_field('form_shortcode');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ($heading) : ?>
            <h2 class="h1 contact-form__heading a-up"><?php echo $heading; ?></h2>
        <?php endif; ?>
        <?php if ($code) : ?>
        <div class="contact-form__inner a-up a-delay-1">
            <?php echo do_shortcode( $code ); ?>
        </div>
        <?php endif; ?>
    </div>
</section>