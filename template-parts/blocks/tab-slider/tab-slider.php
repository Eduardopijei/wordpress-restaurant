<?php

/**
 * Tab Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'tab-slider-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tab tab-slider';
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
        <?php if (have_rows('tab_links')) : ?>
        <div class="tab-links tab-slider__links">
            <?php while (have_rows('tab_links')) : the_row(); ?>
                <a href="#<?php echo esc_attr($id) . get_row_index(); ?>" 
                    class="tab-link tab-slider__link <?php echo get_row_index() == 1 ? 'active' : ''; ?>">
                    <?php the_sub_field('name'); ?>
                </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <?php if (have_rows('tab_links')) : ?>
        <div class="tab-selects">
            <select name="" id="" class="tab-slider__select tab-select">
            <?php while (have_rows('tab_links')) : the_row(); ?>
                <option value="#<?php echo esc_attr($id) . get_row_index(); ?>"><?php the_sub_field('name'); ?></option>
            <?php endwhile; ?>
            </select>
        </div>
        <?php endif; ?>
        <?php if (have_rows('tab_contents')) : ?>
            <div class="tab-contents tab-slider__contents">
                <?php while (have_rows('tab_contents')) : the_row(); ?>
                    <div class="tab-content tab-slider__content <?php echo get_row_index() == 1 ? 'active' : ''; ?>" 
                        id="<?php echo esc_attr($id) . get_row_index(); ?>">
                        <?php if (have_rows('sliders')) : ?>
                            <div class="slider">
                                <div class="slides slides-images">
                                    <?php while(have_rows('sliders')) : the_row(); 
                                    $image = get_sub_field('image'); ?>
                                        <div class="slide">
                                            <div class="slide-img">
                                                <?php if( $video = get_sub_field( 'video' ) ): ?>
                                                    <video loop autoplay playsinline muted preload="metadata" src="<?php echo $video; ?>">
                                                        <source src="<?php echo $video; ?>" type="video/mp4">
                                                    </video>
                                                <?php elseif( $video = get_sub_field( 'video_url' ) ): ?>
                                                    <iframe src="https://player.vimeo.com/video/<?php echo $video; ?>?autoplay=true&controls=false&loop=true&muted=true" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                <?php elseif( $image ): ?>
                                                    <a href="<?php echo $image['url']; ?>" data-fancybox="gallery" rel="<?php echo $id; ?>" data-caption="<?php the_sub_field('caption'); ?>">
                                                        <img class="lazyload" data-src="<?php echo $image['sizes']['slide-image']; ?>" alt="<?php echo $image['alt']; ?>">
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
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            
        <?php endif; ?>
    </div>
</section>