<?php
/**
 * Popup Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'popup-block-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'popup-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <button class="popup-block__close">
        <svg viewBox="0 0 40 42" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="37.9413" y1="40.0607" x2="1.9413" y2="4.06066" stroke="#2F2F2F" stroke-width="3"/>
            <line x1="1.93934" y1="37.9393" x2="37.9393" y2="1.93934" stroke="#2F2F2F" stroke-width="3"/>
        </svg>
    </button>
    <div class="popup-block__inner">
        <div class="popup-block__images">
            <div class="popup-block__slides">
                <?php $images = get_field( 'images' );
                foreach( $images as $image ): ?>
                <div class="popup-block__slide">
                    <img class="lazyload" 
                        data-src="<?php echo $image['sizes']['popup']; ?>" 
                        data-srcset="<?php echo $image['sizes']['popup-2x']; ?> 2x" 
                        alt="<?php echo $image['alt']; ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'caption', 'o' => 'f', 't' => 'span', 'tc' => 'popup-block__images--caption') ); ?>
        </div>
        <div class="popup-block__content">
            <div class="popup-block__content--inner">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f',  't' => 'h2', 'tc' => 'popup-block__heading' ) ); ?>
                <div class="three-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f',  't' => 'h6', 'tc' => 'popup-block__subheading' ) ); ?>
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f',  't' => 'div', 'tc' => 'popup-block__text' ) ); ?>
            </div>
            <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary popup-block__cta', 'w' => 'div', 'wc' => 'popup-block__content--footer' ) ); ?>
        </div>
    </div>
</div>