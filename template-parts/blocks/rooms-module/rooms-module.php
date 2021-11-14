<?php

/**
 * Rooms Module Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'rooms-module-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rooms-module';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'rooms-module__heading a-up' ) ); ?>
    </div>
    <?php if( have_rows( 'rooms' ) ): ?>
        <div class="rooms-module__slides--wrapper">
            <div class="rooms-module__slides circle-arrow">
                <?php while( have_rows( 'rooms' ) ): the_row(); ?>
                    <div class="rooms-module__slide">
                        <div class="rooms-module__slide--image gradient-overlay">
                            <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'c' => 'rooms-module__slide--bg' ) ); ?>
                        </div>
                        <div class="rooms-module__slide--box">
                            <div class="rooms-module__slide--box-header">Best Rate</div>
                            <div class="rooms-module__slide--box-body">
                                $<?php echo the_sub_field( 'price' ); ?>
                            </div>
                            <div class="rooms-module__slide--box-footer">
                                See Rate Options
                            </div>
                        </div>
                        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'name', 't' => 'h6', 'tc' => 'rooms-module__slide--subheading') ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="rooms-module__links">
                <?php while( have_rows( 'rooms') ): the_row(); ?>
                <a href="#" class="rooms-module__link <?php echo get_row_index() == 1 ? 'active' : ''; ?>">
                    <?php the_sub_field( 'name' ); ?>
                </a>
                <?php endwhile; ?> 
            </div>
        </div>
    <?php endif; ?>

    <?php if( have_rows( 'rooms' ) ): ?>
        <div class="rooms-module__slides--buttons">
            <?php while( have_rows( 'rooms' ) ): the_row(); ?>
                <div class="rooms-module__slide">
                    <div class="rooms-module__slide--buttons">
                        <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'c' => 'btn btn-room' ) ); ?>
                        <?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'booking', 'c' => 'btn btn--primary btn-booking' ) ); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>
