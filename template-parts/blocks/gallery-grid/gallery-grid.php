<?php

/**
 * Gallery Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'gallery-grid-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gallery-grid';
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
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h1', 'tc' => 'gallery-grid__heading') ); ?>
        <?php if( have_rows( 'galleries' ) ): ?>
            <div class="gallery-grid__filter">
                <select name="" id="" class="gallery-grid__select" jcf-select>
                    <option value="all">All Images</option>
                    <?php while( have_rows( 'galleries' ) ): the_row(); ?>
                        <option value="<?php echo $id . get_row_index(); ?>"><?php the_sub_field( 'category' ); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="gallery-grids">
                <?php while( have_rows( 'galleries' ) ): the_row(); ?>
                    <div class="gallery-images" data-cat="<?php echo $id . get_row_index(); ?>">
                        <div class="grid-sizer"></div>
                        <?php $images = get_sub_field( 'gallery' );
                        foreach( $images as $image ): ?>
                            <div class="gallery-image">
                                <img data-fancybox="gallery" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>