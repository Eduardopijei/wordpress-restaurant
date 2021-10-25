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
$images = get_field( 'carousel' );
$heading = get_field( 'heading' );
$tags = get_field( 'tags' );
$size = get_field( 'size' );
$booking = get_field( 'booking_url' );
$category = get_field( 'rooms_type' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
   <div class="room-carousel">
       <?php if( $images ) : ?> 
        <div class="room-carousel__images">
            <?php foreach( $images as $image ) : ?>
            <div class="room-carousel__image gradient-overlay">
                <img src="<?php echo $image['sizes']['room-slider-big']; ?>"
                    srcset="<?php echo $image['sizes']['room-slider-big-2x']; ?> 2x" 
                    alt="<?php echo $image['alt']; ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if( $size ) : ?>
            <p class="room-carousel__size"><?php echo $size; ?></p>
        <?php endif; ?>
        <div class="room-carousel__content">
            <div class="room-carousel__info">
                <?php if( $heading ) : ?>
                    <h2 class="room-carousel__heading"><?php echo $heading; ?></h2>
                <?php endif; ?>
                <?php if( $tags ) : ?>
                    <p class="room-carousel__tags"><?php echo $tags; ?></p> 
                <?php endif; ?>
            </div>
            <div class="button-groups">
                <button class="btn btn--outline btn-toggle-slider">
                    View All
                </button>
                <?php if( $booking ) : ?>
                    <a href="<?php echo $booking; ?>" class="btn btn--accent" target="_blank">
                        Reserve Now
                    </a>
                <?php endif; ?>
            </div>
        </div>
   </div>
   <div class="room-slider__wrapper">
       <button class="btn-close__rooms">
            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26 26L1 1" stroke="white" stroke-width="1.5"/>
                <path d="M0.999999 26L26 1" stroke="white" stroke-width="1.5"/>
            </svg>
       </button>
       <div class="room-slider">
            <?php 
            $args = array(
                'post_type'         => 'room',
                'post_status'       => 'publish',
                'posts_per_page'    => -1,
                'tax_query'         => array(
                    array(
                        'taxonomy'  => 'room_category',
                        'field'     => 'term_id',
                        'terms'     => $category
                    )
                )
            );
            $query = new WP_Query( $args );
            if( $query->have_posts( ) ) : 
                while( $query->have_posts( ) ) : $query->the_post();
                    get_template_part('templates/loop', 'room');
                endwhile;
            endif; 
            wp_reset_query(  );
            ?>
       </div>
   </div>
</section>

<style>
    #<?php echo $id; ?> .home-hero::after {
        opacity: <?php echo floatval(intval($opacity) / 100); ?> !important;
    }
  
</style>