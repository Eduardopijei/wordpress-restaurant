<?php

/**
 * Single Room Booking Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'single-room-booking-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'single-room-booking';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
global $post;
$heading = get_field( 'heading' );
$desc = get_field( 'description' );
$direct_contact = get_field( 'direct_contact' );
$contact = get_field( 'contact' );
$cta = get_field( 'cta' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="single-room-booking__inner">
            <div class="single-room-booking__content">
                <?php if( $heading ): ?>
                    <h6 class="title a-up"><?php echo $heading; ?></h6>
                <?php endif; ?>
                <?php if( $desc ): ?>
                    <div class="desc a-up a-delay-1"><?php echo $desc; ?></div>
                <?php endif; ?>
                <div class="contact a-up a-delay-2">
                    <?php if( $direct_contact ): ?>
                        <a href="<?php echo $direct_contact['url']; ?>" class="contact-direct" target="<?php echo $direct_contact['target']; ?>">
                            <?php echo $direct_contact['title']; ?>
                        </a>
                    <?php endif; ?>
                    <?php if( $direct_contact && $contact ): ?>
                        <span class="contact-separator"></span>
                    <?php endif; ?>
                    <?php if( $contact ): ?>
                        <a href="<?php echo $contact['url']; ?>" class="contact-phone" target="<?php echo $contact['target']; ?>">
                            <?php echo $contact['title']; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if( $cta ): ?>
                <div class="button-groups a-up a-delay-3">
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn-amentities' ) ); ?>
                    <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'booking', 'o' => 'f', 'c' => 'btn btn--primary btn-booking' ) ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="single-room-booking__calendar a-up">
                <input type="text" class="booking-range" id="booking-range">
                <div class="booking-calendar" id="booking-calendar">
                </div>
                <a href="https://reservations.bostonharborhotel.com/?Hotel=26834&shell=rBOSHA&chain=10237&template=rBOSHA<?php echo get_field('booking_param'); ?>" class="btn btn--primary btn-check-availability" target="_blank">Check Availability</a>
            </div>
        </div>
    </div>
</section>
