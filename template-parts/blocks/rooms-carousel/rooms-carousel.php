<?php

/**
 * Rooms Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'rooms-carousel-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rooms-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$price = get_field( 'price' );
$direction = get_field( 'content_direction' ) ? ' rooms-carousel--left' : ' rooms-carousel--right'; 
$className .= $direction;
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
   <div class="rooms-carousel__inner">
       <div class="rooms-carousel__images">
            <?php if( have_rows( 'carousel' ) ): ?>
            <div class="rooms-carousel__slides">
                <?php while( have_rows( 'carousel' ) ): the_row(); ?>
                    <div class="rooms-carousel__slide gradient-overlay">
                        <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'is' => 'rooms-slider', 'c' => 'main-bg' ) ); ?>
                        <?php 
                        $secondary_image = get_sub_field( 'secondary_image' );
                        $video = get_sub_field( 'secondary_video' );
                        if( $secondary_image ||  $video ): ?>
                            <div class="rooms-carousel__slide-sec">
                                <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'is' => 'rooms-slider-sub', 'c' => 'sub-bg' ) ); ?>
                                <?php if( $video ): ?>
                                    <a href="<?php echo $video; ?>" class="btn-play" data-fancybox>
                                        <svg width="62" height="62" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30.5593" cy="31.4273" r="30.0593" transform="rotate(-90 30.5593 31.4273)" stroke="white"/>
                                            <path d="M37.0703 30.926L26.5499 36.9999L26.5499 24.852L37.0703 30.926Z" fill="white"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div> 
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
            <?php if( $price ): ?> 
            <div class="rooms-carousel__box">
                <div class="rooms-carousel__box-header">Best Rate</div>
                <?php if( $price ) : ?>
                    <div class="rooms-carousel__box-body">$<?php echo $price; ?></div>
                <?php endif; ?>
                <div class="rooms-carousel__box-footer">See Rate Options</div>
            </div>
            <?php endif; ?>
       </div>
       <div class="rooms-carousel__content">
           <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'rooms-carousel__heading' ) ); ?>
           <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f', 't' => 'h6', 'tc' => 'rooms-carousel__subheading' ) ); ?>
           <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'text', 'o' => 'f', 't' => 'div', 'tc' => 'rooms-carousel__text' ) ); ?>
           <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn-room', 'w' => 'div' ) ); ?>
           <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'booking_cta', 'o' => 'f', 'c' => 'btn btn--primary btn-booking', 'w' => 'div' ) ); ?>
       </div>
   </div>
</section>

<style>
    #<?php echo $id; ?> .home-hero::after {
        opacity: <?php echo floatval(intval($opacity) / 100); ?> !important;
    }
  
</style>