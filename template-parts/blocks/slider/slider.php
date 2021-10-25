<?php

/**
 * Custom Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'slider-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
?>
<?php if (have_rows('sliders')) : ?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="slides slides-images">
            <?php while(have_rows('sliders')) : the_row(); ?>
                <div class="slide">
                    <div class="slide-img">
                        <?php if ($image = get_sub_field('image')): ?>
                            <a href="<?php echo $image['url']; ?>" data-fancybox="gallery" rel="<?php echo $id; ?>" data-caption="<?php the_sub_field('caption'); ?>">
                                <img src="<?php echo $image['sizes']['slide-image']; ?>" alt="<?php echo $image['alt']; ?>">
                            </a>
                        <?php endif; ?>
                        <?php if ($caption = get_sub_field('caption')) : ?>
                            <p class="slide-caption"><?php echo $caption; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="slides slides-contents">
            <?php while(have_rows('sliders')) : the_row(); ?>
                <div class="slide">
                    <div class="slide-content">
                        <?php if ($title = get_sub_field('title')) : ?>
                            <h6 class="slide-title"><?php echo $title; ?></h6>
                        <?php endif; ?>
                        <?php if ($desc = get_sub_field('text')) : ?>
                            <p class="slide-desc"><?php echo $desc; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>