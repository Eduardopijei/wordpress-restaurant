<?php

/**
 * Culinary Form Booking Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'culinary-form-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'culinary-form';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' );
$sub_heading = get_field( 'sub_heading' );
$content = get_field( 'content' );
$form = get_field( 'form' );
$images = get_field( 'images' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if( $images ): ?>
    <div class="culinary-form__images a-left">
        <div class="culinary-form__slides">
            <?php foreach( $images as $image): ?>
                <div class="culinary-form__image">
                    <img class="lazyload"
                        data-src="<?php echo $image['sizes']['culinary-form']; ?>" 
                        data-srcset="<?php echo $image['sizes']['culinary-form-2x']; ?> 2x" 
                        alt="<?php echo $image['alt']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="culinary-form__content a-right">
        <div class="container">
            <?php if( $heading ): ?>
                <h2 class="culinary-form__heading"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php if( $sub_heading): ?>
                <h6 class="culinary-form__subheading"><?php echo $sub_heading; ?></h6>
            <?php endif; ?>
            <?php if( $content ): ?>
                <div class="culinary-form__text"><?php echo $content; ?></div>
            <?php endif; ?>
            <?php if( $form ): ?>
                <div class="culinary-form__form"><?php echo $form; ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
