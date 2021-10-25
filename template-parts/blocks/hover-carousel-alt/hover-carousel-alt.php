<?php

/**
 * Hover Carousel Alt Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'hover-carousel-alt-' . $block['id'];


// Create class attribute allowing for custom "className" and "align" values.
$className = 'hover-section hover-carousel-alt';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$content = get_field( 'content' );
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="hover-carousel-alt__inner two-col-content">
            <?php if ($heading) : ?>
                <h2 class="hover-carousel-alt__heading a-up"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php if( $content ) : ?>
                <div class="hover-carousel-alt__content a-up a-delay-1"><?php echo $content; ?></div>
            <?php endif; ?>
        </div>
        <?php if (have_rows('slides')) : ?>
            <div class="hover-carousel-alt__links a-up a-delay-2">
                <?php while (have_rows('slides')) : the_row(); 
                    $link = get_sub_field('anchor');  ?>
                    <a href="#" 
                        class="hover-section__link hover-carousel-alt__link cta cta-reverse <?php echo (get_row_index() == 1) ? 'active' : ''; ?>" 
                        data-index="<?php echo get_row_index(); ?>">
                        <?php echo $link; ?>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if (have_rows('slides')) : ?>
        <div class=" hover-carousel-alt__selects a-up a-delay-2">
            <select name="" id="" class="hover-section__select hover-carousel-alt-select">
                <?php while (have_rows('slides')) : the_row(); ?>
                    <option value="<?php echo get_row_index(); ?>"><?php the_sub_field('anchor'); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <?php endif; ?>
    </div>
    <?php if (have_rows('slides')) : ?>
        <div class="hover-carousel-alt__images a-up a-delay-3">
            <?php while (have_rows('slides')) : the_row(); 
                $image = get_sub_field('image'); ?>
                <img class="hover-section__image hover-carousel-alt__image <?php echo (get_row_index() == 1) ? 'active' : ''; ?>" 
                    data-index="<?php echo get_row_index(); ?>"
                    src="<?php echo $image; ?>" alt="" />
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>