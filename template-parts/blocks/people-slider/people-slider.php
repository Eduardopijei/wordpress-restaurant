<?php

/**
 * Peoople Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'people-slider-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'people-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field( 'heading' );
$peoples = get_field( 'peoples' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container"> 
        <?php if( $heading ) : ?> 
            <h2 class="people-slider__heading"><?php echo $heading; ?></h2>
        <?php endif; ?>
    </div>
    <?php if( $peoples ) : ?>
        <div class="peoples">
            <?php 
            foreach( $peoples as $post ) : 
                get_template_part( 'templates/loop', 'people', array( 'id' => $post ) );
            endforeach; 
            ?>
        </div>
    <?php endif; ?>
</section>