<?php

/**
 * Hover Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'hover-carousel-' . $block['id'];


// Create class attribute allowing for custom "className" and "align" values.
$className = 'hover-section hover-carousel hover-carousel--slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
?>
<?php if (have_rows('slides')) : ?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="hover-carousel__images">
            <?php while (have_rows('slides')) : the_row(); 
                $image = get_sub_field('image'); ?>
                <div class="hover-section__image hover-carousel__image <?php echo (get_row_index() == 1) ? 'active' : ''; ?>" 
                    data-index="<?php echo get_row_index(); ?>"
                    style="background-image: url(<?php echo $image['url']; ?>);"></div>
            <?php endwhile; ?>
        </div>
    <div class="container hover-carousel__inner">
        <?php if ($heading) : ?>
            <h2 class="hover-carousel__heading"><?php echo $heading; ?></h2>
        <?php endif; ?>
        <?php if (have_rows('slides')) : ?>
            <div class="hover-carousel__links">
                <?php while (have_rows('slides')) : the_row(); 
                    $link = get_sub_field('link'); 
                    if (get_row_index() == 1) :
                        $cta = $link; 
                    endif; ?>
                    <a href="<?php echo $link['url']; ?>" 
                        class="hover-section__link hover-carousel__link cta <?php echo (get_row_index() == 1) ? 'active' : ''; ?>" 
                        target="<?php echo $link['target']; ?>"
                        data-index="<?php echo get_row_index(); ?>">
                        <?php echo $link['title']; ?>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <a class="hover-carousel__cta" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>">
                <?php echo $cta['title']; ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="hover-carousel__slider">
        <?php while (have_rows('slides')) : the_row(); 
            $image = get_sub_field('image'); 
            $link = get_sub_field('link'); ?>
            <div class="hover-carousel__slide">
                <img class="hover-carousel__slide--img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="hover-carousel__slide--link">
                    <?php echo $link['title']; ?>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>