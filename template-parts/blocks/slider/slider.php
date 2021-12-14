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
            <?php while(have_rows('sliders')) : the_row(); 
                $image = get_sub_field('image'); ?>
                <div class="slide">
                    <div class="slide-img">
                        <?php if( $video = get_sub_field( 'video' ) ): ?>
                            <a href="<?php echo $video; ?>" data-fancybox="gallery" rel="<?php echo $id; ?>"  data-caption="<?php the_sub_field('caption'); ?>">
                                <img class="lazyload" data-src="<?php echo $image['sizes']['slide-image']; ?>" alt="<?php echo $image['alt']; ?>">
                                <span class="play">
                                    <svg width="103" height="103" viewBox="0 0 103 103" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="51.5" cy="51.5" r="50.5" fill="black" fill-opacity="0.25" stroke="white" stroke-width="2"/>
                                        <path d="M66.6016 51.5L43.9493 64.5783L43.9493 38.4217L66.6016 51.5Z" fill="#F5F6F1"/>
                                    </svg>
                                </span>
                            </a>
                        <?php else: ?>
                            <?php if( $image ): ?>
                                <a href="<?php echo $image['url']; ?>" data-fancybox="gallery" rel="<?php echo $id; ?>" data-caption="<?php the_sub_field('caption'); ?>">
                                    <img class="lazyload" data-src="<?php echo $image['sizes']['slide-image']; ?>" alt="<?php echo $image['alt']; ?>">
                                </a>
                            <?php endif; ?>
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