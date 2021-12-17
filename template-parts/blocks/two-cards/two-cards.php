<?php

/**
 * Two Image Cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'two-cards-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'two-cards';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$opacity = get_field( 'gradient_opacity' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if( have_rows( 'cards' ) ): ?>
            <div class="two-cards__inner a-up">
                <?php while( have_rows( 'cards' ) ): the_row(); ?>
                    <div class="card">
                        <div class="card-image">
                            <?php if( $video = get_sub_field( 'video' ) ): ?>
                                    <video loop autoplay playsinline muted preload="metadata" src="<?php echo $video; ?>" poster="<?php echo $image; ?>">
                                        <source src="<?php echo $video; ?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php else: ?>
                                <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'image', 'is' => 'two-cards', 'w' => 'div', 'wc' => 'card-image gradient-overlay' ) ); ?>
                            <?php endif; ?>
                            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'h6', 'tc' => 'card-title' ) ); ?>
                        </div>
                        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 't' => 'p', 'tc' => 'card-description' ) ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<style>
    #<?php echo $id; ?> .card-image::after {
        opacity: <?php echo floatval(intval($opacity) / 100); ?> !important;
    }
</style>