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
                            
                            <?php if( $matterport = get_sub_field( 'matterport_link' ) ): ?>
                                <a href="<?php echo $matterport; ?>" class="matterport" target="_blank">
                                    <svg width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 0L0 7.5V22.6637L14 30L28 22.6637V7.58125L14 0V0ZM12.7273 26.5L4.24582 22.0563L9.59254 18.555C10.9671 17.6562 9.50855 15.6062 8.01055 16.5863L2.54545 20.1637V10.2875L12.7273 15.7413V26.5ZM3.98745 8.2125L12.7273 3.53V9.0625C12.7273 10.7162 15.2727 10.7175 15.2727 9.0625V3.54375L24.0673 8.3075L14.0064 13.58L3.98745 8.2125ZM15.2727 15.75L25.4545 10.4138V20.1637L20.0289 16.6112C18.5258 15.63 17.0724 17.68 18.4444 18.5788L23.7542 22.055L15.2727 26.5V15.75Z" fill="white"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'c' => 'rooms-module__slide--bg' ) ); ?>
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
