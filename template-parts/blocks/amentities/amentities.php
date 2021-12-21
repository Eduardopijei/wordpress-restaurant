<?php
/**
 * Amentities Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'amentities-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'amentities';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
global $post;
$pid = $post->ID;
$amentities = get_field( 'amentites', $pid );
$size = get_field( 'size', $pid );
// Load values and assign defaults.
$blocks = parse_blocks( get_the_content( ) ); 
$booking_link;
foreach( $blocks as $block ): 
    if( $block['blockName'] == 'acf/single-room-booking' ):
        $booking_link = $block['attrs']['data']['booking_param'];
    endif;
endforeach;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="amentities-inner">
        <div class="amentities-content">
            <div class="amentities-content__body">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'amentities-heading' ) ); ?>
                <?php if( $amentities ): ?>
                    <div class="amentities-text">
                        <?php echo $amentities; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if( $size ): ?>
            <div class="amentities-content__footer">
                <div class="amentities-size"><?php echo $size; ?> <small>SQ. FT.</small></div>
                <a href="#" class="btn btn-view-gallery">View More</a>
            </div>
            <?php endif; ?>
        </div>
        <?php if( $images = get_field( 'images' ) ): ?>  
        <div class="amentities-images">
            <div class="amentities-carousel">
                <?php foreach( $images as $image ): ?>
                    <div class="amentities-image">
                        <img class="lazyload" 
                            data-src="<?php echo $image['sizes']['amentities']; ?>"
                            data-srcset="<?php echo $image['sizes']['amentities-2x']; ?>" 
                            alt="<?php echo $image['alt']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div id="<?php echo esc_attr($id) . '-popup'; ?>" class="popup-block">
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
            </div>
            <div class="popup-block__content">
                <div class="popup-block__content--inner">
                    <h2 class="popup-block__heading"><?php echo get_the_title( ); ?></h2>
                    <div class="three-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="popup-block__text"><?php echo $amentities; ?></div>
                </div>
                <?php if( $booking_link ): ?>
                <div class="popup-block__content--footer">
                    <a href="<?php echo $booking_link; ?>" class="btn btn--primary">Inquire</a>
                </div>
                <?php endif; ?>
                <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary popup-block__cta', 'w' => 'div', 'wc' => 'popup-block__content--footer' ) ); ?>
            </div>
        </div>
    </div>
</section>
